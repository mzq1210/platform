<?php

namespace common\components;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use common\components\library\CryptAES;

class Tools {



    /**
     * url检测
     * @param $s
     * @return bool
     */
    public static function checkUrl($s) {
        return preg_match('/^http[s]?:\/\/' .
                '(([0-9]{1,3}\.){3}[0-9]{1,3}' . // IP形式的URL- 199.194.52.184
                '|' . // 允许IP和DOMAIN（域名）
                '([0-9a-z_!~*\'()-]+\.)*' . // 域名- www.
                '([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.' . // 二级域名
                '[a-z]{2,6})' . // first level domain- .com or .museum
                '(:[0-9]{1,4})?' . // 端口- :80
                '((\/\?)|' . // a slash isn't required if there is no file name
                '(\/[0-9a-zA-Z_!~\'\(\)\[\]\.;\?:@&=\+\$,%#-\/^\*\|]*)?)$/', $s) == 1;
    }
    

    /**
     * Wrapper for the removeXSS function.
     * Removes potential XSS code from an input string.
     *
     * @param	string		Input string
     * @return	string		Input string with potential XSS code removed
     */
    public static function removeXss($val) {
        $val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val);

        $search = 'abcdefghijklmnopqrstuvwxyz';
        $search.= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $search.= '1234567890!@#$%^&*()';
        $search.= '~`";:?+/={}[]-_|\'\\';

        for ($i = 0; $i < strlen($search); $i++) {
            $val = preg_replace('/(&#[x|X]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val); // with a ;
            $val = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val); // with a ;
        }

        $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
        $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
        $ra = array_merge($ra1, $ra2);

        $found = true; // keep replacing as long as the previous round replaced something
        while ($found == true) {
            $val_before = $val;
            for ($i = 0; $i < sizeof($ra); $i++) {
                $pattern = '/';
                for ($j = 0; $j < strlen($ra[$i]); $j++) {
                    if ($j > 0) {
                        $pattern .= '(';
                        $pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?';
                        $pattern .= '|(&#0{0,8}([9][10][13]);?)?';
                        $pattern .= ')?';
                    }
                    $pattern .= $ra[$i][$j];
                }
                $pattern .= '/i';
                $replacement = substr($ra[$i], 0, 2) . '<x>' . substr($ra[$i], 2); // add in <> to nerf the tag
                $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
                if ($val_before == $val) {
                    $found = false;
                }
            }
        }
        return $val;
    }


    /**
     * 字符串加密、解密函数
     *
     *
     * @param	string	$txt		字符串
     * @param	string	$operation	ENCODE为加密，DECODE为解密，可选参数，默认为ENCODE，
     * @param	string	$key		密钥：数字、字母、下划线
     * @param	string	$expiry		过期时间
     * @return	string
     */
    static function sys_auth($string, $operation = 'ENCODE', $key = '', $expiry = 0) {
        $ckey_length = 4;
        $key = md5($key != '' ? $key : 'newhouse5i5j');
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(strtr(substr($string, $ckey_length), '-_', '+/')) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if ($operation == 'DECODE') {
            if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc . rtrim(strtr(base64_encode($result), '+/', '-_'), '=');
        }
    }

    /**
     * 获取菜单权限树形结构
     * @param array $menuList
     * @param int $pid
     * @return array
     */
    public static function getMenuTree($menuList = [], $pid = 0){
        $tree = [];
        if(!empty($menuList)){
            foreach($menuList as $key => $menu){
                if($menu['parentid'] == $pid){
                    $tree[$menu['id']] = $menu;
                    $tree[$menu['id']]['child'] = self::getMenuTree($menuList, $menu['id']);
                }
            }

        }
        return $tree;
    }


    /**
     * 通过模块,控制器和方法来创建url
     * @param string $m 模块
     * @param string $a 控制器
     * @param string $c 方法
     * @return string
     */
    public static function createUrl($m = '', $a = '', $c = '', $param = ''){
        $url = '/';
        $m && $url .= $m.'/';
        $a && $url .= $a.'/';
        $c && $url .= $c;
        $param && $url .= $param;
        if($url != '/')
            return \yii\helpers\Url::toRoute($url);
    }

    /**
     * 获取菜单深度
     * @param $id
     * @param $array
     * @param $i
     */
    public static function get_level($id,$array=array(),$i=0) {
        foreach($array as $n=>$value){
            if($value['id'] == $id)
            {
                if($value['parentid']== '0') return $i;
                $i++;
                return Tools::get_level($value['parentid'],$array,$i);
            }
        }
    }

    /**
     *中文截取字符串
     *如果第三个参数是false，不加...
     */
    public static function cutUtf8($string, $length, $etc = '...')
    {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++)
        {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0'))
            {
                if ($length < 1.0)
                {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            }
            else
            {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen)
        {
            $result .= $etc;
        }
        return $result;
    }


    /**
     * @Desc:   解密token
     * @Author: < 李效宾 >
     * @Date:   2016-11-22
     * @Param:   string $token
     * @Param:   int $type = 1 加密 否则为解密
     * @Rreurn:  Array
     */
    public static function token_auth($token, $type = 1){
        if(empty($token)) return false;
        $keyStr = PHP_JAVA_KEY;
        $aes = new CryptAES();
        $aes->set_key($keyStr);
        $aes->require_pkcs5();
        if($type == 1){
            $decString = $aes->decrypt($token);
            if(!empty($decString)){
                $tokenArr = explode('-', $decString);
                return $tokenArr;
            }
            return false;
        }else{
            $encText = $aes->encrypt($token);
            return $encText;
        }

    }

    /**
     * 生成物料入库和出库单号
     * @Params string $prefix 单号前缀
     * @Return string
     * @Author <lixiaobin>
     * @Date 2016-12-28
    */
    public static function random_sn($prefix){
        if(!empty($prefix)){
            return $prefix.substr(date('YmdHis').mt_rand(10,99), 2);
        }
        return false;
    }

}
