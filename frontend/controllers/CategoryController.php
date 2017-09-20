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

    //分类下的帖子
    public function actionInfo(){
        $id=Yii::$app->request->get('id');
        $Category=Category::getThisCategory($id);
        $params = [
            'page' => 0,
            'size' => 10,
            'cid'  => $id
        ];
        $data=Content::getContentList($params);

        $Content = $this->_optimizeData($data);
        $config=$this->wxJsConfig();
        return$this->render('index',[
            'Content'=>$Content,
            'Category'=>$Category,
            'config' =>$config
        ]);
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
                $data[$key]['pics'] = explode(',', $value['pic']);
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
