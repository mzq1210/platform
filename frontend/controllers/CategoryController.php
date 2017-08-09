<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-10-27
 * Time: 下午5:22
 */
namespace frontend\controllers;

use common\components\Tools;
use Yii;
use common\models\wechat\Content;
use common\models\wechat\Category;
use app\components\base\BaseController;

class CategoryController extends BaseController{

    //分类下的帖子
    public function actionInfo(){
        $id=Yii::$app->request->get('id');
        $Category=Category::getThisCategory($id);
        $data=Content::getCateContentList($id);

        $Content = $this->_optimizeData($data);
        
        return$this->render('index',[
            'Content'=>$Content,
            'Category'=>$Category
        ]);
    }

    /**
     * 处理数据
     * @param $data
     * @return mixed
     */
    private function _optimizeData($data){
        foreach ($data as $key => $value){
            $data[$key]['ctime'] = Tools::timeTran($value['ctime']);
            if($value['pic'] != ''){
                foreach (explode(',', $value['pic']) as $k => $v){
                    $type = substr($v, strrpos($v, '.'));
                    $data[$key]['pics'][$k] = $v.'_200x200'.$type;
                }
            }
        }
        return $data;
    }

}