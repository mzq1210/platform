<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\sys\UserRole;
?>
<style type="text/css">
    html{_overflow-y:scroll}
</style>
<div class="pad_10" style="margin-top:20px;">
    <?php $form = ActiveForm::begin([
        'id' => 'allotRoleForm'
    ]); ?>
    <table class="table table-bordered table-striped table-hover table-condensed">
        <thead>
        <tr>
            <th>ID</th>
            <th>角色名称</th>
            <th>角色描述</th>
        </tr>
        </thead>
        <tbody id="role">
        <?php if($role):?>
            <?php foreach($role as $val):?>
                <tr>
                    <td width="15%" align="left">
                        <input type="checkbox" name="roleid[]" value="<?=$val->id?>" <?php if(in_array($val->id,UserRole::getUserRole($userid,$val->siteid))):?>checked<?php endif;?>>
                    </td>
                    <td><?=$val->name;?></td>
                    <td><?=$val->desc;?></td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
        </tbody>
    </table>
    <div style="display: none;" class="btn"><input type="submit" id="dosubmit" class="dialog" name="dosubmit" value="提交"/></div>
    <input type="hidden" id="User_id" name="user_id" value="<?=$userid?>"/>
    <?php ActiveForm::end(); ?>
</div>
<script>
    function chRole(siteid) {
        var userid = $('#User_id').val();
        var url = '<?php echo Url::toRoute('/sys/role/choicerole_ajax'); ?>';
        $.post(url,{'userid':userid,'siteid':siteid},function(data){
            if(data.status == 200){
                $('#role').html(data.result);
            }else{
                alert('失败！');
            }
        },'json');
    }
</script>