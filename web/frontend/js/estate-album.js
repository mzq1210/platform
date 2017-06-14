$(function(){
    var menu_swiper = new Swiper('#menu_swiper',{
        watchSlidesProgress : true,
        watchSlidesVisibility : true,
        slidesPerView : 5,
        freeMode : true,
        freeModeSticky: true,
        speed:200,
        onTap: function(swiper){
            detail_album_swiper.slideTo( $(swiper.clickedSlide).attr('slide-index') )
        }
    })
    var detail_album_swiper = new Swiper ('#detail_album_swiper', {
        pagination : '.swiper-pagination',
        paginationType : 'fraction',
        onSlideChangeStart: function(){
            updateNavPosition();
        },
        // loop:true,
	})
    function updateNavPosition(){
        console.log(detail_album_swiper.activeIndex)
        for(var i = 0; i<menu_swiper.slides.length; i++){
            if($(menu_swiper.slides[i]).attr('slide-index') <= detail_album_swiper.activeIndex){
                $('#menu_swiper .active-menu').removeClass('active-menu');
                $(menu_swiper.slides[i]).addClass("active-menu");
            }
        }
    }

})