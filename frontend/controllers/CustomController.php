<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-10-27
 * Time: 下午5:22
 */
namespace frontend\controllers;

use Yii;
use app\components\base\BaseController;


class CustomController extends BaseController{

    //客服
    public function actionIndex(){
        //获取客服组建
        $customService = Yii::$app->wechat->getCustomService();
        $list = $customService->getAccountList();
        var_dump($list);
    }


    //添加客服
    public function actionCreate(){
        //获取客服组建
        $customService = Yii::$app->wechat->getCustomService();
        $account = [
            "kf_account" => "test1@test",
            "nickname" => "客服1"
        ];
        $bool = $customService->addAccount($account);
        var_dump($bool);
    }

    //删除客服
    public function actionDelete(){
        $customService = Yii::$app->wechat->getCustomService();
        $account = [
            "kf_account" => "test1@test"
        ];
        $bool = $customService->deleteAccount($account);
    }


}