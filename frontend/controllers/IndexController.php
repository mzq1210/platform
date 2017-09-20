<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-10-27
 * Time: 下午5:22
 */
namespace frontend\controllers;

use Yii;
use common\components\Tools;
use common\models\wechat\User;
use common\models\wechat\Content;
use common\models\wechat\Category;
use app\components\base\BaseController;

class IndexController extends BaseController {

    /**
     * @desc 帖子列表
     * @return string
     */
    public function actionIndex(){
        $config=$this->wxJsConfig();

        $userModel = User::getUserInfo(['openid' => $this->openid], '', false);
        if($userModel){
            $data = [
                'login_time' => time()
            ];
            $userModel->setAttributes($data, false);
            $userModel->save();
        }

        $category=Category::getCategoryData();

        $param = [
            'page' => 0,
            'size' => 10
        ];
        $data = Content::getContentList($param);
        $content = $this->_optimizeData($data);

        return $this->render('index',[
            'content'=>$content,
            'Category'=>$category,
            'config'=>$config
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
                $data[$key]['pics'] = explode(',', $value['pic']);
            }
        }
        return $data;
    }
}
