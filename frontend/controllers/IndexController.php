<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-10-27
 * Time: 下午5:22
 */
namespace frontend\controllers;

use Yii;
use yii\helpers\Json;
use common\models\wechat\Content;
use common\models\wechat\Category;
use app\components\base\BaseController;

class IndexController extends BaseController {

    /**
     * @desc 帖子列表
     * @return string
     */
    public function actionIndex(){
        $Content=new Content();
        $Category=new Category();
        if (Yii::$app->request->isAjax) {   //门店
            $post = Yii::$app->request->get();
            $page = isset($post['page'])? $post['page'] : 0;
            $size = isset($post['size'])? $post['size'] : 10;
            $data=$Content->getContentList($page, $size);
            echo Json::encode($data);exit;
        }

        $config=$this->wxJsConfig();
        $Content=$Content->getContentList(0, 10);
        $Category=$Category->getCategoryData();

        return $this->render('index',[
        	'Content'=>$Content,
            'Category'=>$Category,
            'config'=>$config
        ]);
    }
}