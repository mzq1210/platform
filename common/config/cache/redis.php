<?php
/**
 * Created by PhpStorm.
 * User: leexb
 * Date: 16-10-31
 * Time: 下午2:16
 */

return [
        'class' => 'yii\redis\Cache',
        'keyPrefix' => 'openid_',
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 0
        ],
];