<?php
namespace app\modules\weixin\controllers;

use Yii;
use yii\helpers\Url;
use app\components\base\WxController;
use common\models\sys\Content;
use common\models\sys\Category;
class ReleaseController extends WxController
{

    public function actionIndex(){
    	$model=new Category();
    	$data=$model->find()->all();
    	// var_dump($data);die;
        return $this->render('category', [
           'data' => $data,
        ]);

    }

    public function actionForms(){

    	$data=Yii::$app->request->get();
    	var_dump($data['id']);die;
    	return $this->render('index', [
           'id' =>$data['id'],
           'name'=>$data['name']
        ]);
    }

    public function actionCreate(){
    	$model=new Content();
    	$params=Yii::$app->request->post();
		$data=[
             "title"=>$params['title'],
             'content'=>$params['content'],
             'ctime'=>time(),
             'cid'=>'111',
             'uid'=>'111'
		];
		$model->setAttributes($data,false);
		if ($model->save()) {
			echo "成功";
		}else{
			echo "失败";
		}
    }

}








?>