<?php
/*
 * 菜单管理控制器
 * @author miaozhongqiang
 * @date 2016-11-07 15:23
 */
namespace app\modules\sys\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\sys\Menu;
use common\models\sys\Icons;
use app\components\TreeMenu;
use common\components\library\ShowMessage;
use app\components\base\BaseController;

class MenuController extends BaseController
{

    /**
     * 首页列表
     * @author <miaozhongqiang>
     */
    public function actionIndex()
    {
        $params = $this->request->post();
        $dataProvider = Menu::search($params);

        $data = array();
        if ($list = $dataProvider->getModels()) {
            foreach ($list as $val) {
                $temp['id'] = $val['id'];
                $temp['sort'] = $val['sort'];
                $res = self::_checkParent($list, $temp['id']);
                $temp['name'] = $res == false ? '&nbsp;&nbsp;&nbsp;&nbsp;' . $val['name'] : $val['name'];
                $temp['parentid'] = $val['parentid'];
                $temp['display'] = $val['display'] ? '<i class="glyphicon glyphicon-remove-sign font-red">' : '<i class="glyphicon glyphicon-ok-sign font-green">';
                $temp['parentid_node'] = ($val['parentid']) ? ' class="child-of-node-' . $val['parentid'] . '"' : '';
                $delurl = Url::toRoute(['/sys/menu/delete', 'id' => $val['id']]);
                $temp['str_manage'] = '
                <a class="btn btn-success button" href="javascript:createsonmenu(\'' . $val['id'] . '\');"><i class="glyphicon glyphicon-plus-sign"></i> 添加子菜单</a> 
                <a class="btn btn-info button" href="javascript:edit(\'' . $val['id'] . '\',\'' . $val['parentid'] . '\');"><i class="glyphicon glyphicon-edit"></i> 编辑</a> 
                <a class="btn btn-danger button" href="javascript:confirmurl(\'' . $delurl . '\',\'确定要删除' . $val['name'] . '吗？\');" ><i class="glyphicon glyphicon-trash"></i> 删除</a>';
                $data[] = $temp;unset($temp);
            }
        }
        $categorys = $this->_menuTree($data, 0, 'tr');
        $showWay = 1;//1为折叠显示。2为缩进显示
        //var_dump($categorys);die;
        return $this->render('index', [
            'data' => $data,
            'categorys' => $categorys,
            'showWay' => $showWay,
            'params' => $params
        ]);
    }

    /**
     * 添加顶级
     * @author <miaozhongqiang>
     */
    public function actionAdd()
    {
        //异步获取菜单
        if (Yii::$app->request->isAjax) {
            $params['siteid'] = $this->request->post('siteid');
            $menuList = Menu::search($params)->getModels();
            $data = array();
            foreach ($menuList as $i => $item) {
                $data[$i + 1] = array('id' => $item->id, 'parentid' => $item->parentid, 'name' => $item->name);
                $data[$i + 1]['level'] = $item->level + 1;
            }
            $str = $this->_menuTree($data, 0);
            exit(Json::encode($str));
        }

        $model = new Menu();
        if ($this->request->isPost) {
            $params = $this->request->post();
            if(empty($params['name'])){
                ShowMessage::info('菜单名称不可为空');
            }
            $data = [
                'parentid' => $params['parentid'],
                'name' => $params['name'],
                'icons' => $params['icons'],
                'm' => $params['m'],
                'c' => $params['c'],
                'a' => $params['a'],
                'param' => $params['param'],
                'display' => $params['display'],
                'add_time' => $this->datetime,
                'edit_time' => $this->datetime,
                'creator' => $this->userid,
                'updater' => $this->userid,
            ];
            $model->setAttributes($data, false);
            if ($model->save()) {
                ShowMessage::info('添加成功', Url::toRoute(['/sys/menu/index']), '', 'add');
            } else {
                ShowMessage::info('添加失败');
            }
        } else {
            $iconList = Icons::find()->all();
            return $this->render('form', [
                'model' => $model,
                'iconList' => $iconList
            ]);
        }
    }

    /**
     * 添加子集
     * @param  int $id
     * @return string
     */
    public function actionAddchildren($id)
    {
        $newmodel = new Menu();
        if ($this->request->isPost) {
            $params = $this->request->post();
            if(empty($params['name'])){
                ShowMessage::info('菜单名称不可为空');
            }
            if(empty($params['m'])){
                ShowMessage::info('模块名称不可为空');
            }
            if(empty($params['c'])){
                ShowMessage::info('控制器名称不可为空');
            }
            if(empty($params['a'])){
                ShowMessage::info('方法名称不可为空');
            }
            $data = [
                'parentid' => $params['parentid'],
                'name' => $params['name'],
                'icons' => $params['icons'],
                'm' => $params['m'],
                'c' => $params['c'],
                'a' => $params['a'],
                'param' => $params['param'],
                'display' => $params['display'],
                'add_time' => $this->datetime,
                'edit_time' => $this->datetime,
                'creator' => $this->userid,
                'updater' => $this->userid,
            ];
            $newmodel->setAttributes($data, false);
            if ($newmodel->save()) {
                ShowMessage::info('添加成功', Url::toRoute(['/sys/menu/index']), '', 'addson');
            } else {
                ShowMessage::info('添加失败');
            }
        } else {
            $model = Menu::getDetailGroupById($id);
            $iconList = Icons::find()->all();
            return $this->render('sonform', [
                'model' => $model,
                'iconList' => $iconList
            ]);
        }
    }

    /**
     * 修改菜单
     * @param int $id
     * @return string
     */
    public function actionEdit($id)
    {
        $model = Menu::getDetailGroupById($id);
        if ($this->request->isPost) {
            $params = $this->request->post();
            if(empty($params['name'])){
                ShowMessage::info('菜单名称不可为空');
            }
            $data = [
                'parentid' => $params['parentid'],
                'name' => $params['name'],
                'icons' => $params['icons'],
                'm' => $params['m'],
                'c' => $params['c'],
                'a' => $params['a'],
                'param' => $params['param'],
                'display' => $params['display'],
                'edit_time' => $this->datetime,
                'updater' => $this->userid,
            ];
            $model->setAttributes($data, false);
            if ($model->save()) {
                ShowMessage::info('添加成功', Url::toRoute(['/sys/menu/index']), '', 'edit');
            } else {
                ShowMessage::info('添加失败');
            }
        } else {
            $data = array();
            $menuList = Menu::search()->getModels();
            foreach ($menuList as $i => $item) {
                $data[$i + 1] = array('id' => $item->id, 'parentid' => $item->parentid, 'name' => $item->name);
                $data[$i + 1]['level'] = $item->level + 1;
            }
            $str = $this->_menuTree($data, $model->parentid);
            $iconList = Icons::find()->all();

            return $this->render('form', [
                'model' => $model,
                'str' => $str,
                'iconList' => $iconList
            ]);
        }
    }

    /**
     * 删除菜单
     * @param int $id 菜单ID
     * @author <miaozhongqiang>
     */
    public function actionDelete($id)
    {
        $model = Menu::getDetailGroupById($id);
        if ($model->del_flag != 1) {
            $data = [
                'del_flag' => 1,
            ];
            $model->setAttributes($data, false);
            if ($model->save()) {
                ShowMessage::info('删除成功', Url::toRoute(['/sys/menu/index']), '', 'edit');
            } else {
                ShowMessage::info('删除失败');
            }
        } else {
            ShowMessage::info('该数据不存在');
        }
    }

    /**
     * 判断子集
     * @author miaozhongqiang
     * @param array $arr
     * @param int $id
     * @return bool
     */
    private static function _checkParent($arr, $id) {
        foreach ($arr as $v) {
            if ($v['parentid'] == $id) {
                return true;
            }
        }
        return false;
    }

    /**
     * 菜单转化树结构
     * @param array $data 原始数据
     * @param int $parentid
     * @param string $type
     * @author <miaozhongqiang>
     * @return string
     */
    private static function _menuTree($data, $parentid, $type = "option") {
        if ($type == "option") {
            $str = "<option value=\$id level=\$level \$selected>\$spacer\$name</option>";
        } else {
            $str = "<tr id='node-\$id' \$parentid_node>
                <td align='left' class='name'>\$name</td>
                <td align='left'><input type='text' value='\$sort' name='sort[]' class='listorder' data-menuid='\$id' data-name='\$name' data-listorder='\$sort' onblur='changeorder(this)' style='width:40px;'></td>
                <td align='left'>\$display</td>
                <td align='left'>\$str_manage</td>
            </tr>";
        }
        return TreeMenu::getTree($data, 0, $parentid, $adds = '', $str_group = '', $str);
    }

}
