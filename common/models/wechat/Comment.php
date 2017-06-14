<?php

namespace common\models\wechat;

use common\models\base\BaseWechat;

class Comment extends BaseWechat
{


    public static function tableName()
    {
        return 'wechat_comment';
    }

    public function getCommentList($id, $page = 0, $pageSize = 10){
        return self::find()->select(['comment','wechat_user.name as uname','wechat_comment.ctime','wechat_comment.id','headimgurl'])
            ->innerJoin("`wechat_user` on `wechat_comment`.`openid` = `wechat_user`.`openid`")
            ->orderBy(['wechat_comment.id'=>SORT_DESC])
            ->where(['cid'=>$id])
            ->offset($page * $pageSize)->limit($pageSize)
            ->asArray()
            ->all();
    }

}