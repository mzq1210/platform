<?php
/**
 * 获取字典数据
 * @Author: <lixiaobin>
 * @Date: 16-12-19
 *
 * 使用方法：
 * use common\components\library\DictTool;
 * DictTool::getDict('ischeck'); //ischec为字段组编码
 */

namespace common\components\library;

use Yii;
use yii\helpers\Json;
use common\models\sys\Dict;
use common\models\sys\DictGroup;
use common\components\BaseCache;

class DictTool
{

    const DICT_KEY = 'dict';
    const DICTGROUP_KEY = 'dictgroup';
    /**
     * 根据code获取到当前的字典
     * @params string $code 字典组编码
     * @return array
     * @date 2016-12-19
     * @Author <lixiaobin>
     */
    public static function getDict($code = '')
    {
        if (empty($code)) return false;
        $key = self::DICT_KEY . $code;
        $keyExists = BaseCache::exists($key);
        if (!empty($keyExists)) {
            $dictInfo = Json::decode(BaseCache::get($key));
            return $dictInfo;
        }
        $dictGroup = DictGroup::getOneDictGroup($code);
        if (empty($dictGroup)) return false;
        $dictInfo = Dict::getDectInfo($dictGroup->id);
        if (!empty($dictInfo)) {
            BaseCache::set($key, Json::encode($dictInfo), 7200);
            return $dictInfo;
        }
        return false;
    }

    /**
     * 当字典组修改时修改成功后删除redis
     * @params string $dictGroupId 字典组的id
     * @return bool
     * @date 2016-12-20
     * @Author <lixiaobin>
    */
    public static function deleteDict($dictGroupId){
        if (empty($dictGroupId)) return false;
        $dictGroup = DictGroup::getOneDictGroup($dictGroupId,3);
        $key = self::DICT_KEY . $dictGroup->code;
        $keyExists = BaseCache::exists($key);
        if (!empty($keyExists)) {
            BaseCache::delete($key);
        }
    }

    /**
     * 根据字典组的code和字典的code 获取 字典label
     * @Params string $groupCode 字典组的code
     *         string $dectCode  字典COde
     * @Return string 
     * @Date 2016-12-28
     * @Author <lixiaobin>
    */
    public static function getDictLable($groupCode,$dictCode){
        $dict = self::getDict($groupCode);
        foreach ($dict as $val){
            if($val['code'] == $dictCode){
                return $val['label'];
            }
        }
    }

    /**
     * 从字典中取出的数组，根据code得到对应的label名称
     * @param array $array 要进行分析的数组
     * @param int $code  code值
     * @return bool or string
     * @author <liangshimao>
     */
    public static function getLabel($array,$code)
    {
        foreach ($array as $val){
            if($val['code'] == $code){
                return $val['label'];
            }
        }
        return false;
    }

    /**
     * 从字典中取出的数组，根据label得到对应的code名称
     * @param array $array 要进行分析的数组
     * @param int $label  label值
     * @return bool or string
     * @author <liangshimao>
     */
    public static function getCode($array,$label)
    {
        foreach ($array as $val){
            if($val['label'] == $label){
                return $val['code'];
            }
        }
        return false;
    }

}