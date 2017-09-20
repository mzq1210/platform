$(function(){
    $('.comment-edit').on('click','.slide-warpper label',function(){
        var str = $(this)[0].className;
        var num = str.split(' ')[0].split("-")[1];
        $(this).parent().parent().siblings(".col").html(num/5+".0分");
        $(this).addClass("active").siblings().removeClass("active");
    });
    $('.comment-edit').on('click','.hope .col',function(){
        $(this).addClass("active").siblings().removeClass("active");
    });
    var switcher;
    $(".commit").click(function(){
        if($('input[name=title]').val().trim().length==0){
            clearTimeout(switcher);
            $(".console").html("请输入手机号！");
            $(".console").css("display","block");
            switcher = setTimeout(function(){
                $(".console").css("display","none")
            },2000);
            return false;
        }
        if($('textarea').val().trim().length==0){
            clearTimeout(switcher);
            $(".console").html("请输入内容！");
            $(".console").css("display","block");
            switcher = setTimeout(function(){
                $(".console").css("display","none")
            },2000);
            return false;
        }
        $('form').submit();
    });
    $('.comment-edit .radio').click(function () {
        $(this).siblings('.radio').removeClass('btn-success').addClass('btn-info');
        $(this).removeClass('btn-info').addClass('btn-success');
    })
})