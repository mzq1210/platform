<?php

/**
 * 微信管理控制器类
 * User: <mzq>
 * Date: 16-12-20
 */
namespace app\modules\weixin\controllers;

use Yii;
use app\components\base\BaseController;

class WeixinController extends BaseController
{


    public function actionIndex()
    {
        echo 123;die;
        return $this->render('index');
    }





}