<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<!-- layout::Inc:jq_mobile::0 -->
<!-- layout::Inc:ueditor::0 -->
<!-- layout::Inc:common_js::0 -->
</head>
<body>
<div data-role="page">
	<!-- layout::Inc:edit_head::0 -->
     <div data-role="content">
	<form method="post" id="formEdit">
    <input type="hidden" name="id" value="<?php echo ($obj["id"]); ?>">
	<input type="hidden" name="category_id" value="<?php echo ($obj["cid"]); ?>">
	<input type="hidden" name="hardware" value="<?php echo ($_SESSION['hardware']); ?>">
	<input type="hidden" name="lang" value="<?php echo ($_SESSION['lang']); ?>">
    <input type="hidden" name="lang" value="<?php echo ($_SESSION['lang']); ?>">
    <input type="hidden" name="dbName" value="Category">
    <fieldset>
       <ul data-role="listview" data-divider-theme="c" data-inset="true">
        	<li data-role="list-divider" role="heading">
               <label>当前位置：</label>
               修改分类 > <?php echo ($obj["title"]); ?>
           </li>
            <li>
                <label>分类标题</label>
                <input type="text" id="title" name="title" value="<?php echo ($obj["title"]); ?>" class="type-text">
            </li> 
            <li>
                <label>描述</label>
                <input type="text" id="description" name="description" value="<?php echo ($obj["description"]); ?>" class="type-text">
            </li>   
            <fieldset data-role="controlgroup">
            <input type="checkbox" name="is_publish" id="is_publish" class="custom" value="1" <?php if(($obj["is_publish"])  ==  "1"): ?>checked<?php endif; ?>  />
            <label for="is_publish">是否发布</label>
         </fieldset>        
        </ul>
           <div data-role="navbar" data-iconpos="top" id="submitDiv">
         <ul>
            <li id="submitButton">
        <a data-role="button" href="javascript:void(0)"  id="submint"  data-theme="a">保存</a>
         </li>
            <li id="resetButton">
        <input  value="重置" type="reset" data-theme="c" />
            </li>
            </ul>
        </div>
    </fieldset>
</form>
</div>
<!-- layout::Inc:edit_footer::0 -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#submint").click(function(){
			var params = $('input').serialize(); //序列化表单的值  
			$.ajax({
				type:'POST',
				url:'__APP__/Index/sortUpdate',
				data:params,
				beforeSend:$.mobile.showPageLoadingMsg('a','正在提交....'),
				success:ajaxTips,
				complete:$.mobile.hidePageLoadingMsg()
				})
		})
	})
</script>
</div>
</body>
</html>