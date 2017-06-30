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
            $data = Content::getContentList($page, $size);
            $Content = $this->_optimizeData($data);
            echo Json::encode($Content);exit;
        }

        $data = Content::getContentList(0, 10);
        $Content = $this->_optimizeData($data);
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

    /**
     * 处理数据
     * @param $data
     * @return mixed
     */
    private function _optimizeData($data){
        foreach ($data as $key => $value){
            $data[$key]['ctime'] = $this->_timeTran($value['ctime']);
            if($value['pic'] != ''){
                foreach (explode(',', $value['pic']) as $k => $v){
                    $type = substr($v, strrpos($v, '.'));
                    $data[$key]['pics'][$k] = $v.'_200x200'.$type;
                }
            }
        }
        return $data;
    }

    /**
     * 处理时间
     * @param $the_time
     * @return bool|string
     */
    private function _timeTran($the_time) {
        header("Content-type: text/html; charset=utf8");
        date_default_timezone_set("Asia/Shanghai");   //设置时区
        $now_time = date("Y-m-d H:i:s", time());
        $now_time = strtotime($now_time);
        $dur = $now_time - $the_time;
        if ($dur < 0) {
            return $the_time;
        } else {
            if ($dur < 60) {
                return $dur . '秒前';
            } else {
                if ($dur < 3600) {
                    return floor($dur / 60) . '分钟前';
                } else {
                    if ($dur < 86400) {
                        return floor($dur / 3600) . '小时前';
                    } else {
                        if ($dur < 259200) {//3天内
                            return floor($dur / 86400) . '天前';
                        } else {
                            return date("Y-m-d H:i:s", $the_time);
                        }
                    }
                }
            }
        }
    }
}