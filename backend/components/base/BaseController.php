<?php
namespace app\components\base;

use Yii;
use yii\web\Controller;
use app\models\sys\MenuModel;
use app\components\Acl;
use common\components\Tools;
use yii\web\MethodNotAllowedHttpException;
use common\components\library\ShowMessage;
use yii\helpers\Url;

class BaseController extends Controller{

    public $request;
    public $session;
    public $userid;
    public $username;
    public $realname;
    public $siteid;
    public $roleid;
    public $datetime;

    public function init(){
        $this->request = Yii::$app->request;
        $this->session = Yii::$app->session;
        $this->userid = $this->session->get('userid');
        if(empty($this->userid)){
            ShowMessage::info('您还没有登录！',Url::toRoute('/login/login'),1000);
        }
        $this->username = $this->session->get('username');
        $this->siteid = $this->session->get('siteid');
        $this->roleid = $this->session->get('roleid');
        $this->datetime = date('Y-m-d H:i:s');
    }

    public function beforeAction($action){
        $m = $this->module->id;
        $c = Yii::$app->controller->id;
        $a = Yii::$app->controller->action->id;

        //检查是否是超级管理员权限
        $isAdmin = $this->_isAdmin();
        if(!empty($isAdmin)) return true;

        $isMenu = $this->_notCheckMenu($m, $c, $a);

        if(empty($isMenu)) return true;
        if (false === Acl::isAllow($this->userid, $m, $c, $a)) {
            $url = Tools::createUrl($m, $c, $a);
            throw new MethodNotAllowedHttpException('抱歉,您没有访问' . $url . '页面的权限', 405);
        }
        return true;

    }

    /**
     * @Desc:   获取当前用户和站点ID获取菜单
     * @Params: int $siteid 站点ID
     * @params: int $roleid 角色ID
     * @Date:   2016-11-18
     * @Return: array
     */
    protected function menuTreeByRole($roleid) {
        if ($this->_isAdmin()) {
            return MenuModel::getSiteMenuTree();
        }
        return MenuModel::getRoleMenuTree($roleid);
    }

    private function _isAdmin(){
        return Acl::isSuperAdmin($this->userid, $this->roleid);
    }

    /**
     * @Desc:   只验证菜单，不验证节点
     * @Param:  string $m 模块名称
     * @Param:  string $c 控制器名称
     * @Param:  string $a 方法名称
     * @Date:   2016-11-18
     * @Rrturn: true OR false
     */
    private function _notCheckMenu($m = '', $c = '', $a = ''){
        $isin = MenuModel::checkUserMenuAlc($m, $c, $a);
        if(!empty($isin)) return true;
        return false;
    }

}