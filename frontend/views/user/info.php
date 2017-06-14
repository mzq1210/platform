<div class="content pull-to-refresh-content" data-ptr-distance="55" style="background: #fff;">
    <header class="bar bar-nav w-color">
        <a class="icon icon-left pull-left o-color back"></a>

        <h1 class="title">我的资料</h1>
    </header>
    <div class="content-block" style="background: #fff!important;height:800px;padding-top:40px">
        <div class="left-con">

            <div class="list-block" style="margin:0">
                <ul><a class="close-panel" style="color:#6d6d72">
                        <li class="item-content item-link item-l">

                            <div class="">
                                <div class="item-title my-info" style="float:left;margin-top:10px">头像</div>
                            </div>
                            <img class="left-user-1" src="<?php echo $UserInfo['headimgurl']?>" style="

                             -bottom:10px;margin-top:16px;margin-right:8px ;width: 80%;height: 40%">
                        </li>
                    </a>
                    <a   style="color:#6d6d72">
                        <li class="item-content item-link item-l">
                            <div class="item-media"><i class="icon icon-f7"></i></div>
                            <div class="item-inner">
                                <div class="item-title my-info">昵称</div>
                                <div style="font-size:16px;color:#999"><?php echo $UserInfo['name']?></div>
                            </div>
                            <div>

                            </div>
                        </li>
                    </a>
                    <a href="#"  style="color:#6d6d72">
                        <li class="item-content item-link item-l">
                            <div class="item-media"><i class="icon icon-f7"></i></div>
                            <div class="item-inner">
                                <div class="item-title my-info">姓名</div>
                                <div style="font-size:16px;color:#999">第六空白</div>
                            </div>
                        </li>
                    </a>
                    <a href="#"  style="color:#6d6d72">
                        <li class="item-content item-link item-l">
                            <div class="item-media"><i class="icon icon-f7"></i></div>
                            <div class="item-inner">
                                <div class="item-title my-info">手机</div>
                                <div style="font-size:16px;color:#999">1888888888</div>
                            </div>
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(function () {
        jQuery('.add-comment').remove();
    })
</script>