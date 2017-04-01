<?php
namespace backend\controllers;

use Yii;
use common\components\verify\Verify;
use yii\web\Controller;

class LoginController extends Controller{

    public function actionLogin(){
        $this->layout = FALSE;
        return $this->render('login');
    }

    /**
     *显示验证码
     */
    function actionVerify()
    {
        $checkcode = new Verify();
        $checkcode->doimg();
    }

}
