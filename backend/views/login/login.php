<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>汇金行MPS系统</title>
		<script src="/js/jquery-1.9.1.min.js"></script>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/css/webmain.css">
	<style>
	.lmaisft{
		width:450px;border-radius:5px;
		text-align:left;
		background-color:#C4E0F4;
		background: rgba(255,255,255,0.3);
	}
	</style>

</head>
<body style="background:#66A8E5 url(/images/loginbg.jpg) top center no-repeat">
<div id="topheih" class="blank40" style="height: 141.5px;"></div>
<div align="center">

	<div class="blank30"></div>
	<div class="lmaisft">

		<form style="padding:20px;padding-left:80px" name="myform" action="/login/login" method="post">
			<!--<div style="font-size:20px">系统登录</div>-->
			<div class="blank10"></div>
			<div>
				<div><input type="text" style="height:40px;width:300px" class="input" value=""  placeholder="请输入用户名" name="info[adminuser]" ></div>
			</div>

			<div class="blank30"></div>
			<div>
				<div><input  style="height:40px;width:300px" class="input"  name="info[adminpass]" id="adminpasss" type="password" placeholder="请输入密码"></div>
			</div>
			<div class="blank30"></div>
			<div>
				<div>
					<input  style="height:40px;width:200px" class="input"  name="info[verifyCode]" id="adminpasss"  placeholder="请输入验证码">
					<img id="show_verify" src="<?php echo Url::toRoute('login/verify');?>" style="cursor:pointer" title="看不清,换一张" />
				</div>
			</div>

			<div class="blank10"></div>
			<!--<div align="left">
				 <div class="checkbox"><label><input type="checkbox" checked name="rempass">记住密码</label>&nbsp; &nbsp;</div>
			</div>-->
			<div class="blank10"></div>
			<div align="left">
				<button type="submit" class="btn btn-success" name="button"><i class="glyphicon glyphicon-hand-up"></i> 登录</button>&nbsp;<span id="msgview"></span>
			</div>
		</form>

	</div>

	<div class="blank20"></div>
	<div align="center" style="height:30px;line-height:30px;color:#555555">
		Copyright &copy;2016 S系统 &nbsp; - &nbsp;
		技术支持：PHP团队
	</div>

</div>
<script type="text/javascript">

	$(function(){
		$('#show_verify').click(function(){
			var _this = $(this);
				var dt = new Date().getTime();
				_this.attr({src : '<?php echo Url::toRoute('login/verify')?>?t='+dt});
		})
	})

</script>

</body>
</html>
