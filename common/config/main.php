<?php

include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'constant.php');

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'runtimePath' => '@root/runtime',
    'timeZone' => 'Asia/Chongqing',
    'components' => [
        //基础数据库
        'db' => require (__DIR__ . '/db/sysDb.php'),
        'weixin' => require (__DIR__ . '/db/weixinDb.php'), //微信管理
        //配置Redis缓存
        'cache' => require (__DIR__ . '/cache/redis.php'),
        'urlManager' => array(
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'suffix' => '.html',
            'rules' => [
            ]
        ),
        
        //去除自带的jquery
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                     'sourcePath' => null,
                     'js' => []
                ],
            ],
        ],
        
    ],
];
