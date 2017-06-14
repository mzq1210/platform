<?php

/**
 * 微信管理控制器类
 * User: <mzq>
 * Date: 16-12-20
 */
namespace app\modules\weixin\controllers;

use Yii;
use app\components\base\WxController;

class WeixinController extends WxController
{

    //创建菜单
    public function actionSetMenu(){
        $menu = [
           [
                'type' => 'view',
                'name' => '广场',
                'url' => 'http://www.onelog.cn/index/index'
           ],
            [
                'type' => 'view',
                'name' => '发布',
                'url' => 'http://www.onelog.cn/release/index'
            ],
            [
                'type' => 'view',
                'name' => '我的',
                'url' => 'http://www.onelog.cn/weixin/user/index'
            ],

        ];

        $wechat = Yii::$app->wechat;
        $res=$wechat->createMenu($menu);
        var_dump($res);die;

    }




}