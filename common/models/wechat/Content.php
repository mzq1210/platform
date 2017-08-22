<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-11-29
 * Time: 上午9:30
 */

namespace common\models\wechat;

use yii\data\Pagination;
use common\models\base\BaseWechat;

class Content extends BaseWechat
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat_content';
    }

    public static function search($params=[]){
        $query = self::find()->where(['del_flag' => 0])->orderBy(['id' => SORT_ASC]);
        $pageSize = isset($params['per-page']) ? $params['per-page'] : 10;

        if(isset($params['title'])) {
            $query->andFilterWhere(['like', 'title', $params['title']]);
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
        $info['data'] = $query->offset($pages->offset)->limit($pages->limit)->all();
        $info['pages'] = $pages;
        return $info;
    }

    //获取所有话题列表
    public static function getContentList($page, $size){
        $query = self::find()->select(['content','title','wechat_user.name as uname','pic','headimgurl','cid','wechat_content.ctime','zan','wechat_content.id','look','wechat_category.name as cname','coments'])
           ->innerJoin("`wechat_user` on `wechat_content`.`uid` = `wechat_user`.`id`")
           ->innerJoin("`wechat_category` on `wechat_content`.`cid` = `wechat_category`.`id`")
            ->where(['wechat_content.del_flag'=>0]);
        $query->orderBy(['wechat_content.ctime'=>SORT_DESC]);
        $list = $query->offset($page * $size)->limit($size)->asArray()->all();
        return $list;
    }

    //获取用户话题列表
    public static function getUserContentList($id){
        return self::find()->select(['content','title','wechat_user.name as uname','wechat_user.openid','pic','headimgurl','cid','wechat_content.ctime','zan','wechat_content.id','look','wechat_category.name as cname','coments'])
            ->innerJoin("`wechat_user` on `wechat_content`.`uid` = `wechat_user`.`id`")
            ->innerJoin("`wechat_category` on `wechat_content`.`cid` = `wechat_category`.`id`")
            ->orderBy(['wechat_content.ctime'=>SORT_DESC])
            ->where(['wechat_content.del_flag'=>0, 'wechat_content.uid'=>$id])
            ->asArray()
            ->all();
    }

    //获取分类话题
    public static function getCateContentList($cid){
        return self::find()->select(['content','title','wechat_user.name as uname','pic','headimgurl','cid','wechat_content.ctime','zan','wechat_content.id','look','wechat_category.name as cname','coments'])
            ->innerJoin("`wechat_user` on `wechat_content`.`uid` = `wechat_user`.`id`")
            ->innerJoin("`wechat_category` on `wechat_content`.`cid` = `wechat_category`.`id`")
            ->orderBy(['wechat_content.ctime'=>SORT_DESC])
            ->where(['wechat_content.del_flag'=>0, 'wechat_category.id'=>$cid])
            ->asArray()
            ->all();
    }

    //话题详情
    public static function getUserContentInfo($id){
        return self::find()->select(['content','title','wechat_user.name as uname','wechat_user.openid','pic','headimgurl','cid','wechat_content.ctime','zan','wechat_content.id','look','wechat_category.name as cname','coments'])
            ->innerJoin("`wechat_user` on `wechat_content`.`uid` = `wechat_user`.`id`")
            ->innerJoin("`wechat_category` on `wechat_content`.`cid` = `wechat_category`.`id`")
            ->orderBy(['wechat_content.id'=>SORT_DESC])
            ->where(['wechat_content.id'=>$id])
            ->asArray()
            ->one();
    }

    //获得当前话题
    public static function getThisContent($id){
        return self::findOne($id);
    }
}
