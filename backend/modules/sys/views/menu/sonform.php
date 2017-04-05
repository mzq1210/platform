<?php
use yii\widgets\ActiveForm;
use common\models\sys\Icons;
$form = ActiveForm::begin([
        'id' => 'menuSonForm'
]); ?>
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
<div class="common-form">
<table width="100%" class="table_form contentWrap">
    <tr>
        <th width="120">上级菜单：</th>
        <td>
            <select name="parentid" id="menulist" >
                <option value="<?=$model->id?>" level="<?php echo $model->level;?>" selected><?=$model->name;?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th width="120">描述/名称：</th>
        <td>
            <input type="text" name="name" value="" id="menu_name" class="input-text" >
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
        <th width="120">权限值：</th>
        <td>
            <table>
                <tr><td><span id="a_tip" class="onShow" style="font-size: 12px;">1.如果为非功能性菜单,则无需填写!2.功能性菜单分为MCA(模块->控制器->方法)</span></td></tr>
                <tr><td>
                        模块:<input type="text" name="m" id="menu_m" value="" class="input-text" style="width:60px;">
                        控制器:<input type="text" name="c" id="menu_c" value="" class="input-text" style="width:60px;">
                        方法:<input type="text" name="a" id="menu_a" value="" class="input-text"  style="width:60px;">
                        参数值:<input type="text" name="param" id="menu_param" value="" class="input-text"  style="width:100px;">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <th width="120">是否显示：</th>
        <td><input type="radio" name="display" value="0" checked>是
            <input type="radio" name="display" value="1" > 否</td>
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
        $("#menu_m").formValidator({onshow:"请输入内容",onfocus:"请输入内容"}).regexValidator({regexp:"^[0-9a-z_]{2,20}$",onerror:"模块名称有误"});
        $("#menu_c").formValidator({onshow:"请输入内容",onfocus:"请输入内容"}).regexValidator({regexp:"^[0-9a-z_]{3,20}$",onerror:"控制器名称有误"});
        $("#menu_a").formValidator({onshow:"请输入内容",onfocus:"请输入内容"}).regexValidator({regexp:"^[0-9a-z-_]{3,20}$",onerror:"方法名称有误"});
    });
    $("#dosubmit").click(function(){
        var menu_m = $.trim($("#menu_m").val());
        var menu_c  = $.trim($("#menu_c").val());
        var menu_a = $.trim($("#menu_a").val());
        //获取当前要添加菜单的等级
        var level = parseInt($("#menulist").find("option:selected").attr('level')) + 1;
        $("#menuSonForm").append('<input type="hidden" name="Menu[level]" value='+level+'>');
        $("#menuSonForm").submit();
    });

    //选顶级菜单
    moderid = <?php echo $model->parentid;?>;
    $("#menulist").val(moderid);

    $(".iconList").click(function () {
        var id = $(this).attr('index');
        var icon = $(this).attr('icon');
        $("#icon_id").val(id);
        $("#icons").removeClass().addClass('glyphicon '+icon);
    })
</script>