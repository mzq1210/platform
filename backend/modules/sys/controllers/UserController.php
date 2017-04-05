<?php
/**
 * 用户控制器类
 * User: zhangshaohua
 * Date: 16-10-21
 */
namespace app\modules\sys\controllers;

use Yii;
use common\models\sys\Role;
use common\models\sys\UserRole;
use common\models\sys\UserInfo;
use common\components\library\ShowMessage;
use common\components\Validate;
use common\models\sys\User;
use app\components\base\BaseController;
use yii\helpers\Url;

class UserController extends BaseController{

    /**
     * @Desc:   用户信息
     * @Author: < zhangshaohua >
     * @return: array
     */
    public function actionIndex(){
        $name = $this->request->get('name', '');
        $pageSize = $this->request->get('per-page', PAGESIZE);

        $info = User::searchUser($name,$pageSize);
        return $this->render('index', [
            'info' => $info['data'],
            'name' => $name,
            'pages' => $info['pages']
        ]);
    }

    /**
     * @Desc:   添加用戶
     * @Author: < zhangshaohua >
     * @return: bool
     */
    public function actionAdd(){
        if($this->request->isPost){
            $params = $this->request->post('user');
            (Validate::isOverMaxLen($params['username'],30) || Validate::isLowMinLen($params['username'],3)) && ShowMessage::info("用户名不能低于3位或超出30位！");

            (User::checkName($params['username'],0)) && ShowMessage::info("该用户已经注册！");

            Validate::isLowMinLen($params['realname'],1) && ShowMessage::info("真实姓名不能为空");

            (Validate::isOverMaxLen($params['realname'],20) || Validate::isLowMinLen($params['username'],3)) && ShowMessage::info("真实姓名不能低于3位或超出20位！");

            (Validate::isOverMaxLen($params['password'],20) || Validate::isLowMinLen($params['password'],6)) && ShowMessage::info("密码不能低于6位或超出16位！");

            !Validate::isMobilePhone($params['mobile']) && ShowMessage::info("请输入正确手机号！",Url::toRoute('/sys/user/create'),1000);

            User::checkPhone($params['mobile'],0) && ShowMessage::info("该手机号已经注册！");

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $params['password'] = User::hashPwd($params['password']);
                $params['creator'] = $this->userid;
                $params['updater'] = $this->userid;
                $userModel = new User();
                $userModel->setAttributes($params,false);
                $userModel->save();
                $user_info_array = array(
                    'userid'   => $userModel->attributes['id'],
                    'add_time'  => $this->datetime,
                    'edit_time' => $this->datetime,
                );
                $userInfoModel = new UserInfo();
                $userInfoModel->setAttributes($user_info_array,false);
                $userInfoModel->save();
                $transaction->commit();
                ShowMessage::info('添加成功',Url::toRoute(['/sys/user/index']),'','add');
            } catch (Exception $e) {
                $transaction->rollBack();
                ShowMessage::info('添加失败',Url::toRoute(['/sys/user/index']),1000);
            }
        }else{
            return $this->render('add');
        }

    }

    /**
     * @Desc:   修改用户信息
     * @Author: < zhangshaohua >
     * @param:  int $id 用户id
     * @return: bool
     */
    public function actionEdit($id){
        if(!empty($id)){
            $userModel = User::selUser($id);
            if($this->request->isPost){
                $params = $this->request->post('user');
                (Validate::isOverMaxLen($params['username'],30) || Validate::isLowMinLen($params['username'],3)) && ShowMessage::info("用户名不能低于3位或超出30位！");

                User::checkName($params['username'],$id) && ShowMessage::info("该用户已经注册！");

                Validate::isLowMinLen($params['realname'],1) && ShowMessage::info("真实姓名不能为空");

                (Validate::isOverMaxLen($params['realname'],20) || Validate::isLowMinLen($params['username'],3)) && ShowMessage::info("真实姓名不能低于3位或超出20位！");

                !empty($params['password']) && (Validate::isOverMaxLen($params['password'], 20) || Validate::isLowMinLen($params['password'], 6)) && ShowMessage::info("密码不能低于6位或超出20位！");

                !Validate::isMobilePhone($params['mobile']) &&ShowMessage::info("请输入正确手机号！",Url::toRoute('/sys/user/create'),1000);

                (User::checkPhone($params['mobile'],$id)) && ShowMessage::info("该手机号已经注册！");

                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if(!empty($params['password'])){
                        $params['password'] = User::hashPwd($params['password']);
                    } else{
                        $params['password'] = $userModel->password;
                    }
                    $params['updater'] = $this->userid;
                    $userModel->setAttributes($params,false);
                    $userModel->save();
                    $userInfoModel = UserInfo::getUserInfo($userModel->attributes['id']);
                    $user_info_array = array(
                        'userid'   => $userModel->attributes['id'],
                        'edit_time' => $this->datetime,
                    );
                    $userInfoModel->setAttributes($user_info_array,false);
                    $userInfoModel->save();
                    $transaction->commit();
                    ShowMessage::info('修改成功',Url::toRoute(['/sys/user/index']),'','edit');
                } catch (Exception $e) {
                    $transaction->rollBack();
                    ShowMessage::info('修改失败',Url::toRoute(['/sys/user/index']),1000);
                }
            }else {
                return $this->render('edit',[
                    'model'    => $userModel
                ]);
            }
        }else{
            ShowMessage::info('请求错误！',Url::toRoute('/sys/user/index',10));
        }
    }

    /**
     * @Desc:   ajax验证user表里用户名是否已经存在
     * @Author: < zhangshaohua >
     * @param:  int $id 用户id
     * @param:  string $username 验证用户名
     * @return: string
     */
    public function actionCheckname_ajax() {
        if (Yii::$app->request->isAjax) {
            $username = Yii::$app->request->get('User-username');
            $id = Yii::$app->request->get('id');
            if (!empty($id)) {
                $userInfo = User::find()->where('username=:username and id !=:id', [':username' => $username, ':id' => $id])->one();
            } else {
                $userInfo = User::find()->where(['username' => $username])->one();
            }
            if (!empty($userInfo)) {
                echo 200;die;  //返回该用户名已经注册
            } else {
                echo 201;die;
            }
        } else {
            echo 201;die;
        }
    }

    /**
     * @Desc:   ajax验证user表里手机是否已经存在
     * @Author: < zhangshaohua >
     * @param:  int $id 用户id
     * @param:  string $mobile 验证用户手机号
     * @return: string
     */
    public function actionCheckphone_ajax() {
        if (Yii::$app->request->isAjax) {
            $mobile = Yii::$app->request->get('User-mobile');
            $id = Yii::$app->request->get('id');
            if (!empty($id)) {
                $phoneInfo = User::find()->where('mobile=:mobile and id !=:id', [':mobile' => $mobile, ':id' => $id])->one();
            } else {
                $phoneInfo = User::find()->where(['mobile' => $mobile])->one();
            }
            if (!empty($phoneInfo)) {
                echo 200;die;  //返回该手机号码已经注册
            } else {
                echo 201;die;
            }
        } else {
            echo 200;die;
        }
    }

    /**
     * @Desc:   ajax验证密码是否正确
     * @Author: < zhangshaohua >
     * @param:  string $oldpass 验证密码
     * @param:  int    $userid  验证用户id
     * @return: string
     */
    public function actionCheckpass_ajax(){
        if (Yii::$app->request->isAjax) {
            $oldpass = Yii::$app->request->post('old_pass');
            $userid = Yii::$app->request->post('userid');
            $user = User::selUser($userid);
            if(!empty($user)) {
                if (User::hashPwd($oldpass) == $user->password) {
                    echo json_encode(['status' => 200]);
                }else{
                    echo json_encode(['status' => 201]);
                }
            }else{
                echo json_encode(['status' => 201]);
            }
        }
    }

    /**
     * @Desc:   添加角色
     * @Author: < zhangshaohua >
     * @return: arrry
     */
    public function actionAllowrole ($id) {
        if(!empty($id)){
            $role = Role::find()->where(['del_flag'=>0])->all();
            if (Yii::$app->request->isPost) {
                $params = Yii::$app->request->post();
                if(empty($params['roleid'])){
                    ShowMessage::info("请选择角色！");
                }
                UserRole::deleteAll('userid=:userid',[':userid'=>$params['user_id']]);
                foreach ($params['roleid'] as $val){
                    $usrRoleModel = new UserRole();
                    $user_role_array = array(
                        'userid'   => $params['user_id'],
                        'roleid' => $val,
                        'add_time' => $this->datetime,
                    );
                    $usrRoleModel->setAttributes($user_role_array,false);
                    $flag=$usrRoleModel->save();
                }
                if($flag){
                    ShowMessage::info('添加成功', Url::toRoute(['/sys/user/index']), '', 'edit');
                }
            } else {
                return $this->render('allowrole', [
                    'role' => $role,
                    'userid' => $id
                ]);
            }
        }else{
            ShowMessage::info('请求错误！',Url::toRoute('/sys/user/index',10));
        }
    }

    /**
     * @Desc:   删除用户
     * @Author: < zhangshaohua >
     * @return: bool
     */
    public function actionDelete($id) {
        $user = User::selUser($id);
        if($user->del_flag != 1) {
            $params['del_flag'] = 1;
            $user->setAttributes($params,false);
            if ($user->save()) {
                ShowMessage::info('删除成功',Url::toRoute(['/sys/user/index']),'','edit');
            }else{
                ShowMessage::info('删除失败',Url::toRoute(['/sys/user/index']),1000);
            }
        }else{
            ShowMessage::info('该数据不存在',Url::toRoute(['/sys/user/index']),1000);
        }
    }

    /**
     * @Desc:   用户修改密码
     * @Author: < zhangshaohua >
     * @param:  string $oldPassword 验证原密码
     * @return: bool
     */
    public function actionEditpwd()
    {
        $user = User::selUser($this->userid);
        if (Yii::$app->request->isPost) {
            $params = Yii::$app->request->post();
            if (User::hashPwd($params['oldPassword']) != $user->password) {
                ShowMessage::info("输入的原密码不对！", Url::toRoute(['/sys/user/editpwd']));
            } else {
                $params['password'] = User::hashPwd($params['password']);
                $user->setAttributes($params, false);
                if ($user->save()) {
                    ShowMessage::info('修改成功', Url::toRoute(['/sys/user/editpwd']), '', 'edit');
                }else{
                    ShowMessage::info('修改失败', Url::toRoute(['/sys/user/editpwd']), 1000);
                }
            }
        }
        return $this->render('editpwd',['userid' => $this->userid]);
    }
    
}
