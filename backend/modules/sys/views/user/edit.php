<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'myform'
]);
?>
<div class="pad_10">
    <div class="common-form">

        <table width="100%" class="table_form contentWrap">
            <tr>
                <th width="100">用户名：</th>
                <td><input type="text" name="user[username]" value="<?= $model->username ?>"
                           class="form-control-table width-160" id="User-username" style="display: inline"></td>
            </tr>
            <tr>
                <th width="100">真实姓名：</th>
                <td><input type="text" name="user[realname]" value="<?= $model->realname ?>" class="input-text"
                           id="User-realname" style="display: inline"></td>
            </tr>
            <tr>
                <th width="100">密 码：</th>
                <td><input type="password" name="user[password]" value="" class="input-text" id="User-password"
                           style="display: inline">
                    <div id="User-passwordTip"></div>
                </td>
            </tr>
            <tr>
                <th width="100">确认密码：</th>
                <td><input type="password" name="user[repassword]" value="" class="input-text" id="User-repassword"
                           style="display: inline;">
                    <div id="User-repasswordTip">
                </td>
            </tr>
            <tr>
                <th width="100">手机号：</th>
                <td><input type="text" name="user[mobile]" maxlength="11" value="<?= $model->mobile ?>"
                           class="input-text" id="User-mobile" style="display: inline"></td>
            </tr>
            <tr>
                <th width="100">状态：</th>
                <td>
                    <input type="radio" name="user[status]" value="0" <?= $model->status == 0 ? 'checked' : ''; ?>> 正常
                    <input type="radio" name="user[status]" value="1" <?= $model->status == 1 ? 'checked' : ''; ?>> 禁止
                </td>
            </tr>
            <tr>
                <th width="100">排序：</th>
                <td><input type="text" name="user[sort]" size="3" class="input-text" id="User-sort" value="0"></td>
            </tr>
        </table>
        <div style="display: none;" class="btn"><input type="submit" id="dosubmit" class="dialog" name="dosubmit"
                                                       value="提交"/></div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<script>
    $(function () {
        $.formValidator.initConfig({
            formid: "myform", autotip: true, onerror: function (msg, obj) {
            }
        });
        $("#User-username").formValidator({onshow: "请输入用户名,用户名由字母和数字组成", onfocus: "请输入用户名"})
            .regexValidator({regexp: "^[0-9a-zA-Z-_]{3,20}$", onerror: "用户名不合法"})
            .inputValidator({min: 3, max: 30, onerrormin: "用户名不能为空！", onerrormax: "用户名词长度必须在1-30范围内!"})
            .ajaxValidator({
                type: "GET",
                data: "id=<?=$model->id?>",
                url: "<?=Url::toRoute('/sys/user/checkname_ajax')?>",
                success: function (status) {
                    if (status == "200") {
                        return false;
                    } else {
                        return true;
                    }
                },
                onerror: "用户名已经存在！",
                onwait: "正在验证..."
            }).defaultPassed();
        $("#User-realname").formValidator({onshow: "请输入真实姓名", onfocus: "请输入真实姓名"}).inputValidator({
            min: 1,
            onerror: "真实姓名不能为空"
        }).defaultPassed();
        $("#User-mobile").formValidator({onshow: "请输入手机号", onfocus: "请输入手机号"})
            .regexValidator({regexp: "^1[358][0-9]{9}$", onerror: "手机号码不正确"})
            .ajaxValidator({
                type: "GET",
                data: "id=<?=$model->id?>",
                url: "<?=Url::toRoute('/sys/user/checkphone_ajax')?>",
                success: function (status) {
                    if (status == "200") {
                        return false;
                    } else {
                        return true;
                    }
                },
                onerror: "该手机号已经注册！",
                onwait: "正在验证..."
            }).defaultPassed();
    });
    $("#dosubmit").click(function () {
        var pass = $("#User-password").val();
        var repass = $("#User-repassword").val();
        if (pass != "" || repass != "") {
            if (pass.length < 6 || pass.length > 20) {
                $("#User-passwordTip").removeClass("onCorrect").addClass("onError").html("密码长度必须在6-20范围内");
                return false;
            } else {
                $("#User-passwordTip").removeClass("onError").addClass("onCorrect").html("");
            }
            if (repass.length < 6 || repass.length > 20) {
                $("#User-repasswordTip").removeClass("onCorrect").addClass("onError").html("确认密码长度必须在6-20范围内");
                return false;
            } else {
                $("#User-repasswordTip").removeClass("onError").addClass("onCorrect").html("");
            }
            if (pass != repass) {
                $("#User-repasswordTip").removeClass("onCorrect").addClass("onError").html("两次密码输入不一致");
                return false;
            }
        }
    });
</script>