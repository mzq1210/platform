$(function(){
    $(".description").each(function(){
        var _self = $(this);
        var content = _self.html().trim();
        _self.attr("data",content)
        if(content.length>50){
            _self.html(_self.attr("data").substring(0,50)+"...<span class='color-info' onclick='readmore(this)'>阅读更多</span>")
        }
    })
    
    // 页数
    var page = 0;
    // 每页展示10个
    var size = 10;

    // dropload
    $('.list-content').dropload({
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
                        result +=   '<div>\
                    <div class="box">\
                        <div class="grid font-15">\
                            <div class="grid-33 text-left">2016-11-22</div>\
                            <div class="grid-33 text-center">任郁南</div>\
                            <div class="grid-33 text-center">\
                                <div class="row">\
                                    <div class="col text-right">\
                                        <i class="iconfont inline-block margin-right font-17">&#xe67f;</i><span class="inline-block margin-right" style="color:#e5e7ec">|</span><img class="inline-block" width="17" src="../img/daikan-icon-message@3x.png" alt="">\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="msg padding">\
                            <div class="margin-bottom">\
                                <span class="font-14">138****5232</span>\
                                <div class="float-right" style="margin-top:4px;">\
                                    <div class="font-12">\
                                        <span class="color-light-font">带看评分</span>\
                                        <span class="score-main">\
                                            <img src="../img/redheart.png" alt="">\
                                            <img src="../img/redheart.png" alt="">\
                                            <img src="../img/redheart.png" alt="">\
                                            <img src="../img/halfheart.png" alt="">\
                                            <img src="../img/grayheart.png" alt="">\
                                        </span>\
                                        &nbsp;\
                                        <span class="color-number">\
                                            7.0分\
                                        </span>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="description font-14">\
                                很耐心的带我看了很多我意向的房源，每次都是随到最后选到了理想的房子，感谢！\
                            </div>\
                        </div>\
                    </div>\
                    <div class="gray-space"></div>\
                </div>';
                    }
                    // 为了测试，延迟1秒加载
                    setTimeout(function(){
                        $('.list-content .content').html(result);
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
                            result +=   '<div>\
                    <div class="box">\
                        <div class="grid font-15">\
                            <div class="grid-33 text-left">2016-11-22</div>\
                            <div class="grid-33 text-center">任郁南</div>\
                            <div class="grid-33 text-center">\
                                <div class="row">\
                                    <div class="col text-right">\
                                        <i class="iconfont inline-block margin-right font-17">&#xe67f;</i><span class="inline-block margin-right" style="color:#e5e7ec">|</span><img class="inline-block" width="17" src="../img/daikan-icon-message@3x.png" alt="">\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="msg padding">\
                            <div class="margin-bottom">\
                                <span class="font-14">138****5232</span>\
                                <div class="float-right" style="margin-top:4px;">\
                                    <div class="font-12">\
                                        <span class="color-light-font">带看评分</span>\
                                        <span class="score-main">\
                                            <img src="../img/redheart.png" alt="">\
                                            <img src="../img/redheart.png" alt="">\
                                            <img src="../img/redheart.png" alt="">\
                                            <img src="../img/halfheart.png" alt="">\
                                            <img src="../img/grayheart.png" alt="">\
                                        </span>\
                                        &nbsp;\
                                        <span class="color-number">\
                                            7.0分\
                                        </span>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="description font-14">\
                                很耐心的带我看了很多我意向的房源，每次都是随到最后选到了理想的房子，感谢！\
                            </div>\
                        </div>\
                    </div>\
                    <div class="gray-space"></div>\
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
                        $('.list-content .content').append(result);
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
function readmore(el){
    var _parent = $(el).parent()
    _parent.html(_parent.attr("data")+" <span class='color-info' onclick='packUp(this)'>收起</span>")
}
function packUp(el){
    var _parent = $(el).parent()
    _parent.html(_parent.html().trim().substring(0,50)+"...<span class='color-info' onclick='readmore(this)'>阅读更多</span>")
}