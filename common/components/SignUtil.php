<?php

/**
 * @Description 接口签名校验工具类
 * @author pingzheng_liang
 * @createData 2016-5-10 13：32
 */

namespace common\components;

use yii\helpers\Json;
use Yii;
define('TOKEN', 'bacic5i5j@1101');

/*调用方式
 * $signUtil = SignUtil::getInstance();
   $signUtil->valid();
 */
class SignUtil {

    private static $_instance;

    //单例方法,用于访问实例的公共的静态方法
    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function valid() {
        //valid signature , option
        if ($this->checkSignature()==FALSE) {
            $ret = ['msg' => 'valid signature fail', 'status' => 300];
            exit(Json::encode($ret));
        }
    }

    public function checkSignature($signature='',$timestamp='') {
        // you must define TOKEN by yourself  
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        //$signature = $_GET["signature"];
        //$timestamp = $_GET["timestamp"];
//        $nonce = $_GET["nonce"];
        
        /*$signature = Yii::$app->request->get('signature');
        $timestamp = Yii::$app->request->get('timestamp');*/
        $token = TOKEN;
        $tmpArr = array($token, $timestamp);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    public function getSignature(){

        $timestamp=time();
        $token = TOKEN;
        $tmpArr = array($token, $timestamp);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        $returnarr=[
            'signature' => $tmpStr,
            'timestamp' => $timestamp,
        ];
        return $returnarr;
    }
}