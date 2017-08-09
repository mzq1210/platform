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
use common\components\Tools;
use common\models\wechat\Content;
use common\models\wechat\Category;
use app\components\base\BaseController;

class AjaxController extends BaseController {

    /**
     * @desc 帖子列表
     * @return string
     */
    public function actionIndex(){
        if (Yii::$app->request->isAjax) {   //门店
            $params = Yii::$app->request->get();
            $page = isset($params['page'])? $params['page'] : 0;
            $size = isset($params['size'])? $params['size'] : 10;
            $data = Content::getContentList($page, $size);
            $content = $this->_optimizeData($data);
            echo Json::encode($content);exit;
        }
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
                $data[$key]['pics'] = explode(',', $value['pic']);
            }
        }
        return $data;
    }
}
