<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\Tools;
?>

<?php $form = ActiveForm::begin([
    'id' => 'userForm',
    'enableClientScript' => false
]); ?>

<table width="100%" class="table_form contentWrap">
    <tr>
        <th width="100">原密码：</th>
        <td><input type="password" name="oldPassword" id='old-password' maxlength="11" class="form-control-table width-160">
            <div id="checked" style="display: inline"></div>
        </td>
    </tr>
    <tr>
        <th width="100">新密码：</th>
        <td><input type="password" name="password" id='User-password' class="form-control-table width-160">
        </td>
    </tr>
    <tr>
        <th width="100">确认新密码：</th>
        <td><input type="password" name="repassword" id='User-repassword' class="form-control-table width-160"></td>
    </tr>
</table>
</div>
<div style="display: none;" class="btn"><input type="submit" id="dosubmit" class="dialog" name="dosubmit" value="提交"/></div>
<input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>"/>
<input type="hidden" name="userid" id="userid" value="<?=$userid ?>"/>
<input type="hidden" name="result" id="result" value=""/>
</div>
<?php ActiveForm::end(); ?>
<script>
    $(function() {
        $.formValidator.initConfig({formid:"userForm",autotip:true,onerror:function(msg,obj){}});
        $("#old-password").keyup(function () {
            var old_pass = $("#old-password").val();
            var userid   = $("#userid").val();
            if(old_pass.length>5){
                var url = '<?php echo Url::toRoute('/sys/user/checkpass_ajax'); ?>';
                $.post(url,{'old_pass':old_pass,'userid':userid},function(data){
                    if(data.status == 200){
                        $("#checked").removeClass("onError").addClass("onCorrect").html("输入正确");
                        $("#result").val(1);
                    }else {
                        $("#checked").removeClass("onCorrect").addClass("onError").html("原密码错误");
                        $("#result").val(2);
                        return false;
                    }
                },'json');
            }else {
                $("#checked").removeClass("onCorrect").addClass("onError").html("原密码错误");
                $("#old-password").formValidator({onshow: "", onfocus: ""}).inputValidator({
                    min: 6,
                    max: 20,
                    onerror: ""
                });
            }

        });
        if(result != ''){
            $("#old-password").formValidator({onshow: "请输入原密码", onfocus: "请输入原密码"}).inputValidator({
                min: 6,
                max: 20,
                onerror: "原密码输入错误"
            });
        }
        $("#User-password").formValidator({onshow: "请输入新密码", onfocus: "请输入新密码"}).inputValidator({
            min: 6,
            max: 20,
            onerror: "新密码长度为6-20位"
        });
        $("#User-repassword").formValidator({
            onshow: "请确认密码",
            onfocus: "请输入密码"
        }).compareValidator({desid: "User-password", operateor: "=", onerror: "两次输入的密码不一致"}).inputValidator({
            min: 6,
            max: 20,
            onerror: "密码长度为6-20位"
        });

        $("#dosubmit").click(function(){
            var result = $("#result").val();
            if(result == 2){
                $("#checked").removeClass("onCorrect").addClass("onError").html("原密码错误");
                return false;
            }
        });
    });
</script>