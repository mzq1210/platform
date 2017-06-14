<?php
namespace app\modules\sys\controllers;

/*
 * 分类管理控制器
 * @author miaozhongqiang
 * @date 2016-11-07 15:23
 */
use Yii;
use yii\helpers\Url;
use common\models\sys\Icons;
use app\components\TreeMenu;
use common\models\wechat\Category;
use app\components\base\BaseController;
use common\components\library\ShowMessage;

class CategoryController extends BaseController{
    
    public function actionIndex(){
        $params = $this->request->post();
        $dataProvider = Category::search($params);

        $list = $dataProvider->getModels();
        $data = array();
        foreach ($list as $val){
            $temp['id'] = $val['id'];
            $temp['sort'] = $val['sort'];
            $res = self::_checkParent($list, $temp['id']);
            $temp['name'] = $res == false ? '&nbsp;&nbsp;&nbsp;&nbsp;' . $val['name'] : $val['name'];
            $temp['parentid'] = $val['parentid'];
            $temp['display'] = $val['display'] ? '<i class="glyphicon glyphicon-remove-sign font-red">' : '<i class="glyphicon glyphicon-ok-sign font-green">';
            $temp['parentid_node'] = ($val['parentid']) ? ' class="child-of-node-' . $val['parentid'] . '"' : '';
            $delurl = Url::toRoute(['/sys/category/delete', 'id' => $val['id']]);
            $temp['str_manage'] = '
                <a class="btn btn-success button" href="javascript:createsonmenu(\'' . $val['id'] . '\');"><i class="glyphicon glyphicon-plus-sign"></i> 添加子菜单</a>
                <a class="btn btn-info button" href="javascript:edit(\'' . $val['id'] . '\',\'' . $val['parentid'] . '\');"><i class="glyphicon glyphicon-edit"></i> 编辑</a>
                <a class="btn btn-danger button" href="javascript:confirmurl(\'' . $delurl . '\',\'确定要删除' . $val['name'] . '吗？\');" ><i class="glyphicon glyphicon-trash"></i> 删除</a>';
            $data[] = $temp;unset($temp);
        }

        $categorys = $this->_menuTree($data, 0, 'tr');
        $showWay = 1;//1为折叠显示。2为缩进显示
        return $this->render('index', [
            'categorys' => $categorys,
            'showWay' => $showWay,
            'params' => $params,
        ]);

}
    /**
     * 添加顶级分类
     * @param int $id
     * @return string
     */
    public function actionAdd(){
        $model=new Category();
        if($this->request->isPost){
            $params = $this->request->post();
            $data=[
                'name' => $params['name'],
                'sort' => $params['sort'],
                'display' => $params['display'],
                'type' => $params['type'],
            ];
            $model->setAttributes($data,false);
            if ($model->save()) {
                ShowMessage::info('添加成功', Url::toRoute(['/sys/category/index']), '', 'add');
            } else {
                ShowMessage::info('添加失败');
            }
        }
        $iconList = Icons::find()->all();
        return $this->render('form',[
            'model' => $model,
            'iconList' => $iconList
        ]);
    }

    /**
     * 添加子分类
     * @param int $id 菜单ID
     */
    public function actionAddchildren($id){
        $newmodel = new Category();
        if ($this->request->isPost) {
            $params = $this->request->post();
            if(empty($params['name'])){
                ShowMessage::info('菜单名称不可为空');
            }
            $data = [
                'name' => $params['name'],
                'sort' => $params['sort'],
                'type' => $params['type'],
                'display' => $params['display'],
                'parentid' => $params['parentid'],
            ];
            $newmodel->setAttributes($data, false);
            if ($newmodel->save()) {
                ShowMessage::info('添加成功', Url::toRoute(['/sys/menu/index']), '', 'addson');
            } else {
                ShowMessage::info('添加失败');
            }
        } else {
            $model = Category::getDetailGroupById($id);
            $iconList = Icons::find()->all();
            return $this->render('sonform', [
                'model' => $model,
                'iconList' => $iconList
            ]);
        }
    }

    /**
     * 修改分类
     * @param int $id 菜单ID
     */
    public function actionEdit($id)
    {
        $model = Category::getDetailGroupById($id);
        if ($this->request->isPost) {
            $params = $this->request->post();
            if(empty($params['name'])){
                ShowMessage::info('菜单名称不可为空');
            }
            $data = [
                'name' => $params['name'],
                'sort' => $params['sort'],
                'type' => $params['type'],
                'display' => $params['display']
            ];
            $model->setAttributes($data, false);
            if ($model->save()) {
                ShowMessage::info('添加成功', Url::toRoute(['/sys/category/index']), '', 'edit');
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
     * 删除分类
     * @param int $id 菜单ID
     */
    public function actionDelete($id)
    {
       
        $model = Category::getDetailGroupById($id);
        if ($model->del_flag != 1) {
            $data = [
                'del_flag' => 1,
            ];
            $model->setAttributes($data, false);
            if ($model->save()) {
                ShowMessage::info('删除成功', Url::toRoute(['/sys/category/index']), '', 'edit');
            } else {
                ShowMessage::info('删除失败');
            }
        } else {
            ShowMessage::info('该数据不存在');
        }
    }


    /**
     * 判断子集
     * @author
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






?>