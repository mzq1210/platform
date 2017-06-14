<?php
/**
 * Created by PhpStorm.
 * User: <liangshimao>
 * Date: 16-11-28
 * Time: 上午11:58
 * 问卷基础表
 */

namespace common\models\base;


use yii\db\ActiveRecord;
use Yii;

class BaseWechat extends ActiveRecord
{
    public static function getDb(){
        return Yii::$app->wechatDb;
    }
}