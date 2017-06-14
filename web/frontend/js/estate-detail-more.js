$(function(){
    var content = $("#description").html().trim();
    console.log(content)
    if($("#description").html().length>40){
        packUp();
    }
    function packUp(){
        $("#description").html(content.substring(0,50)+"...<span id='read-more' class='color-info'>阅读更多</span>")
        $("#read-more").click(function(){
            $("#description").html(content+" <span id='packUp' class='color-info'>收起</span>");
            $("#packUp").click(function(){
                packUp()
            })
        })
    }
})