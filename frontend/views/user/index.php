<?php
use yii\helpers\Url;
?>
<link rel="stylesheet" href="/css/information.css">
<link rel="stylesheet" href="/css/user.min.css">
<link rel="stylesheet" href="/fonts/iconfont.css">


<div id="information">
    <div class="information-wrapper">
        <div class="info">
            <div class="icon_img text-center">
                <img src="<?php echo $UserInfo['headimgurl']?>" class="head-icon " alt="">
            </div>
            <div class="message">
                <div class="name"><?php echo $UserInfo['name']?></div>
                <?php if($UserInfo['phone'] != ''){?>
                    <div class="phone"><?php echo $UserInfo['phone']?></div>
                <?php }else{?>
                    <div class="phone">请绑定手机号</div>
                <?php }?>

            </div>
        </div>
        <div class="set">
            <a href="<?php echo Url::toRoute(['/user/topic']); ?>" >
                <div class="col-xs-12">
                    <div class="set-icon">
                        <i class="icon iconfont icon-icon01"></i>
                    </div>
                    <div class="set-content">
                        我的帖子
                    </div>
                    <i class="icon iconfont icon-jiantou1"></i>
                </div>
            </a>
            <a href="javascript:void(0)" >
                <div class="col-xs-12">
                    <div class="set-icon">
                        <i class="icon iconfont icon-yonghu"></i>
                    </div>
                    <div class="set-content">
                        我的怀来豆
                    </div>
                    <span style="line-height: 23px;color: #0aa3e9;"><?= $UserInfo['integration']?></span>
                </div>
            <div class="both"></div>
            </a>
        </div>
    </div>
</div>
















































<!--<div class="content">-->
<!--    <header class="bar bar-nav w-color" style="color: #0894ec">-->
<!--        <a class="icon icon-left pull-left  back" style="color: #0894ec"></a>-->
<!--        <h1 class="title ">个人中心</h1>-->
<!--    </header>-->
<!--    <div class="content-block">-->
<!--        <div>-->
<!--            <div class="left-head-1" style="padding-top:40px">-->
<!--                <img class="left-user-1" src="--><?php //echo $UserInfo['headimgurl']?><!--">-->
<!--                <div style="margin-left:0px;color:#fff;font-size:15px;margin-top:10px">--><?php //echo $UserInfo['name']?><!--</div>-->
<!--            </div>-->
<!--            <img style="width:100%" src="/images/left-head-all.png">-->
<!--        </div>-->
<!--        <div class="left-con">-->
<!--<!--            <div style="position:relative">-->-->
<!--<!--                <div style="width:80%;">这个人很懒，连签名也没有...</div>-->-->
<!--<!--                <div style="position:absolute;top:0;right:10px;border:1px solid #999;width:80px;text-align:center;border-radius:4px;border-color:#ff6800">修改签名</div>-->-->
<!--<!--            </div>-->-->
<!---->
<!--            <div class="list-block">-->
<!--                <ul>-->
<!--                    <a class="close-panel" href="--><?php //echo Url::toRoute(['/user/info']); ?><!--" style="color:#6d6d72">-->
<!--                        <li class="item-content item-link item-l">-->
<!--                            <div class="item-media"><i class="icon icon-f7"></i></div>-->
<!--                            <div class="item-inner">-->
<!--                                <div class="item-title"><img class="dot-left" src="/images/left-user-dot.png">我的资料</div>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                    </a>-->
<!--<!--                    <a   style="color:#6d6d72">-->-->
<!--<!--                        <li class="item-content item-link item-l">-->-->
<!--<!--                            <div class="item-media"><i class="icon icon-f7"></i></div>-->-->
<!--<!--                            <div class="item-inner">-->-->
<!--<!--                                <div class="item-title"><img class="dot-left" src="/images/left-user-dot.png">我的消息</div>-->-->
<!--<!--                            </div>-->-->
<!--<!--                        </li>-->-->
<!--<!--                    </a>-->-->
<!--                    <a href="--><?php //echo Url::toRoute(['/user/topic']); ?><!--"  style="color:#6d6d72">-->
<!--                        <li class="item-content item-link item-l">-->
<!--                            <div class="item-media"><i class="icon icon-f7"></i></div>-->
<!--                            <div class="item-inner">-->
<!--                                <div class="item-title"><img class="dot-left" src="/images/left-user-dot.png">我的帖子</div>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                    </a>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!---->
<!--<nav class="bar bar-tab" >-->
<!--    <a class="tab-item external " href="--><?php //echo Url::toRoute(['/index/index']);?><!--">-->
<!--        <span class="icon icon-home"></span>-->
<!--        <span class="tab-label">首页</span>-->
<!--    </a>-->
<!--    <a class="tab-item external " href="--><?php //echo Url::toRoute(['/category/index']);?><!--">-->
<!--        <span class="icon icon-app"></span>-->
<!--        <span class="tab-label">分类</span>-->
<!--    </a>-->
<!--    <a class="tab-item external active" href="--><?php //echo Url::toRoute(['/user/index']);?><!--">-->
<!--        <span class="icon icon-me"></span>-->
<!--        <span class="tab-label">我的</span>-->
<!--    </a>-->
<!--</nav>-->
<!--<script>-->
<!--    jQuery(function () {-->
<!--        jQuery('.add-comment').remove();-->
<!--    })-->
<!--</script>-->

