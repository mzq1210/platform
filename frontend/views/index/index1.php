<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link rel="stylesheet" href="/templet/css/amazeui.min.css">
    <link rel="stylesheet" href="/templet/css/wap.css">
    <!--dropload.js:https://github.com/ximan/dropload-->
    <link rel="stylesheet" href="/utils/dropload/dropload.css">
    <title>首页</title>
    <style type="text/css">
        .content{
            position: relative;
            height: 100%;
            overflow-y: auto;
        }
        /*内容高度*/
        .pet_list_one_bt{
            height: 45px;overflow: hidden;
        }
    </style>
</head>
<body>
<div data-am-widget="gotop" class="am-gotop am-gotop-fixed">
    <a href="#top" title="">
        <img class="am-gotop-icon-custom" src="/templet/img/goTop.png"/>
    </a>
</div>

<div class="pet_mian" id="top">
    <div data-am-widget="slider" class="am-slider am-slider-a1" data-am-slider='{"directionNav":false}'>
        <ul class="am-slides">
            <li>
                <img src="/templet/img/fl01.png">
                <div class="pet_slider_font">
                    <span class="pet_slider_emoji"> (╭￣3￣)╭♡   </span>
                    <span>“大白”有望成为现实：充气机器人研究取得进展</span>
                </div>
                <div class="pet_slider_shadow"></div>
            </li>
            <li>
                <img src="/templet/img/fl02.png">
                <div class="pet_slider_font">
                    <span class="pet_slider_emoji"> []~(￣▽￣)~*　</span>
                    <span>已然魔性的雪橇犬哈士奇 —《雪地狂奔》</span>
                </div>
                <div class="pet_slider_shadow"></div>
            </li>
            <li>
                <img src="/templet/img/fl03.png">
                <div class="pet_slider_font">
                    <span class="pet_slider_emoji"> (｡・`ω´･)　</span>
                    <span>《星际争霸2:虚空之遗》国服过审!</span>
                </div>
                <div class="pet_slider_shadow"></div>
            </li>
        </ul>
    </div>

    <div class="pet_circle_nav">
        <ul class="pet_circle_nav_list">
            <li><a href="" class="iconfont pet_nav_xinxianshi ">&#xe61e;</a><span>新鲜事</span></li>
            <li><a href="" class="iconfont pet_nav_zhangzhishi ">&#xe607;</a><span>趣闻</span></li>
            <li><a href="" class="iconfont pet_nav_kantuya ">&#xe62c;</a><span>阅读</span></li>
            <li><a href="" class="iconfont pet_nav_mengzhuanti ">&#xe622;</a><span>专题</span></li>
            <li><a href="" class="iconfont pet_nav_meirong ">&#xe629;</a><span>订阅</span></li>
            <li><a href="" class="iconfont pet_nav_yiyuan ">&#xe602;</a><span>专栏</span></li>
            <li><a href="" class="iconfont pet_nav_dianpu ">&#xe604;</a><span>讨论</span></li>
            <li><a href="javascript:;" class="iconfont pet_nav_gengduo ">&#xe600;</a><span>更多</span></li>
        </ul>
    </div>
    <div class="pet_content_main content">
        <div data-am-widget="list_news" class="am-list-news am-list-news-default ">
            <div class="am-list-news-bd ">
                <ul class="am-list ">
                    <?php foreach ($content as $key => $value): ?>
                    <li class="am-g am-list-item-desced pet_list_one_block" style="padding-bottom: 10px;">
                        <div class="pet_list_one_info">
                            <div class="pet_list_one_info_l">
                                <div class="pet_list_one_info_ico">
                                    <img src="<?= $value['headimgurl'];?>" alt="">
                                </div>
                                <div class="pet_list_one_info_name"><?= $value['uname'];?></div>
                            </div>
                            <div class="pet_list_one_info_r">
                                <div class="pet_list_tag pet_list_tag_stj"><?= $value['cname'];?></div>
                            </div>
                        </div>
                        <div class=" am-list-main">
                            <h3 class="am-list-item-hd pet_list_one_bt">
                                <a href="###" class=""><?= $value['content'];?></a>
                            </h3>
                            <ul data-am-widget="gallery" class="am-gallery am-avg-sm-3 am-avg-md-3 am-avg-lg-3 am-gallery-default pet_list_one_list">
                                <?php if(isset($value['pics'])):?>
                                    <?php foreach ($value['pics'] as $k => $v): ?>
                                        <?php if($k<3):?>
                                            <li>
                                                <div class="am-gallery-item">
                                                    <a href="###" class="">
                                                        <img src="<?= $v;?>" alt="某天 也许会相遇 相遇在这个好地方"/>
                                                    </a>
                                                </div>
                                            </li>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </ul>
                            <div class="am-list-item-text pet_list_two_text">
                            </div>
                        </div>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="/templet/js/amazeui.min.js"></script>
<script src="/utils/dropload/dropload.min.js"></script>
<script src="/templet/js/index.js"></script>
</body>
</html>