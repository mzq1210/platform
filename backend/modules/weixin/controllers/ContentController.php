<?php
/*
 * 角色管理控制器
 * @author miaozhongqiang
 * @date 2016-11-07 15:23
 */
namespace app\modules\weixin\controllers;

use Yii;
use yii\helpers\Url;
use common\models\wechat\Content;
use app\components\base\BaseController;
use common\components\library\ShowMessage;

class ContentController extends BaseController{

    /**
     * 首页列表
     * @return string
     * @author <miaozhongqiang>
     */
    public function actionIndex()
    {
        $params = $this->request->get();
        $params['per-page'] = !empty($params['per-page']) ? $params['per-page'] : PAGESIZE;

        $info = Content::search($params);
        return $this->render('index', [
            'info' => $info['data'],
            'pages' => $info['pages'],
            'params' =>$params
        ]);
    }

    /**
     * 删除
     * @param int   $id
     * @return bool|null|static
     * @author <miaozhongqiang>
     */
    public function actionDelete($id)
    {
        $model = Content::findOne($id);
        if($model->del_flag != 1) {
            $data = [
                'del_flag' => 1,
            ];
            $model->setAttributes($data,false);
            if ($model->save()) {
                ShowMessage::info('删除成功',Url::toRoute(['/weixin/content/index']),'','edit');
            }else{
                ShowMessage::info('删除失败');
            }
        }else{
            ShowMessage::info('该数据不存在');
        }
    }
}
