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
    .imgnum{
        position: absolute;
        left: 88%;
        top: 58px;
        color: #fff;
        font-size: 16px;
    }
    .look, .zan, .coments{
        font-size: 18px;
    }
    .item-box .info-block .num{
        display: inline-block;
        font-size: 16px;
        margin: 0;
    }
    .item-box .info-block{
        text-align: right;
    }
    .biaoti{
        font-weight: 700;
    }
    .neirong{
        color: #666;
    }
    .info-block{
        border-radius: 5px;
    }
</style>

<div class="index">
    <!--轮波图-->
    <div class="swiper-container lunbo" id="lunbo">
        <div class="swiper-wrapper">
            <div class="swiper-slide lunbo"><img src="/images/01.jpg"/></div>
            <div class="swiper-slide lunbo"><img src="/images/02.jpg" alt=""></div>
            <div class="swiper-slide lunbo"><img src="/images/03.jpg" alt=""></div>
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination"></div>
    </div>
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

                <?php foreach ($Content as $key => $value): ?>
                <div class="item-box">
                    <div class="font-12" style="color: #A1A2A4;padding: 8px 0;">
                        <img class="img-circle" src="<?php echo $value['headimgurl'];?>" style="width: 35px;height: 35px;">&nbsp;
                        <?= $value['uname'];?>　　<span><?php echo date("m-d h:m",$value['ctime']);?></span>
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
                            <?php if($value['pic']):?>
                                <span class="imgnum"><span class="glyphicon glyphicon-picture"></span>&nbsp;<?= count(explode(',', $value['pic']))?></span>
                                <?php foreach ($pics = explode(',', $value['pic']) as $k => $v): ?>
                                    <div class="imgbox"><img class="img-rounded" src="<?= $v['pic'].'_200x200.jpg';?>"></div>
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
<div class="IM-btn">
    <div class="mark"></div>
    <a href="<?php echo Url::toRoute(['/release/index']);?>"><img width="100%" src="/images/hoverButtonIM@2x.png" alt=""></a>
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
    })
</script>

<script type='text/javascript' src='http://res.wx.qq.com/open/js/jweixin-1.2.0.js' charset='utf-8'></script>
<script>
    wx.config(<?= json_encode($config) ?>);
    wx.ready(function(){
        //分享朋友圈
        wx.onMenuShareTimeline({
            title: '怀来县还有你不知道的事情？', // 分享标题
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
            title:'怀来县还有你不知道的事情？', // 分享标题
            desc: '好我的老天爷也这是闹刷呀', // 分享描述
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