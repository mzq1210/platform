<?php
namespace common\components;

/**
 * 图片上传及显示类
 * Class Image
 * @package common\components
 */
class Image extends \yii\base\Component
{
    //单图片上传接口地址
    //const UPLOAD_API_URL = 'http://upload.99yijia.com/fileupload';
    const UPLOAD_API_URL = 'http://up.onelog.cn/fileupload';

    //图片展示域名
    //const IMG_DOMAIN = 'http://img.99yijia.com/';
    const IMG_DOMAIN = 'http://show.onelog.cn/';

    //授权token
    const AUTH_TOKEN = 'u0eew2y17mZZCaaZv43dqdWalA';

    /**
     * 文件curl上传接口
     * @param string $file 文件
     * @param int $isthumb 是否生成缩略图
     * @return bool|string
     */
    public static function upload($file = '', $dir = 'thumb', $isthumb = false){
        $file = $file ? $file : $_FILES;
        $data = array(
            'token'   => self::AUTH_TOKEN,
            'isthumb' => $isthumb,
            'dir'     => $dir
        );
        if (class_exists('\CURLFile')) {
            $data['file'] = new \CURLFile($file['tmp_name'], $file['type'], $file['name']);
        }else{
            $data['file'] = "@".realpath($file['tmp_name']).";type=".$file['type'].";filename=".$file['name'];
        }

        $ch = curl_init();
        $url = self::UPLOAD_API_URL;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (class_exists('\CURLFile')) {
            curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
        } else {
            if (defined('CURLOPT_SAFE_UPLOAD')) {
                curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
            }
        }
        $return_data = curl_exec($ch);
        curl_close($ch);
        $ret = json_decode($return_data, true);

        if($ret && $ret['status'] == 200){
            $file = self::IMG_DOMAIN . $ret['file'];
            return $file;
        }
        return false;
    }

    /**
     * 文件显示
     * @param string $path
     */
    public static function showImg($path = '', $width = '', $height = ''){
        $path = '/'.ltrim($path, '/');
        $imgUrl = self::IMG_DOMAIN.$path;
        if($width && $height){
            $ext  = pathinfo($path, PATHINFO_EXTENSION);
            $imgUrl .= '_'.$width.'x'.$height.'.'.$ext;
        }
        return $imgUrl;
    }
}