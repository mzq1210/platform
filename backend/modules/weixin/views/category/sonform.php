<?php
use yii\widgets\ActiveForm;
use common\models\sys\Icons;
$form = ActiveForm::begin([
    'id' => 'menuSonForm'
]); ?>
<div class="common-form">
    <table width="100%" class="table_form contentWrap">
        <tr>
            <th width="120">上级菜单：</th>
            <td>
                <select name="parentid" id="menulist" class="select-option">
                    <option value="<?=$model->id?>" selected><?=$model->name;?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th width="120">分类：</th>
            <td>
                <select name="type" class="select-option">
                    <option value="<?=$model->type?>" selected>
                        <?php if($model->type == 1){?>
                            首页
                        <?php }else{?>
                            周边
                        <?php }?>
                    </option>
                </select>
            </td>
        </tr>
        <tr>
            <th width="120">描述/名称：</th>
            <td>
                <input type="text" name="name" value="" id="menu_name" class="input-text" >
            </td>
        </tr>
        <tr>
            <th width="120">是否显示：</th>
            <td>
                <input type="radio" name="display" value="0" checked>是
                <input type="radio" name="display" value="1" > 否</td>
        </tr>
        <tr>
            <th width="120">分类排序：</th>
            <td>
                <input type="text" name="sort" value="<?=$model->sort;?>" class="input-text" >
            </td>
        </tr>
    </table>
    <div class="bk15"></div>
    <div class="btn" style="display: none;">
        <input type="hidden" name="icons" value="" id="icon_id" class="input-text" >
        <input type="button" id="dosubmit" class="dialog" name="dosubmit" value="提交"/>
    </div>
    <?php ActiveForm::end(); ?>
    <script type="text/javascript">
        $(function(){
            $.formValidator.initConfig({formid:"menuSonForm",autotip:true,onerror:function(msg,obj){}});
            $("#menu_name").formValidator({onshow:"请输入菜单英文名称",onfocus:"请输入菜单英文名称",oncorrect:"输入正确"}).inputValidator({min:1,onerror:"请输入菜单英文名称"});
        });
        $("#dosubmit").click(function(){
            //获取当前要添加菜单的等级
            $("#menuSonForm").submit();
        });

        //选顶级菜单
        moderid = <?php echo $model->parentid;?>;
        $("#menulist").val(moderid);
    </script>