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

class User extends BaseWechat
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat_user';
    }

    public static function search($params=[]){
        $query = self::find()->where(['del_flag' => 0])->orderBy(['id' => SORT_ASC]);
        $pageSize = isset($params['per-page']) ? $params['per-page'] : 10;

        if(isset($params['name'])) {
            $query->andFilterWhere(['like', 'name', $params['name']]);
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
        $info['data'] = $query->offset($pages->offset)->limit($pages->limit)->all();
        $info['pages'] = $pages;
        return $info;
    }

    public static function getUserInfo($params, $field='*', $bool=true){
        $info = self::find()->select($field)->where($params);
        if($bool){
            $info = $info->asArray();
        }
        return $info->one();
    }
}
