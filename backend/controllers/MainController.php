<?php
/**
 * Created by PhpStorm.
 * User: leexb
 * Date: 16-10-27
 * Time: 下午5:22
 */
namespace backend\controllers;

use common\components\library\ShowMessage;
use common\models\sys\Role;
use common\models\sys\UserInfo;
use Yii;
use common\models\sys\User;
use app\components\base\BaseController;

class MainController extends BaseController{

    public function actionIndex(){
        //获取菜单
        $menuTree = $this->menuTreeByRole($this->siteid, $this->roleid);
        return $this->render('index',[
            'menuTree' => $menuTree,
            'username' => $this->username,
            'third_type' => $this->session->get('third_type')
        ]);
    }

    public function actionBasics(){
        $user = User::selUser($this->userid);
        $userInfo = UserInfo::getUserInfo($this->userid);
        return $this->render('basics',[
            'mobile' => $user->mobile,
            'userInfo' => $userInfo
        ]);
        
    }

    /**
     * 开 发: 李效宾
     * 时 间: 2016-11-09
     * 说 明: 查看用户详情
     */
    public function actionDetail(){
        if(!empty($this->userid)){
            $user = User::selUser($this->userid);
            return $this->render('detail',[
                'user'    => $user
            ]);
        }else{
            ShowMessage::info('请重新登陆');
        }
    }

}