<?php
use yii\widgets\ActiveForm;
use common\models\sys\Icons;
$form = ActiveForm::begin([
    'id' => 'menuForm'
]);
?>

<script type="text/javascript">
    $(function(){
        $.formValidator.initConfig({formid:"menuForm",autotip:true,onerror:function(msg,obj){}});
        <?php if(Yii::$app->controller->action->id == 'add'): ?>
        $("#menu_name").formValidator({onshow:"请输入菜单英文名称",onfocus:"请输入菜单英文名称"}).inputValidator({min:1,onerror:"请输入菜单英文名称"});
        <?php else: ?>
        $("#menu_name").formValidator({onshow:"请输入菜单英文名称",onfocus:"请输入菜单英文名称"}).inputValidator({min:1,onerror:"请输入菜单英文名称"}).defaultPassed();
        <?php endif; ?>

    });
</script>
<div class="common-form">
    <table width="100%" class="table_form contentWrap">
        <tr>
            <th width="120">分类名称：</th>
            <td>
                <input type="text" name="name" value="<?=$model->name;?>" id="menu_name" class="input-text" >
            </td>
        </tr>
        <tr>
            <th width="120">类型：</th>
            <td>
                <select name="type" class="select-option">
                    <option value="1" <?php if($model->type == 1):?>selected<?php endif;?>>首页</option>
                    <option value="2" <?php if($model->type == 2):?>selected<?php endif;?>>周边</option>
                </select>
            </td>
        </tr>
        <tr>
            <th width="120">是否显示：</th>
            <td><input type="radio" name="display" value="0" <?php if($model->display == 0):?>checked<?php endif;?>>是
                <input type="radio" name="display" value="1" <?php if($model->display == 1):?>checked<?php endif;?>> 否
            </td>
        </tr>
        <tr>
            <th width="120">分类排序：</th>
            <td>
                <input type="text" name="sort" value="<?=$model->sort;?>" id="menu_name" class="input-text" >

            </td>
        </tr>
    </table>
    <div class="btn" style="display: none;">
        <input type="hidden" name="icons" value="<?=$model->icons;?>" id="icon_id" class="input-text" >
        <input type="button" id="dosubmit" class="dialog" name="dosubmit" value="提交"/>
    </div>
    <?php ActiveForm::end(); ?>


    <script type="text/javascript">
        $("#dosubmit").click(function(){

            $("#menuForm").submit();
        });

        //选顶级菜单
        $("#menulist").val(<?php echo isset($model->parentid)? $model->parentid:0;?>);

        //异步获取菜单列表
        $("#menu_site").change(function () {
            var site_id = $(this).val();
            if(site_id != 0){
                $.ajax({
                    'type':'POST',
                    'url':'/sys/category/add',
                    'dataType':"json",
                    'data':{siteid:site_id},
                    'success':function(data){
                        if(data){
                            $("#menulist").html('<option value="0" level = "0">请选择</option>'+data);
                        }else{
                            $("#menulist").html('<option value="0" level = "0">请选择</option>');
                        }
                    }
                });
            }
        });
    </script>
