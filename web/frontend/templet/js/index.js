// index.js
window.onload = function () {
    // 页数
    var page = 0;
    // 每页展示10个
    var size = 10;

    // dropload
    $('.content').dropload({
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
                data:{page:0, size:10},
                url: '/ajax/index',
                dataType: 'json',
                success: function (data) {
                    if (data.length > 0) {
                        var result = createList(data);
                    } else{
                        me.lock();me.noData();
                    }
                    setTimeout(function () {
                        $('.am-list').html(result);
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
                data:{page:page,size:size},
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
                                        picHtml += '<li><div class="am-gallery-item">\
                                            <a href="###" class="">\
                                                <img src="'+pics[j]+'"  alt="某天 也许会相遇 相遇在这个好地方"/>\
                                            </a></div></li>';
                                    }
                                }
                            }
                            result += '<li class="am-g am-list-item-desced pet_list_one_block">\
                                <div class="pet_list_one_info">\
                                    <div class="pet_list_one_info_l">\
                                        <div class="pet_list_one_info_ico"><img src="'+data[i].headimgurl+'" alt=""></div>\
                                        <div class="pet_list_one_info_name">'+data[i].uname+'</div>\
                                    </div>\
                                    <div class="pet_list_one_info_r">\
                                        <div class="pet_list_tag pet_list_tag_stj">'+data[i].cname+'</div>\
                                    </div>\
                                </div>\
                                <div class=" am-list-main">\
                                    <h3 class="am-list-item-hd pet_list_one_bt"><a href="###" class="">'+data[i].content+'</a></h3>\
                                    <ul data-am-widget="gallery" class="am-gallery am-avg-sm-3 am-avg-md-3 am-avg-lg-3 am-gallery-default pet_list_one_list" >'+picHtml+
                                '</ul><div class="am-list-item-text pet_list_two_text"></div></div></li>';
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
                        $('.am-list').append(result);
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
                    picHtml += '<li><div class="am-gallery-item">\
                <a href="###" class="">\
                    <img src="'+pics[j]+'"  alt="某天 也许会相遇 相遇在这个好地方"/>\
                </a></div></li>';
                }
            }
        }
        html += '<li class="am-g am-list-item-desced pet_list_one_block">\
            <div class="pet_list_one_info">\
                <div class="pet_list_one_info_l">\
                    <div class="pet_list_one_info_ico"><img src="'+data[i].headimgurl+'" alt=""></div>\
                    <div class="pet_list_one_info_name">'+data[i].uname+'</div>\
                </div>\
                <div class="pet_list_one_info_r">\
                    <div class="pet_list_tag pet_list_tag_stj">'+data[i].cname+'</div>\
                </div>\
            </div>\
            <div class=" am-list-main">\
                <h3 class="am-list-item-hd pet_list_one_bt"><a href="###" class="">'+data[i].content+'</a></h3>\
                <ul data-am-widget="gallery" class="am-gallery am-avg-sm-3 am-avg-md-3 am-avg-lg-3 am-gallery-default pet_list_one_list" >'+picHtml+
            '</ul><div class="am-list-item-text pet_list_two_text"></div></div></li>';
    }
    return html;
}


