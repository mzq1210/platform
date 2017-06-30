// index.js
window.onload = function () {
     new Swiper('#lunbo', {
        // 轮播图的方向，也可以是vertical方向
        direction: 'horizontal',
        //播放速度
        loop: true,
        // 自动播放时间
        autoplay: 1000,
        // 播放的速度
        speed: 2000,
        // 如果需要分页器，即下面的小圆点
        pagination: '.swiper-pagination',
        // 这样，即使我们滑动之后， 定时器也不会被清除
        autoplayDisableOnInteraction: false
    });
    
    // 页数
    var page = 0;
    // 每页展示10个
    var size = 10;

    // dropload
    var dropload = $('.content').dropload({
        scrollArea: window,
        domUp: {
            domClass: 'dropload-up',
            domRefresh: '<div class="dropload-refresh">更新更多</div>',
            domUpdate: '<div class="dropload-update">更新更多</div>',
            domLoad: '<div class="dropload-load"><span class="loading"></span>更新中...</div>'
        },
        domDown: {
            domClass: 'dropload-down',
            domRefresh: '<div class="dropload-refresh">加载更多</div>',
            domLoad: '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
            domNoData: '<div class="dropload-noData">到底了</div>'
        },
        loadUpFn: function (me) {
            $.ajax({
                type: 'GET',
                data:{page:1,size:10},
                url: '/index/index',
                dataType: 'json',
                success: function (data) {
                    var result = '';
                    for (var i = 0; i < 10; i++) {
                        result += '<a href="/release/look?id=">\
						<div class="item-box">\
							<div class="font-12" style="color: #A1A2A4;padding: 8px 0;">\
								<img class="img-circle" src="" style="width: 35px;height: 35px;">&nbsp;\
								uname<span>2017-2-5</span>\
								<div class="float-right top-tip" style="margin-top: 4px;">置顶</div>\
							</div>\
							<div class="item item-thumbnail-left" style="border: none;">\
								<span class="imgnum"><span class="glyphicon glyphicon-picture"></span>&nbsp;</span>\
								<img width="100%" src="" alt="">\
								<div class="border-box">\
									<div class="item-title font-16">title</div> \
								</div>\
							</div>\
                            <div class="info-block font-12" style="margin-top: 10px;padding-right: 5px;">\
                                <span style="float: left;">发布于｜cname</span>\
                                <span class="glyphicon glyphicon-eye-open look"></span><span class="num">look</span>\
                                <span class="glyphicon glyphicon-heart-empty zan"></span><span class="num">zan</span>\
                                <span class="glyphicon glyphicon-comment coments"></span><span class="num">coments</span>\
                            </div>\
                        </div>\
                    </a>';
                    }
                    // 为了测试，延迟1秒加载
                    setTimeout(function () {
                        $('.article-list').html(result);
                        // 每次数据加载完，必须重置
                        me.resetload();
                        // 重置页数，重新获取loadDownFn的数据
                        page = 0;
                        // 解锁loadDownFn里锁定的情况
                        me.unlock();
                        me.noData(false);
                    }, 1000);
                },
                error: function (xhr, type) {
                    // 即使加载出错，也得重置
                    me.resetload();
                }
            });
        },
        loadDownFn: function (me) {
            page++;
            // 拼接HTML
            var result = '';
            $.ajax({
                type: 'GET',
                data:{page:page,size:size},
                url: '/index/index',
                dataType: 'json',
                success: function (data) {
                    var arrLen = data.length;
                    if (arrLen > 0) {
                        for (var i = 0; i < arrLen; i++) {
                            var picHtml = '';
                            if(data[i].pic != ''){
                                var pics = data[i].pic.split(",");
                                for (var j = 0; j < pics.length; j++) {
                                    picHtml += '<div class="imgbox"><img class="img-rounded" src="'+pics[j]+'_200x200.jpg"></div>';
                                }
                            }
                            result += '<a href="/release/look?id='+data[i].id+'">\
                            <div class="item-box">\
                                <div class="font-12" style="color: #A1A2A4;padding: 8px 0;">\
                                    <img class="img-circle" src="'+data[i].headimgurl+'" style="width: 35px;height: 35px;">&nbsp;'+
                                    data[i].uname+'<span>2017-2-5</span>\
                                </div>\
                                <div class="item item-thumbnail-left" style="border: none;">'+
                                    '<div class="border-box">\
                                        <div class="item-title font-16 biaoti">'+data[i].title+'</div>'+
                                    '</div>'+
                                    '<div class="border-box">\
                                        <div class="item-title font-14 neirong" style="max-height: 80px;">'+data[i].content+'</div>'+
                                    '</div>'+picHtml+
                                '</div>\
                                <div class="info-block font-12" style="margin-top: 10px;padding-right: 5px;">\
                                    <span style="float: left;">发布于｜'+data[i].cname+'</span>\
                                    <span class="glyphicon glyphicon-eye-open look"></span><span class="num">'+data[i].look+'</span>\
                                    <span class="glyphicon glyphicon-heart-empty zan"></span><span class="num">'+data[i].zan+'</span>\
                                    <span class="glyphicon glyphicon-comment coments"></span><span class="num">'+data[i].coments+'</span>\
                                </div>\
                            </div>\
                        </a>';
                        }
                    } else{
                        // 锁定
                        me.lock();
                        // 无数据
                        me.noData();
                    }
                    // 为了测试，延迟1秒加载
                    setTimeout(function () {
                        // 插入数据到页面，放到最后面
                        $('.article-list').append(result);
                        // 每次数据插入，必须重置
                        me.resetload();
                    }, 600);
                },
                error: function (xhr, type) {
                    // 即使加载出错，也得重置
                    me.resetload();
                }
            });
        },
        threshold: 50
    });
}