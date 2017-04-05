<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use common\models\sys\User;
use common\components\SignUtil;
use common\components\library\ShowMessage;
use common\components\verify\Verify;
use common\models\sys\UserRole;
use common\models\sys\UserInfo;

class LoginController extends Controller{

    public function actionIndex(){
        $this->layout = FALSE;
        return $this->render('login');
    }

    /**
     *显示验证码
     */
    function actionVerify()
    {
        $checkcode = new Verify();
        $checkcode->doimg();
    }

    /**
     * 登陆验证
     * @return \yii\web\Response
     */
    function actionLogin()
    {
        if (Yii::$app->request->isPost) {
            $code = Yii::$app->session->get('verify');
            $referer = Yii::$app->request->post('referer');
            $info = Yii::$app->request->post('info');
            $loginUrl = Url::toRoute('/login/index');
            if (! $info['verifyCode'] || strtolower($info['verifyCode']) != strtolower($code)) {
                ShowMessage::info("验证码为空或不正确", $loginUrl);
            }
            if (! $info['adminuser'] || ! $info['adminpass']) {
                ShowMessage::info("用户名或密码不能为空", $loginUrl);
            }
            $mInfo = User::find()->where(['username' => $info['adminuser']])->one();
            if (! $mInfo) {
                ShowMessage::info("用户不存在", $loginUrl);
            }
            if(!empty($mInfo['unique_code'])){
                ShowMessage::info("不是本系统用户", $loginUrl);
            }
            if (User::hashPwd($info['adminpass']) != $mInfo['password']) {
                ShowMessage::info("密码错误", $loginUrl);
            }
            if ($mInfo['status'] == 1) {
                ShowMessage::info("该用户被禁用", $loginUrl);
            }
            $this->_saveUserInfo($mInfo);

            if($mInfo->save()){
                $mainUrl = "/main";
                return $this->redirect($mainUrl);
            }else{
                ShowMessage::info("登录失败", $loginUrl);
            }
        }else{
            $this->redirect(Url::toRoute('/login/index'));
        }
    }

    private function _saveUserInfo(User $mInfo){
        $userRole = UserRole::getUserRole($mInfo->id);
        if (empty($userRole)){
            $roleid = 0;
        }else{
            //$roleid = $userRole[0];
            //将$userRole[0] 改为 $userRole lixiaobin 2016-12-26
            if(count($userRole) == 1){
                $roleid = $userRole[0];
            }else{
                $roleid = $userRole;
            }
        }

        Yii::$app->session->set("username", $mInfo->username);
        Yii::$app->session->set("realname", $mInfo->realname);
        Yii::$app->session->set("sessionid", Yii::$app->session->getId());
        Yii::$app->session->set("userid", $mInfo->id);
        Yii::$app->session->set("roleid", $roleid);

        $userInfo = UserInfo::find()->where(['userid'=>$mInfo->id])->one();
        $userInfo->ip = $_SERVER['REMOTE_ADDR'];
        $userInfo->login_time = date("Y-m-d H:i:s");
        $userInfo->login_num = $userInfo->login_num + 1;
        $userInfo->save();
        return;
    }

    /**
     * 退出
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->session->removeAll();
        return $this->redirect(Url::toRoute('/login'));
    }


}
