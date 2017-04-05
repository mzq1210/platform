<?php

/*
 * 字典组管理
 * @author <liangpingzheng>
 * @date Dec 1, 2016 10:52:58 AM
 */

namespace app\modules\sys\controllers;

use common\components\library\OutPut;
use Yii;
use yii\helpers\Url;
use common\models\sys\DictGroup;
use common\components\library\ShowMessage;
use app\components\base\BaseController;

class DictgroupController extends BaseController {

    public function actionIndex() {
        $searchModel = new DictGroup();
        $params = Yii::$app->request->queryParams;
        $params['pageSize'] = $this->request->get('per-page', PAGESIZE);
        $info = $searchModel->search($params);
        return $this->render('index', ['info' => $info, 'params' => $params]);
    }

    public function actionAdd() {
        if (Yii::$app->request->isPost) {
            $info = Yii::$app->request->post('DictGroup');
            if (!$info['code'] || !$info['name']) {
                ShowMessage::info('新增失败,数据填写不完整');
            }
            $info['add_time'] = $info['edit_time'] = $this->datetime;
            $info['creator'] = $info['creator'] = $this->userid;
            $info['editor'] = $info['editor'] = $this->userid;
            if (DictGroup::addRecord($info)) {
                ShowMessage::info('新增成功', '', Url::toRoute(['/sys/dictgroup/index']), 'add');
            } else {
                ShowMessage::info('新增失败');
            }
        }
        return $this->render('add');
    }

    public function actionEdit($id) {
        if (Yii::$app->request->isPost) {
            $postInfo = Yii::$app->request->post('DictGroup');
            if (!$postInfo['code'] || !$postInfo['name']) {
                ShowMessage::info('修改失败,数据填写不完整');
            }

            $postInfo['edit_time'] = $this->datetime;
            $postInfo['editor'] = $this->userid;
            if (DictGroup::editRecord($id, $postInfo)) {
                ShowMessage::info('成功', 'close', Url::toRoute(['/sys/dictgroup/index']), 'edit');
            } else {
                ShowMessage::info('更新失败');
            }
        }
        $info = DictGroup::findOne($id);
        return $this->render('edit', ['info' => $info]);
    }

    public function actionDelete($id) {
        $params['editor'] = $this->userid;
        $params['edit_time'] = $this->datetime;
        if (DictGroup::delRecord($id, $params)) {
            ShowMessage::info('删除成功', '', Url::toRoute(['/sys/dictgroup/index']));
        } else {
            ShowMessage::info('系统异常,操作失败');
        }
    }

    public function actionCheckcode_ajax(){
        if($this->request->isAjax){
            $code = $this->request->get('code','');
            if(!preg_match("/^[a-zA-Z_]+$/", $code))  OutPut::returnJson('编码不能为空',201);
            $info = DictGroup::getOneDictGroup($code);
            if(!empty($info)) OutPut::returnJson('当前编码已存在',201);
            OutPut::returnJson('当前编码可以用',200);
        }
        OutPut::returnJson('编码不能为空',201);
    }

    public function actionCheckname_ajax(){
        if($this->request->isAjax){
            $name = $this->request->get('name','');
            if(!preg_match("/^[\x{4e00}-\x{9fa5}a-zA-Z_]+$/u", $name))  OutPut::returnJson('名称不能为空',201);
            $info = DictGroup::getOneDictGroup($name,2);
            if(!empty($info)) OutPut::returnJson('当前名称已存在',201);
            OutPut::returnJson('当前名称可以用',200);
        }
        OutPut::returnJson('名称不能为空',201);
    }
    
    

}
