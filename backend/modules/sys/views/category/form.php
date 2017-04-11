<?php
use yii\widgets\ActiveForm;
use common\models\sys\Icons;
$form = ActiveForm::begin([
    'id' => 'menuForm'
]);
?>
<style type="text/css">
    #icons,.icon{
        display: inline-block;
        width: 30px;height: 26px;
        color: #1ABC9C;
        vertical-align: middle;
        text-align: center;line-height: 24px;
        border: solid 1px #ddd;border-radius: 6px;
    }
    .dropdown{display: inline-block;}
    .dropdown>button{height: 27px;font-size: 12px;font-weight: 700;}
    .dropdown>ul{width: 77px;height: 150px;overflow-y: auto;overflow-x: hidden;min-width: 0;}
    .dropdown>ul>li{width: 60px;text-align: center;}
    .dropdown>ul>li>a>i{color: #1ABC9C;margin-top: 3px;}
    .dropdown>ul>li>a{padding: 3px 5px;}
</style>
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
                <i id="icons" class=""></i>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-expanded="false">
                        <i class="glyphicon glyphicon-th"></i> 图标 <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                        <?php if($iconList):?>
                            <?php foreach($iconList as $val):?>
                                <li class="iconList" index="<?=$val->id;?>" icon="<?=$val->icon;?>" role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="glyphicon <?=$val->icon?> icon"></i></a></li>
                            <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>
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

        //选择图标
        $("#icons").addClass('glyphicon '+'<?php echo Icons::getIcon($model->icons);?>');
        $(".iconList").click(function () {
            var id = $(this).attr('index');
            var icon = $(this).attr('icon');
            $("#icon_id").val(id);
            $("#icons").removeClass().addClass('glyphicon '+icon);
        })
    </script>
