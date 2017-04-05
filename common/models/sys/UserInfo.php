<?php
/**
 * 用户信息模型
 * User: mzq
 * Date: 16-11-8
 */

namespace common\models\sys;

use yii;
use common\models\base\BaseSys;

class UserInfo extends BaseSys
{
    public static function tableName()
    {
        return 'sys_user_info';
    }

    public static function tableDesc(){
        return   '用户信息';
    }

    /**
     * 开 发: mzq
     * 说 明:根据id获取用户信息详情
     * 参 数: $siteid 站点ID
     * 参 数: int $userid
     * 返 回: Object
     */
    public static function getUserInfo($userid = 0){
        if(!empty($userid)){
            return self::find()->where('userid = :userid',['userid' => $userid])->one();
        }else{
            return self::find()->all();
        }
    }
}