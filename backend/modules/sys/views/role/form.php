<?php
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'roleForm'
]);
?>

<script type="text/javascript">
    $(function(){
        $.formValidator.initConfig({formid:"roleForm",autotip:true,onerror:function(msg,obj){}});
        <?php if(Yii::$app->controller->action->id == 'add'): ?>
            $("#rolename").formValidator({onshow:"请输入角色名称",onfocus:"请输入角色名称"}).inputValidator({min:2,max:40,onerror:"角色名称长度为2-20位"});
        <?php else: ?>
            $("#rolename").formValidator({onshow:"请输入角色名称",onfocus:"请输入角色名称"}).inputValidator({min:2,max:40,onerror:"角色名称长度为2-20位"}).defaultPassed();
        <?php endif; ?>
    });
</script>
<div class="pad_10">
    <div class="common-form">

        <table width="100%" class="table_form contentWrap">
            <tr>
                <th width="100">角色名称：</th>
                <td><input type="text" name="name" value="<?=$model->name;?>" class="input-text" id="rolename"></td>
            </tr>
            <tr>
                <th width="100">角色描述：</th>
                <td><textarea name="desc" rows="2" cols="10" id="description" class="inputtext" style="height:100px;width:400px;"><?php echo $model->desc?></textarea></td>
            </tr>
            <tr>
                <th width="100">是否启用：</th>
                <td>
                    <input type="radio" name="status" checked value="0" <?php echo ($model->status=='0')?' checked':''?>>启用
                    <input type="radio" name="status" value="1" <?php echo ($model->status=='1')?' checked':''?>>禁用
                </td>
            </tr>
            <tr>
                <th width="100">排序：</th>
                <td><input type="text" name="sort" size="3" value="<?php echo $model->sort?>" class="input-text"></td>
            </tr>
        </table>
        <input style="display: none;" name="dosubmit" type="submit" id="dosubmit" value="提交" class="dialog">
    </div>
</div>
<?php ActiveForm::end(); ?>
