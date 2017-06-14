$(function(){
    var itemIndex = 0;
    var menu_swiper = new Swiper('#menu_swiper',{
        watchSlidesProgress : true,
        watchSlidesVisibility : true,
        slidesPerView : 4,
        onTap: function(swiper){
            itemIndex = swiper.clickedIndex;
            console.log(itemIndex);
            $('.list').eq(itemIndex).show().siblings('.list').hide();
            $("#menu_swiper .active-nav").removeClass("active-nav");
            $('#menu_swiper .swiper-slide').eq(swiper.clickedIndex).find("a").addClass('active-nav');
        }
    })
    function updateNavPosition(){
        $("#menu_swiper .active-nav").removeClass("active-nav")
        $('#menu_swiper .swiper-slide').eq(dynamic_swiper.activeIndex).find("a").addClass('active-nav');
    }
    $($(".container .list")[0]).siblings().css("display",'none');
})