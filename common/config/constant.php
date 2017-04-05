<?php
/**
 * Created by PhpStorm.
 * Date: 2016-10-31
 * Time: 下午2:16
 * Desc: 将所用的到配置参数（常量）配置在该文件中
 */

//redis前缀设置
defined('MPS_REDIS_KEY') OR define('MPS_REDIS_KEY', 'mps_');

//本地测试-mps系统后台Url、接口地址、登陆入口地址
defined('MPS_URL') OR define('MPS_URL','http://www.mps.com');
defined('MPS_URL_API') OR define('MPS_URL_API','http://api.mps.com');

//设置默认分布条数
define('PAGESIZE', 15);