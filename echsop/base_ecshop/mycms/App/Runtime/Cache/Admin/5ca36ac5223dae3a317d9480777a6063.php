<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>编辑内容</title>


<!-- layout::Inc:edit_page::0 -->
<!-- layout::Inc:ueditor::0 -->

<script>
$(function(){
	$('#position_id').val("<?php echo $obj['position_id']; ?>");
});

//语言选择回调方法
function langCallBackFunction(lang) {
	//职位下拉改变
	$.getJSON("__APP__/Admin/Index/selectCategoryByPid",{"pid":"<?php echo getCategoryIdByAlias('Job/index'); ?>","lang":lang},function(json){
		$('#position_id').html('');
		$('#position_id').append('<option value="-1" selected>请选择</option>');
		$(json.list).each(function(i,obj){
			var str_tr = '<option value="'+obj.id+'">'+obj.title+'</option>';
			$('#position_id').append(str_tr);
		});
	});
}

//langCallBackFunction("<?php echo $_GET['lang'];?>");
</script>

</head>
<body>
<div class="nav-site"><?php getNavSite($nav_site,$_GET['cid']);?> > 编辑内容</div>
<form action="__APP__/Admin/<?php echo $actionName;?>/<?php echo $obj==null?'add':'update'; ?>" method="post" enctype="multipart/form-data" class="form">  
	<input type="hidden" id="id" name="id" value="<?php echo ($obj["id"]); ?>">
	<input type="hidden" name="category_id" value="<?php echo $_GET["cid"];?>">
	<input type="hidden" name="is_publish" value="1">
	<input type="hidden" name="hardware" value="<?php echo ($_SESSION['hardware']); ?>">
	<input type="hidden" name="lang" value="<?php echo $_GET["lang"];?>">
   <fieldset>
       <ul class="align-list">
       	<li>
               <label>当前分类</label>
               <?php getCurCategoryNav($_GET['cid']);?>
           </li>
           <li>
               <label>标题</label>
               <input type="text" id="title" name="title" value="<?php echo ($obj["title"]); ?>" class="type-text">
           </li>
           <li>
               <label>职位描述</label>
               <div name="content" id="content" style="margin-left:200px;margin-left: 140px;margin-top: -25px;margin-bottom: 10px;"></div>
               <script type="text/javascript">
				    var editor = new baidu.editor.ui.Editor();
				    editor.render("content");
				    editor.setContent('<?php echo (htmlspecialchars_decode($obj["content"])); ?>');
				</script>
				
           </li>
           <li>
           	 <label>部门</label>
             <input type="text" id="department" name="department" value="<?php echo ($obj["department"]); ?>" class="type-text">
           </li>
           <li>
           	 <label>学历</label>
             <input type="text" id="education" name="education" value="<?php echo ($obj["education"]); ?>" class="type-text">
           </li>
           <li>
           	 <label>薪水</label>
             <input type="text" id="salary" name="salary" value="<?php echo ($obj["salary"]); ?>" class="type-text">
           </li>
           <li>
               <label>工作地点</label>
               <textarea id="site" name="site" cols="100" rows="3"><?php echo ($obj["site"]); ?></textarea>
           </li>
           <li>
               <label>招聘人数</label>
               <input type="text" id="number" name="number" value="<?php echo ($obj["number"]); ?>" class="type-text">
           </li>
           <li>
               <label>职位要求</label>
               <input type="text" id="ask" name="ask" value="<?php echo ($obj["ask"]); ?>" class="type-text">
           </li>
           <li>
               <label>发布日期</label>
               <input type="text" id="begin_time" name="begin_time" onClick="WdatePicker()" value="<?php echo (!isset($obj['begin_time'])) ? date('Y-m-d') : date('Y-m-d', $obj['begin_time']);?>" class="type-text">
           </li>
           <li>
               <label>截止日期</label>
               <input type="text" id="end_time" name="end_time" onClick="WdatePicker()" value="<?php echo (!isset($obj['end_time'])) ? date('Y-m-d') : date('Y-m-d', $obj['end_time']);?>" class="type-text">
           </li>
           <li>
               <label>发布时间</label>
               <input type="text" id="create_time" name="create_time" onClick="WdatePicker()" value="<?php echo (!isset($obj['create_time'])) ? date('Y-m-d') : date('Y-m-d', $obj['create_time']);?>" class="type-text">
           </li>
		   <?php if( $_SESSION['hardware']=='pc' ) { ?>
            <li id="li_synch_mobile">
                <label>手机同步</label>
                <input type="checkbox" name="synch_mobile" id="synch_mobile" value="1"> <small class="fc-999"> --如果手机版对应栏目也有这个招聘，您还可以同步过去</small>
            </li>
			<li id="li_mobile_category">
                <label>手机分类</label>
                <select id="one_mobile_category_id" name="one_mobile_category_id" style="width:200px;" onchange="changeCategory(this,'two_mobile_category_id','mobile')">
                	<option value="-1" selected="">请选择手机分类</option>
					<?php selectCateoryOptions($_SESSION['c_root'], 'all');?>
                </select>
            </li>
			<script>$('#li_mobile_category').hide();</script>
            <?php } ?>
           <li>
               <label></label>
               <input type="submit" value="确定并保存" name="save" class="button button-green button-big" />
               <input type="button" value="返回列表" onclick="javascript:history.go(-1);" class="button button-big" />
            </li>
        </ul>
    </fieldset>
</form>

</body>
</html>