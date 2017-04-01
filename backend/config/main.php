<?php

//$params = array_merge(
//        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/params.php')
//);

return [
    'id' => 'mps',
    'name' => 'S系统',
    'basePath' => dirname(__DIR__),
    'language' => 'zh-CN',
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'login/login',
    'bootstrap' => ['log'],
    'modules' => [
        'sys' => ['class' => 'app\modules\sys\SysModule'], //用户管理+角色管理
    ],
    'components' => [
        
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fE0FIJe9gHx7n4jrXBrUEjTNfpL2UE0P',
            'enableCsrfValidation' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
        //'errorAction' => 'site/error',
        ],
    ],
   /* 'on beforeRequest' => function($event){
        \yii\base\Event::on(\yii\db\BaseActiveRecord::className(), \yii\db\BaseActiveRecord::EVENT_AFTER_INSERT,['app\components\log\AdminLog','write'] );
        \yii\base\Event::on(\yii\db\BaseActiveRecord::className(), \yii\db\BaseActiveRecord::EVENT_AFTER_UPDATE,['app\components\log\AdminLog','write'] );
        \yii\base\Event::on(\yii\db\BaseActiveRecord::className(), \yii\db\BaseActiveRecord::EVENT_AFTER_DELETE,['app\components\log\AdminLog','write'] );
    },*/
    //'params' => $params,
];