<?php
/**
 * 获取移动端信息数据
 * @Author: leexb
 * @Date: 16-12-16
 */

namespace common\components\library;

class TerminalInfo{
    /**
     * 获取来源端手机型号
     * @author <liangshimao>
     * @params $agentInfo 终端信息
     */
    public static function getClient($agentInfo)
    {
        $agent = strtolower($agentInfo);
        $is_android = (strpos($agent, 'android')) ? true : false;
        $is_iphone = (strpos($agent, 'iphone')) ? true : false;
        if($is_android){
            return 'android';
        }elseif($is_iphone){
            return 'ios';
        }else{
            return '其他';
        }
    }

    /**
     * 判断来源是否是手机端
     * @return bool
     * @author <liangshimao>
     */
    public static function isClient($agentInfo)
    {
        $agent = strtolower($agentInfo);
        $is_pc = (strpos($agent, 'windows nt')) ? true : false;
        $is_iphone = (strpos($agent, 'iphone')) ? true : false;
        $is_linux = (strpos($agent, 'linux')) ? true : false;
        $is_mac = (strpos($agent, 'mac os')) ? true : false;
        $is_android = (strpos($agent, 'android')) ? true : false;
        $is_ipad = (strpos($agent, 'ipad')) ? true : false;

        if($is_iphone){
            return  true;
        }

        if($is_android){
            return  true;
        }

        if($is_ipad){
            return  true;
        }

        if($is_pc){
            return  false;
        }
        if($is_linux){
            return  false;
        }

        if($is_mac){
            return  true;
        }
    }

}