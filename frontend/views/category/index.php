<?php
use yii\helpers\Url;
?>
<style type="text/css">
    .icons{
        display: inline-block;margin-top: 10px;
        width: 50px;height: 50px;border-radius: 50%;
    }
    .icons span{
        line-height: 44px;font-size: 30px;color: #fff;
    }
    .detail{
        margin: 10px;padding:10px;
        border: dashed 1px deepskyblue;
        border-radius: 8px;
    }
    .title{
        padding-left: 20px;
    }
    .category-name{
        margin-top: 7px;font-size: 12px;width: 50px;text-align: center;
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
    .neirong{
        color: #666;
    }
    .info-block{
        border-radius: 5px;
        margin-top: 10px !important;height: 36px;padding: 0 !important;
    }
    .info-block div{
        width: 50%;float: left;text-align: center;
    }
</style>
<div class="title">
    <a href="" class="<?= $Category['style'];?> icons"><span style="color: #fff" class="<?= $Category['icons'];?>"></span></a>
    <div class="category-name"><?= $Category['name'];?></div>
</div>

<div class="index">
    <div class="gray-space"></div>
    <div class="title border-bottom detail"><?= $Category['detail'];?></div>

    <div class="gray-space"></div>
    <div class="recommend-estate">
        <div class="title border-bottom">为您推荐</div>
        <div class="content">
            <div class="list article-list">

                <?php foreach ($Content as $key => $value): ?>
                    <div class="item-box">
                        <div class="font-12" style="color: #A1A2A4;padding: 8px 0;">
                            <?= $value['ctime'];?>
                            <div class="float-right top-tip" style="margin-top: 4px;"><?= $value['cname'];?></div>
                        </div>
                        <a href="<?php echo Url::toRoute(['/release/look','id' => $value['id']]);?>">
                            <div class="item item-thumbnail-left" style="border: none;">
                                <div class="border-box">
                                    <div class="item-title font-16 biaoti" style="max-height: 50px;">
                                        <?= $value['title'];?>
                                    </div>
                                </div>
                                <div class="border-box">
                                    <div class="item-title font-14 neirong" style="max-height: 80px;">
                                        <?= $value['content'];?>
                                    </div>
                                </div>
                                <?php if(isset($value['pics'])):?>
                                    <?php foreach ($value['pics'] as $k => $v): ?>
                                        <div class="imgbox"><img class="img-rounded" src="<?= $v;?>"></div>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </div>
                        </a>
                        <div class="info-block font-16">
                            <div><i class="glyphicon glyphicon-eye-open look font-14"></i><span class="num"><?= $value['look'];?></span></div>
                            <div><i class="glyphicon glyphicon-comment coments font-14"></i><span class="num"><?= $value['coments'];?></span></div>
                        </div>
                    </div>
                <?php endforeach;?>

            </div>
        </div>
    </div>
</div>
</div>

<div class="IM-btn">
    <a href="<?php echo Url::toRoute(['/release/index']);?>"></a>
</div>
<script type='text/javascript'>
    $(function(){
        $(".biaoti").dotdotdot();//省略号
        $(".neirong").dotdotdot();//省略号
    })
</script>