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
        $("#icon").formValidator({onshow:"请输入类名",onfocus:"请输入类名",onerror:"请输入类名"}).inputValidator({min:1,onerror:"请输入类名"});
        <?php else: ?>
        $("#icon").formValidator({onshow:"请输入类名",onfocus:"请输入类名",onerror:"请输入类名"}).inputValidator({min:1,onerror:"请输入类名"}).defaultPassed();
        <?php endif; ?>
    });
</script>
<div class="pad_10">
    <div class="common-form">
        <table width="100%" class="table_form contentWrap">
            <tr>
                <th width="100">图标：</th>
                <td><i class="glyphicon <?=$model->icon;?>" style="font-size: 18px;color: #1ABC9C;"></i></td>
            </tr>
            <tr>
                <th width="100">图标类名：</th>
                <td><input type="text" name="icon" value="<?=$model->icon;?>" class="input-text" id="icon"></td>
            </tr>
            <tr>
                <th width="100">图标名称：</th>
                <td><input type="text" name="name" value="<?=$model->name;?>" class="input-text" id="name"></td>
            </tr>
        </table>
        <input style="display: none;" name="dosubmit" type="submit" id="dosubmit" value="提交" class="dialog">
    </div>
</div>
<?php ActiveForm::end(); ?>
