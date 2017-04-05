<?php
/*
 * @author <miaozhongqiang>
 * @date 2016-11-07 15:23
 * @desc 角色Model
 */
namespace common\models\sys;

use Yii;
use common\models\base\BaseSys;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class Role extends BaseSys
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_role';
    }

    /**
     * @desc 过滤角色列表
     * @param array   $params  参数
     * @return ActiveDataProvider
     * @author <miaozhongqiang>
     */
    public static function search($params = [])
    {
        $query = self::find()->where(['del_flag' => 0])->orderBy(['id' => SORT_ASC]);
        $pageSize = isset($params['per-page']) ? $params['per-page'] : 10;

        if(isset($siteid) &&  $siteid> 0){
            $query->andFilterWhere(['siteid' => (int)$siteid]);
        }
        if(isset($params['siteid']) && $params['siteid'] > 0){
            $query->andFilterWhere(['siteid' => (int)$params['siteid']]);
        }
        if(isset($params['name'])) {
            $query->andFilterWhere(['like', 'name', $params['name']]);
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
        $info['data'] = $query->offset($pages->offset)->limit($pages->limit)->all();
        $info['pages'] = $pages;

        return $info;
    }

    /**
     * @desc 根据id得到详情
     * @param array  $id  角色ID
     * @return bool
     * @author <miaozhongqiang>
     */
    public static function getDetailGroupById($id){
        return self::findOne($id);
    }

    /**
     * 开 发: 李效宾
     * 日 期: 2016-12-05
     * 参 数:
     * 说 明: 查询角色列表
     * 返 回: Array
     */
    public static function getRoleList(){
        return self::find()->where( ['del_flag' => 0, 'status' => 0])->asArray()->all();
    }
    
}
