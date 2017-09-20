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


class ActivityController extends BaseController{

    //客服
    public function actionIndex(){

        return$this->renderPartial('index');
    }




}