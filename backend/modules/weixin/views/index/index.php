<?php

use yii\widgets\LinkPager;
use yii\helpers\Url;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>广场</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link href="/wx_css/amazeui.min.css" rel="stylesheet" type="text/css" />
    <link href="/wx_css/style.css" rel="stylesheet" type="text/css" />
    <script src="/wx_js/jquery.min.js"></script>
    <script src="/wx_js/amazeui.min.js"></script>
</head>
<body>
<!--图片轮换-->
<div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0" style="position: relative;">
    <ul class="am-slides">
        <li><img src="/wx_images/banner1.png" /></li>
        <li><img src="/wx_images/banner1.png" /></li>
    </ul>
</div>
<!--导航-->
<ul class="sq-nav"  >
    <li>
        <div class="am-gallery-item">
            <a href="newproduct.html" class="">
                <img src="/wx_images/icon.png" />
                <p style="text-indent:0pt; ">爆料</p>
            </a>
        </div>
    </li>
    <li>
        <div class="am-gallery-item">
            <a href="specialprice.html" class="">
                <img src="/wx_images/icon1.png" />
                <p style="text-indent:0pt; ">房屋</p>
            </a>
        </div>
    </li>
    <li>
        <div class="am-gallery-item">
            <a href="reserve.html" class="">
                <img src="/wx_images/icon2.png" />
                <p style="text-indent:0pt; ">招聘</p>
            </a>
        </div>
    </li>
    <li>
        <div class="am-gallery-item">
            <a href="integral.html" class="">
                <img src="/wx_images/icon3.png" />
                <p style="text-indent:0pt; ">二手</p>
            </a>
        </div>
    </li>
    <li>
        <div class="am-gallery-item">
            <a href="integral.html" class="">
                <img src="/wx_images/icon3.png" />
                <p style="text-indent:0pt; ">婚姻</p>
            </a>
        </div>
    </li>


</ul>

</ul>
<!-- 便民-->
<!--<div class="sq-title">-->
<!--    <img src="/wx_images/bm.png" width="24"/>-->
<!--    便民服务-->
<!--</div>-->

<!--列表开始-->
<ul class="index_list">

    <li class="info_top">
        <ul>
            <li class="info_tittle"><span style="color: dodgerblue">#民生#</span>1亿多退休人员养老金上涨5.5% 这些人可多涨点</li>
            <li class="info_content">中新网北京4月15日电 人社部、财政部近日正式下发通知，2017年继续同步提高企业和机关事业单位退休人员基本养老金水平，总体上调5.5%左右，共将惠及1亿多退休人员。其中，对高龄退休人员、艰苦边远地区企业退休人员，可适当提高调整水平。</li>
            <li class="info_pic">
                <img src="/wx_images/aa.jpg" class="img"  alt="">
                <img src="/wx_images/bb.jpg" class="img"  alt="">
                <img src="/wx_images/cc.jpg" class="img"  alt="">
            </li>
        </ul>
    </li>

    <li class="info_bottom">
        <img src="/wx_images/banner1.png" alt="">
        <b class="username">A趁年轻的时光</b>
<!--        <b class="type" >发布于&nbsp爆料</b>-->
        <div class="comment_num" >10</div>
        <div class="comment">
            <img src="/wx_images/comment.jpg" alt="">
<!--            <div class=" am-icon-comment-o"></div>-->
        </div>
    </li>

</ul>
<ul class="index_list">

    <li class="info_top">
        <ul>
            <li class="info_tittle"><span style="color: dodgerblue">#民生#</span>1亿多退休人员养老金上涨5.5% 这些人可多涨点</li>
            <li class="info_content">中新网北京4月15日电 人社部、财政部近日正式下发通知，2017年继续同步提高企业和机关事业单位退休人员基本养老金水平，总体上调5.5%左右，共将惠及1亿多退休人员。其中，对高龄退休人员、艰苦边远地区企业退休人员，可适当提高调整水平。</li>
            <li class="info_pic">
                <img src="/wx_images/aa.jpg" class="img"  alt="">
            </li>
        </ul>
    </li>

    <li class="info_bottom">
        <img src="/wx_images/banner1.png" alt="">
        <b class="username">A趁年轻的时光</b>
        <!--        <b class="type" >发布于&nbsp爆料</b>-->
        <div class="comment_num" >10</div>
        <div class="comment">
            <img src="/wx_images/comment.jpg" alt="">
            <!--            <div class=" am-icon-comment-o"></div>-->
        </div>
    </li>

</ul>
<ul class="index_list">

    <li class="info_top">
        <ul>
            <li class="info_tittle"><span style="color: dodgerblue">#民生#</span>1亿多退休人员养老金上涨5.5% 这些人可多涨点</li>
            <li class="info_content">中新网北京4月15日电 人社部、财政部近日正式下发通知，2017年继续同步提高企业和机关事业单位退休人员基本养老金水平，总体上调5.5%左右，共将惠及1亿多退休人员。其中，对高龄退休人员、艰苦边远地区企业退休人员，可适当提高调整水平。</li>
            <li class="info_pic">

                <img src="/wx_images/bb.jpg" class="img"  alt="">
                <img src="/wx_images/cc.jpg" class="img"  alt="">
            </li>
        </ul>
    </li>

    <li class="info_bottom">
        <img src="/wx_images/banner1.png" alt="">
        <b class="username">A趁年轻的时光</b>
        <!--        <b class="type" >发布于&nbsp爆料</b>-->
        <div class="comment_num" >10</div>
        <div class="comment">
            <img src="/wx_images/comment.jpg" alt="">
            <!--            <div class=" am-icon-comment-o"></div>-->
        </div>
    </li>

</ul>

<ul class="index_list">

    <li class="info_top">
        <ul>
            <li class="info_tittle"><span style="color: dodgerblue">#数码科技#</span>诺基亚6手机上市三个月：老用户集体"情怀疲劳"</li>
            <li class="info_content">大量70后，80后诺基亚铁粉，省吃俭用支持“偶像厂商”1699元或1499元不是个事儿，诺基亚6算是HMD送给中国用户的怀旧见面礼，既然是怀旧，情怀最值钱，而不是性价比。</li>
            <li class="info_pic">
<!--            <img src="/wx_images/banner1.png" class="img"  alt="">
                <img src="/wx_images/banner1.png" class="img"  alt="">
                <img src="/wx_images/banner1.png" class="img"  alt=""> -->
            </li>
        </ul>
    </li>

    <li class="info_bottom">
        <img src="/wx_images/banner1.png" alt="">
        <b class="username">趁年轻</b>
<!--        <b class="type" >发布于&nbsp相亲</b>-->
        <div class="comment_num" >10</div>
        <div class="comment">
            <img src="/wx_images/comment.jpg" alt="">
<!--            <div class=" am-icon-comment-o"></div>-->
        </div>

    </li>

</ul>
<ul class="index_list">

    <li class="info_top">
        <ul>
            <li class="info_tittle"><span style="color: dodgerblue">#爆料#</span>财政局长安排未成年女儿进地税 吃十年空饷</li>
            <li class="info_content"></li>
            <li class="info_pic">
                <!--            <img src="/wx_images/banner1.png" class="img"  alt="">
                                <img src="/wx_images/banner1.png" class="img"  alt="">
                                <img src="/wx_images/banner1.png" class="img"  alt=""> -->
            </li>
        </ul>
    </li>

    <li class="info_bottom">
        <img src="/wx_images/banner1.png" alt="">
        <b class="username">A趁年轻的时光</b>
<!--        <b class="type" > 发布于&nbsp房产</b>-->
        <div class="comment_num" >10</div>
        <div class="comment">
            <img src="/wx_images/comment.jpg" alt="">
<!--            <div class=" am-icon-comment-o"></div>-->
        </div>

    </li>

</ul>

<!--列表结束-->

<!--底部-->
<div style="height: 55px;"></div>
<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default sq-foot am-no-layout" id="">
    <ul class="am-navbar-nav am-cf am-avg-sm-4">
        <li>
            <a href="<?= Yii::$app->urlManager->createUrl(['weixin/index/index']); ?>" class="curr">
                <span class="am-icon-home"></span>
                <span class="am-navbar-label">首页</span>
            </a>
        </li>
        <li>
            <a href="<?= Yii::$app->urlManager->createUrl(['weixin/category/index']); ?>" class="">
                <span class="am-icon-th-large"></span>
                <span class="am-navbar-label">分类</span>
            </a>
        </li>

        <li>
            <a href="<?= Yii::$app->urlManager->createUrl(['weixin/release/index']); ?>" class="">
                <span class="am-icon-edit"></span>
                <span class="am-navbar-label">发布</span>
            </a>
        </li>
        <li>
            <a href="<?= Yii::$app->urlManager->createUrl(['weixin/user/index']); ?>" class="">
                <span class="am-icon-user"></span>
                <span class="am-navbar-label">我的</span>
            </a>
        </li>
    </ul>
</div>


</body>
</html>
