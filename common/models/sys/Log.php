<?php
/**
 * Created by PhpStorm.
 * User: leexb
 * Date: 16-11-7
 * Time: 上午10:17
 * Desc: 操作日志model
 */
namespace common\models\sys;

use common\models\base\BaseSys;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;


class Log extends BaseSys{

    const EVENT_TYPE_INSERT = 1;//插入操作
    const EVENT_TYPE_UPDATE = 2;//更新操作
    const EVENT_TYPE_DELETE = 3;//删除操作
    const EVENT_TYPE_LOGIN = 4;//登录

    public static function tableName()
    {
        return 'sys_log';
    }

    public static function tableDesc(){
        return '日志';
    }

    /**
     * 开 发: 李效宾
     * 日 期: 2016-11-07
     *
    */
    public static function searchLog($params = []){
        $info = [];
        $query = self::find();
        $query->orderBy(['id' => SORT_DESC]);
        if(!empty($params['siteid'])){
            $query->andFilterWhere(['siteid' => $params['siteid']]);
        }
        if(!empty($params['type'])){
            $query->andFilterWhere(['type' => $params['type']]);
        }
        if(!empty($params['operator'])){
            $query->andFilterWhere(['operator' => $params['operator']]);
        }
        if(!empty($params['start_date'])){
            $start_date = $params['start_date'] . ' 00:00:00';
            $end_date = date('Y-m-d'). ' 23:59:59';
            if(!empty($params['end_date'])){
                $end_date = $params['end_date'] . ' 23:59:59';
            }
            $query->andFilterWhere(['between', 'add_time',$start_date,$end_date]);
        }
        
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $params['pageSize']]);

        $info['data'] = $query->offset($pages->offset)->limit($pages->limit)->all();
        $info['pages'] = $pages;
        return $info;
    }

    public function getUsername(){
        return $this->hasOne(User::className(), ['id' => 'userid' ]);
    }

}