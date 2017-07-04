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

class BaseController extends Controller
{

    //总的redis对象
    public $cache;
    public $request;
    public $session;
    public $userid;
    public $username;
    public $datetime;

    public $wechat;
    public $actoken;
    public $appid;
    public $secret;

    public function init()
    {
        parent::init();
        $this->request = Yii::$app->request;
        $this->session = Yii::$app->session;
        $this->userid = $this->session->get('userid');
        $this->username = $this->session->get('username');
        $this->datetime = date('Y-m-d H:i:s');

        /*if (Cookie::getCookie('openid') == "") {
            header('location:http://www.onelog.cn/wx/getcode');
        }*/
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
    public function massage($openid, $data)
    {
        $wechat = Yii::$app->wechat;
        return $wechat->sendText($openid, $data);
    }
}
