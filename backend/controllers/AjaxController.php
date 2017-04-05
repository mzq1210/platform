<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-11-4
 * Time: 下午2:49
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\sys\Menu;
use common\models\sys\RoleMenu;

class AjaxController extends Controller
{
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















