<?php

use yii\helpers\Url;
use common\models\sys\DictGroup;

?>
<script type="text/javascript">
    $(function () {
        $.formValidator.initConfig({formid: "myform", autotip: true, onerror: function (msg, obj) {
                /*window.top.art.dialog({content: msg, lock: true, width: '200', height: '50'}, function () {
                    this.close();
                    $(obj).focus();
                })*/
            alertpop(msg,200,20);
        }});
        $("#label").formValidator({onshow: "请输入标签名称", onfocus: "请输入标签名称"}).inputValidator({min: 1, onerror: "请输入标签名称"});
        $("#code").formValidator({onshow: "请输入组编码", onfocus: "请输组编码",}).inputValidator({min: 1, onerror: "请输入组编码"});
        $("#dict_group_id").formValidator({onshow: "请选择字典组", onfocus: "请选择字典组"}).inputValidator({min: 1, onerror: "请选择字典组"});

    })

</script>
<form action="<?php echo Url::to('/sys/dict/add') ?>" method="post" id="myform">
    <table width="100%" class="table_form contentWrap">
        <tr>
            <th width="100">编码：</th>
            <td><input type="text" name="Dict[code]" id="code" class="input-text"></td>
        </tr>      
        <tr>
            <th>标签：</th>
            <td><input type="text" name="Dict[label]" id="label" class="input-text"></td>
        </tr>
        <tr>
            <th>字典组：</th>
            <td>
                <select id="dict_group_id" name="Dict[dict_group_id]" class="select-option">
                    <option value="0">请选择</option>
                    <?php foreach (DictGroup::find()->select(['id', 'name'])->where(['del_flag' => 0])->all() as $list): ?>
                        <option value="<?= $list->id; ?>"><?= $list->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
    </table>
    <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="提交" />
</form>