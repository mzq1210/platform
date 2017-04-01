<?php
/**
 * Created by PhpStorm.
 * User: 李效宾
 * Date: 2016-10-31
 * Time: 下午2:16
 * Desc: 将所用的到配置参数（常量）配置在该文件中
 */

//redis前缀设置
defined('MPS_REDIS_KEY') OR define('MPS_REDIS_KEY', 'mps_');
//生产环境-魔售接口URL
//defined('MOSHOU_URL') OR define('MOSHOU_URL','http://ms.51moshou.com');
//测试环境-魔售接口Url
defined('MOSHOU_URL') OR define('MOSHOU_URL','http://ms.fangodata.com');

//城市同步时的访问接口和token
defined('MOSHOU_CITY_UPDATE') OR define('MOSHOU_CITY_UPDATE',MOSHOU_URL.'/api/mojie/channelexpand/syncCitys');
defined('MOSHOU_TOKEN') OR define('MOSHOU_TOKEN','703cc09837d1b61a5b384e6c9fc39162dd2ded11');

//问卷前段访问魔兽获取用户信息
defined('MOSHOU_USER_INFO') OR define('MOSHOU_USER_INFO',MOSHOU_URL.'/api/mojie/channelexpand/findUser');
//来源
define('HTTP_REFERER', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');

//生产环境-汇金行mps系统后台Url、接口地址、登陆入口地址
/*defined('MPS_URL') OR define('MPS_URL','http://mps.51moshou.com');
defined('MPS_URL_API') OR define('MPS_URL_API','http://apipub.51moshou.com');
defined('PASSPORT_URL') OR define('PASSPORT_URL', 'http://passport.51moshou.com');*/

//本地测试-汇金行mps系统后台Url、接口地址、登陆入口地址
defined('MPS_URL') OR define('MPS_URL','http://www.mps.com');
defined('MPS_URL_API') OR define('MPS_URL_API','http://api.mps.com');
defined('PASSPORT_URL') OR define('PASSPORT_URL', 'http://passport.mps.com');


//第三方登陆组织机构ID
defined('OAUTH_DEPT_ID') OR define('OAUTH_DEPT_ID', 10);


//php与java 加解密的key
defined('PHP_JAVA_KEY') OR define('PHP_JAVA_KEY', 'd31f18587e47ad6d');

//设置默认分布条数
define('PAGESIZE', 15);