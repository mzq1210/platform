<?php
/**
 * 日志管理控制器
 * @Author: mzq
 * @Date: 16-11-7
 */
namespace app\modules\sys\controllers;

use Yii;
use common\models\sys\Log;
use app\components\base\BaseController;
use common\components\library\ShowMessage;
use yii\helpers\Url;

class LogController extends BaseController
{

    /**
     * @Author <lixiaobin>
     * @Date   2016-11-07
     * @Desc   日志列表
     */
    public function actionIndex()
    {
        $params = $this->request->get();
        $params['pageSize'] = !empty($params['per-page']) ? $params['per-page'] : PAGESIZE;
        $logModel = new Log();
        $info = $logModel::searchLog($params);
        return $this->render('index', [
            'info' => $info,
            'params' => $params
        ]);
    }

    /**
     * @Author <lixiaobin>
     * @Date   2016-11-07
     * @Parma  $id 信息id
     * @Desc  查看日志详情
     */
    public function actionDetail($id = '')
    {
        if (!empty($id)) {
            $logModel = new Log();
            $info = $logModel::findOne($id);
            return $this->render('detail', [
                'info' => $info
            ]);
        } else {
            ShowMessage::info('请求错误！', Url::toRoute('/sys/log/index', 10));
        }
    }

    /**
     * @Author <lixiaobin>
     * @Date   2016-11-07
     * @Parma  $id 信息id
     * @Desc 删除日志
     */
    public function actionDelete($id = '')
    {
        if (!empty($id)) {
            $logModel = new Log();
            $info = $logModel::findOne($id);
            if (!empty($info)) {
                $res = $logModel::deleteAll('id = :id', ['id' => $id]);
                if (!empty($res)) {
                    ShowMessage::show_msg('删除成功！', Url::toRoute('/sys/log/index'));
                } else {
                    ShowMessage::show_msg('删除失败！', Url::toRoute('/sys/log/index'));
                }

            } else {
                ShowMessage::show_msg('请求错误！', Url::toRoute('/sys/log/index'));
            }
        } else {
            ShowMessage::info('请求错误！', Url::toRoute('/sys/log/index'));
        }
    }

    /**
     * 删除30天以前的数据
     * @Author <lixiaobin>
     * @Date   2016-12-13
     */
    public function actionDeletelog()
    {
        //设置30天以前的时间
        $datetime = date('Y-m-d', time() - (30 * 86400)) . ' 00:00:00';
        $LogModel = new Log();
        $res = $LogModel::deleteAll(['<', 'add_time', $datetime]);
        if (!empty($res)) {
            ShowMessage::info('删除成功！', Url::toRoute('/sys/log/index'));
        } else {
            ShowMessage::info('删除失败！', Url::toRoute('/sys/log/index'));
        }
    }


}