<?php

/*
 * 字典的管理
 * @author <mzq>
 * @date Dec 1, 2016 10:52:58 AM
 */

namespace app\modules\sys\controllers;

use Yii;
use yii\helpers\Url;
use common\models\sys\Dict;
use app\components\base\BaseController;
use common\components\library\DictTool;
use common\components\library\ShowMessage;

class DictController extends BaseController {

    public function actionIndex() {
        $searchModel = new Dict();
        $params = Yii::$app->request->queryParams;
        $params['pageSize'] = $this->request->get('per-page', PAGESIZE);
        $info = $searchModel->searchDict($params);
        return $this->render('index', [
                'info' => $info,
                'params' => $params
        ]);
    }

    public function actionAdd() {
        if (Yii::$app->request->isPost) {
            $info = Yii::$app->request->post('Dict');
            $info['add_time'] = $info['edit_time'] = $this->datetime;
            $info['creator'] = $info['creator'] = $this->userid;
            $model = new Dict();
            $model->setAttributes($info, false);
            if ($model->save()) {
                ShowMessage::info('新增成功', '', Url::toRoute(['/sys/dict/index']), 'add');
            } else {
                ShowMessage::info('新增失败');
            }
        }
        return $this->render('add');
    }

    public function actionDelete($id) {
        $params['editor'] = $this->userid;
        $params['edit_time'] = $this->datetime;
        if (Dict::delRecord($id, $params)) {
            ShowMessage::info('删除成功', '', Url::toRoute(['/setting/dict/index']));
        } else {
            ShowMessage::info('系统异常,操作失败');
        }
    }

    public function actionEdit($id) {
        $info = Dict::findOne($id);
        if (Yii::$app->request->isPost) {
            $postInfo = Yii::$app->request->post('Dict');
            if (!$postInfo['dict_group_id'] || $postInfo['code'] === null || !$postInfo['label']) {
                ShowMessage::info('修改失败,数据填写不完整');
            }
            $info->setAttributes($postInfo, false);
            $info->save();
            DictTool::deleteDict($postInfo['dict_group_id']);
            ShowMessage::info('成功', '', Url::toRoute(['dict/index']), 'edit');
        }
        return $this->render('edit', ['info' => $info]);
    }

}
