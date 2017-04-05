<?php
/*
 * @author miaozhongqiang
 * @date 2016-11-07 15:23
 * @desc 角色-菜单Model
 */
namespace common\models\sys;

use Yii;
use yii\helpers\ArrayHelper;

class RoleMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_user_role_menu';
    }

    /**
     * @desc  查询一个用户的角色
     * @param int $roleid
     * @return array|\yii\db\ActiveRecord[]
     * @author <miaozhongqiang>
     */
    public static function getRoleMenu($roleid = 0){
        $list = self::find()
            ->where('roleid=:roleid', [':roleid' => $roleid])
            ->select('menuid')
            ->asArray()
            ->all();

        return ArrayHelper::getColumn($list, 'menuid');
    }

    /**
     * @desc  根据角色id和菜单id删除
     * @param int $roleid  角色ID
     * @param array $menuids
     * @return bool|int
     * @author <miaozhongqiang>
     */
    public static function delRoleMenu($roleid, $menuids = []){
        if(!$roleid || !$menuids) return false;
        if(is_array($menuids)){
            return self::deleteAll([
                'and',
                'roleid = :roleid',
                ['in', 'menuid', $menuids]
            ],[':roleid' => $roleid]);
        }else{
            return self::deleteAll(['roleid=:roleid AND menuid=:menuid', [':roleid' => $roleid,':menuid' => $menuids]]);
        }
    }
}
