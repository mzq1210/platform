<?php

namespace common\models\sys;


use yii;
use common\models\base\BaseSys;
use yii\helpers\ArrayHelper;
use common\query\CommonQuery;

class UserRole extends BaseSys
{
    public static function tableName()
    {
        return 'sys_user_role';
    }

    /*
     * 开 发: zsh
     * 时 间: 2016-11-10
     * 说 明:查询一个用户的角色
     */
    public static function getUserRole($userid = 0){
        $list = self::find()
            ->where('userid=:userid', [':userid' => $userid])
            ->select('roleid')
            ->asArray()
            ->all();
        /*if(!empty($siteid)){
            $list->andFilterWhere(['siteid' => $siteid]);
        }*/

        return ArrayHelper::getColumn($list, 'roleid');
    }

    public static function find(){
        return new CommonQuery(get_called_class());
    }

}