<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>编辑分类</title>

<link rel="stylesheet" type="text/css" href="__ADMIN__/Public/css/base.css" />
<script src="__ADMIN__/Public/js/jquery-1.7.1.min.js"></script>
<script src="__ADMIN__/Public/js/base.js"></script>

<script>
$(function(){
	$("input[name=lang][value=<?php echo $obj['lang']; ?>]").attr("checked", true).siblings().attr('disabled',true);
	var pid = "<?php echo $_SESSION['c_root']; ?>";
	$('#synch_mobile').click(function(){
		if( $(this).is(':checked') ) {
			$('#one_mobile_category_id').html('');
			$('#li_mobile_category').show();
			/*var lang = $('input[name=lang]:checked').val();
			if(lang==''){
				lang = $('input[name=lang]').val();
			}*/
			$.getJSON("__APP__/Admin/Index/selectMobileCategoryByPid",{"pid":pid,"hwe":'mobile'},function(json){
				$('#one_mobile_category_id').append('<option value="mobile" selected>顶级分类</option>');
				if( json.list!=undefined ) {
					$(json.list).each(function(i,obj){
						var str_tr = '<option value="'+obj.id+'">'+obj.title+'</option>';
						$('#one_mobile_category_id').append(str_tr);
					});
				}
			});
		} else {
			$('#li_mobile_category').hide();
		}
	});
	
	//有封面文章使用
	$('#delete_image').click(function(){
		if( confirm('确定要删除图片吗？') ) {
			$.get('__APP__/Admin/Category/deleteImage',{'id':"<?php echo $obj['id'];?>"},function(bool){
				if( bool==1 ) {
					$('input[name=image]').val('');
					$('#span_image').css('display','none');
				}
			});
		}
	});
	
});

</script>

</head>
<body>

<div class="nav-site"><?php getNavSite($nav_site,2);?> &gt; 分类管理 &gt; 编辑分类</div>

<form action="__APP__/Admin/Category/save" method="post" enctype="multipart/form-data" class="form" id="categoryForm">
<input type="hidden" id="id" name="id" value="<?php echo ($obj["id"]); ?>">
<input type="hidden" name="pid" value="<?php echo empty($_GET['pid'])?$obj['pid']:$_GET['pid'];?>">
<input type="hidden" name="is_publish" value="1">
<input type="hidden" name="hardware" value="<?php echo ($_SESSION['hardware']); ?>">
<?php if(empty($obj['id'])): ?><input type="hidden" name="tpl_one" value="list"><?php endif; ?>
   <fieldset>
       <ul class="align-list">
			<li id="li_lang">
            <?php isLang();?>
			</li>
           <li>
               <label>分类名称</label>
               <input type="text" id="title" name="title" value="<?php echo ($obj["title"]); ?>" class="type-text">
           </li>
           <li>
       	 	   <label>描述</label>
       	 	   <textarea id="description" name="description" cols="100" rows="3"><?php echo ($obj["description"]); ?></textarea>
       	   </li>
       	   <!--li>
       	 	   <label>别名<a href="#" class="issue" title="提示：友好的URL定制,如News/company">?</a></label>
       	 	   <input name="alias" id="alias" class="type-text" style="width:300px" value="<?php echo ($obj["alias"]); ?>">
       	   </li-->
       	   <li>
               <label>封面图片</label>
               <?php if( !empty($obj['image']) ) { ?>
               <span id="span_image">
               	<input type="hidden" name="image" value="<?php echo ($obj["image"]); ?>">
			   <img alt="" align="middle" height="80" vspace="5" src="<?php echo __ROOT__.'/Public/images/category/'.$obj['image']; ?>">
           	   <a href="javascript:void(0)" id="delete_image">删除封面</a>&nbsp;&nbsp;&nbsp;&nbsp;
           	   </span>
           	   <?php } ?>
			    <input type="file" name="image">
           </li>
		   <?php if( $_SESSION['hardware']=='pc' ) { ?>
            <li id="li_synch_mobile">
                <label>手机同步</label>
                <input type="checkbox" name="synch_mobile" id="synch_mobile" value="1"> <small class="fc-999"> --如果手机版对应栏目也有这个分类，您还可以同步过去</small>
            </li>
			<li id="li_mobile_category">
                <label>手机分类</label>
                <select id="one_mobile_category_id" name="one_mobile_category_id" style="width:200px;" onchange="changeCategory(this,'two_mobile_category_id','mobile')">
                	
                </select>
            </li>
			<script>$('#li_mobile_category').hide();</script>
            <?php } ?>
           <li>
               <label></label>
           </li>
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