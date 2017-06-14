<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-10-27
 * Time: 下午5:22
 */
namespace frontend\controllers;

use Yii;
use common\models\wechat\Content;
use common\models\wechat\Category;
use app\components\base\BaseController;

class CategoryController extends BaseController{

    //分类列表
    public function actionIndex(){
        $data=Category::getCategoryData();
        
        return $this->render('index',[
            'data'=>$data,
        ]);
    }

    //分类下的帖子
    public function actionInfo(){
        $id=Yii::$app->request->get('id');
        $Content=new Content();
        $Category=new Category();
        $Category=$Category->getThisCategory($id);
        $Content=$Content->getCateContentList($id);

        return$this->render('info',[
            'Content'=>$Content,
            'Category'=>$Category
        ]);
    }
}