<?php
namespace frontend\controllers;

use Yii;
use app\components\base\BaseController;

class TopicController extends BaseController{

    public function actionIndex(){
        //设置所属行业
        $data1 = [
            "industry_id1" => 1,
            "industry_id2" => 4
        ];
        Yii::$app->wechat->setTemplateIndustry($data1);


        $data2 = [
            "touser" => "o8eCtv8xqFe5d41yKkJBGaiMNb3A",
            "msgtype" => "text",
            "text" =>[
                "content" => "Hello World"
            ]
        ];
        Yii::$app->wechat->sendMessage($data2);
    }
    
}