<?php
/**
 * Created by PhpStorm.
 * User: leexb
 * Date: 17-4-6
 * Time: 上午11:03
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class ErrorController extends Controller {

    public function actionIndex() {
        return $this->renderPartial('404');
    }

}