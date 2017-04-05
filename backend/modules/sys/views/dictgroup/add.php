<?php
use yii\helpers\Url;
?>
<script type="text/javascript">
	$(function() {
        $.formValidator.initConfig({
            formid: "myform", autotip: true, onerror: function (msg, obj) {
                alertpop(msg, 200, 20);
            }
        });
        $("#name").formValidator({onshow: "请输入组名称", onfocus: "请输入组名称"})
            .inputValidator({min: 1, max: 20, onerrormin: "请输入组名称", onerrormax: "组名称长度必须在1-20范围内!"})
            .regexValidator({regexp: "^[a-zA-Z0-9\u4e00-\u9fa5]+$", onerror: "组名称只能为中文、数字、字母！"})
            .ajaxValidator({
                type: "GET",
                url: "<?=Url::toRoute('/sys/dictgroup/checkname_ajax')?>"+'?time=' + Math.random(),
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.code == 200) {
                        return true;
                    } else {
                        return false;
                    }
                },
                onerror: "组名称已经存在！",
                onwait: "正在验证..."
            });
        $("#code").formValidator({onshow:"请输入组编码", onfocus:"请输入组编码"})
            .inputValidator({min: 2, max:15,onerrormin: "请输入组编码",onerrormax:"组编码长度必须在2-15范围内!"})
            .regexValidator({regexp:"^[a-zA-Z_]+$",onerror:"组编码只能为字母！"})
            .ajaxValidator({
                type:"GET",
                url:"<?=Url::toRoute('/sys/dictgroup/checkcode_ajax')?>"+'?time=' + Math.random(),
                success:function(data){
                    var obj = JSON.parse(data);
                    if(obj.code == 200){
                        return true;
                    }else{
                        return false;
                    }
                },
                onerror:"组编码已经存在！",
                onwait:"正在验证..."
            });
	})

</script>
<form action="<?php echo Url::to('/sys/dictgroup/add/')?>" method="post" id="myform">
<table width="100%" class="table_form contentWrap">
    <tr>
        <th width="100">组名称：</th>
        <td><input type="text" name="DictGroup[name]" id="name" maxlength="20" class="input-text"></td>
    </tr>      
    <tr>
        <th>组编码：</th>
        <td><input type="text" name="DictGroup[code]" id="code" maxlength="15" class="input-text"></td>
    </tr>
</table>
    <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="提交" />
</form>