<?php
/**
 * Created by PhpStorm.
 * User: smile
 * Date: 16-11-7
 * Time: 下午5:10
 */

namespace common\models\sys;


use common\models\base\BaseSys;
use yii\data\ActiveDataProvider;

class City extends BaseSys
{
    public static function tableName()
    {
        return 'sys_area';
    }
    
    public static function searchCity($params = [])
    {
        $query = self::find()->where(['del_flag' => 0]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if (empty($params)) {
            return $dataProvider;
        }
        if(isset($params['name']) && $params['name'] > 0) $query->andFilterWhere(['like','name',$params['name']]);

        return $dataProvider;
    }

    /*
     *  获取表最大的 moshou_id
     */
    public static function getMaxMoshouId(){
        //$maxMoshouId = self::findBySql("select * from sys_area limit 5")->asArray()->all();
        $maxMoshouId = self::find()->max('moshou_id');
        if ( $maxMoshouId === null){
            return 0;
        }
        return $maxMoshouId;
    }

    /* @param int $id
     * 获取城市列表,如果id存在则返回对应id的城市
     */
    public static function getCityList($id = 0)
    {
        if($id){
            return self::find()->where(['moshou_id'=>$id,'type'=> 1,'del_flag'=>0])->all();
        }else{
            return self::find()->where(['type'=> 1,'del_flag'=>0])->all();
        }
    }

    /**
     *  同步java端数据
     */
    public static function insertData($data){
        $result = \Yii::$app->db->createCommand()->batchInsert(self::tableName(),
            ['id','moshou_id','name','type','simple_spell','parent_id','longitude','latitude','creator','create_time','updater','update_time','del_flag'],
            $data)->execute();
        return $result;
    }
    /**
     * 添加问卷
     * @author  <zsh>
     * @param:  string $ids 城市id
     * @return: string
     */
    public static function getCity($ids){
        if(!empty($ids)){
            if(strpos($ids,',')) {
                $cityName = '';
                $ids = explode(',', $ids);
                foreach ($ids as $id) {
                    $model = self::findOne($id);
                    $cityName .= $model['name'].',';
                }
                return rtrim($cityName,',');
            } else {
                $model = self::findOne($ids);
                return $model['name'];
            }
        }
    }

}