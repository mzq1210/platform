$(function(){
    // 页数
    var page = 0;
    // 每页展示10个
    var size = 10;

    // dropload
    $('.list').dropload({
        scrollArea : window,
        domUp : {
            domClass   : 'dropload-up',
            domRefresh : '<div class="dropload-refresh">更新更多</div>',
            domUpdate  : '<div class="dropload-update">更新更多</div>',
            domLoad    : '<div class="dropload-load"><span class="loading"></span>更新中...</div>'
        },
        domDown : {
            domClass   : 'dropload-down',
            domRefresh : '<div class="dropload-refresh">加载更多</div>',
            domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
            domNoData  : '<div class="dropload-noData">到底了</div>'
        },
        loadUpFn : function(me){
            $.ajax({
                type: 'GET',
                url: 'http://ons.me/tools/dropload/json.php?page=0&size=10',
                dataType: 'json',
                success: function(data){
                    var result = '';
                    for(var i = 0; i < 10; i++){
                        result +=   '<div class="item-box padding-double border-bottom">\
                <div class="item item-thumbnail-left" style="border: none">\
                    <div class="img">\
                        <div class="discount text-ellipsis">\
                            交500抵1000万11111\
                        </div>\
                        <div class="shade text-ellipsis">普通住宅 公寓 别墅</div>\
                        <img width="100%" src="../img/houselistPicHouse@2x.png" alt="">\
                    </div>\
                    <div class="padding-left border-box">\
                        <div class="item-title font-16">\
                            山水文园五期\
                            <div class="float-right top-tip">置顶</div> \
                        </div>\
                        <div class="item-subTitle font-12 text-ellipsis">昌平 · 东五环七棵树路口向东230米</div>\
                        <div class="item-keywords font-12 text-ellipsis">\
                            <span class="keywords-tag" >普通住宅</span>\
                            <span class="keywords-tag">高新区</span>\
                            <span class="keywords-tag">近地铁</span>\
                            <span class="keywords-tag">LOFTER</span>\
                        </div>\
                        <div class="item-price"><span class="font-14">9200元／平</span> <span class="font-12">80-120㎡</span></div>\
                    </div>\
                </div>\
                <div class="text-center info-block text-center font-12">\
                    关注87人｜看房45次｜评价16条\
                </div>\
            </div>';
                    }
                    // 为了测试，延迟1秒加载
                    setTimeout(function(){
                        $('.list-wapper').html(result);
                        // 每次数据加载完，必须重置
                        me.resetload();
                        // 重置页数，重新获取loadDownFn的数据
                        page = 0;
                        // 解锁loadDownFn里锁定的情况
                        me.unlock();
                        me.noData(false);
                    },1000);
                },
                error: function(xhr, type){
                    alert('Ajax error!');
                    // 即使加载出错，也得重置
                    me.resetload();
                }
            });
        },
        loadDownFn : function(me){
            page++;
            // 拼接HTML
            var result = '';
            $.ajax({
                type: 'GET',
                url: 'http://ons.me/tools/dropload/json.php?page='+page+'&size='+size,
                dataType: 'json',
                success: function(data){
                    var arrLen = data.length;
                    if(arrLen > 0){
                        for(var i=0; i<arrLen; i++){
                            result +=   '<div class="item-box padding-double border-bottom">\
                <div class="item item-thumbnail-left" style="border: none">\
                    <div class="img">\
                        <div class="discount text-ellipsis">\
                            交500抵1000万11111\
                        </div>\
                        <div class="shade text-ellipsis">普通住宅 公寓 别墅</div>\
                        <img width="100%" src="../img/houselistPicHouse@2x.png" alt="">\
                    </div>\
                    <div class="padding-left border-box">\
                        <div class="item-title font-16">\
                            山水文园五期\
                            <div class="float-right top-tip">置顶</div> \
                        </div>\
                        <div class="item-subTitle font-12 text-ellipsis">昌平 · 东五环七棵树路口向东230米</div>\
                        <div class="item-keywords font-12 text-ellipsis">\
                            <span class="keywords-tag" >普通住宅</span>\
                            <span class="keywords-tag">高新区</span>\
                            <span class="keywords-tag">近地铁</span>\
                            <span class="keywords-tag">LOFTER</span>\
                        </div>\
                        <div class="item-price"><span class="font-14">9200元／平</span> <span class="font-12">80-120㎡</span></div>\
                    </div>\
                </div>\
                <div class="text-center info-block text-center font-12">\
                    关注87人｜看房45次｜评价16条\
                </div>\
            </div>';
                        }
                    // 如果没有数据
                    }else{
                        // 锁定
                        me.lock();
                        // 无数据
                        me.noData();
                    }
                    // 为了测试，延迟1秒加载
                    setTimeout(function(){
                        // 插入数据到页面，放到最后面
                        $('.list-wapper').append(result);
                        // 每次数据插入，必须重置
                        me.resetload();
                    },1000);
                },
                error: function(xhr, type){
                    alert('Ajax error!');
                    // 即使加载出错，也得重置
                    me.resetload();
                }
            });
        },
        threshold : 50
    });
})