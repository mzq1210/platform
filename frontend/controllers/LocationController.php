<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-10-27
 * Time: 下午5:22
 */
namespace frontend\controllers;

use Yii;
use app\components\base\BaseController;
use common\models\wechat\Category;
use common\components\BaiduMap;

class LocationController extends BaseController{

    //分类列表
    public function actionIndex(){
        $data=Category::getCategory();
        
        return $this->render('index',[
            'data'=>$data,
        ]);
    }

    public function actionList(){
        $id=Yii::$app->request->get('id');
        $data=Category::getThisCategory($id);

        //怀来市经纬度
        $location = '40.420242,115.524536';
        $mapObj = new BaiduMap();
        $info = $mapObj->place(1, $data['name'], '', $location, 2000, '', 1);
        $info = json_decode($info);

        return $this->render('list',[
            'data'=>$data,
            'info'=>$info->results,
        ]);
    }

    public function actionDetail(){
        $data='';
        return $this->render('detail',[
            'data'=>$data,
        ]);
    }

}