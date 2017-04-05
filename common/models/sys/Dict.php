<?php

/*
 * 数据字典表
 * @author <mzq>
 * @date Dec 1, 2016 10:43:48 AM
 */

namespace common\models\sys;

use common\models\base\BaseSys;
use yii\data\Pagination;

class Dict extends BaseSys {

    public static function tableName() {
        return 'sys_dict';
    }

    public function searchDict($params = []) {

        $info = [];
        $query = Dict::find();
        $query->orderBy(['id' => SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $params['pageSize']]);
        $query->andFilterWhere(['=', 'del_flag', 0]);
        isset($params['label']) && $params['label'] && $query->andFilterWhere(['like', 'label', $params['label']]);
        isset($params['code']) && $params['code'] && $query->andFilterWhere(['like', 'code', $params['code']]);
        isset($params['dict_group_id']) && $params['dict_group_id'] && $query->andFilterWhere(['=', 'dict_group_id', $params['dict_group_id']]);
        $info['data'] = $query->offset($pages->offset)->limit($pages->limit)->all();
        $info['pages'] = $pages;
        return $info;
    }

    /*
     * 删除字典
     * @params  int $id
     * @params  array $params 变更的数据
     * @return boolen
     * @author <mzq>
     */

    public static function delRecord($id, $params) {
        $params['del_flag'] = 1;
        $model = Dict::findOne($id);
        $model->setAttributes($params, false);
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 根据字典组id查询字典信息
     *
     * @params string $dictGroupId 字典组ID
     * @return array
     * @date 2016-12-19
     * @author <mzq>
     */
    public static function getDectInfo($dictGroupId){
        if(!empty($dictGroupId)){
            $res = self::find()->select('id,code,label')->where(['dict_group_id' => $dictGroupId, 'del_flag' => 0])->asArray()->all();
            if(!empty($res)) return $res;
        }
        return false;
    }
    
}
