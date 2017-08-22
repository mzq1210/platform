<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-10-27
 * Time: 下午5:22
 */
namespace frontend\controllers;

use Yii;
use common\models\wechat\Integration;
use app\components\base\BaseController;

class SignController extends BaseController{

    //分类下的帖子
    public function actionIndex(){
        $this->layout=false;
        $uid = $this->userid;
        $integration = Integration::getIntegration(['userID' => $uid]);

        return$this->render('index',[
            'integration' => $integration
        ]);
    }
    
}
