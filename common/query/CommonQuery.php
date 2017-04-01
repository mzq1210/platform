<?php
/**
 * Created by PhpStorm.
 * User: leexb
 * Date: 16-11-17
 * Time: 下午1:41
 * Desc: 公共条件，可直接用该类里的方法
 * 使用: 在模型类中增加
 *  public static function find(){
 *    return new CommonQuery(get_called_class());
 *  }
 */

namespace common\query;

use yii\db\ActiveQuery;

class CommonQuery extends ActiveQuery{
    /**
     * 被删除的
     */
    public function onlyTrashed(){
        return $this->andFilterWhere(['del_flag' => 1]);
    }
    /**
     * 未被删除的
     */
    public function notTrashed(){
        return $this->andFilterWhere(['del_flag' => 0]);
    }

    /**
     * 启动的状态
    */
    public function isStatus(){
        return $this->andFilterWhere(['status' => 0]);
    }

    /**
     * 禁用的状态
     */
    public function notStatus(){
        return $this->andFilterWhere(['status' => 0]);
    }
}