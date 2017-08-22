<?php
use yii\helpers\Url;
?>
<link rel="stylesheet" href="/css/index.css" />
<script  src="/js/index.js"></script>
<style type="text/css">
    .lunbo {
        width: 100%;
        height: 165px;
    }
    .lunbo img{
        width: 100%;
        height: 100%;
    }
    .cate {
        width: 100%;margin-top: 5px;
        overflow: hidden;
    }
    .cate-list {
        float: left;
        margin: 10px 2% 5px 2%; padding-bottom: 21%;
        width: 16%; height: 0;
        text-align: center;
    }
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
    .qiandao{
        display: block;z-index: 99;
        position: fixed;right: 15px; bottom: 128px;
        width: 58px;  height: 58px;border-radius: 50%;
        background: url("/sign/images/qiandao.jpg") no-repeat;
        background-size: 100% 100%;
    }
</style>
<a class="qiandao" href="<?php echo Url::toRoute(['/sign/index'])?>"></a>
<div class="index">
    <!--轮波图-->
<!--     <div class="swiper-container lunbo" id="lunbo">
        <div class="swiper-wrapper">
            <div class="swiper-slide lunbo"><img src="http://show.onelog.cn/platform/platform/2017/07/14/18031449207986.jpg_600x300.jpg" alt=""></div>
            <div class="swiper-slide lunbo"><img src="http://show.onelog.cn/platform/platform/2017/07/14/6d0b6e7fab96437f82692d83abf0c40e.jpg_600x300.jpg" alt=""></div>
        </div> -->
        <!-- 如果需要分页器 -->
        <!-- <div class="swiper-pagination"></div> -->
    <!-- </div> -->
    <!--轮波图-->
    <div class="cate">
        <?php foreach ($Category as $key => $value): ?>
            <div class="cate-list">
                <a href="<?php echo Url::toRoute(['/category/info'])."?id=".$value['id']; ?>" class="<?= $value['style'];?>"><span style="color: #fff" class="<?= $value['icons'];?>"></span></a>
                <div style="margin-top: 7px;font-size: 12px;"><?= $value['name'];?></div>
            </div>
        <?php endforeach;?>
    </div>

    <div class="gray-space"></div>
    <div class="recommend-estate">
        <div class="title border-bottom">为您推荐</div>
        <div class="content">
            <div class="list article-list">

                <?php foreach ($content as $key => $value): ?>
                    <div class="item-box">
                        <div class="font-12" style="color: #A1A2A4;padding: 8px 0;">
                            <?= $value['ctime'];?>
                            <div class="float-right top-tip" style="margin-top: 4px;"><?= $value['cname'];?></div>
                        </div>
                        <a href="<?php echo Url::toRoute(['/release/look','id' => $value['id']]);?>">
                            <div class="item item-thumbnail-left" style="border: none;">
                                <div class="border-box">
                                    <div class="item-title font-16 biaoti" style="line-height:25px;height: 50px;">
                                        <?= $value['content'];?>
                                    </div>
                                </div>
                                <?php if(isset($value['pics'])):?>
                                    <?php foreach ($value['pics'] as $k => $v): ?>
                                        <?php if($k<3):?>
                                            <div class="imgbox"><img style="width: 122px;height: 122px;" class="img-rounded" src="<?= $v;?>"></div>
                                        <?php endif;?>
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
<div class="IM-btn">
    <a href="<?php echo Url::toRoute(['/release/index']);?>"></a>
</div>

<script type='text/javascript'>
    $(function(){
        $(".biaoti").dotdotdot();//省略号
        $(".neirong").dotdotdot();//省略号
        $(".add_zan").click(function () {
            var zan_num = parseInt($(this).text());
            var zan_new_num = zan_num + 1;
            $(this).find(".zan_num").text(zan_new_num);
            $(this).find(".zan_num").css('color','green');
            var id=$(this).find(".zan_num").attr('id');

            $.get("<?= Yii::$app->urlManager->createUrl(['release/zan']); ?>", { 'id': id }, function(data){
            });
            $(this).unbind('click');
        });
        $(".content img").addClass("carousel-inner img-responsive img-rounded");
    })
</script>

<script type='text/javascript' src='http://res.wx.qq.com/open/js/jweixin-1.2.0.js' charset='utf-8'></script>
<script>
    wx.config(<?= json_encode($config) ?>);
    wx.ready(function(){
        //分享朋友圈
        wx.onMenuShareTimeline({
            title: '发广告，找合作，关注怀来便民网，还您个干净的朋友圈', // 分享标题
            link: '', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: 'http://wx.qlogo.cn/mmopen/JeDmEdykfArU3pCbCGC9EQFGiaxsiccuHpHJyvXYy9LONWIxBEPp1zzbqIZVXJAdDB3R2aSQr6levvicXc0ZY4ykbpRIh7ib4Lxs/0', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });

        //分享给朋友
        wx.onMenuShareAppMessage({
            title:'怀来便民网-无需手机验证', // 分享标题
            desc: '发广告，找合作，关注怀来便民网，还您个干净的朋友圈', // 分享描述
            link: '', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: 'http://wx.qlogo.cn/mmopen/JeDmEdykfArU3pCbCGC9EQFGiaxsiccuHpHJyvXYy9LONWIxBEPp1zzbqIZVXJAdDB3R2aSQr6levvicXc0ZY4ykbpRIh7ib4Lxs/0', // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
    });
</script>
