<?php
namespace frontend\controllers;

use Yii;
use app\components\base\BaseController;

class TopicController extends BaseController{

    public function actionIndex(){
        return $this->render('index');
    }
    
}