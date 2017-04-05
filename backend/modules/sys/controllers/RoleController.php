<?php
/*
 * 角色管理控制器
 * @author miaozhongqiang
 * @date 2016-11-07 15:23
 */
namespace app\modules\sys\controllers;

use common\models\sys\UserSite;
use Yii;
use common\models\sys\Role;
use yii\helpers\Json;
use common\models\sys\Site;
use common\components\library\ShowMessage;
use yii\helpers\Url;
use common\models\sys\RoleMenu;
use app\components\base\BaseController;
use common\models\sys\UserRole;

class RoleController extends BaseController{

    /**
     * 首页列表
     * @return string
     * @author <miaozhongqiang>
     */
    public function actionIndex()
    {
        $params = $this->request->get();
        $params['per-page'] = !empty($params['per-page']) ? $params['per-page'] : PAGESIZE;

        $info = Role::search($params);
        return $this->render('index', [
            'info' => $info['data'],
            'pages' => $info['pages'],
            'params' =>$params
        ]);
    }

    /**
     * 添加角色
     * @return string
     * @author <miaozhongqiang>
     */
    public function actionAdd()
    {
        $model = new Role();
        if ($this->request->isPost) {
            $param = $this->request->post();
            if(empty($param['name'])){
                ShowMessage::info('角色名称不可为空');
            }
            $data = [
                'name'     => $param['name'],
                'desc'     => $param['desc'],
                'sort'   => $param['sort'],
                'status'   => $param['status'],
                'add_time'  => $this->datetime,
            ];
            $model->setAttributes($data,false);
            if ($model->save()) {
                ShowMessage::info('添加成功',Url::toRoute(['/sys/role/index']),'','add');
            }else{
                ShowMessage::info('添加失败');
            }
        }else {
            return $this->render('form', [
                'model' => $model
            ]);
        }
    }

    /**
     * 修改角色
     * @param int   $id  角色ID
     * @return string
     * @author <miaozhongqiang>
     */
    public function actionEdit($id)
    {
        $model = Role::findOne($id);
        if ($this->request->isPost) {
            $param = $this->request->post();
            if(empty($param['name'])){
                ShowMessage::info('角色名称不可为空');
            }
            $data = [
                'name'     => $param['name'],
                'desc'     => $param['desc'],
                'sort'   => $param['sort'],
                'status'   => $param['status'],
                'edit_time' => $this->datetime,
            ];
            $model->setAttributes($data,false);
            if ($model->save()) {
                ShowMessage::info('编辑成功',Url::toRoute(['/sys/role/index']),'','edit');
            }else{
                ShowMessage::info('编辑失败');
            }
        } else {
            $roles = Role::getRoleList();

            return $this->render('form', [
                'model' => $model,
                'roles'=>$roles
            ]);
        }
    }

    /**
     * 删除角色
     * @param int   $id  角色ID
     * @return bool|null|static
     * @author <miaozhongqiang>
     */
    public function actionDelete($id)
    {
        $model = Role::findOne($id);
        if($model->del_flag != 1) {
            $data = [
                'del_flag' => 1,
            ];
            $model->setAttributes($data,false);
            if ($model->save()) {
                ShowMessage::info('删除成功',Url::toRoute(['/sys/role/index']),'','edit');
            }else{
                ShowMessage::info('删除失败');
            }
        }else{
            ShowMessage::info('该数据不存在');
        }
    }
    
    /**
     * 选择角色
     * @Author: < zsh >
     * @return json
     */
    public function actionChoicerole_ajax(){
        if (Yii::$app->request->isAjax) {
            $result='';
            $params = $this->request->post();
            $role = Role::find()->where(['del_flag'=>0,'siteid'=>$params['siteid']])->all();
            if($role){
                foreach($role as $val){
                    $result.= '<tr>';
                    if(in_array($val->id,UserRole::getUserRole($params['userid'],$params['siteid']))){
                        $result.='<td width="15%" align="left"><input type="checkbox" name="roleid[]" checked value="'.$val->id.'"></td>';
                    }else{
                        $result.='<td width="15%" align="left"><input type="checkbox" name="roleid[]" value="'.$val->id.'"></td>';
                    }
                    $result.='<td>'.$val->name.'</td>';
                    $result.='<td>'.Site::selSite($val->siteid)['name'].'</td>';
                    $result.='<td>'.$val->desc.'</td>';
                    $result.= '</tr>';
                }
            }

            echo json_encode(['status' => 200,'result'=>$result]);
        }else{
            echo json_encode(['status' => 201]);
        }
    }

    /**
     * 权限设置
     * @author miaozhongqiang
     * @throws \yii\base\ExitException
     * @throws \yii\db\Exception
     * @author <miaozhongqiang>
     */
    public function actionRoleset()
    {
        if($post = $this->request->post()){
            $ids = $post['ids'];
            $id = $post['roleid'];
            $menuIds = array_filter(explode(',', $ids));
            $menuList = RoleMenu::getRoleMenu($id);//已经存在的角色权限

            $transaction = Yii::$app->db->beginTransaction();//开启事物
            try {
                if($menuIds) {
                    $diffMenuids = array_diff($menuIds, $menuList);//新增的权限
                    if (!empty($diffMenuids)) {
                        $insertData = [];
                        foreach ($diffMenuids as $key => $menuid) {
                            $insertData[$key][] = $id;
                            $insertData[$key][] = $menuid;
                            $insertData[$key][] = 1;
                            $insertData[$key][] = $this->datetime;
                        }
                        if (! Yii::$app->db->createCommand()->batchInsert(RoleMenu::tableName(), ['siteid', 'roleid', 'menuid', 'creator', 'add_time'], $insertData)->execute()) {
                            throw new \Exception('保存失败！');
                        }
                    }
                    $delMenuids = array_diff($menuList, $menuIds);//减少的权限
                    if(!empty($delMenuids)){
                        if(! RoleMenu::delRoleMenu($id, $delMenuids)){
                            throw new \Exception('删除失败！');
                        }
                    }
                }
                $transaction->commit();
                echo Json::encode(['status' => 200]);
            }catch (\Exception $e) {
                $transaction->rollBack();
                echo Json::encode(['status' => 201]);
            }
            Yii::$app->end();
        }
    }

}
