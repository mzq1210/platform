<?php
/**
 * Created by PhpStorm.
 * User: leexb
 * Date: 16-10-21
 * Time: 下午3:26
 * Desc: 用户模块基类model
 */
namespace common\models\base;

use Yii;
use yii\db\ActiveRecord;

class BaseSys extends ActiveRecord{

    public static function getDb(){
        return Yii::$app->db;
    }
    
}