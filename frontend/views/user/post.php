<div class="content pull-to-refresh-content" data-ptr-distance="55" style="background: #fff;">
    <!-- 标题栏 -->
    <header class="bar bar-nav w-color">
        <a class="icon icon-left pull-left o-color back"></a>
        <h1 class="title o-color">我的帖子</h1>
    </header>
    <!-- 工具栏 -->
    <!-- 这里是页面内容区 -->
    <div class="content infinite-scroll  infinite-scroll-bottom  " style="background-color:#fff;">

        <div class="list-container">
            <div id="test_1" class="card facebook-card" style="padding-left:10px">
                <div class="card-header no-border">
                    <div style="float:right">
                        <a href="#" class="create-actions">
                            <span class="icon icon-remove " style="color:#f97711;font-size:20px;"></span>
                        </a>
                        <a href="#" class="open-about">
                            <span class="icon icon-share" style="padding-left:20px;color:#f97711;font-size:20px;"></span>
                        </a>
                    </div>
                    <div class="facebook-avatar"><img src="./images/user.png" width="44" height="44"></div>
                    <div class="facebook-name">李女士</div>
                    <div class="facebook-date">一天前&nbsp&nbsp&nbsp&nbsp&nbsp来自
                        <span style="color:#f97711">健康养生话题</span>
                    </div>
                </div>
                <div class="text-c">测试2测试2测试2测试2测试测试测试测试测试测试测试测试测试测试测</div>
                <div class="card-content">
                    <img class="img-c" src="http://gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i3/TB10LfcHFXXXXXKXpXXXXXXXXXX_!!0-item_pic.jpg_250x250q60.jpg">
                    <img class="img-c" src="http://gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i3/TB10LfcHFXXXXXKXpXXXXXXXXXX_!!0-item_pic.jpg_250x250q60.jpg">
                    <img class="img-c" src="http://gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i3/TB10LfcHFXXXXXKXpXXXXXXXXXX_!!0-item_pic.jpg_250x250q60.jpg">
                </div>
                <div class="card-footer no-border" style="    width: 220px;padding-left:5px;background-color:#fff">
                    <div class="foot-c"><a href="#"><i class="fa fa-eye icon-c"></i>231</a></div>
                    <div class="foot-c"><a href="#"><i class="fa fa-thumbs-o-up icon-c"></i>231</a></div>
                    <div class="foot-c"><a href="#"><i class="fa fa-comment-o icon-c"></i>231</a></div>
                </div>
            </div>
        </div>
        <div class="infinite-scroll-preloader">
            <div class="preloader"></div>
        </div>
    </div>
</div>
<div class="popup popup-about">
    <div class="content-block">
        <img style="width:100%" src="./images/share2.jpg">
        <p style="text-align:center"><a href="#" class="close-popup">关闭</a></p>

    </div>
</div>

<script type="text/javascript">
    $.init();
    $(document).on('click', '.open-about', function () {
        $.popup('.popup-about');
    });
    $(document).on('click', '.create-actions', function () {
        var buttons1 = [{
            text: '确定删除',
            label: true
        }, {
            text: '确定',
            bold: true,
            color: 'danger',
            onClick: function () {

            }
        },

        ];
        var buttons2 = [{
            text: '取消',
            bg: 'danger'
        }];
        var groups = [buttons1, buttons2];
        $.actions(groups);
    });
</script>
