<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-11-18
 * Time: 上午9:53
 */
namespace app\models\sys;

use common\models\sys\Menu;
use common\components\Tools;
use yii\db\Query;

class MenuModel extends Menu{


    /**
     * @Author: < mzq >
     * @Desc:   根据当前站点id和角色id，获取菜单列表
     * @Param:  int $roleid 角色ID
     * @Date:   2016-11-18
     * @Return: Array
    */
    public static function getRoleMenuTree($roleid = 0){
        $query = new Query();
        $query->from(['m'=> self::tableName()]);
        $query->leftJoin(['rm' => 'sys_user_role_menu'],'{{rm}}.menuid={{m}}.id');
        $query->where('m.display=:display AND m.del_flag=:del_flag', [':display' => 0,':del_flag' => 0]);
        if(is_array($roleid)){
            $query->andWhere(['in', 'rm.roleid', $roleid]);
        }else{
            $query->andWhere('rm.roleid=:roleid',[':roleid' => (int)$roleid]);
        }
        $list = $query->orderBy(['sort'=> SORT_ASC,'id'=>SORT_ASC])
            ->all();
        $list = Tools::getMenuTree($list, 0);
        return $list;
    }

    /**
     * 获取菜单树
     */
    public static function getSiteMenuTree(){
        $list = self::find()
            ->where('display=:display AND del_flag=:del_flag', [':display' => 0,':del_flag' => 0])
            ->orderBy(['sort'=> SORT_ASC,'id'=> SORT_ASC])
            ->asArray()
            ->all();;
        $list = Tools::getMenuTree($list, 0);

        return $list;
    }

    /**
     * @Author: < mzq >
     * @Desc:   验证用户是否有这个菜单的权限
     * @Param:  string $m 模块名称
     * @Param:  string $c 控制器名称
     * @Param:  string $a 方法名称
     * @Date:   2016-11-18
     * @Return: true OR false
     */
    public static function checkUserMenuAlc($m, $c, $a){
        $info = self::find()->onlyTrashed()->isStatus()
            ->where('m = :m AND c = :c AND a = :a',[':m' => $m, ':c' => $c, ':a' => $a])
            ->select('id')
            ->asArray()
            ->one();

        if(!empty($info)) return true;
        return false;
    }
}