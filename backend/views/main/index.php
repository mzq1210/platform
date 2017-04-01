<?php

use yii\helpers\Url;
use common\models\sys\Icons;
use common\components\Tools;
?>
<script>
if(self.parent && self.parent!=self)self.parent.location.href=self.location.href;
</script>
<div class="topheader">
    <table border="0" width="100%">
        <tbody>
            <tr>
                <td height="50">
                    <table>
                        <tbody>
                            <tr>
                                <td style="padding:0px 10px;"><img src="/images/xh829.png" height="34" width="34"></td>
                                <td style="font-size:18px;padding-right:20px"><b>汇金行MPS系统</b></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="80%">
                    <div class="topmenubg">
                        <span menu="0" class="spanactive"><i class="glyphicon glyphicon-briefcase"></i> 个人信息</span>
                        <?php if (!empty($menuTree) && is_array($menuTree)): ?>
                            <?php foreach ($menuTree as $menu): ?>
                                <?php echo $menu['m']; ?>
                                <span id="moshou_<?php echo $menu['id'] ?>" menu="<?php echo $menu['id'] ?>"><i class="glyphicon <?php echo Icons::getIcon($menu['icons']) ?>"></i> <?php echo $menu['name'] ?></span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="topcenter" align="right">
    <span id="indexexit">&nbsp;<a href="/login/loginout"> <i style="color:#fff" class="glyphicon glyphicon-log-in"></i></a></span>
    <span id="indexuserl" status="0">
        <div class="rockmenu" style="display: none">
            <div class="rockmenuli">
                <ul>
                    <li id="editPassword" onclick="window.top.Dialog('', '修改密码', '<?php echo Url::toRoute('/sys/user/editpwd'); ?>', 480, 180)"><i class="glyphicon glyphicon-lock"></i> 修改密码</li>
                    <li style="border:none;"><i class="glyphicon glyphicon-user"></i> 帐号(<?php echo $username; ?>)</li>
                </ul>
            </div>
        </div>
        <img src="/images/1.jpg">你好，管理员&nbsp; <i class="caret caret-down"></i></span>
</div>
<div id="content" style="width: auto;">
    <div class="col-left left_menu left_menu_on">
        <!--------------左侧菜单-------------------->
        <div id="indexmenu">
            <div class="menutoptext">
                <ul>
                    <li class="li01">
                        <div id="menulisttop" style="font-size:16px;padding-left:10px">
                            <i class="glyphicon glyphicon-briefcase"></i> 个人信息
                        </div>
                    </li>
                    <li class="li02">
                        <div style="text-align:right;padding-right:10px">&nbsp;<i id="reordershla" data-clicknum='0' class="glyphicon glyphicon-list cursor" title="收起菜单"></i>
                        </div>
                    </li>
                </ul>
            </div>
            <div id="menulist">
                <div id="left_menu_0">
                    <div class="menuone" data-url="/main/detail" name="useredit">
                        <i class="glyphicon glyphicon-list-alt"></i> 个人资料
                    </div>
                </div>
                <?php if (!empty($menuTree) && is_array($menuTree)): ?>
                    <?php foreach ($menuTree as $leftMenu): ?>
                        <!--判断有没有子类-->
                        <?php if (!empty($leftMenu) && is_array($leftMenu)): ?>
                            <div id="left_menu_<?php echo $leftMenu['id']; ?>" style="display: none">
                                <?php if (!empty($leftMenu['child']) && is_array($leftMenu['child'])): ?>
                                    <?php foreach ($leftMenu['child'] as $childMenu): ?>
                                        <?php if (!empty($childMenu['child']) && is_array($childMenu['child'])): ?>
                                            <div class="menuone" disab="1" status="false">
                                                <i class="glyphicon <?php echo Icons::getIcon($childMenu['icons']) ?>"></i> <?php echo $childMenu['name'] ?>
                                                <span class="caret caret-downc"></span>
                                            </div>
                                        <?php endif; ?>
                                        <!--判断子类下面的子类-->
                                        <?php if (!empty($childMenu['child']) && is_array($childMenu['child'])): ?>
                                            <div class="menulist" style="display:none">
                                                <?php foreach ($childMenu['child'] as $grandson): ?>
                                                    <div class="menutwo" data-url="<?php echo Tools::createUrl($grandson['m'], $grandson['c'], $grandson['a'], $grandson['param']); ?>" name="<?php echo $grandson['m'] . $grandson['a'] . $grandson['c'] ?>"><i class="glyphicon <?php echo Icons::getIcon($grandson['icons']); ?>"></i> <?php echo $grandson['name']; ?></div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="menuone" data-url="<?php echo Tools::createUrl($childMenu['m'], $childMenu['c'], $childMenu['a'], $childMenu['param']); ?>" name="<?php echo $childMenu['m'] . $childMenu['c'] . $childMenu['a']; ?>">
                                                <i class="glyphicon <?php echo Icons::getIcon($childMenu['icons']) ?>"></i> <?php echo $childMenu['name']; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>            </div>
        <div id="openClose" style="display: none;" class="menulistbg cursor">
            <i class="glyphicon glyphicon-list"></i><br>展<br>开<br>菜<br>单
        </div>
    </div>
    <style>
        .jtcls{height:44px;line-height:44px;overflow:hidden;width:14px;text-align:center;position:absolute;z-index:8;top:50px; background-color:#e1e1e1;right:0px;font-size:12px;cursor:pointer;color:#888888;display:none;top:0px}
        .jtcls:hover{background-color:#e5e5e5;color:#000000}
    </style>
    <script>
        var isIE = true;
        if (!document.all)
            isIE = false;
        function _changesrcool(lx) {
            var l = $('#tabs_title').scrollLeft();
            var w = l + 200 * lx;
            $('#tabs_title').animate({scrollLeft: w});
        }
        function winHb() {
            var winH = (!isIE) ? window.innerHeight : document.documentElement.offsetHeight;
            return winH;
        }
        function winWb() {
            var winH = (!isIE) ? window.innerWidth : document.documentElement.offsetWidth;
            return winH;
        }
        function resizewh() {
            var _lw = $('#indexmenu').width();
            if (document.getElementById('indexmenu').style.display == 'none') {
                _lw = $('#openClose').width();
            }
            var w = winWb() - _lw - 5;
            var h = winHb();
            viewwidth = w;
            viewheight = h - 50 - 44;
            //$('#rightMain').css({width: '' + viewwidth + 'px', height: '' + (viewheight) + 'px'});
            $('.tabsindex').css({width: '' + viewwidth + 'px'});
            var nh = h - 50;
            //$('#indexmenu').css({height: '' + nh + 'px'});
            //$('#indexsplit').css({height: '' + nh + 'px'});
            $('#openClose').css({height: '' + nh + 'px'});
            _pdleftirng();
        }
        
        function _pdleftirng(){
	var mw=document.getElementById('tabs_title').scrollWidth;
	if(mw>viewwidth){$('.jtcls').show();}else{$('.jtcls').hide();}
}
    </script>
    <div class="col-auto" style="overflow:hidden;position:relative;">
        <div id="jtcls_right" class="jtcls" onclick="_changesrcool(-1)" style="left: 0px; display: block;"><</div> 
        <div class="jtcls" id="jtcls_left" onclick="_changesrcool(1)" style="display: block;float: right">&gt;</div>
        <div id="tabs_title" class="tabsindex">
            <div id="index" class="accive menu-list"><i class="glyphicon glyphicon-home"></i> <a href="javascript:_MP('/main/basics');"> 首页</a></div>
        </div>
        <div class="col-1" style="padding: 5px 5px 0px 5px">
            <?php
            if ($third_type == 'ask') {
                $url = '/ask/ask/index';
            } elseif ($third_type == 'sensitive') {
                $url = '/filter/keywords/index';
            } else {
                $url = '/main/basics';
            }
            ?>
            <iframe name="right" id="rightMain" src="<?php echo Url::toRoute($url); ?>" frameborder="false" scrolling="auto" style="border:none;margin-bottom: 0px" width="100%" height="auto" allowtransparency="true"></iframe>
        </div>
    </div>
</div>
<script type="text/javascript">
//左侧开关(展开情况下)
    $("#reordershla").click(function () {
        if ($(this).data('clicknum') === 1) {
//            $("html").removeClass("on");
//            $(".left_menu").addClass("left_menu_on");
//            $(this).data('clicknum', 0);
//            $("#indexmenu").show();
//            $("#openClose").hide();
        } else {
            $("html").addClass("on");
            $(".left_menu").removeClass("left_menu_on");
            $(this).data('clicknum', 1);
            $("#indexmenu").hide();
            resizewh();
            $("#openClose").show();

        }
        return false;
    });
//左侧开关(折叠情况下)
    $("#openClose").click(function () {
        if ($("#reordershla").data('clicknum') === 0) {
//            $("#reordershla").data('clicknum', 1);
//            $(".left_menu").addClass("left_menu_on");
//            $("#indexmenu").hide();
//            $("#openClose").show();
        } else {
            $("html").addClass("on");
            $("#reordershla").data('clicknum', 0);
            $(".left_menu").addClass("left_menu_on");
            $("#indexmenu").show();
            $("#openClose").hide();
            resizewh();
        }
        return false;
    });

    var getWindowSize = function () {
        return ["Height", "Width"].map(function (name) {
            return window["inner" + name] ||
                    document.compatMode === "CSS1Compat" && document.documentElement[ "client" + name ] || document.body[ "client" + name ]
        });
    }
    window.onload = function () {
        if (!+"\v1" && !document.querySelector) { // for IE6 IE7
            document.body.onresize = resize;
        } else {
            window.onresize = resize;
        }
        function resize() {
            resizewh();
            wSize();
            return false;
        }
    }
    function wSize() {
        //这是一字符串
        var str = getWindowSize();
        var strs = new Array(); //定义一数组
        strs = str.toString().split(","); //字符分割
        var heights = strs[0] - 150, Body = $('body');
        $('#rightMain').height(heights);
        if (strs[1] < 980) {
            $('#content').css('width', 980 + 'px');
            Body.attr('scroll', '');
        } else {
            $('#content').css('width', 'auto');
            Body.attr('scroll', 'no');
        }

        var openClose = $("#rightMain").height() + 39;
        $("#rightMain").css("height", openClose);
    }
    wSize();

    $(function () {
        //右上方折叠
        $('#indexuserl').click(function () {
            var status = $(this).attr('status');
            if (status == 0) {
                $(this).children('i').removeClass('caret-down').addClass('caret-up');
                $('.rockmenu').show();
                $(this).attr('status', 1);
            } else {
                $(this).children('i').removeClass('caret-up').addClass('caret-down');
                $('.rockmenu').hide();
                $(this).attr('status', 0);
            }
        });

        //左侧纵向折叠
        $('.menuone').click(function () {
            var status = $(this).attr('status');
            if (status == 'false') {
                $(this).children('span').removeClass('caret-downc').addClass('caret-upc');
                $(this).next('.menulist').show();
                $(this).attr('status', 'true');
            } else {
                $(this).children('span').removeClass('caret-upc').addClass('caret-downc');
                $(this).next('.menulist').hide();
                $(this).attr('status', 'false');
            }
        });

        //tab添加
        $('.menuone, .menutwo').click(function () {
            if ($(this).attr('disab') != 1) {
                var targetUrl = $(this).attr('data-url');
                $("#rightMain").attr('src', targetUrl);
                var title = $(this).attr('name');
                //页面模块切换
                $('.' + title).show().siblings().hide();
                //TAB状态切换
                $('#' + title).addClass('accive').siblings().removeClass('accive');
                //TAB如果已存在则不添加
                if (typeof (title) != 'undefined' && $('#' + title).size() > 0)
                    return;
                $('#tabs_title .accive').removeClass('accive');
                var html = '<div id="' + title + '" data-url="' + targetUrl + '" class="accive menu-list">' + $(this).html() + '<span class="glyphicon glyphicon-remove"></span></div>';
                $('#tabs_title').append(html);
            }
        });
        //tab关闭
        $('.tabsindex').on('click', '.glyphicon-remove', function () {
            $(this).parent().remove();
            if ($('.accive').size() == 0) {
                var num = $('.tabsindex .menu-list').size();
                //最后一个添加状态
                $('.tabsindex .menu-list').eq(num - 1).addClass('accive');
                //页面模块切换
                var title = $('.tabsindex .menu-list').eq(num - 1).attr('id');
                var targetUrl = $('.tabsindex .menu-list').eq(num - 1).attr('data-url');
                if (typeof (targetUrl) != 'undefined') {
                    $("#rightMain").attr('src', targetUrl);
                } else {
                    $("#rightMain").attr('src', '/main/basics');
                }

                $('.' + title).show().siblings().hide();
            }
            //阻止冒泡事件
            return false;
        });
        //tab状态切换
        $('#tabs_title').on('click', '.menu-list', function () {

            $(this).addClass('accive').siblings().removeClass('accive');
            var title = $(this).attr('id');
            //页面模块切换
            $('.' + title).show().siblings().hide();
            var targetUrl = $(this).attr('data-url');
            $("#rightMain").attr('src', targetUrl);
        });

        //新增点击头部一级菜单 显示作则
        $('.topmenubg span').click(function () {
            //设置菜单切换时 自动展示并初始化
            $("#reordershla").data('clicknum', 0);
            $(".left_menu").addClass("left_menu_on");
            $("#indexmenu").show();
            $("#openClose").hide();

            var menuId = $(this).attr('menu');
            $('#left_menu_' + menuId).show().siblings().hide();
            $(this).addClass("spanactive").siblings().removeClass("spanactive");
            var menulisttop = $(this).html();
            $('#menulisttop').html(menulisttop);
        });

    });

<?php if (!empty($third_type)): ?>
        $(function () {
            $('#moshou_9').trigger('click', function () {})
        });
<?php endif; ?>

    function _MP(targetUrl) {
        $("#rightMain").attr('src', targetUrl);
    }
</script>

