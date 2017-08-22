<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>签到</title>
    <link rel="stylesheet" href="/sign/css/bootstrap3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/sign/css/style.css">
    <link rel="stylesheet" href="/sign/css/qiandao_style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12 clearPadding">
            <div class=""><img src="/sign/images/qdBanner.jpg" class="img-responsive"></div>

            <div class="calendar">
                <div class="calenbox">
                    <div id="calendar"></div>
                </div>
                <div class="text-center">
                    <button class="btn btn-qiandao" onClick="signIn()">马上签到</button>
                </div>
            </div>
            <div class="padding10">
                <div class="font16 pb10 borderb"><strong>连续签到礼包</strong></div>
                <div class="libaolist">
                    <div class="clearfix borderb ptb10">
                        <div class="col-xs-9 clearPadding">
                            <div class="media">
                                <a class="media-left pt3" href="javascript:void(0);">
                                    <img src="/sign/images/dou.png" style="width:30px;height:30px;">
                                </a>
                                <div class="media-body">
                                    <div class="">5天礼包（50怀来豆）</div>
                                    <div class="text-muted font12">连续签到5天即可领取</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 clearPadding text-right pt2">
                            <button class="btn <?php echo ($integration['integration5'] == 0)? 'btn-lingqu' : 'btn-disable';?>" onClick="receive(5, this)">领取</button>
                        </div>
                    </div>
                    <div class="clearfix borderb ptb10">
                        <div class="col-xs-9 clearPadding">
                            <div class="media">
                                <a class="media-left pt3" href="javascript:void(0);">
                                    <img src="/sign/images/dou.png" style="width:30px;height:30px;">
                                </a>
                                <div class="media-body">
                                    <div class="">10天礼包（100怀来豆）</div>
                                    <div class="text-muted font12">连续签到10天即可领取</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 clearPadding text-right pt2">
                            <button class="btn <?php echo ($integration['integration10'] == 0)? 'btn-lingqu' : 'btn-disable';?>" onclick="receive(10, this)">领取</button>
                        </div>
                    </div>
                    <div class="clearfix borderb ptb10">
                        <div class="col-xs-9 clearPadding">
                            <div class="media">
                                <a class="media-left pt3" href="javascript:void(0);">
                                    <img src="/sign/images/dou.png" style="width:30px;height:30px;">
                                </a>
                                <div class="media-body">
                                    <div class="">15天礼包（150怀来豆）</div>
                                    <div class="text-muted font12">连续签到15天即可领取</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 clearPadding text-right pt2">
                            <button class="btn <?php echo ($integration['integration15'] == 0)? 'btn-lingqu' : 'btn-disable';?>" onclick="receive(15, this)">领取</button>
                        </div>
                    </div>
                    <div class="clearfix borderb ptb10">
                        <div class="col-xs-9 clearPadding">
                            <div class="media">
                                <a class="media-left pt3" href="javascript:void(0);">
                                    <img src="/sign/images/dou.png" style="width:30px;height:30px;">
                                </a>
                                <div class="media-body">
                                    <div class="">20天礼包（200怀来豆）</div>
                                    <div class="text-muted font12">连续签到20天即可领取</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 clearPadding text-right pt2">
                            <button class="btn <?php echo ($integration['integration20'] == 0)? 'btn-lingqu' : 'btn-disable';?>" onclick="receive(20, this)">领取</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="maskbox"></div>
<div class="qdbox">
    <div class="text-center text-green font18 message"><strong></strong></div>
    <div class="text-center pt10 count"></div>
    <div class="text-center ptb15"><img src="/sign/images/gift.png" style="width:125px;margin-left:20px;"></div>
<!--    <div class="text-center"><button class="btn btn-lottery"><a href="turnlate.html" target="_blank">去抽奖</a></button></div>-->
</div>
<script src="/sign/js/jquery-1.10.2.min.js"></script>
<script src="/sign/js/calendar.js"></script>
<script>
    function signIn(){
        $.ajax({
            type: 'GET',
            url: '/ajax/sign',
            dataType: 'json',
            success: function (info) {
                $(".maskbox").fadeIn();
                $(".qdbox").fadeIn();
                $(".maskbox").height($(document).height());
                $('.count').html('您本月已经连续签到&nbsp;<span class="text-green">'+info.count+'</span>&nbsp;天啦！');
                if(info.status == 2){
                    $('.message').html('已经签到了呦！');
                }else{
                    $('.message').html('签到成功,太棒啦！');
                    getSignDate();
                }
            }
        });
    }
    $(".maskbox").click(function(){
        $(".maskbox").fadeOut();
        $(".qdbox").fadeOut();
    });
    $(function(){
        //ajax获取日历json数据
        getSignDate();
    });

    function getSignDate(){
        $.ajax({
            type: 'GET',
            url: '/ajax/signdate',
            dataType: 'json',
            success: function (status) {
                calUtil.init(status);
            }
        });
    }

    //领取积分
    function receive(num, obj){
        if($(obj).hasClass('btn-disable')){
            return false;
        }
        $.ajax({
            type: 'post',
            data:{num:num},
            url: '/ajax/receive',
            dataType: 'json',
            success: function (info) {
               if(info.status == 1){
                   $(obj).removeClass('btn-lingqu').addClass('btn-disable');
                   alert('积分领取成功！')
               }else if(info.status == 2){
                   alert('您已领取过啦！')
               }else if(info.status == 3){
                   alert('签到天数不够呦！')
               }
            }
        });
    }
</script>
</body>
</html>
