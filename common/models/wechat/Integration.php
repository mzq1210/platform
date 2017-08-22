<?php
namespace common\models\wechat;

use Yii;
use common\models\base\BaseWechat;

class Integration extends BaseWechat{

    /**
     * @inheritdoc
     */
    public static function tableName(){
        return 'wechat_integration';
    }

    public static function integrationStatus($params){
        return self::find()->where($params)->one();
    }

    public static function getIntegration($params){
        return self::find()->where($params)->asArray()->one();
    }

}















?>