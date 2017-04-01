<?php
/**
 * 用户模型
 * User: zhangshaohua
 * Date: 16-10-21
 */
namespace common\models\sys;



use Yii;
use common\models\base\BaseSys;
use common\query\CommonQuery;
use yii\data\Pagination;

class User extends BaseSys{

    public static function tableName()
    {
        return 'sys_user';
    }

    public static function tableDesc(){
        return   '用户';
    }

    /**
     * 加密用户密码
     * @param $pwd
     */
    public static function hashPwd($pwd) {

        return md5(md5(strtolower($pwd)));
    }

    /*
     * ajax验证user表里用户名是否已经存在
     */
    public static function checkName($username,$id) {
        if (!empty($id)) {
            $userInfo = self::find()->where('username=:username and id !=:id', [':username' => $username, ':id' => $id])->one();
        } else {
            $userInfo = self::find()->where(['username' => $username])->one();
        }
        if (!empty($userInfo)) {
            return 1;  //返回该用户名已经注册
        } else {
            return 0;
        }
    }

    /*
     * ajax验证user表里用户名是否已经存在
     */
    public static  function checkPhone($userphone,$id) {
        if (!empty($id)) {
            $userInfo = self::find()->where('mobile=:mobile and id !=:id', [':mobile' => $userphone, ':id' => $id])->one();
        } else {
            $userInfo = self::find()->where(['mobile' => $userphone])->one();
        }
        if (!empty($userInfo)) {
            return 1;  //返回该用户名已经注册
        } else {
            return 0;
        }
    }

    public static function searchUser($name = '', $pageSize){
        if ($name) {
            $query = self::find()->where(['like', 'username', $name])->orderBy('id DESC');
            $query = $query->andFilterWhere(['del_flag' => 0]);
        } else {
            $query = self::find()->where(['del_flag' => 0])->orderBy('id DESC');
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
        $info['data'] = $query->offset($pages->offset)->limit($pages->limit)->all();
        $info['pages'] = $pages;
        return $info;
    }
    /**
     * 获取用户信息
    */
    public static function selUser($id){
        return self::findOne($id);
    }

    /**
     * 关联用户扩展表查询
    */
    public function getUserInfo(){
        return $this->hasOne(UserInfo::className(),['userid' => 'id']);
    }

    /**
     * 获取组织结构
    */
    public function getDeptName(){
        return $this->hasOne(Dept::className(), ['id' => 'deptid']);
    }

    /**
     * @Desc:   通过唯一码查询用户信息
     * @Author: < 李效宾 >
     * @Date:   2016-11-22
     * @param:  string $unique_code 唯一码
     * @return: Obj
    */
    public static function getUniqueCodeUser($unique_code = ''){
        if(empty($unique_code)) return false;
        $userInfo = self::find()->where('unique_code = :unique_code', [':unique_code' => $unique_code])->one();
        if(!empty($unique_code)) return $userInfo;
        return false;
    }

    /**
     * 接口查询 根据用户名和站点ID查询 用户信息是否是存在
     * @Params string $username 用户名
     *         string $password 密码
     *         int    $siteId 站点ID
     * @Author <lixiaobin>
     * @Date 2016-02-06
     * @Return Array
     */
    public static function findSiteUser($username, $password, $siteId, $field = '*'){
        $userInfo = self::find()->select($field)->where(['username' => $username, 'password'=>$password, 'status' => 0, 'del_flag' => 0])->asArray()->one();
        if(!empty($userInfo)){
            //查看当前用户是否和当前站点一致
            $userSite = UserSite::find()->where(['userid' => $userInfo['id'], 'siteid' => $siteId])->asArray()->one();
            //查询当前用户所在的城市
            $userCity = Dept::find()->select('cityid')->where(['id' => $userInfo['deptid'], 'status'=> 0, 'del_flag' => 0])->asArray()->one();
            if(!empty($userSite) && !empty($userCity)){
                $userInfo['siteid'] = $userSite['siteid'];
                $userInfo['cityid'] = $userCity['cityid'];
                return $userInfo;
            }
            return false;
        }
        return false;
    }

    /**
     * @author <lixiaobin>
     * @deas 加载CommonQuery类中的公共条件
     *
    */
    public static function find(){
        return new CommonQuery(get_called_class());
    }

}
