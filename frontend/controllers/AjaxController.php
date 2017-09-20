<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-10-27
 * Time: 下午5:22
 */
namespace frontend\controllers;

use common\models\wechat\User;
use Yii;
use yii\helpers\Json;
use common\components\Tools;
use common\models\wechat\Content;
use common\models\wechat\Sign;
use common\models\wechat\Integration;
use app\components\base\BaseController;

class AjaxController extends BaseController {

    /**
     * @desc 帖子列表
     * @return string
     */
    public function actionIndex(){
        if (Yii::$app->request->isAjax) {   //门店
            $params = Yii::$app->request->get();

            $data = Content::getContentList($params);
            $content = $this->_optimizeData($data);

            echo Json::encode($content);exit;
        }
    }

    /**
     * @desc 签到
     * @return string
     */
    public function actionSign(){
        if (Yii::$app->request->isAjax) {
            //验证
            $params = [
                'userID' => $this->userid,
                'sign_time' => strtotime(date('Y-m-d'))
            ];
            $status = Sign::signStatus($params);
            if($status){
                $data['status'] = 2;
            }else{
                //签到
                $model = new Sign();
                $data = [
                    'userID' => $this->userid,
                    'sign_time' => time()
                ];
                $model->setAttributes($data, false);
                $model->save();
                //积分
                $userInfo = User::getUserInfo(['id' => $this->userid], '', false);
                $integration = $userInfo->integration + 10;
                $userInfo->setAttributes(['integration' => $integration], false);
                $userInfo->save();
                $data['status'] = 1;
            }

            //统计
            $params2 = [
                'userID' => $this->userid,
                'month' => strtotime(date('Y-m'))
            ];
            $signArr = Sign::signDate($params2);
            $data['count'] = count($signArr);

            echo Json::encode($data);exit;
        }
    }

    public function actionSigndate(){
        if (Yii::$app->request->isAjax) {
            $info = [];
            $params = [
                'userID' => $this->userid,
                'month' => strtotime(date('Y-m'))
            ];
            $data = Sign::signDate($params);
            foreach ($data as $key => $value){
                $info[$key]['signDay'] = date('d', $value['sign_time']);
            }
            echo Json::encode($info);exit;
        }
    }

    //积分领取
    public function actionReceive(){
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();

            //查询总天数
            $params = [
                'userID' => $this->userid,
                'month' => strtotime(date('Y-m'))
            ];
            $signArr = Sign::signDate($params);
            $count = count($signArr);
            if($post['num'] > $count){
                $data['status'] = 3;
                echo Json::encode($data);exit;
            }

            $params = [
                'userID' => $this->userid,
                'integration'.$post['num'] => 1
            ];
            $status = Integration::integrationStatus($params);
            if($status){
                $data['status'] = 2;
            }else{
                //如果已经有记录就只需要修改否则添加
                $info = Integration::integrationStatus(['userID' => $this->userid]);
                if($info){
                    $info->setAttributes($params, false);
                    $info->save();
                }else{
                    $model = new Integration();
                    $model->setAttributes($params, false);
                    $model->save();
                }
                //积分
                $userInfo = User::getUserInfo(['id' => $this->userid], '', false);
                $integration = $userInfo->integration + $post['num']*10;
                $userInfo->setAttributes(['integration' => $integration], false);
                $userInfo->save();

                $data['status'] = 1;
            }
            echo Json::encode($data);exit;
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
