<?php
use yii\helpers\Url;
?>
<link rel="stylesheet" href="../css/new-dynamic-detail.css">
<link rel="stylesheet" href="/css/comment-detail.css">
<style>
    .tixing {
        margin: 10px;
        padding: 10px;
        border-bottom: dashed 1px #999;
    }
</style>

<nav class="nav text-center">
    <a href="javascript:history.back(-1);"><div class="back-btn"><i class="icon iconfont">&#xe600;</i></div></a>
    <span class="title text-ellipsis">帖子详情</span>
<!--    <div class="share-btn"><i class="icon iconfont">&#xe684;</i></div>-->
</nav>

<div class="new-dynamic-detail padding-double">
    <h3 class="margin-bottom"><?= $data['title']; ?></h3>
    <div class="color-light-font font-12 margin-bottom-double"><?= $data['uname']; ?>
        &nbsp;&nbsp;<span><?= date("m-d h:m", $data['ctime']); ?></span>&nbsp&nbsp&nbsp<?= $data['cname']; ?></div>
    <div class="line margin-bottom-double"></div>
    <!--<div class="summary padding margin-bottom">
        <div class="text font-16">
            【摘要】当我们聊设计的时候，可读性是我们最常提及的话题。良好的设计应该都是可读的设计，如果信息都无
        </div>
    </div>-->
    <div class="content">
        <?= $data['content']; ?>
        <?php if ($data['pic']) { ?>

            <div style="width: 95%;margin:0 auto;">
                <?php foreach (explode(',', $data['pic']) as $kk => $vv): ?>
                    <img src="<?php echo $vv ?>" width="100%"
                         style="margin-right: 1%; margin-top: 8px;display: inline-block;">
                <?php endforeach; ?>
            </div>
        <?php } ?>

    </div>
</div>

<div class="comment-detail">

    <div class="all-comments">
        <div class="title border-bottom padding-double">
            <div class="font-16">
                用户评论<span class="font-14">（<?= $data['coments']; ?>条）</span>
                <span class="glyphicon glyphicon-eye-open look"></span><span class="num"><?= $data['look'];?></span>
<!--                <span class="glyphicon glyphicon-heart-empty zan"></span><span class="num">--><?//= $data['zan'];?><!--</span>-->
            </div>
        </div>
        <div class="content comment-list">
            <div class="list">

                <?php if (!empty($comment)) { ?>
                    <?php foreach ($comment as $key => $value) { ?>

                        <div class="padding-double border-bottom">
                            <div class="item item-ava">
                                <img src="<?= $value['headimgurl']; ?>" alt="">
                                <div class="padding-left">
                                    <div>
                                    <span class="font-14">
                                        <?= $value['uname']; ?>
                                    </span>
                                        <div class="float-right color-light-font font-12 line-20">
                                            <?= date("Y-m-d h:m", $value['ctime']); ?>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="color-light-font font-12" style="color: #00b3ee;">
                                            <?= $key+1; ?>楼
                                        </span>
                                    </div>
                                    <div class="text font-14" data-switch="true">
                                        <?= $value['comment']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="tixing">还没有评论，快来抢沙发</div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="cid" id="cid" value="<?= $id; ?>">
<a href="<?php echo Url::toRoute(['/release/comment','id' => $data['id']]);?>">
<div class="comment-btn">
    写评论
</div>
</a>
<script  src="/js/look.js"></script>
<script type='text/javascript' src='http://res.wx.qq.com/open/js/jweixin-1.2.0.js' charset='utf-8'></script>
<script>
    wx.config(<?= json_encode($config) ?>);
    wx.ready(function(){

        //分享朋友圈
        wx.onMenuShareTimeline({
            title: '<?= $data['cname']; ?>:<?= $data['title']; ?>', // 分享标题
            link: '', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: '<?= $data['headimgurl']; ?>', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });

        //分享给朋友
        wx.onMenuShareAppMessage({
            title: '<?= $data['cname']; ?>:<?= $data['title']; ?>', // 分享标题
            desc: '怀来便民网,免费发布各类消息', // 分享描述
            link: '', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: '<?= $data['headimgurl']; ?>', // 分享图标
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