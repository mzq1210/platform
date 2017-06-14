$(function(){
    function init(){
        $(".text").each(function(){
            var _self = $(this);
            if(_self.attr("data-switch")=="true"){
                var content = _self.html().trim();
                _self.attr("data",content);
                _self.attr("data-switch",'false');
                if(content.length>50){
                    _self.html(_self.attr("data").substring(0,50)+"...<span class='color-info' onclick='readmore(this)'>阅读更多</span>")
                }
            }
            
        })
    }
    init();
    // 页数
    var page = 0;
    // 每页展示10个
    var size = 10;

    // dropload
    $('.content').dropload({
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
                        result +=   '<div class="padding-double border-bottom">\
                        <div class="item item-ava">\
                            <img src="../img/pic_head.png" alt="">\
                            <div class="padding-left">\
                                <div>\
                                    <span class="font-14">\
                                        132****3901\
                                    </span>\
                                    <span class="tag tag-disable">\
                                        暂不考虑\
                                    </span>\
                                    <div class="float-right color-light-font font-12 line-20">\
                                        2017-02-28\
                                    </div>\
                                </div>\
                                <div>\
                                    <span class="color-light-font font-12">评分指数</span>\
                                    <span class="score">\
                                        <img src="../img/redheart.png" alt="">\
                                        <img src="../img/redheart.png" alt="">\
                                        <img src="../img/redheart.png" alt="">\
                                        <img src="../img/halfheart.png" alt="">\
                                        <img src="../img/grayheart.png" alt="">\
                                    </span>\
                                    &nbsp;\
                                    <span class="color-number font-12">\
                                        7.0分\
                                    </span>\
                                </div>\
                                <div class="text font-14" data-switch="true" data="很耐心的带我看了很多我意向的房源，每次都是随叫随到，最后选到了理想的房子，感谢！很耐心的带我看了很多我意向的房源，每次都是随叫随到，最后选到了理想的房子，感谢！很耐心的带我看了很多我意向的房源，每次都是随叫随到，最后选到了理想的房子，感谢！">\
                                    很耐心的带我看了很多我意向的房源，每次都是随叫随到，最后选到了理想的房子，感谢！很耐心的带我看了很多我意向的房源，每次都是随叫随到，最后选到了理想的房子，感谢！很耐心的带我看了很多我意向的房源，每次都是随叫随到，最后选到了理想的房子，感谢！\
                                </div>\
                            </div>\
                        </div>\
                    </div>';
                    }
                    // 为了测试，延迟1秒加载
                    setTimeout(function(){
                        $('.list').html(result);
                        // 每次数据加载完，必须重置
                        me.resetload();
                        // 重置页数，重新获取loadDownFn的数据
                        page = 0;
                        init();
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
                            result +=   '<div class="padding-double border-bottom">\
                        <div class="item item-ava">\
                            <img src="../img/pic_head.png" alt="">\
                            <div class="padding-left">\
                                <div>\
                                    <span class="font-14">\
                                        132****3901\
                                    </span>\
                                    <span class="tag tag-disable">\
                                        暂不考虑\
                                    </span>\
                                    <div class="float-right color-light-font font-12 line-20">\
                                        2017-02-28\
                                    </div>\
                                </div>\
                                <div>\
                                    <span class="color-light-font font-12">评分指数</span>\
                                    <span class="score">\
                                        <img src="../img/redheart.png" alt="">\
                                        <img src="../img/redheart.png" alt="">\
                                        <img src="../img/redheart.png" alt="">\
                                        <img src="../img/halfheart.png" alt="">\
                                        <img src="../img/grayheart.png" alt="">\
                                    </span>\
                                    &nbsp;\
                                    <span class="color-number font-12">\
                                        7.0分\
                                    </span>\
                                </div>\
                                <div class="text font-14" data-switch="true" data="很耐心的带我看了很多我意向的房源，每次都是随叫随到，最后选到了理想的房子，感谢！很耐心的带我看了很多我意向的房源，每次都是随叫随到，最后选到了理想的房子，感谢！很耐心的带我看了很多我意向的房源，每次都是随叫随到，最后选到了理想的房子，感谢！">\
                                    很耐心的带我看了很多我意向的房源，每次都是随叫随到，最后选到了理想的房子，感谢！很耐心的带我看了很多我意向的房源，每次都是随叫随到，最后选到了理想的房子，感谢！很耐心的带我看了很多我意向的房源，每次都是随叫随到，最后选到了理想的房子，感谢！\
                                </div>\
                            </div>\
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
                        $('.list').append(result);
                        init();
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
    changeScore(3,0);
    function changeScore(score,index){
        var dom = ''
        var maxScore = score;
        var length = 0;
        for(var i = 2; i < maxScore;i+=2){
            dom += ' <img src="../img/redheart.png" alt="">'
            length++;
        }      
        if(i-1 == maxScore){
            dom += ' <img src="../img/halfheart.png" alt="">'
        }
        for(var j = 1;j < 5-length;j++){
            dom += ' <img src="../img/grayheart.png" alt="">'
        }
        console.log(dom)
        $(".score-main").eq(index).html(dom);
    }
})

function readmore(el){
    var _parent = $(el).parent()
    _parent.html(_parent.attr("data")+" <span class='color-info' onclick='packUp(this)'>收起</span>")
}
function packUp(el){
    var _parent = $(el).parent()
    _parent.html(_parent.html().trim().substring(0,50)+"...<span class='color-info' onclick='readmore(this)'>阅读更多</span>")
}