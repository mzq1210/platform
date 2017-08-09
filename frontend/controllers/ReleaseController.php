<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-10-27
 * Time: 下午5:22
 */
namespace frontend\controllers;

use Yii;
use yii\helpers\Json;
use app\components\Cookie;
use common\components\Image;
use common\components\Tools;
use common\models\wechat\User;
use common\models\wechat\Content;
use common\models\wechat\Category;
use common\models\wechat\Comment;
use app\components\base\BaseController;

class ReleaseController extends BaseController{

    public function actionIndex(){
        $model = new Category();
        $data = $model->getCategoryData();
        $config = $this->wxJsConfig();

        return $this->render('add', [
            'data' => $data,
            'config' =>$config
        ]);
    }

    public function actionCreate(){
        $params = Yii::$app->request->post();
        //动态网址过滤
        if(!empty($params['content'])){
            preg_match_all("/[a-z]+:\/\/[a-z0-9_\-\/.%]+/i", $params['content'], $array);
            if(!empty($array[0])) {
                foreach ($array[0] as $k=>$v){
                    $params['content'] = str_replace($v, '<a style="color:#00f;" href="'.$v.'">'.$v.'</a>', $params['content']);
                }
            }
        }
        //微信图片处理
        $serverids = isset($params['serverid']) ? $params['serverid'] : [];
        if(!empty($serverids)){
            $picArr = [];
            foreach ($serverids as $key => $value){
                $url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=".$this->accessToken."&media_id=".$value;
                $ret = Tools::https_request($url);
                $picArr[] = Tools::saveWeixinFile($ret);
            }
        }
        $pic = empty($picArr) ? '':implode(',', $picArr);
        //存储
        $model = new Content();
        $data = [
            "title" => $params['title'],
            'content' => trim($params['content']),
            'ctime' => time(),
            'cid' => $params['cid'],
            'uid' => $this->userid,
            'openid' => Cookie::getCookie('openid'),
            'pic' => $pic,
        ];
        $model->setAttributes($data, false);
        if ($model->save()) {
            $arr = ['id' => $this->userid];
            $user=User::getUserInfo($arr, '', false);
            //同步用户表手机号
            $phone=$user->phone=$params['title'];
            $data=[
                'phone'=>$phone,
            ];
            $user->setAttributes($data, false);
            $res = $user->save();
            if($res){
                $this->redirect(['/index/index']);
                echo "成功";
            }
        } else {
            echo "失败";
        }
    }

    //赞
    public function actionZan(){
        $id = Yii::$app->request->get('id');
        $model = Content::getThisContent($id);

        $zan = $model->zan + rand(1,15);
        $data = [
            'zan' => $zan
        ];
        $model->setAttributes($data, false);
        $res = $model->save();
        if ($res) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    //查看
    public function actionLook($value = '')
    {
        $id = Yii::$app->request->get('id');

        if (Yii::$app->request->isAjax) {   //门店
            $post = Yii::$app->request->get();
            $cid = isset($post['cid']) ? $post['cid'] : 0;
            $page = isset($post['page']) ? $post['page'] : 0;
            $size = isset($post['size']) ? $post['size'] : 0;
            $comment = new Comment();
            $comment = $comment->getCommentList($cid, $page, $size);
            foreach ($comment as $key => $value){
                $comment[$key]['ctime'] = date("Y-m-d h:m", $value['ctime']);
            }
            echo Json::encode($comment);
            exit;
        }

        $config = $this->wxJsConfig();
        //查看
        $model = Content::getThisContent($id);
        $look = $model->look + rand(1,15);

        $data = [
            'look' => $look
        ];
        $model->setAttributes($data, false);
        $model->save();

        //详情
        $ContentInfo = $model->getUserContentInfo($id);

        //评论列表
        $comment = new Comment();
        $comment = $comment->getCommentList($id);
       

        return $this->render('look', [
            'data' => $ContentInfo,
            'comment' => $comment,
            'config' => $config,
            'id' => $id
        ]);
    }

    //关注
    public function actionGuanzhu(){
        return $this->render('guanzhu');
    }

    public function actionGuanzhu2(){
        header('location:https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIxNTg0MzU2OQ==&scene=123&from=groupmessage&isappinstalled=0#wechat_redirect');
    }

    //上传图片
    public function actionUpload()
    {
        $newUploadPath = $this->fileMerge($_FILES['file']);
        $info['code'] = 200;
        $info['class'] = self::getClass(6);
        $info['imgpath'] = $newUploadPath;
        echo json_encode($info);
        exit;
    }

    /**
     * @desc 将传过来的图片数组配凑成每个图片单独的数组，组合成一个新的二维数组，然后循环上传
     * @param $files
     * @return string
     */
    public function fileMerge($files)
    {
        $imgPath = Image::upload($files, 'platform', true);
        return rtrim($imgPath, ',');
    }

    //评论
    public function actionComment()
    {
        $id = $this->request->get('id', 0);
        $comment = new Comment();
        if ($this->request->isPost) {
            $params = $this->request->post();
            $openid = Cookie::getCookie('openid');
            $data = ['openid' => $openid];
            $userInfo = User::getUserInfo($data);
            $data = [
                'cid' => $params['postId'],
                'comment' => $params['content'],
                'ctime' => time(),
                'uid' => $userInfo['id'],
                'fromUsername' => $userInfo['name'],
            ];
            $comment->setAttributes($data, false);
            $res = $comment->save();
            if ($res) {
                $Content = Content::getThisContent($params['postId']);
                $coments = $Content->coments + 1;
                $data = [
                    'coments' => $coments
                ];
                $Content->setAttributes($data, false);
                $Content->save();

                //获取评论人信息
                if ($userInfo) {
                    $url = 'http://www.onelog.cn/release/look?id='.$params["postId"];
                    $masage = $userInfo['name'] . "@了你:" . $params['content'];
                    $info = Content::getThisContent($params['postId']);
                    $arr = ['id' => $info->uid];
                    $postUserInfo = User::getUserInfo($arr);
                    $data = [
                        'touser' => $postUserInfo['openid'],
                        'msgtype' => 'text',
                        'text' => [
                            'content' => $masage. "<a href='". $url ."'>回复</a>",
                        ]
                    ];
                    $this->massage($data);
                }
                $this->redirect(['/release/look?id=' . $params['postId']]);
            }
        } else {
            return $this->render('commen', [
                'id' => $id
            ]);
        }
    }

    //回复
    public function actionReply()
    {
        $pid = $this->request->get('pid', 0);
        $mid = $this->request->get('mid', 0);
        if ($this->request->isPost) {
            $params = $this->request->post();
            $openid = Cookie::getCookie('openid');
            $data = ['openid' => $openid];
            $userInfo = User::getUserInfo($data);
            $comment = Comment::getInfo($params['commenId']);
            $arr = ['id' => $comment['uid']];
            $toUserInfo = User::getUserInfo($arr);
            $data = [
                'cid' => $params['postId'],
                'parentID' => $params['commenId'],
                'comment' => $params['content'],
                'ctime' => time(),
                'uid' => $userInfo['id'],
                'fromUsername' => $userInfo['name'],
                'toID' => $toUserInfo['id'],
                'toUsername' => $toUserInfo['name'],
            ];

            $model = new Comment();
            $model->setAttributes($data, false);
            $res = $model->save();
            if ($res) {
                //获取评论人信息
                if ($userInfo) {

                    $url = 'http://www.onelog.cn/release/look?id='.$params["postId"];

                    $masage = $userInfo['name'] . "@了你:" . $params['content'];
                    $data = [
                        'touser' => $toUserInfo['openid'],
                        'msgtype' => 'text',
                        'text' => [
                            'content' => $masage. "<a href='". $url ."'>回复</a>"
                        ]
                    ];
                    $this->massage($data);
                }

                $this->redirect(['/release/look?id=' . $params['postId']]);
            }
        } else {
            return $this->render('reply', [
                'pid' => $pid,
                'mid' => $mid
            ]);
        }
    }

    private static function getClass($len){
        $chars = "abcdefghijklmnopqrstuvwxyz";
        for ($i = 0, $str = '', $lc = strlen($chars) - 1; $i < $len; $i++) {
            $str .= $chars[mt_rand(0, $lc)];
        }
        return $str;
    }
}
