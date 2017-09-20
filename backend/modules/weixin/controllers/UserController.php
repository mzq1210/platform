<?php
namespace app\modules\weixin\controllers;

use Yii;
use yii\helpers\Url;
use common\models\wechat\User;
use app\components\base\BaseController;
use common\components\library\ShowMessage;

class UserController extends BaseController
{

    /**
     * 首页列表
     * @return string
     * @author <miaozhongqiang>
     */
    public function actionIndex()
    {
        $params = $this->request->get();
        $params['per-page'] = !empty($params['per-page']) ? $params['per-page'] : PAGESIZE;

        $info = User::search($params);
        $count = User::count();
        $todayLogin = User::todayLogin();
        return $this->render('index', [
            'info' => $info['data'],
            'pages' => $info['pages'],
            'params' =>$params,
            'count' => $count,
            'todayLogin' =>$todayLogin
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
        $model = User::findOne($id);
        if($model->del_flag != 1) {
            $data = [
                'del_flag' => 1,
            ];
            $model->setAttributes($data,false);
            if ($model->save()) {
                ShowMessage::info('删除成功',Url::toRoute(['/weixin/user/index']),'','edit');
            }else{
                ShowMessage::info('删除失败');
            }
        }else{
            ShowMessage::info('该数据不存在');
        }
    }

}
