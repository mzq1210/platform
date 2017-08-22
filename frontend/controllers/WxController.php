<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-10-27
 * Time: 下午5:22
 */
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\components\Cookie;
use common\models\wechat\User;

class WxController extends Controller{

    public $actoken;
    public $appid;
    public $secret;

    public function init(){
        parent::init();
    }

    /**
     * @desc 获取code
     */
    public function actionGetcode(){
        $this->secret=Yii::$app->wechat->appSecret;
        $backUrl="http://www.onelog.cn/wx/openid";
        $url=Yii::$app->wechat->getOauth2AuthorizeUrl($backUrl);
        header('location:'.$url);
    }

    public function actionOpenid(){

        if(isset($_GET['code'])){
            $res=Yii::$app->wechat->getOauth2AccessToken($_GET['code']);

            if($res){
				$model = new User();
                $params=Yii::$app->wechat->getSnsUserInfo($res['openid'],$res['access_token']);
                if($params){
                    $data = ['openid' => $params['openid']];
                    if(!User::getUserInfo($data)){
                         $data=[
                            'openid'=>$params['openid'],
                            'name'=>$params['nickname'],
                            'ctime'=>time(),
                            'phone'=>'',
                            'sex'=>$params['sex'],
                            'headimgurl'=>$params['headimgurl'],
                            'country'=>$params['country']
                        ];
                        $model->setAttributes($data,false);
                        if ($model->save()) {
                            //保存cookie
                            Cookie::setCookie('openid', $params['openid'], time()+3600*24*365);
                            Cookie::setCookie('access_token', $res['access_token'], time()+3600);
                            Cookie::setCookie('refresh_token', $res['refresh_token'], time()+3600*24*25);
                            //redis保存个人资料
                            Yii::$app->cache->set($res['openid'], $params);
                            //header('location:https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIxNTg0MzU2OQ==&scene=123&from=groupmessage&isappinstalled=0#wechat_redirect');
                            return $this->redirect(['index/index']);
                        }else{
                            echo "失败";
                        }
                    }else{
                        //保存cookie
                        Cookie::setCookie('openid', $params['openid'], time()+3600*24*365);
                        Cookie::setCookie('access_token', $res['access_token'], time()+3600);
                        //redis保存个人资料
                        Yii::$app->cache->set($res['openid'], $params);
                        return $this->redirect(['index/index']);
                    }
                }else{
                    //header("Location: https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIxNTg0MzU2OQ==&scene=123&from=groupmessage&isappinstalled=0#wechat_redirect");
                    return $this->redirect(['index/index']);
                }
            }else{
                return $this->redirect(['error/index']);
            }
        } else {
            echo "获取code失败";
        }
    }


    /**
     * @desc 验证token
     */
    public function getToken(){
        $token = Yii::$app->wechat->requestAccessToken();
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $echostr = $_GET['echostr'];
        if($token=='' & $signature=='' & $timestamp=='' & $nonce=='' & $echostr==''){
            return false;
        }

        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);//将token、timestamp、nonce三个参数由小到大进行排序
        $tmpStr = implode( $tmpArr );//将三个参数字符串拼接成一个字符串
        $tmpStr = sha1( $tmpStr );//进行sha1加密
        if( $tmpStr == $signature ) {
            exit( $echostr );//返回echostr参数
        }
    }


//    function userTextEncode($str){
//        if(!is_string($str))return $str;
//        if(!$str || $str=='undefined')return '';
//
//        $text = json_encode($str); //暴露出unicode
//        $text = preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i",function($str){
//            return addslashes($str[0]);
//        },$text); //将emoji的unicode留下，其他不动，这里的正则比原答案增加了d，因为我发现我很多emoji实际上是\ud开头的，反而暂时没发现有\ue开头。
//        return json_decode($text);
//    }

    public function pr($arr){

        $arr = func_get_args();

        echo "<pre>";

        print_r($arr);

        echo "</pre>";
    }


}
