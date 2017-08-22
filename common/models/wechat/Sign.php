<?php
namespace common\models\wechat;

use Yii;
use common\models\base\BaseWechat;

class Sign extends BaseWechat{

    /**
     * @inheritdoc
     */
    public static function tableName(){
        return 'wechat_sign';
    }

    public static function signStatus($params){
        return self::find()->where(['userID' => $params['userID']])->andWhere(['>', 'sign_time', $params['sign_time']])->one();
    }

    public static function signDate($params){
        return self::find()->where(['userID' => $params['userID']])->andWhere(['>', 'sign_time', $params['month']])->asArray()->all();
    }
}















?>