<?php
/**
 * Created by PhpStorm.
 * User: mzq
 * Date: 16-10-21
 * Time: 下午3:19
 */
namespace app\components;

use Yii;

class Cookie{

    /**
     * @desc 存cookie
     * @param $key
     * @param $value
     * @param $time
     */
    public static function setCookie($key, $value, $time) {
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => $key,
            'value' => $value,
            'expire' => $time,
        ]));
    }

    /**
     * @desc 取cookie
     * @param $key
     * @return bool|mixed
     */
    public static function getCookie($key) {
        if (Yii::$app->request->cookies->has($key)){
            return Yii::$app->request->cookies->getValue($key);
        }
        return false;
    }

    /**
     * @desc 删除cookie
     * @param $key
     */
    public static function deleteCookie($key){
        Yii::$app->response->cookies->remove($key);
    }
}