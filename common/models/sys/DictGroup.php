<?php

/*
 * 字典分组表  
 * @author <liangpingzheng>
 * @date Dec 1, 2016 10:45:45 AM
 */

namespace common\models\sys;

use common\models\base\BaseSys;
use yii\data\Pagination;

class DictGroup extends BaseSys {

    public static function tableName() {
        return 'sys_dict_group';
    }

    /**
     * 列表搜索功能
     * 
     * @param arrat $params
     * @return array
     * @data 2016-12-02
     * @author <liangpingzheng>
     */
    public function search($params = []) {
        $info = [];
        $query = DictGroup::find();
        $query->orderBy(['id' => SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $params['pageSize']]);
        $query->andFilterWhere(['=', 'del_flag', 0]);
        isset($params['name']) && $params['name'] && $query->andFilterWhere(['like', 'name', $params['name']]);
        isset($params['code']) && $params['code'] && $query->andFilterWhere(['like', 'code', $params['code']]);
        $info['data'] = $query->offset($pages->offset)->limit($pages->limit)->all();
        $info['pages'] = $pages;
        return $info;
    }

    /**
     * 添加记录
     * 
     * @param  array $params 参数数组
     * @return boolen
     * @data 2016-12-02
     * @author <liangpingzheng>
     */
    public static function addRecord($params = []) {
        $model = new DictGroup;
        $model->setAttributes($params, false);
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 更新记录
     * 
     * @param int $id 编号 
     * @param array $params 参数数组
     * @return boolen
     * @data 2016-12-02
     * @author <liangpingzheng>
     */
    public static function editRecord($id, $params = []) {
        $model = self::findOne($id);
        $model->setAttributes($params, false);
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * 删除字典组
     * @params  int $id
     * @params  array $params 变更的数据
     * @return boolen
     * @author <liangpingzheng>
     */

    public static function delRecord($id, $params) {
        $params['del_flag'] = 1;
        $model = DictGroup::findOne($id);
        $model->setAttributes($params, false);
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getName($id) {
        $info = DictGroup::findOne($id);
        return $info->name;
    }

    /**
     * 根据code编码获取字典组
     *
     * @params string $string 字典组编码、组名称或者ID
     *         int    $type 1默认按照code查询 2 按照name查询 3 按照ID查
     * @return object
     * @date 2016-12-19
     * @author <lixiaobin>
    */
    public static function getOneDictGroup($string = '', $type = 1){
        if(!empty($string) && $type == 1){
            $res = self::find()->select('id,name,code')->where(['code' => $string, 'del_flag' => 0])->one();
            if(!empty($res)) return $res;
        }elseif(!empty($string) && $type == 2){
            $res = self::find()->select('id,name,code')->where(['name' => $string, 'del_flag' => 0])->one();
            if(!empty($res)) return $res;
        }else{
            $res = self::find()->select('id,name,code')->where(['id' => $string, 'del_flag' => 0])->one();
            if(!empty($res)) return $res;
        }
        return false;
    }

}
