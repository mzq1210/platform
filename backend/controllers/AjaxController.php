<?php
/**
 * Created by PhpStorm.
 * User: zsh
 * Date: 16-11-4
 * Time: 下午2:49
 */

namespace backend\controllers;

use Yii;
use common\models\filter\Keywords;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\sys\Dept;
use common\models\sys\Menu;
use common\models\sys\RoleMenu;
use common\models\sys\Icons;

class AjaxController extends Controller
{
    /**
     * @Desc:   获取组织结构
     * @Author: < zsh >
     * @return: array
     */
    public function actionGetorganiz()
    {
        $this->layout = false;
        $dataProvider = new ActiveDataProvider([
            'query' => Dept::find()->where(['del_flag' => 0])->orderby([ 'id' => SORT_ASC]),
            'pagination' => [
                'pagesize' => 1000
            ],
        ]);
        $dataProvider = $dataProvider->getModels();
        $typeId   = Yii::$app->request->post('typeId'); //选择组织机构类型，1是添加或修改用户的类型，2是添加或修改组织结构选择上下级
        $deptId   = Yii::$app->request->post('deptId'); //组织机构id,如果选择编辑，默认会选上

        return $this->render('getorganiz', ['dataProvider' => $dataProvider, 'typeId' => $typeId, 'deptId'=>$deptId]);
    }
    
    
    /**
     * @desc  获取菜单列表
     * @author miaozhongqiang
     * @return string
     */
    public function actionGetmenu(){
        $this->layout = false;
        $params = Yii::$app->request->post();
        $dataProvider = new ActiveDataProvider([
            'query' => Menu::find()->where(['del_flag' => 0, 'status' => 0]),
            'pagination' => [
                'pagesize' => 1000
            ],
        ]);
        $dataProvider = $dataProvider->getModels();

        $menuIds = RoleMenu::find()->select('menuid')->where(['roleid'=>$params['id']])->all();
        $menuArr = [];
        foreach ($menuIds as $key => $value){
            $menuArr[] = $value->menuid;
        }

        return $this->render('getmenu',[
            'dataProvider' => $dataProvider,
            'params' =>$params,
            'menuIds' =>$menuArr
        ]);
    }
    
}















