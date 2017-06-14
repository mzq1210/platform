$(function(){
    $('.list').eq(0).show().siblings('.list').hide();
    var menu_swiper = new Swiper('#menu_swiper',{
        watchSlidesProgress : true,
        watchSlidesVisibility : true,
        slidesPerView : 3,
        onTap: function(swiper){
            // dynamic_swiper.slideTo( swiper.clickedIndex)
            itemIndex = swiper.clickedIndex;
            console.log(itemIndex);
            $('.list').eq(itemIndex).show().siblings('.list').hide();
            $("#menu_swiper .active-nav").removeClass("active-nav");
            $('#menu_swiper .swiper-slide').eq(swiper.clickedIndex).find("a").addClass('active-nav');
            // 如果选中菜单一
            if(itemIndex == '0'){
                // 如果数据没有加载完
                if(!tab1LoadEnd){
                    // 解锁
                    dropload.unlock();
                    dropload.noData(false);
                }else{
                    // 锁定
                    dropload.lock('down');
                    dropload.noData();
                }
            // 如果选中菜单二
            }else if(itemIndex == '1'){
                if(!tab2LoadEnd){
                    // 解锁
                    dropload.unlock();
                    dropload.noData(false);
                }else{
                    // 锁定
                    dropload.lock('down');
                    dropload.noData();
                }
            }else if(itemIndex == '2'){
                if(!tab3LoadEnd){
                    // 解锁
                    dropload.unlock();
                    dropload.noData(false);
                }else{
                    // 锁定
                    dropload.lock('down');
                    dropload.noData();
                }
            }
            // 重置
            dropload.resetload();
        }
    })
    // var dynamic_swiper = new Swiper('#dynamic_swiper',{
    //     onSlideChangeStart: function(){
	// 		updateNavPosition()
	// 	}
    // })
    function updateNavPosition(){
        $("#menu_swiper .active-nav").removeClass("active-nav")
        $('#menu_swiper .swiper-slide').eq(dynamic_swiper.activeIndex).find("a").addClass('active-nav');
    }
    // 页数
    var page = 0;
    // 每页展示10个
    var size = 10;

    var itemIndex = 0;
    var tab1LoadEnd = false;
    var tab2LoadEnd = false;
    var tab3LoadEnd = false;
    var counter = 0;
    // 每页展示4个
    var num = 4;
    var pageStart = 0,pageEnd = 0;
    var dropload = $('.container').dropload({
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
            domNoData  : '<div class="dropload-noData">暂无数据</div>'
        },
        loadUpFn : function(me){
            $.ajax({
                type: 'GET',
                url: 'http://ons.me/tools/dropload/json.php?page=0&size=10',
                dataType: 'json',
                success: function(data){
                    var result = '';
                    for(var i = 0; i < 10; i++){
                        result +=   '<div class="border-bottom padding-top-double">\
                                <div class="item item-thumbnail-left">\
                                    <img class="img" src="../img/pic_house.png" alt="">\
                                    <div class="margin-bottom">中港CCPAR在售均价1100元/平米左右主推户型主推户型主推户型主推户型</div>\
                                    <div class="font-12">2017-01-21  12:21 ｜我爱我家</div>\
                                </div>\
                            </div>';
                    }
                    // 为了测试，延迟1秒加载
                    setTimeout(function(){
                        $('.list').eq(itemIndex).html(result);
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
            // 加载菜单一的数据
            if(itemIndex == '0'){
                $.ajax({
                    type: 'GET',
                    url: 'http://ons.me/tools/dropload/json.php?page='+page+'&size='+size,
                    dataType: 'json',
                    success: function(data){
                        var result = '';
                        counter++;
                        pageEnd = num * counter;
                        pageStart = pageEnd - num;
                        for(var i = 0; i < 10; i++){
                            result +=   '<div class="border-bottom padding-top-double">\
                                    <div class="item item-thumbnail-left">\
                                        <img class="img" src="../img/pic_house.png" alt="">\
                                        <div class="margin-bottom">中港CCPAR在售均价1100元/平米左右主推户型主推户型主推户型主推户型</div>\
                                        <div class="font-12">2017-01-21  12:21 ｜我爱我家</div>\
                                    </div>\
                                </div>';
                        }
                        // 为了测试，延迟1秒加载
                        setTimeout(function(){
                            $('.list').eq(0).append(result);
                            // 每次数据加载完，必须重置
                            me.resetload();
                        },1000);
                    },
                    error: function(xhr, type){
                        alert('Ajax error!');
                        // 即使加载出错，也得重置
                        me.resetload();
                    }
                });
            // 加载菜单二的数据
            }else if(itemIndex == '1'){
                $.ajax({
                    type: 'GET',
                    url: 'http://ons.me/tools/dropload/json.php?page='+page+'&size='+size,
                    dataType: 'json',
                    success: function(data){
                        var result = '';
                        for(var i = 0; i < 10; i++){
                            result +=   '<div class="border-bottom padding-top-double">\
                                    <div class="item item-thumbnail-left">\
                                        <img class="img" src="../img/pic_house.png" alt="">\
                                        <div class="margin-bottom">中港CCPAR在售均价1100元/平米左右主推户型主推户型主推户型主推户型</div>\
                                        <div class="font-12">2017-01-21  12:21 ｜我爱我家</div>\
                                    </div>\
                                </div>';
                        }
                        // 为了测试，延迟1秒加载
                        setTimeout(function(){
                            $('.list').eq(1).append(result);
                            // 每次数据加载完，必须重置
                            me.resetload();
                        },1000);
                    },
                    error: function(xhr, type){
                        alert('Ajax error!');
                        // 即使加载出错，也得重置
                        me.resetload();
                    }
                });
            }else if(itemIndex == '2'){
                $.ajax({
                    type: 'GET',
                    url: 'http://ons.me/tools/dropload/json.php?page='+page+'&size='+size,
                    dataType: 'json',
                    success: function(data){
                        var result = '';
                        for(var i = 0; i < 10; i++){
                            result +=   '<div class="border-bottom padding-top-double">\
                                    <div class="item item-thumbnail-left">\
                                        <img class="img" src="../img/pic_house.png" alt="">\
                                        <div class="margin-bottom">中港CCPAR在售均价1100元/平米左右主推户型主推户型主推户型主推户型</div>\
                                        <div class="font-12">2017-01-21  12:21 ｜我爱我家</div>\
                                    </div>\
                                </div>';
                        }
                        // 为了测试，延迟1秒加载
                        setTimeout(function(){
                            $('.list').eq(2).append(result);
                            // 每次数据加载完，必须重置
                            me.resetload();
                        },1000);
                    },
                    error: function(xhr, type){
                        alert('Ajax error!');
                        // 即使加载出错，也得重置
                        me.resetload();
                    }
                });
            }
        }
    });
})
