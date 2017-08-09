<?php
use yii\helpers\Url;
?>

<link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/bootstrap-fileinput/4.3.9/css/fileinput.min.css">
<script type="text/javascript" src="https://cdn.bootcss.com/bootstrap-fileinput/4.3.9/js/fileinput.min.js"></script>
<script type="text/javascript" src="https://cdn.bootcss.com/bootstrap-fileinput/4.3.9/js/locales/zh.min.js"></script>
<script type="text/javascript" src="/js/dialog.js"></script>

<link rel="stylesheet" href="/css/comment-edit.css">
<script src="/js/comment-edit.js"></script>
<link rel="stylesheet" href="/css/calc-detail.css">
<script src="/js/calc-detail.js"></script>

<style>
    .comment-edit .editor input{
        width: 100%;
        height: 30px;
        box-sizing: border-box;
        font-size: 14px;
        outline: none;
        border: none;
        resize: none;
    }
    input::-webkit-input-placeholder{
        color: #E3E3E3;
    }
    input:-moz-placeholder{
        color:#666;
    }
    input::-moz-placeholder{
        color:#666;
    }
    input:-ms-input-placeholder{
        color:#666;
    }

    .upload-botton i {
        font-size: 24px;
    }
    /*模态框居中*/
    .tb {display: table;pointer-events: none;width: 100%;height: 100%;  }
    .tb>.tc {display: table-cell;pointer-events: none;vertical-align: middle;}
    .tb>.tc>div {pointer-events: auto;}
    .imgbox{
        width: 60px;height: 60px;margin-right: 10px;float: left;margin-bottom: 5px;
        border: dashed 2px #ccc;display: inline-block;
        text-align: center;font-size: 38px;color: #999;line-height: 60px;
        position: relative;top: 0;left: 0;
    }
    .imgbox img{
        position: relative;top: 0;left: 0;
    }
    .imgclose{
        font-size: 22px;
        position: absolute;
        top:0;
        right: 0;
        color: red;
    }
</style>

<nav class="nav text-center">
    <a href="<?php echo Url::toRoute(['/index/index']); ?>"><div class="back-btn"><i class="icon iconfont">&#xe600;</i>首页</div></a>
    <span class="title text-ellipsis">发布帖子</span>
</nav>
<div class="gray-space"></div>
<form class="form-horizontal" action="<?php echo Url::to(['release/create']); ?>" method="post">
<div class="comment-edit">
    <div class="calc">
        <div class="list font-14 padding-left-double padding-right-double">
            <div class="item-box item padding-top-double padding-bottom-double">
                <span class="color-light-font">选择分类</span>
                <div class="float-right">
                    <span class="select">买卖</span>
                    <i class="iconfont">&#xe601;</i>
                </div>
            </div>
        </div>
        <div class="gray-space"></div>
    </div>

    
<!--     <div class="editor padding-double">
        <input type="text" name="title" placeholder="请输入标题">
    </div> -->
    <div class="gray-space"></div>
    <div class="editor padding-double">
        <textarea name="content" placeholder="请输入内容"></textarea>
        <div class="imgs" style="width: 100%;height: auto;overflow: hidden;">
            <div class="imgbox" onclick="camera()">
                <i class="glyphicon glyphicon-picture"></i>
            </div>
        </div>
    </div>
    <div class="gray-space"></div>

    <div class="filebox" style="display: none"></div>

    <div class="gray-space"></div>

    <div class="editor padding-double">
        <input type="text" name="title" placeholder="请输入手机号">
    </div>
    <input type="hidden" name="cid" value="1">
    <div class="footer flex border-top">
        <div class="commit">
            发布
        </div>
    </div>
</div>
</form>
<div id="dialogContent"></div>
<a class="link-hope" style="display: none;" href="#hope"></a>
<div class="console">
    请输入您的帖子内容...
</div>

<div class="select-menu">

</div>
<div class="menu-list list text-center">
    <div class="item padding-double header">
        选择分类
    </div>
    <div class="container">
        <?php foreach ($data as $key => $value) { ?>
            <div cid="<?php echo $value['id'] ?>" class="item padding-double font-14">
                <?php echo $value['name'] ?>
            </div>
        <?php } ?>
    </div>
</div>

<script type='text/javascript' src='http://res.wx.qq.com/open/js/jweixin-1.2.0.js' charset='utf-8'></script>
<script>
    $(function () {
        $(document).on('click', '.imgclose', function() {
            $(this).parent().remove();
            var i = $(this).index();
            $('input[type=hidden]').eq(i).remove();
        });
    });
    //分类
    var json = '<?php echo json_encode($data);?>';
    var test_data = JSON.parse(json);

    wx.config(<?= json_encode($config) ?>);
    wx.ready(function () {});
    function camera() {
        wx.chooseImage({
            count: 9, // 默认9
            sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                var html = '';
                if(localIds.length>0){
                    $.each(localIds, function(key, value) {
                        html += '<div style="overflow: hidden;" class="imgbox"><img style="width: 100%;" src="'+value+'" alt=""><span class="glyphicon glyphicon-remove-circle imgclose"></span></div>';
                    });
                    uploadImg(localIds);
                }
                $('.imgs').append(html);
            }
        });
    }

    function uploadImg(localIds) {
        var localId = localIds.pop();
        wx.uploadImage({
            localId: localId, // 需要上传的图片的本地ID，由chooseImage接口获得
            isShowProgressTips: 1, // 默认为1，显示进度提示
            success: function (res) {
                var imgValue = '<input type="hidden" name="serverid[]" value="'+res.serverId+'">';
                $('.filebox').append(imgValue);
                if(localIds.length > 0){
                    uploadImg(localIds);
                }
            }
        });
    }

      wx.config(<?= json_encode($config) ?>);
    wx.ready(function(){
        //分享朋友圈
        wx.onMenuShareTimeline({
            title: '怀来便民网，免费发布各类信息招聘，买卖，拼车-无需手机验证', // 分享标题
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
            desc: '点击进入免费发布各类信息招聘，买卖，拼车..', // 分享描述
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