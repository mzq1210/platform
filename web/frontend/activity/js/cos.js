$(function(){
	$(document).ready(function() {
		//内容页table切换
		var mo_ioc = $("#modal_ioc");
		$(".comments").bind("click", function() {
			$("#c_all").show().siblings().hide();
			mo_ioc.animate({
				right: '8%'
			}, 200);
		});
		$(".shares").bind("click", function() {
			$("#s_all").show().siblings().hide();
			mo_ioc.animate({
				right: '42%'
			}, 200);
		});
		$(".praises").bind("click", function() {
			$("#p_all").show().siblings().hide();
			mo_ioc.animate({
				right: '76%'
			}, 200);
		});
		if ($(window).width() <= 435) {
			$(".comments").bind("click", function() {
				$("#c_all").show().siblings().hide();
				mo_ioc.animate({
					right: '11%'
				}, 100);
			});
			$(".shares").bind("click", function() {
				$("#s_all").show().siblings().hide();
				mo_ioc.animate({
					right: '44%'
				}, 100);
			});
			$(".praises").bind("click", function() {
				$("#p_all").show().siblings().hide();
				mo_ioc.animate({
					right: '80%'
				}, 100);
			});
		}
	});
})