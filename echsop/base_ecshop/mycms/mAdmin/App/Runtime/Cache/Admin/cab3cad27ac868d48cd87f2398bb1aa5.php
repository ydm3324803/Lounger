<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!-- layout::Inc:jq_mobile::0 -->
<script>
function fleshVerify(type){ 
	//重载验证码
	var timenow = new Date().getTime();
	if (type){
		document.getElementById('verifyImg').src= '__APP__/Admin/Public/verify/adv/1/'+timenow;
	}else{
		document.getElementById('verifyImg').src= '__APP__/Admin/Public/verify/'+timenow;
	}
}
function onLoginSubmit() {
	var form = document.login_form;
	if (form.username.value=="")
	{
		alert("提示：用户名不能为空!");
		form.username.focus();
		return false;
	}
	if (form.password.value=="")
	{
		alert("提示：密码不能为空!");
		form.password.focus();
		return false;
	}	
	form.submit();
}
</script>

</head>
<body>
<div data-role="page"> 
	<!-- layout::Inc:index_head::0 -->
　 	<div data-role="content">
        <form method="post" name="login_form" id="login_form" action="__APP__/Admin/Public/checkLogin">
                  <label for="name">用户名：</label>
                <input name="username" id="username" value="" type="text"  />
               
                  <label for="name">密&nbsp;&nbsp;码：</label>
                <input name="password" id="password" value="" type="password"  />
             	<a href="javascript:void(0)" onclick="onLoginSubmit()" data-role="button" data-theme="a">登录</a>
             
        </form>
	</div> 
　 	<!-- layout::Inc:index_footer::0 -->
</div>
</body>
</html>