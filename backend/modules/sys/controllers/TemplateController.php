<?php
/**
 * 模板控制器
 * User: miaozhongqiang
 * Date: 16-12-02
 * Time: 上午10:17
 */
namespace app\modules\sys\controllers;

use Yii;
use common\models\sys\User;
use app\components\base\BaseController;

class TemplateController extends BaseController{

    /**
     * @desc:   模板
     * @author: < miaozhongqiang >
     */
    public function actionIndex(){
        $info = User::searchUser('', 10);
        return $this->render('index',[
            'info' => $info['data'],
            'pages' => $info['pages']
        ]);
    }
}
