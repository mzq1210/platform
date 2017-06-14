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
    .title{
        padding-left: 20px;
    }
    .imgnum{
        position: absolute;
        left: 88%;
        top: 58px;
        color: #fff;
        font-size: 16px;
    }
    .look, .zan, .coments{
        font-size: 14px;
    }
    .item-box .info-block .num{
        display: inline-block;
        font-size: 16px;
        margin: 0px;
    }
    .item-box .info-block{
        text-align: right;
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
                    <a href="<?php echo Url::toRoute(['/release/look','id' => $value['id']]);?>">
                        <div class="item-box">
                            <div class="font-12" style="color: #A1A2A4;padding: 8px 0;">
                                <img class="img-circle" src="<?php echo $value['headimgurl'];?>" style="width: 35px;height: 35px;">&nbsp;
                                <?= $value['uname'];?>　　<span><?php echo date("m-d h:m",$value['ctime']);?></span>
                                <!--                        <div class="float-right top-tip" style="margin-top: 4px;">置顶</div>-->
                            </div>

                            <div class="item item-thumbnail-left" style="border: none;">
                                <?php if($value['pic']):?>
                                    <span class="imgnum"><span class="glyphicon glyphicon-picture"></span>&nbsp;<?= count(explode(',', $value['pic']))?></span>
                                    <img width="100%" src="<?= explode(',', $value['pic'])[0]?>" alt="">
                                <?php endif;?>
                                <div class="border-box">
                                    <div class="item-title font-16">
                                        <?= $value['title'];?>
                                    </div>
                                </div>
                            </div>
                            <div class="info-block font-12" style="margin-top: 10px;padding-right: 5px;">
                                <span style="float: left;">发布于｜<?= $value['cname'];?></span>
                                <span class="glyphicon glyphicon-eye-open look"></span><span class="num"><?= $value['look'];?></span>
                                <span class="glyphicon glyphicon-heart-empty zan"></span><span class="num"><?= $value['zan'];?></span>
                                <span class="glyphicon glyphicon-comment coments"></span><span class="num"><?= $value['coments'];?></span>
                            </div>
                        </div>
                    </a>

                <?php endforeach;?>

            </div>
        </div>
        <!--<div class="more">
            查看更多动态
            <i class="float-right icon iconfont">&#xe601;</i>
        </div>-->
    </div>
</div>
</div>


<div class="IM-btn">
    <div class="mark"></div>
    <a href="<?php echo Url::toRoute(['/release/index']);?>"><img width="100%" src="/images/hoverButtonIM@2x.png" alt=""></a>
</div>