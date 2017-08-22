<?php
use yii\helpers\Url;
?>
<style type="text/css">
    .cate-list a{
        display: inline-block;
        width: 50px;height: 50px;border-radius: 50%;
    }
    .cate-list a span{
        line-height: 44px;font-size: 30px;
    }
    .title{
        padding-left: 20px;
    }
    .look, .coments{
        font-size: 18px;line-height: 36px;
    }
    .item-box .info-block .num{
        display: inline-block;
        font-size: 18px;
        margin-left: 10px;line-height: 36px;
    }
    .biaoti{
        font-weight: 700;
    }
    .info-block{
        border-radius: 5px;
        margin-top: 10px !important;height: 36px;padding: 0 !important;
    }
    .info-block div{
        width: 25%;float: left;text-align: center;
    }
</style>

<div class="index">
    <div class="recommend-estate">
        <div class="title border-bottom">我的帖子</div>
        <div class="content">
            <div class="list article-list">

                <?php foreach ($data as $key => $value): ?>
                    <div class="item-box">
                        <div class="font-12" style="color: #A1A2A4;padding: 8px 0;">
                            <?= $value['ctime'];?>
                            <div class="float-right top-tip" style="margin-top: 4px;"><?= $value['cname'];?></div>
                        </div>
                        <a href="<?php echo Url::toRoute(['/release/look','id' => $value['id']]);?>">
                            <div class="item item-thumbnail-left" style="border: none;">
                                <div class="border-box">
                                    <div class="item-title font-16 biaoti" style="max-height: 50px;">
                                        <?= $value['content'];?>
                                    </div>
                                </div>
                                <?php if(isset($value['pics'])):?>
                                    <?php foreach ($value['pics'] as $k => $v): ?>
                                        <?php if($k<3):?>
                                            <div class="imgbox"><img class="img-rounded" src="<?= $v;?>"></div>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </div>
                        </a>
                        <div class="info-block font-16">
                            <div><i class="glyphicon glyphicon-eye-open look font-14"></i><span class="num"><?= $value['look'];?></span></div>
                            <div><i class="glyphicon glyphicon-comment coments font-14"></i><span class="num"><?= $value['coments'];?></span></div>
                            <div cid="<?= $value['id'];?>" class="settop"><i class="glyphicon glyphicon-arrow-up coments font-14"></i><span class="num"></span></div>
                            <div cid="<?= $value['id'];?>" class="delete"><i class="glyphicon glyphicon-trash coments font-14"></i><span class="num"></span></div>
                        </div>
                    </div>
                <?php endforeach;?>

            </div>
        </div>
    </div>
</div>
</div>
<div class="console">
    请输入您的帖子内容...
</div>
<div id="dialogContent"></div>
<script>
    $(function () {
        $(".biaoti").dotdotdot();//省略号
        $(".neirong").dotdotdot();//省略号
        var switcher;
        $('.settop').click(function () {
            var cid = $(this).attr('cid');
            $.ajax({
                type: 'get',
                data:{id : cid},
                url: '/release/settop',
                dataType: 'json',
                success: function (status) {
                    if (status== 2) {
                        $(".console").html("置顶频率过快,请稍后重试...");
                        $(".console").css("display","block");
                    } else if(status== 1){
                        $(".console").html("已置顶!");
                        $(".console").css("display","block");
                    }else{
                        $(".console").html("置顶失败!");
                        $(".console").css("display","block");
                    }
                    switcher = setTimeout(function(){
                        $(".console").css("display","none")
                    },2000);
                }
            });
        })

        $('.delete').click(function () {
            var cid = $(this).attr('cid');
            var that = $(this);
            $.ajax({
                type: 'get',
                data:{id : cid},
                url: '/release/delete',
                dataType: 'json',
                success: function (status) {
                    if(status== 1){
                        that.parents('.item-box').remove();
                        $(".console").html("删除成功!");
                        $(".console").css("display","block");
                    }else{
                        $(".console").html("删除失败!");
                        $(".console").css("display","block");
                    }
                    switcher = setTimeout(function(){
                        $(".console").css("display","none")
                    },2000);
                }
            });
        })
    })
</script>