<?php
/**
 * Created by PhpStorm.
 * User: miaozhongqiang
 * Date: 16-11-18
 * Time: 上午10:10
 */

namespace common\models\sys;

use Yii;
use common\models\base\BaseSys;
use yii\data\Pagination;

class Icons extends BaseSys
{
    public static function tableName()
    {
        return 'sys_icons';
    }

    /**
     * @desc 图标列表
     * @param array   $params  参数
     * @return mixed
     * @author <miaozhongqiang>
     */
    public static function search($params = [])
    {
        $query = self::find()->where(['del_flag' => 0])->orderBy('id asc');
        $pageSize = isset($params['per-page']) ? $params['per-page'] : PAGESIZE;

        if(isset($params['name'])) $query->andFilterWhere(['like', 'name', $params['name']]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
        $info['data'] = $query->offset($pages->offset)->limit($pages->limit)->all();
        $info['pages'] = $pages;
        return $info;
    }

    /**
     * @param $id
     * @return mixed|string
     * @author <miaozhongqiang>
     */
    public static function getIcon($id){
        if($id){
            return static::find()->where(['id' => $id])->one()->icon;
        }else{
            return '';
        }
    }
    
}