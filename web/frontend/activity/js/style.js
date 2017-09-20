$(function() {
	window.setInterval(function() {
		var num = $(".tit-num").html();
		var bar_tit1 = $(".praise-n span").html();
		var bar_tit2 = $(".comment-n span").html();
		
		if(num == "") {
			$(".click-apply").css({
				"top": "18px"
			});
		} else {
			$(".click-apply").css({
				"top": "8px"
			});
		}
		
		if(bar_tit1 == "") {
			$(".praise-img").css({
				"padding": "15px 0 2px"
			});
		} else {
			$(".praise-img").css({
				"padding": "5px 0 2px"
			});
		};
		if(bar_tit2 == "") {
			$(".comment-img").css({
				"padding": "15px 0 2px"
			});
		} else {
			$(".comment-img").css({
				"padding": "5px 0 2px"
			});
		};
	}, 100);
	
	
		$(".i").click( function() {
			$("#modal-content").show().animate({bottom:'-1000px'},300);
			$("#alert").hide();
		})

		$(".r").click(function(){
			$("#modal-content").show().animate({bottom:'0px'},300);
			$("#alert").show();
		})
//		支付失败
		/*layer.open({
		    content: '<div class="error">支付失败</div>',
		    btn: ['<a href="" style="color:white">重新支付</a>', '<a href="" style="color:#333">刷新</a>'],
		    yes: function(index){
		      location.reload();
		      layer.close(index);
		    }
  		});*/
//		报名成功*/
		/*layer.open({
		    content: '<div class="error" style="color:#999999;text-align: left;">打开商会通，查看更多商会活动，结交100万商界精英</div>',
		    title:'<p style="line-height:none;position: fixed;top: 10px; width: 95%;text-align: center;">报名成功</p>',
		    btn: ['<a href="" style="color:white">打开商会通</a>', '<a href="#" style="color:#333">确定</a>'],
		    yes: function(index){
		      location.reload();
		      layer.close(index);
		    }
  		});	*/
	 
	
	
	
	
	$(".gou-apply").toggle( function () {
			$(this).css({"background": "url(./images/gou2.png) no-repeat center/100%"});
		}, function () {
		
			$(this).css({"background": "url(./images/gou.png) no-repeat center/100%"});
	});
	
//	点赞出现带色值图标
	$(".c").bind("click", function() {

		$(".icon_collect").css({
			'background': 'url(./images/ioc/dianzan.png) no-repeat center / 82%'
		});
	});
//	出现评论框
	$(".l").bind("click",function(){
		$("#send_comment").show();
	})
	//活动内容页展开报名
	$("#open ul .mld").bind("click", function() {

		$("#sign").css({
			'height': 'auto'
		});
	});
	$("#more").bind("click", function() {

		$("#modal").css({
			'height': 'auto'
		});
	});

	//内容页table切换
	var mo_ioc = $("#modal_ioc");
	$(".comments").bind("click", function() {
		$("#c_all").show().siblings().hide();

		mo_ioc.animate({
			right: '11%'
		}, 200);
	});
	$(".shares").bind("click", function() {
		$("#s_all").show().siblings().hide();

		mo_ioc.animate({
			right: '45%'
		}, 200);
	});
	$(".praises").bind("click", function() {
		$("#p_all").show().siblings().hide();

		mo_ioc.animate({
			right: '80%'
		}, 200);
	});

	//praise 点赞
	$(".praise").bind("click", function() {
		$(".praise li span").removeClass("praise_ioc");
		$(".praise li span").addClass("praise_ioco");
		$("#add").show().animate({
			bottom: "40px"
		}, 500).fadeOut(800);
		return false;

	});
	//comment 评论
	$(".comment").bind("click", function() {
		$("#send_comment").fadeIn();
		//		$("div").not("#send_comment").css({"opacity":"0.3","background":"red"})
	});
	//取消
	$(".off").bind("click", function() {
		$("#send_comment").fadeOut();
		$("body").css({
			"background": "none"
		});
	});

	//	<input type='file' id='file'/>
	//
	//<script>
	//  $(function(){
	//     $("#file").change(function(e){
	//           var file = e.target.files||e.dataTransfer.files;
	//           if(file){
	//               var reader = new FileReader();
	//               reader.onload=function(){
	//                      $("<img src='"+this.result+"'/>").appendTo("body");
	//
	//               }
	//
	//              reader.readAsDataURL(file);
	//          }
	//    });
	// })
	//
	// </script>

	//$(".all_p p").bind("click",function(){
	//	alert(1)
	//});

});