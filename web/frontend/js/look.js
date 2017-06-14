// index.js
window.onload = function () {
    // 页数
    var page = 0;
    // 每页展示10个
    var size = 10;

    // dropload
    var dropload = $('.comment-list').dropload({
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

        },
        loadDownFn: function (me) {
            page++;
            // 拼接HTML
            var result = '';
            var cid = $('#cid').val();
            $.ajax({
                type: 'get',
                data:{cid:cid, page:page, size:size},
                url: '/release/look',
                dataType: 'json',
                success: function (data) {
                    var arrLen = data.length;
                    if (arrLen > 0) {
                        for (var i = 0; i < arrLen; i++) {
                            result += '<div class="padding-double border-bottom">\
                                <div class="item item-ava">\
                                <img src="'+data[i].headimgurl+'" alt="">\
                                <div class="padding-left"><div>\
                                <span class="font-14">\
                            '+data[i].uname+'</span>\
                            <div class="float-right color-light-font font-12 line-20">\
                            '+data[i].ctime+'\
                        </div></div><div>\
                            <span class="color-light-font font-12" style="color: #00b3ee;">\
                            '+(i+1)+'楼\
                            </span></div><div class="text font-14" data-switch="true">\
                           '+data[i].comment+
                            '</div></div></div></div>';
                        }
                    }else{
                        // 锁定
                        me.lock();
                        // 无数据
                        me.noData();
                    }
                    // 为了测试，延迟1秒加载
                    setTimeout(function () {
                        // 插入数据到页面，放到最后面
                        $('.list').append(result);
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