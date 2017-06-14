<?php
namespace app\modules\weixin\controllers;

use Yii;
use app\components\base\WxController;

class CategoryController extends WxController
{

    public function actionIndex(){
        return $this->render('index', [
//            'info' => $info,
//            'params' => $params
        ]);

    }



}








?>