$(function(){
//	短文
		//praise 点赞
	$(".praise").bind("click",function(){
		$(".praise li span").removeClass("praise_ioc");
		$(".praise li span").addClass("praise_ioco");
		$("#add").show().animate({bottom:"40px"},500).fadeOut(800);
		return false;
		
	});
		//comment 评论
	$(".comment").bind("click",function(){
		$("#send_comment").fadeIn();
//		$("div").not("#send_comment").css({"opacity":"0.3","background":"red"})
	});
	//取消
	$(".off").bind("click",function(){
		$("#send_comment").fadeOut();
		$("body").css({"background":"none"});
	});

});
	


