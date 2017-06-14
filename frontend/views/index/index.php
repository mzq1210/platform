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
    .left{
        float: left;
    }
    .right{
        float: right;
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
<!--        <div class="cate-list">-->
<!--            <a href="--><?php //echo Url::toRoute(['/category/index']); ?><!--" class="label label-success"><span style="color: #fff" class="glyphicon glyphicon-briefcase"></span></a>-->
<!--            <div style="margin-top: 7px;font-size: 12px;">更多</div>-->
<!--        </div>-->
    </div>
    <div class="gray-space"></div>
    <!--<div class="active-recommend">
        <div class="title">
            活动行
        </div>
        <div class="content">
            <div id="index_swiper" class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="shadow"></div>
                        <div class="text">
                            <div class="line"></div>
                            <div>山水文化</div>
                        </div>
                        <img src="/images/pic_activityhouse.png" alt="">
                    </div>
                    <div class="swiper-slide">
                        <div class="shadow"></div>
                        <div class="text">
                            <div class="line"></div>
                            <div>碧桂园</div>
                        </div>
                        <img src="/images/pic_activityhouse.png" alt="">
                    </div>
                    <div class="swiper-slide">
                        <div class="shadow"></div>
                        <div class="text">
                            <div class="line"></div>
                            <div>碧桂园</div>
                        </div>
                        <img src="/images/pic_activityhouse.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="gray-space"></div>-->
<!--    <div class="headline">-->
<!--        <div class="title">-->
<!--            今日头条-->
<!--        </div>-->
<!--        <div class="content">-->
<!--            <div class="list">-->
<!--                <div class="item item-thumbnail-right padding">-->
<!--                    <img src="/images/toutiao_pic.png" alt="">-->
<!--                    <div class="item-title font-15">杭州厦门同日发布楼市调控新政杭州厦门同日发布楼市调控新政杭州厦门同日发布楼市调控新政杭州厦门同日发布楼市调控新政</div>-->
<!--                    <div class="item-subTitle font-12 text-ellipsis">2017-03-28  17:56丨我爱我家111</div>-->
<!--                </div>-->
<!--                <div class="item item-thumbnail-right padding">-->
<!--                    <img src="/images/toutiao_pic.png" alt="">-->
<!--                    <div class="item-title font-15">杭州厦门同日发布</div>-->
<!--                    <div class="item-subTitle font-12 text-ellipsis">2017-03-28  17:56丨我爱我家</div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <!--<div class="more">
            更多
            <i class="float-right icon iconfont">&#xe601;</i>
        </div>-->
<!--    </div>-->
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
<div class="IM-btn">
    <div class="mark"></div>
    <a href="<?php echo Url::toRoute(['/release/index']);?>"><img width="100%" src="/images/hoverButtonIM@2x.png" alt=""></a>
</div>

<script type='text/javascript'>
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