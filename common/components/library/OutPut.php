<?php
/**
 * Created by PhpStorm.
 * User: leexb
 * Date: 16-11-22
 * Time: 上午10:24
 * Desc: Json 输出
 */


namespace common\components\library;

use yii\helpers\Json;

class OutPut {

    public static function returnJson($msg = '', $code = 200, $data = array(), $page = '') {
        $res = array();
        $res['success'] = ($code == 200) ? true : false;
        $res['msg']     = $msg ? $msg :( ($code == 200) ? '成功' : '失败');
        $res['code']    = $code;
        $res['page']    = null;
        $res['data']    = $data;
        exit(Json::encode($res, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE));
        //exit(str_replace('null', '""', Json::encode($res, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE)));
    }
}
