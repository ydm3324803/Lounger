<?php if (!defined('THINK_PATH')) exit();?><script src="__ROOT__/Public/js/base.js"></script>
<!-- Redactor is here -->
<script src="__ROOT__/Public/redactor/redactor.js"></script>
<script type="text/javascript">
	$(document).ready(
		function()
		{
			$('#content').redactor();
		}
	);
</script>
<link rel="stylesheet" href="__ROOT__/Public/redactor/redactor.css" />
<style>
	#content{
		background:#F9F9F9;
		border:1px solid #AAAAAA;
		border-radius:9.6px;
		padding:1em;
		margin: 0.5em 0;
		box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2) inset;
		outline-color:#333333;
	}
	#content img{
		max-width:80%;
	}
	#content *{
		white-space:pre-wrap;
	}
	#goodsImage{
		max-width:80%;
	}
</style>