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

    //创建菜单
    public function actionSetMenu(){
        $menu = [
            [
                'type' => 'view',
                'name' => '广场',
                'url' => 'http://www.onelog.cn/index/index'
            ],
            [
                'type' => 'view',
                'name' => '发布',
                'url' => 'http://www.onelog.cn/release/index'
            ],
            [
                'type' => 'view',
                'name' => '我的',
                'url' => 'http://www.onelog.cn/user/index'
            ],

        ];

        $res=Yii::$app->wechat->createMenu($menu);
        var_dump($res);die;
    }

    /**
     * @desc 获取ceode
     */
    public function actionGetcode(){
        $this->secret=Yii::$app->wechat->appSecret;
        $url="http://www.onelog.cn/wx/openid";
        $url=Yii::$app->wechat->getOauth2AuthorizeUrl($url);
        header('location:'.$url);
    }

    /**
     * @desc 获取open_id
     */
    public function actionOpenid(){
        if(isset($_GET['code'])){
            $res=Yii::$app->wechat->getOauth2AccessToken($_GET['code']);
            //检验授权凭证（access_token）是否有效
            $status = Yii::$app->wechat->checkOauth2AccessToken($res['access_token'], $res['openid']);
            if($status){//当access_token超时后，可以使用refresh_token进行刷新
                $res = Yii::$app->wechat->refreshOauth2AccessToken($res['refresh_token']);
            }

            if($res['openid']){
                $params=Yii::$app->wechat->getMemberInfo($res['openid']);
                //如果获取不到用户名称跳转关注
                if(!empty($params['nickname'])){

                    $model=new User();
                    if(!$model->getUserOpenId($params['openid'])){
                        $data=[
                            "openid"=>$params['openid'],
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
                            Cookie::setCookie('openid', $params['openid'], time()+300);
                            //保存session
                            $userId = $model->attributes['id'];
                            Yii::$app->session->set("userid",$userId);
                            Yii::$app->session->set("openid",$params['openid']);
                            Yii::$app->session->set("username", $params['nickname']);
                            //保存redis
                            $redisKey = $userId.$res['openid'];
                            Yii::$app->cache->set(md5($redisKey), $data);
                            header('location:https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIxNTg0MzU2OQ==&scene=123&from=groupmessage&isappinstalled=0#wechat_redirect');
                        }else{
                            echo "失败";
                        }
                    }else{
                        //保存cookie
                        Cookie::setCookie('openid', $params['openid'], time()+300);
                        $userInfo = $model->getUserInfo($params['openid']);
                        //var_dump($userInfo);die;
                        //保存session
                        Yii::$app->session->set("userid",$userInfo['id']);
                        Yii::$app->session->set("openid",$params['openid']);
                        Yii::$app->session->set("username", $userInfo['name']);
                        //保存redis
                        $redisKey = 'sso_'.md5($userInfo['id'].$res['openid']);
                        $redisInfo = Yii::$app->cache->get($redisKey);
                        if(!$redisInfo){Yii::$app->cache->set($redisKey, $userInfo);}
                        header('location:http://www.onelog.cn/index/index');
                    }
                }else{
                	header("Location: https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIxNTg0MzU2OQ==&scene=123&from=groupmessage&isappinstalled=0#wechat_redirect");
                }
            }
        } else {
            echo "获取code失败";
        }
    }

    /**
     * @desc 验证token
     */
    public function getToken(){
        $token = Yii::$app->wechat->token;
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




}