<?php

namespace common\models\wechat;

use common\models\base\BaseWechat;

class Comment extends BaseWechat
{

    public static function tableName(){
        return 'wechat_comment';
    }

    public function getCommentList($id, $page = 0, $pageSize = 10){
        $comment = self::find()->select(['comment','wechat_user.name as uname','wechat_comment.ctime','wechat_comment.id','wechat_comment.parentID','wechat_comment.toUsername','headimgurl'])
            ->innerJoin("`wechat_user` on `wechat_comment`.`uid` = `wechat_user`.`id`")
            ->orderBy(['wechat_comment.id'=>SORT_DESC])
            ->where(['cid'=>$id])
            ->offset($page * $pageSize)->limit($pageSize)
            ->asArray()
            ->all();
        return self::getTree($comment);
    }

    /**
     * 把返回的数据集转换成Tree
     * @param array $list 要转换的数据集
     * @param string $pk 自增字段
     * @param string $pid parent标记字段
     * @return array
     */
    private static function getTree($list,$pk='id',$pid='parentID',$child='_child',$root=0){
        $tree=array();
        $packData=array();
        foreach ($list as  $data) {
            $packData[$data[$pk]] = $data;
        }
        foreach ($packData as $key =>$val){
            if($val[$pid]==$root){
                $tree[]=& $packData[$key];
            }else{
                $packData[$val[$pid]][$child][]=& $packData[$key];
            }
        }
        return $tree;
    }

    public static function getInfo($id){
        return self::find()->where(['id'=>$id])->asArray()->one();
    }
}
