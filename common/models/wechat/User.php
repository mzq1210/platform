<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-11-29
 * Time: 上午9:30
 */

namespace common\models\wechat;

use common\models\base\BaseWechat;

class User extends BaseWechat
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat_user';
    }


    public static function getUserOpenId($openid){
        return self::find()->select(['openid'])->where(['openid'=>$openid])->one();
    }

    public static function getUserInfo($openid){
        return self::find()->where(['openid'=>$openid])->asArray()->one();
    }
}