<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-10-27
 * Time: 下午5:22
 */
namespace frontend\controllers;

use Yii;
use common\models\wechat\User;
use app\components\base\BaseController;
use app\components\Cookie;
use common\models\wechat\Content;

class UserController extends BaseController{

    //个人中心
    public function actionIndex(){
        $openid = Cookie::getCookie('openid');
        $data = ['openid' => $openid];
        $UserInfo=User::getUserInfo($data);

        return $this->render('index',[
            'UserInfo'=>$UserInfo,
        ]);
    }

    //我的资料
    public function actionInfo(){
        $openid = Cookie::getCookie('openid');
        $data = ['openid' => $openid];
        $UserInfo=User::getUserInfo($data);
        
        return $this->render('info',[
                'UserInfo'=>$UserInfo,
            ]);
    }

    //我的话题
    public function actionTopic(){
        $openid = Cookie::getCookie('openid');
        if(empty($openid)){
            echo '请登录...';die;
        }
        $data = ['openid' => $openid];
        $info = User::getUserInfo($data);
        $data=Content::getUserContentList($info['id']);

        return $this->render('topic',[
            'data'=>$data,
        ]);
    }
}
