<?php
/**
 * Created by PhpStorm.
 * User: lixiaobin
 * Date: 16-12-1
 * Time: 下午2:04
 * Desc: 就是日期选择空间
 */
namespace common\components\library;

class JsDatePut {
    public static function js_date(){
        $date = <<<jsdate
        <link href="/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap-datepicker.zh-CN.min.js"></script>
        <script type="text/javascript">
        $(function(){
            $('.input-group').datetimepicker({
                minView: "month", //选择日期后，不会再跳转去选择时分秒
                format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
                language: 'zh-CN', //汉化
                clearBtn:true,
                autoclose: true, //选择日期后自动关闭
                language: 'zh-CN',/*加载日历语言包，可自定义*/
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                endDate : new Date()
            });
        })
        </script>
jsdate;
        echo $date;
    }
}