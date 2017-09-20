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
                data:{page:0, size:10, uid:uid},
                url: '/ajax/index',
                dataType: 'json',
                success: function (data) {
                    if (data.length > 0) {
                        var result = createList(data);
                    } else{
                        me.lock();me.noData();
                    }
                    setTimeout(function () {
                        $('.article-list').html(result);
                        $(".biaoti").dotdotdot();//省略号
                        $(".neirong").dotdotdot();//省略号
                        me.resetload();
                    }, 600);
                },
                error: function (xhr, type) {
                    me.resetload();
                }
            });
        },
        loadDownFn: function (me) {
            page++;
            // 拼接HTML
            $.ajax({
                type: 'GET',
                data:{page:page,size:size,uid:uid},
                url: '/ajax/index',
                dataType: 'json',
                success: function (data) {
                    var arrLen = data.length; var result = '';
                    if (arrLen > 0) {
                        for (var i = 0; i < arrLen; i++) {
                            var picHtml = '';
                            if(data[i].pic != ''){
                                var pics = data[i].pics;
                                for (var j = 0; j < pics.length; j++) {
                                    if(j<3){
                                        picHtml += '<div class="imgbox"><img style="width: 122px;height: 122px;" class="img-rounded" src="'+pics[j]+'"></div>';
                                    }
                                }
                            }
                            result += '<a href="/release/look?id='+data[i].id+'">\
                                <div class="item-box">\
                                    <div class="font-12" style="color: #A1A2A4;padding: 8px 0;">'+data[i].ctime+
                                '<div class="float-right top-tip" style="margin-top: 4px;">'+data[i].cname+'</div>'+
                                '</div>'+
                                '<div class="item item-thumbnail-left" style="border: none;">'+
                                '<div class="border-box">\
                                    <div class="item-title font-16 biaoti" style="line-height:25px;max-height: 50px;">'+data[i].content+'</div>'+
                                '</div>'+picHtml+
                                '</div>\
                                <div class="info-block font-16">\
                                    <div><i class="glyphicon glyphicon-eye-open look font-14"></i><span class="num">'+data[i].look+'</span></div>\
                                        <div><i class="glyphicon glyphicon-comment coments font-14"></i><span class="num">'+data[i].coments+'</span></div>\
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
                        $(".biaoti").dotdotdot();//省略号
                        $(".neirong").dotdotdot();//省略号
                        // 每次数据插入，必须重置
                        me.resetload();
                    }, 600);
                },
                error: function (xhr, type) {
                    me.resetload();
                }
            });
        },
        threshold: 50
    });
};

function createList(data) {
    var html = '';
    for(var i = 0; i < data.length; i++) {
        var picHtml = '';
        if(data[i].pic != ''){
            var pics = data[i].pics;
            for (var j = 0; j < pics.length; j++) {
                if(j<3){
                    picHtml += '<div class="imgbox"><img style="width: 122px;height: 122px;" class="img-rounded" src="'+pics[j]+'"></div>';
                }
            }
        }
        html += '<a href="/release/look?id='+data[i].id+'">\
            <div class="item-box">\
                <div class="font-12" style="color: #A1A2A4;padding: 8px 0;">'+data[i].ctime+
            '<div class="float-right top-tip" style="margin-top: 4px;">'+data[i].cname+'</div>'+
            '</div>'+
            '<div class="item item-thumbnail-left" style="border: none;">'+
            '<div class="border-box">\
                <div class="item-title font-16 biaoti" style="line-height:25px;max-height: 50px;">'+data[i].content+'</div>'+
            '</div>'+picHtml+
            '</div>\
            <div class="info-block font-16">\
                <div><i class="glyphicon glyphicon-eye-open look font-14"></i><span class="num">'+data[i].look+'</span></div>\
                    <div><i class="glyphicon glyphicon-comment coments font-14"></i><span class="num">'+data[i].coments+'</span></div>\
                </div>\
            </div>\
        </a>';
    }
    return html;
}