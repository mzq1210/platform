<?php

/**
 * 权限控制类
 * User: sandom
 * Date: 22/03/16
 * Time: 15:28
 */
namespace app\components;

use yii\caching\Cache;
use yii\db\Connection;
use yii\db\Query;
use yii\di\Instance;
use common\models\sys\UserRole;

class Acl extends \yii\base\Component
{

    private static $userRoleTable = 'sys_user_role';

    private static $roleMenuTable = 'sys_user_role_menu';

    private static $menuTable = 'sys_menu';

    public $cache;

    public $db = 'db';

    //默认超级管理员id
    public static $superAdminId = 1;

    //默认超级管理员角色
    public static $superAdminRoleId = 1;

    public function __construct()
    {
        $this->db = Instance::ensure($this->db,Connection::className());
        if($this->cache !== null){
            $this->cache = Instance::ensure($this->cache,Cache::className());
        }
    }

    /**
     * 判断用户有没有访问权限
     * @param $userId int 用户ID
     * @param $m string 模块
     * @param $c string 控制器
     * @param $a string 方法
     * @return boolean true Or false
     */
    public static function isAllow($userid = 0,$m,$c, $a)
    {
        if(Acl::isSuperAdmin($userid))//超级管理员
            return true;
        $query = new Query();
        $query ->from(['m'=>self::$menuTable]);
        $query ->leftJoin(['rm' => self::$roleMenuTable],'{{rm}}.menuid={{m}}.id');
        $query ->leftJoin(['u' => self::$userRoleTable],'{{u}}.roleid = {{rm}}.roleid');
        $query ->where('u.userid=:userid AND m.m=:m AND m.c=:c AND m.a=:a',
                      [':userid'=> $userid ,':m'=>$m,':c'=>$c, ':a' => $a]);
        $data = [];
//        $command = $query->createCommand();
//        echo $command->rawSql;die;
        foreach($query ->all() as $row){
            $data[] = $row;
            if(!empty($row)) break;
        }
        if($data){
            return true;
        }

        return false;
    }
    public static function isAllowByRole($roleid,$m,$c,$a)
    {
        if(Acl::isSuperAdminByRole($roleid)){
            return true;
        }
        $query = new Query();
        $query->from(['m'=>self::$menuTable]);
        $query->leftJoin(['rm'=> self::$roleMenuTable],'{{rm}}.menuid={{m}}.id');
        $query->where('m.m=:m AND m.c=:c AND m.a=:a',[':m'=>$m,':c'=>$c, ':a' => $a]);
        if(is_array($roleid)){
            $query->andWhere(['in', 'rm.roleid', $roleid]);
        }else{
            $query->andWhere('rm.roleid=:roleid',[':roleid' => (int)$roleid]);
        }


        $data=[];
        foreach($query ->all() as $row){
            $data[] = $row;
            if(!empty($row)) break;
        }
        if($data){
            return true;
        }

        return false;
    }

    /**
     * 页面中是否显示该功能
     * @param string $m
     * @param string $c
     * @param string $a
     * @return mixed
     */
    public static function isAclAuth($m = '', $c = '', $a = ''){
        $roleid = \Yii::$app->session->get('roleid');
        $isAcl = (int)self::isAllowByRole($roleid,$m,$c,$a);
        if(!empty($isAcl)) return 'aclblock';
        return 'aclnone';
    }

    /**
     * 是否为超级管理员(超级管理员拥有系统所有权限)
     */
    public static function isSuperAdmin($userid = 1, $roleid = 0){
        if($userid == self::$superAdminId){
            return true;
        }else{
            $roleids = UserRole::getUserRole($userid);
            if($roleids && in_array(self::$superAdminRoleId, $roleids)){
                return true;
            }
        }
        if(is_array($roleid)){
            return in_array(self::$superAdminRoleId, $roleid);
        }else{
            if($roleid == self::$superAdminRoleId){
                return true;
            }
        }

        return false;
    }
    public static function isSuperAdminByRole($roleid = 0)
    {
        return $roleid == self::$superAdminRoleId;
    }

}