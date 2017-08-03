<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-10-21
 * Time: 下午3:19
 */
namespace app\components\base;

use Yii;
use yii\web\Controller;
use app\components\Cookie;
use common\models\wechat\User;

class BaseController extends Controller
{

    //总的redis对象
    public $request;
    public $userid;
    public $openid;
    public $username;
    public $datetime;
    public $accessToken;

    public function init()
    {
        parent::init();
        /*$this->request = Yii::$app->request;
        $this->datetime = date('Y-m-d H:i:s');
        $this->accessToken = Yii::$app->wechat->getAccessToken();
        //var_dump($_COOKIE);die;
        $this->openid = Cookie::getCookie('openid');
        $accessToken = Cookie::getCookie('access_token');
        $refreshToken = Cookie::getCookie('refresh_token');
        //验证access_token是否有效
        $status = Yii::$app->wechat->checkOauth2AccessToken($accessToken, $this->openid);
        if(!$this->openid || !$status){
            if($refreshToken){//刷新access_token
                $res = Yii::$app->wechat->refreshOauth2AccessToken($refreshToken);
                Cookie::setCookie('openid', $res['openid'], time()+3600);
                Cookie::setCookie('access_token', $res['access_token'], time()+3600);
                $this->openid = $res['openid'];
            }else{
                header('location:http://www.onelog.cn/wx/getcode');
            }
        }*/

        $info = User::getUserInfo($this->openid);
        $this->userid = $info['id'];
        $this->username = $info['name'];
    }

    //验证token
    public function getToken()
    {
        $wechat = Yii::$app->wechat;
        $token = $wechat->token;
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $echostr = $_GET['echostr'];
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);//将token、timestamp、nonce三个参数由小到大进行排序
        $tmpStr = implode($tmpArr);//将三个参数字符串拼接成一个字符串
        $tmpStr = sha1($tmpStr);//进行sha1加密
        if ($tmpStr == $signature) {
            exit($echostr);//返回echostr参数
        }
    }

    //微信js_Cofig
    public function wxJsConfig()
    {
        $wechat = Yii::$app->wechat;
        return $wechat->jsApiConfig();
    }

    //消息
    public function massage($data)
    {
        $wechat = Yii::$app->wechat;
        return $wechat->sendMessage($data);
    }

    public function pr($arr){

        $arr = func_get_args();

        echo "<pre>";

        print_r($arr);

        echo "</pre>";
    }
}
