<script src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
	var sessionid="<?php echo "$sessid";?>";
	var signature="<?php echo "$signature";?>";
	var timestamp="<?php echo "$timestamp";?>";
	var passport_url = "<?php echo PASSPORT_URL;?>";
	jQuery(document).ready(function(){
		$.ajax({
			url: passport_url + "/login/urljson",
			dataType:"jsonp",
			jsonp: "callback",
			success:function(data){
				$.each(data, function(i, value) {
					var sessurl=value+"/sso/index?sessid="+sessionid+"&signature="+signature+"&timestamp="+timestamp;
					$.ajax({
						url:sessurl,
						dataType:"jsonp",
						jsonp:"callback",
						success:function(data){
							//alert(data);
						},
						error:function(){
						}
					});
				});
				setTimeout('redirect()',100);
			},
			error:function(){
				window.location.href=passport_url;
			}
		});
	});
	function redirect() {
		location.href = passport_url + "/login/jump?referer=<?=$referer?>";
	}
</script>