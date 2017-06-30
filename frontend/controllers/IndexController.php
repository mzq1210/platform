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
        if (Yii::$app->request->isAjax) {   //门店
            $post = Yii::$app->request->get();
            $page = isset($post['page'])? $post['page'] : 0;
            $size = isset($post['size'])? $post['size'] : 10;
            $data=Content::getContentList($page, $size);
            foreach ($data as $key => $value){
                $data[$key]['ctime'] = date('Y-m-d: H:i:s', $value['ctime']);
                if($value['pic'] != ''){
                    foreach (explode(',', $value['pic']) as $k => $v){
                        $type = substr($v, strrpos($v, '.'));
                        $data[$key]['pics'][$k] = $v.'_200x200'.$type;
                    }
                }
            }
            echo Json::encode($data);exit;
        }
        
        $Content=Content::getContentList(0, 10);
        foreach ($Content as $key => $value){
            $Content[$key]['ctime'] = date('Y-m-d: H:i:s', $value['ctime']);
            if($value['pic'] != ''){
                foreach (explode(',', $value['pic']) as $k => $v){
                    $type = substr($v, strrpos($v, '.'));
                    $Content[$key]['pics'][$k] = $v.'_200x200'.$type;
                }
            }
        }
        $config=$this->wxJsConfig();
        $category=Category::getCategoryData();

        return $this->render('index',[
        	'Content'=>$Content,
            'Category'=>$category,
            'config'=>$config
        ]);
    }


    public function actionGames(){
        return $this->render('games');
    }


}