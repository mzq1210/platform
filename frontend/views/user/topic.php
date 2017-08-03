<?php
use yii\helpers\Url;
?>
<style type="text/css">
    .icons span{
        line-height: 44px;font-size: 30px;color: #fff;
    }
    .title{
        padding-left: 20px;
    }
    .title{
        padding-left: 20px;
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

<div class="index">
    <div class="recommend-estate">
        <div class="title border-bottom">我的帖子</div>
        <div class="content">
            <div class="list article-list">
                <?php foreach ($data as $key => $value): ?>
                    <div class="item-box">
                        <div class="font-12" style="color: #A1A2A4;padding: 8px 0;">
                            <img class="img-circle" src="<?php echo $value['headimgurl'];?>" style="width: 35px;height: 35px;">&nbsp;
                            <?= $value['uname'];?><span style="margin-left: 10px;"><?= $value['ctime'];?></span>
                            <!--<div class="float-right top-tip" style="margin-top: 4px;">置顶</div>-->
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
                        <div class="info-block font-16" style="margin-top: 10px;padding-right: 5px;">
                            <span style="float: left;">发布于｜<?= $value['cname'];?></span>
                            <span class="glyphicon glyphicon-eye-open look font-14"></span><span class="num"><?= $value['look'];?></span>
                            <span class="glyphicon glyphicon-heart-empty zan"></span><span class="num"><?= $value['zan'];?></span>
                            <span class="glyphicon glyphicon-comment coments"></span><span class="num"><?= $value['coments'];?></span>
                        </div>
                    </div>

                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
</div>
