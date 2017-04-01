<?php

namespace common\components;
use yii;
/**
 * 缓存工具
 * @author liangpingzheng
 * @Date 2014-1126 10:33
 */
class BaseCache{

    /**
     * 取缓存
     * @param $key
     */
    public static function get( $key ) {

        return Yii::$app->cache->get($key);
    }

    /**
     * 检查键是否存在
     * @param $key
    */
    public static function exists($key){
        return Yii::$app->cache->exists($key);
    }

    /**
     * 设置缓存
     */
    public static function set( $key, $val, $expire = 0) {

        return Yii::$app->cache->set($key, $val, $expire);
    }

    public static function delete($key){
        return Yii::$app->cache->delete($key);
    }

}