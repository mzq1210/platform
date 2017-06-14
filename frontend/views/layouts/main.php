<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>怀来便民网</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <!--bootstrap start-->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--bootstrap end-->
    <!--swiper start-->
    <link rel="stylesheet" href="/utils/swiper/swiper-3.4.2.min.css">
    <script src="/utils/swiper/swiper-3.4.2.min.js"></script>
    <!--swiper end-->
    <!--dropload.js:https://github.com/ximan/dropload-->
    <link rel="stylesheet" href="/utils/dropload/dropload.css">
    <script src="/utils/dropload/dropload.min.js"></script>
    <!--dropload end-->
    <link rel="stylesheet" href="/css/index.css" />

    <!--当网站添加到主屏幕快速启动方式，将网站添加到主屏幕快速启动方式-->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!--隐藏ios上的浏览器地址栏-->
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <!-- UC默认竖屏 ，UC强制全屏 -->
    <meta name="full-screen" content="yes">
    <meta name="browsermode" content="application">
    <!-- QQ强制竖屏 QQ强制全屏 -->
    <meta name="x5-orientation" content="portrait">
    <meta name="x5-fullscreen" content="true">
    <meta name="x5-page-mode" content="app">
</head>
<?php $this->beginPage() ?>
    <?php $this->beginBody() ?>
        <body>
            <?php echo $content; ?>
        </body>
    <?php $this->endBody() ?>
<?php $this->endPage() ?>
</html>
