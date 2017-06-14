$(function(){
    $(".calc .item-box").click(function(){
        var content = $(this).find(".select").html().trim();
        var result = '';
        for(var i = 0;i<test_data.length;i++){
            var str = '<div class="item padding-double font-14" key="'+test_data[i].id+'">';
            if(content == test_data[i].name){
                str = '<div class="item padding-double font-14 active" key="'+test_data[i].id+'">';
            }
            result += str
                +test_data[i].name+
            '</div>';
        }
        $(".menu-list .container").html(result);

        $(".select-menu").css("display","block");
        $(".menu-list").css("bottom","0")
    });
    $(".select-menu").click(function(){
        $(".select-menu").css("display","none");
        $(".menu-list").css("bottom","-100%")
    });
    $(".menu-list .container").on('click','.item',function(){
        $(".select").html($(this).html());
        $(".select-menu").css("display","none");
        $(".menu-list").css("bottom","-100%")
        $("input[name=cid]").val($(this).attr('key'))
    })
});