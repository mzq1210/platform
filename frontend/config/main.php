<?php

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'index/index',
    'components' => [
        'wechat' => [
            'class' => 'yii\wechat\MpWechat',
            'appId' => 'wx570477a9e2c7711f',
             //'appId' => 'wx56ec9c9455dcefd0',//测试
             'appSecret' => '3188b3aa10eab2e2ba00c1fb1ecdb136',
            //'appSecret' => 'd4624c36b6795d1d99dcf0547af5443d',//测试
            'token' => 'weixin',
            'encodingAesKey' => 'platform'
        ],
        'urlManager' => array(
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => array(//rewrite
            ),
        ),
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],*/
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fE0FIJe9gHx7n4jrXBrUEjTNfpL2UE0P',
            'enableCsrfValidation' => false
        ],
        'errorHandler' => [
            //'errorAction' => '/show/notfound',
        ],
    ],
];
