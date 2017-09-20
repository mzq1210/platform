<?php
use yii\helpers\Url;
?>
<link rel="stylesheet" type="text/css" href="/css/success/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/css/success/business.css" />

</head>
<style type="text/css">
    html,body{
        width: 100%;height: 100%;
        background: #fff;
    }

</style>


<div id="continue">
    <!--header-->
    <div id="box" style="margin-bottom: 10px;">
        <div class="app-content">
            <div class="app-content-body fade-in-up">
                <div class="hbox hbox-auto-xs hbox-auto-sm">
                    <div class="col">
                        <div class="col-sm-12 text-center">
                            <i class="succeed"></i>
                        </div>
                        <div class="col-sm-12 text-center">
                            <p>恭喜您，发布成功！</p>
                        </div>
                        <div class="col-sm-12 text-center">
                            <a onclick="$('.layer-con').show()">
                                <button  class="btn share text-center">分享信息</button>
                            </a>
                        </div>
                        <div class="col-sm-12 text-center">
                            <a href="<?php echo Url::toRoute(['/release/look','id' => $id]);?>">
                                <button  class="btn look text-center">查看信息</button>
                            </a>
                        </div>
                        <div class="both"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="layer-con" style="display: none;" onclick="$(this).hide()">
    <div class="layer-bg" style="">
        <span class="layer-details">使用浏览器的分享功能<br>分享至朋友圈/QQ空间</span>
    </div>
</div>



<script src="/js/look.js"></script>
<script type='text/javascript' src='http://res.wx.qq.com/open/js/jweixin-1.2.0.js' charset='utf-8'></script>
<script>
    wx.config(<?= json_encode($config) ?>);
    wx.ready(function () {

        //分享朋友圈
        wx.onMenuShareTimeline({
            title: '<?php echo mb_substr($content,0,45);?>', // 分享标题
            link: "http://www.onelog.cn/release/look?id=<?php echo $id; ?>", // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
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
            title: '<?php echo mb_substr($content,0,45);?>', // 分享标题
            desc: '关注“怀来便民网”,免费在线发布招聘、租售、求职、相亲等信息', // 分享描述
            link: "http://www.onelog.cn/release/look?id=<?php echo $id; ?>", // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: 'http://wx.qlogo.cn/mmopen/JeDmEdykfArU3pCbCGC9EQFGiaxsiccuHpHJyvXYy9LONWIxBEPp1zzbqIZVXJAdDB3R2aSQr6levvicXc0ZY4ykbpRIh7ib4Lxs/0', // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
                //alert('干的漂亮');
            },
            cancel: function () {
                //alert('怎么不分享了？')
                // 用户取消分享后执行的回调函数
            }
        });
    });
</script>
