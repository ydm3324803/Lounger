<?php if (!defined('THINK_PATH')) exit();?>	<div data-role="header" data-position="fixed" data-theme="a">
	<a href="javascript:history.go(-1)" data-icon="arrow-l" data-iconpos="left"  data-transition="pop">返回上一步</a>
    <h1><?php echo ($headTitle); ?></h1>
    <a href="__APP__/About/selectBlock" data-icon="arrow-r" data-iconpos="right" data-transition="pop" data-rel="dialog">选择语言</a>
    </div>
	<script type="text/javascript">
		function hideInfo(){
			$.mobile.hidePageLoadingMsg();
		}
		function showInfo(){
			$.mobile.loadingMessageTextVisible = true;
			$.mobile.showPageLoadingMsg('a','<?php echo $tips; ?>',true);
		}
		$(document).ready(function(){
			
			setTimeout(showInfo,0);
			setTimeout(hideInfo,3000);
		});
		/*
		pageInit(function({
			　$('body').bind('scrollstart', function(event) {
				setTimeout(showInfo,0)
　			  });
		});*/
    </script>