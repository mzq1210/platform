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
        $backUrl=urlencode("http://www.onelog.cn/wx/openid");
        $url=Yii::$app->wechat->getOauth2AuthorizeUrl($backUrl);
        header('location:'.$url);
    }

    public function actionOpenid(){
        if(isset($_GET['code'])){
            $res=Yii::$app->wechat->getOauth2AccessToken($_GET['code']);
            if(!$res){
                $params=Yii::$app->wechat->getSnsUserInfo($res['openid'], $res['access_token']);
                if(!$params){
                    $model=new User();
                    if(!User::getUserOpenId($params['openid'])){
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
                            Cookie::setCookie('openid', $params['openid'], time()+3600);
                            Cookie::setCookie('access_token', $res['access_token'], time()+3600);
                            Cookie::setCookie('refresh_token', $res['refresh_token'], time()+3600*24*25);
                            //redis保存个人资料
                            Yii::$app->cache->set($res['openid'], $params);
                            header('location:https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIxNTg0MzU2OQ==&scene=123&from=groupmessage&isappinstalled=0#wechat_redirect');
                        }else{
                            echo "失败";
                        }
                    }else{
                        //保存cookie
                        Cookie::setCookie('openid', $params['openid'], time()+300);
                        Cookie::setCookie('access_token', $res['access_token'], time()+3600);
                        //redis保存个人资料
                        Yii::$app->cache->set($res['openid'], $params);
                        return $this->redirect(['index/index']);
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
        if (isset($_GET['echostr'])) {
            $echostr   = $_GET['echostr'];
            $status=Yii::$app->wechat->checkSignature();
            if($status) {
                exit( $echostr );
            }
        } else {
            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
            if (!empty($postStr)) {
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $RX_TYPE = trim($postObj->MsgType);
                //消息类型分离
                switch ($RX_TYPE) {
                    case "event":
                        $result = $this->receiveEvent($postObj);
                        break;
                    case "text":
                        $result = $this->receiveText($postObj);
                        break;
                    case "image":
                        $result = $this->receiveImage($postObj);
                        break;
                    case "location":
                        $result = $this->receiveLocation($postObj);
                        break;
                    case "voice":
                        $result = $this->receiveVoice($postObj);
                        break;
                    case "video":
                        $result = $this->receiveVideo($postObj);
                        break;
                    case "link":
                        $result = $this->receiveLink($postObj);
                        break;
                    default:
                        $result = "unknown msg type: " . $RX_TYPE;
                        break;
                }
                echo $result;
            } else {
                echo "请联系公众号管理员!";
                exit;
            }
        }
    }

    //接收事件消息
    private function receiveEvent($object)
    {
        $content = "";
        switch ($object->Event) {
            case "subscribe":
                $content = "欢迎关注怀来便民网";
                $content .= (!empty($object->EventKey)) ? ("\n来自二维码场景 " . str_replace("qrscene_", "", $object->EventKey)) : "";
                break;
            case "unsubscribe":
                $content = "取消关注";
                break;
            case "SCAN":
                $content = "扫描场景 " . $object->EventKey;
                break;
            case "CLICK":
                switch ($object->EventKey) {
                    case "COMPANY":
                        $content = " 怀来便民网提供怀来周边信息与服务。";
                        break;
                    default:
                        $content = "点击菜单：" . $object->EventKey;
                        break;
                }
                break;
            case "LOCATION":
                $this->ctrl->db->insert('wx_user_xy', array('open_id' => $object->FromUserName . "" . "", 'x' => $object->Latitude . "", 'y' => $object->Longitude . ""));
                //$content = "上传位置：纬度 ".$object->Latitude.";经度 ".$object->Longitude;//注释掉就不回信息了
                break;
            case "VIEW":
                $content = "跳转链接 " . $object->EventKey;
                break;
            case "MASSSENDJOBFINISH":
                $content = "消息ID：" . $object->MsgID . "，结果：" . $object->Status . "，粉丝数：" . $object->TotalCount . "，过滤：" . $object->FilterCount . "，发送成功：" . $object->SentCount . "，发送失败：" . $object->ErrorCount;
                break;
            default:
                $content = "receive a new event: " . $object->Event;
                break;
        }
        if (is_array($content)) {
            if (isset($content[0]['PicUrl'])) {
                $result = $this->transmitNews($object, $content);
            } else if (isset($content['MusicUrl'])) {
                $result = $this->transmitMusic($object, $content);
            }
        } else {
            $result = $this->transmitText($object, $content);
        }
        return $result;
    }

    //接收文本消息
    private function receiveText($object)
    {
        $keyword = trim($object->Content);
        //多客服人工回复模式
        if (strstr($keyword, "您好") || strstr($keyword, "你好") || strstr($keyword, "在吗")) {
            $result = $this->transmitService($object);
        } //自动回复模式
        else {
            if (strstr($keyword, "文本")) {
                $content = "这是个文本消息";
            } else if (strstr($keyword, "图文") || strstr($keyword, "单图文")) {
                $content = array();
                $content[] = array("Title" => "单图文标题", "Description" => "单图文内容", "PicUrl" => "http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" => "http://m.cnblogs.com/?u=txw1958");
            } else if (strstr($keyword, "多图文")) {
                $content = array();
                $content[] = array("Title" => "多图文1标题", "Description" => "", "PicUrl" => "http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" => "http://m.cnblogs.com/?u=txw1958");
                $content[] = array("Title" => "多图文2标题", "Description" => "", "PicUrl" => "http://d.hiphotos.bdimg.com/wisegame/pic/item/f3529822720e0cf3ac9f1ada0846f21fbe09aaa3.jpg", "Url" => "http://m.cnblogs.com/?u=txw1958");
                $content[] = array("Title" => "多图文3标题", "Description" => "", "PicUrl" => "http://g.hiphotos.bdimg.com/wisegame/pic/item/18cb0a46f21fbe090d338acc6a600c338644adfd.jpg", "Url" => "http://m.cnblogs.com/?u=txw1958");
            } else if (strstr($keyword, "音乐")) {
                $content = array();
                $content = array("Title" => "最炫民族风", "Description" => "歌手：凤凰传奇", "MusicUrl" => "http://121.199.4.61/music/zxmzf.mp3", "HQMusicUrl" => "http://121.199.4.61/music/zxmzf.mp3");
            } else {
                $content = date("Y-m-d H:i:s", time()) . "\n技术支持 怀来便民网";
            }

            if (is_array($content)) {
                if (isset($content[0]['PicUrl'])) {
                    $result = $this->transmitNews($object, $content);
                } else if (isset($content['MusicUrl'])) {
                    $result = $this->transmitMusic($object, $content);
                }
            } else {
                $result = $this->transmitText($object, $content);
            }
        }
        return $result;
    }

    //接收图片消息
    private function receiveImage($object)
    {
        $content = array("MediaId" => $object->MediaId);
        $result = $this->transmitImage($object, $content);
        return $result;
    }

    //接收位置消息
    private function receiveLocation($object)
    {
        $this->ctrl->db->insert('wx_user_xy', array('open_id' => $object->FromUserName . '', 'x' => $object->Location_X . '', 'y' => $object->Location_Y . ''));
        $content = "你发送的是位置，纬度为：" . $object->Location_X . "；经度为：" . $object->Location_Y . "；缩放级别为：" . $object->Scale . "；位置为：" . $object->Label;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    //接收语音消息
    private function receiveVoice($object)
    {
        if (isset($object->Recognition) && !empty($object->Recognition)) {
            $content = "你刚才说的是：" . $object->Recognition;
            $result = $this->transmitText($object, $content);
        } else {
            $content = array("MediaId" => $object->MediaId);
            $result = $this->transmitVoice($object, $content);
        }

        return $result;
    }

    //接收视频消息
    private function receiveVideo($object)
    {
        $content = array("MediaId" => $object->MediaId, "ThumbMediaId" => $object->ThumbMediaId, "Title" => "", "Description" => "");
        $result = $this->transmitVideo($object, $content);
        return $result;
    }

    //接收链接消息
    private function receiveLink($object)
    {
        $content = "你发送的是链接，标题为：" . $object->Title . "；内容为：" . $object->Description . "；链接地址为：" . $object->Url;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    //回复文本消息
    private function transmitText($object, $content)
    {
        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }

    //回复图片消息
    private function transmitImage($object, $imageArray)
    {
        $itemTpl = "<Image>
<MediaId><![CDATA[%s]]></MediaId>
</Image>";

        $item_str = sprintf($itemTpl, $imageArray['MediaId']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复语音消息
    private function transmitVoice($object, $voiceArray)
    {
        $itemTpl = "<Voice>
<MediaId><![CDATA[%s]]></MediaId>
</Voice>";

        $item_str = sprintf($itemTpl, $voiceArray['MediaId']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复视频消息
    private function transmitVideo($object, $videoArray)
    {
        $itemTpl = "<Video>
<MediaId><![CDATA[%s]]></MediaId>
<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
</Video>";

        $item_str = sprintf($itemTpl, $videoArray['MediaId'], $videoArray['ThumbMediaId'], $videoArray['Title'], $videoArray['Description']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[video]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复图文消息
    private function transmitNews($object, $newsArray)
    {
        if (!is_array($newsArray)) {
            return;
        }
        $itemTpl = "    <item>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>";
        $item_str = "";
        foreach ($newsArray as $item) {
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
$item_str</Articles>
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
    }

    //回复音乐消息
    private function transmitMusic($object, $musicArray)
    {
        $itemTpl = "<Music>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<MusicUrl><![CDATA[%s]]></MusicUrl>
<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
</Music>";

        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[music]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复多客服消息
    private function transmitService($object)
    {
        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[transfer_customer_service]]></MsgType>
</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
}