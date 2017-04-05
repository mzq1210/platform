<?php
/**
 * 图标控制器
 * User: miaozhongqiang
 * Date: 16-12-01
 * Time: 上午10:13
 */

namespace app\modules\sys\controllers;

use app\components\base\BaseController;
use common\components\library\ShowMessage;
use common\models\sys\Icons;

use yii\helpers\Url;

class IconController extends BaseController
{

    /**
     * 首页列表
     * @author <miaozhongqiang>
     */
    public function actionIndex()
    {
        $params = $this->request->get();
        $info = Icons::search($params);
        
        return $this->render('index',[
            'info' => $info['data'],
            'pages' => $info['pages'],
            'params' => $params,
        ]);
    }

    /**
     * 添加图标
     * @author <miaozhongqiang>
     */
    public function actionAdd()
    {
        if($this->request->isPost){
            $params = $this->request->post();
            if(empty($param['name'])){
                ShowMessage::info('图标名称不可为空');
            }
            $data = [
                'icon' => $params['icon'],
                'name' => $params['name'],
                'add_time' => $this->datetime
            ];
            $model = new Icons();
            $model->setAttributes($data,false);
            if($model->save()){
                ShowMessage::info('添加成功',Url::toRoute(['/sys/icon/index']),'','add');
            }else{
                ShowMessage::info('添加失败');
            }
        }
        $model = new Icons();

        return $this->render('form', [
            'model' => $model
        ]);
    }

    /**
     * 修改图标
     * @param int $id
     * @return string
     */
    public function actionEdit($id)
    {
        $model = Icons::findOne($id);
        if($this->request->isPost){
            $params = $this->request->post();
            if(empty($params['name'])){
                ShowMessage::info('图标名称不可为空');
            }
            $data = [
                'icon' => $params['icon'],
                'name' => $params['name'],
                'edit_time'=> $this->datetime
            ];
            $model->setAttributes($data,false);
            if($model->save()){
                ShowMessage::info('更新成功',Url::toRoute(['/sys/icon/index']),0,'edit');
            }else{
                ShowMessage::info('更新失败');
            }
        }
        return $this->render('form',[
            'model' => $model,
        ]);
    }

    /**
     * 删除图标
     * @param int   $id  图标ID
     * @author <miaozhongqiang>
     */
    public function actionDelete($id)
    {
        $model = Icons::findOne($id);
        $model->setAttributes(['del_flag'=>1],false);
        if($model->save()){
            ShowMessage::info('删除成功',Url::toRoute(['/sys/icon/index']),'2000','edit');
        }else{
            ShowMessage::info('删除失败');
        }
    }
    
}