<?php
/*
 * @author <miaozhongqiang>
 * @date 2016-11-07 15:23
 * @desc 菜单Model
 */
namespace common\models\sys;

use common\query\CommonQuery;
use Yii;
use common\components\Tools;
use common\models\base\BaseSys;
use yii\data\ActiveDataProvider;

class Menu extends BaseSys
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_menu';
    }

    /**
     * @desc  菜单搜索
     * @param array   $params  参数
     * @return ActiveDataProvider
     * @author <miaozhongqiang>
     */
    public static function search($params=[])
    {
        $siteid = Yii::$app->session->get('siteid');
        $query = self::find()->where(['del_flag' => 0]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 100
            ],
        ]);
        $query->orderBy(['sort'=>SORT_ASC,'id'=>SORT_ASC]);
        if (empty($params)) {
            return $dataProvider;
        }
        if($siteid > 0){
            $query->andFilterWhere(['siteid' => (int)$siteid]);
        }
        if($params['siteid'] > 0){
            $query->andFilterWhere(['siteid' => (int)$params['siteid']]);
        }
        if(isset($params['name'])){
            $query->andFilterWhere(['like', 'name', $params['name']]);
        }
        return $dataProvider;
    }

    /**
     * @desc 菜单树状结构
     * @param int $siteid 站点ID
     * @return array
     * @author <miaozhongqiang>
     */
    public static function menuTree($siteid){
        $menuArr = self::find()
            ->select('id,parentid,name,m,c,a,param,icons')
            ->where('siteid=:siteid AND display=:display AND del_flag=:del_flag',['siteid' => $siteid, 'display' => 0, 'del_flag' => 0])
            ->orderBy(['sort' => SORT_ASC, 'id' => SORT_ASC])
            ->asArray()
            ->all();
        return Tools::getMenuTree($menuArr);
    }

    /**
     * @desc 获取站点菜单列表
     * @param int $siteid  站点ID
     * @return array|\yii\db\ActiveRecord[]
     * @author <miaozhongqiang>
     */
    public static function getSiteMenu($siteid = 0){
        return self::find()
            ->where('siteid=:siteid', [':siteid' => $siteid, 'del_flag' => 0, 'display' => 0])
            ->orderBy(['sort'=>SORT_ASC,'id'=>SORT_ASC])
            ->all();
    }

    /**
     * @desc 根据id得到详情
     * @param array  $id  菜单ID
     * @return bool
     * @author <miaozhongqiang>
     */
    public static function getDetailGroupById($id){
        return self::findOne($id);
    }

    /**
     * @desc 加载CommonQuery类中的公共条件
     * @return CommonQuery
     * @author <lixiaobin>
     */
    public static function find(){
        return new CommonQuery(get_called_class());
    }
}
