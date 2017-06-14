<?php
namespace app\components\base;

use Yii;
use yii\web\Controller;
use app\models\sys\MenuModel;
use app\components\Acl;
use common\components\Tools;
use yii\web\MethodNotAllowedHttpException;
use common\components\library\ShowMessage;
use yii\helpers\Url;


class WxController extends Controller{
	public $wechat;
    public $res;
    public $actoken;
    public $appid;
    public $secret;
    public $code;

    public function init(){

//       $this->getToken();

        $wechat= Yii::$app->wechat;
        $this->appid=$wechat->appId;
        $this->secret=$wechat->appSecret;

// 		$uri = 'http://www.onelog.cn/weixin/index/index';
//        $redirect_uri = urlencode($uri);
//        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
//		header('location:'.$url);


        $redirect_uri=urlencode("www.onelog.cn/weixin/index/index");//这里的地址需要http://
        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_base&state=123#wechat_redirect";
        header('location:'.$url);




//		 $open_id=$this->getOpenId();
//		 var_dump($open_id);die;
    }

//    public function getOpenId(){
////        $code=$_GET['code'];
////        var_dump($code);die;
//    	$get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->appid.'&secret='.$this->secret.'&code='.$code.'&grant_type=authorization_code';
//    	$ch = curl_init();
//	    curl_setopt($ch,CURLOPT_URL,$get_token_url);
//	    curl_setopt($ch,CURLOPT_HEADER,0);
//	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );


//	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
//	    $res = curl_exec($ch);
//	    curl_close($ch);
//	    $www = $_SERVER['HTTP_HOST'];
//
//	    $json_obj = json_decode($res,true);
//	    if(!$json_obj){
//	        //获取openid失败
//	        return false;
//	    }
//	    //获取到了存cookie
//	    @$openids = $json_obj['openid'];
//	    setcookie("new_openid","$openids",time()+3600*24*7,"/","$www",0);
//	    //var_dump($openids);die;
//	    return $openids;
//    }

    public function getToken(){
        $wechat = Yii::$app->wechat;
        $token = $wechat->token;
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $echostr = $_GET['echostr'];
        //$token = $this->token;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);//将token、timestamp、nonce三个参数由小到大进行排序
        $tmpStr = implode( $tmpArr );//将三个参数字符串拼接成一个字符串
        $tmpStr = sha1( $tmpStr );//进行sha1加密
        if( $tmpStr == $signature )
        {
            exit( $echostr );//返回echostr参数
        }

    }


}











?>