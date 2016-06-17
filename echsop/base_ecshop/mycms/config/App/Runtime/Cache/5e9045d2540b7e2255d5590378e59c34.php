<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<script src="__PUBLIC__/js/jquery-1.7.1.min.js"></script>
<script src="__PUBLIC__/js/jquery.form.js"></script>
<script src="__PUBLIC__/js/base.js"></script>
<title>edit</title>
</head>
<body>
<h3>自定义栏目</h3>
 <input type="hidden" name="getLang" value="<?php echo ($obj["lang"]); ?>">
 <input type="hidden" name="getPid" value="<?php echo ($obj["pid"]); ?>">
<form id="category_form" action="__APP__/Category/<?php if(!empty($obj)): ?>undatePart<?php else: ?>savePart<?php endif; ?>" method="post" class="form">
    <input type="hidden" name="id" value="<?php echo ($obj["id"]); ?>">
    <fieldset>
        <ul class="align-list">
            <li style="height:30px;">
                <div id="msg_category" style="display:none;line-height:30px;text-align:center;height:30px;color:#fff;">
                </div>
            </li>
            <li>
                <label>上级分类</label>
                <select id="pid" name="pid" style="padding: 7px;">
                <?php echo ($categoryList); ?>
                </select>&nbsp;&nbsp;&nbsp;<a href="javascript:;" onClick="deletePart()" id="category_delete" class="delete">删除</a>
            </li>
            <!--<li id="goods_muitlphoto">
            <label>多图展示 <a href="#" class="issue" title="产品附加功能">?</a></label>
            <input type="checkbox" name="is_multiple images" />
            </li>-->
            <li>
            	<label>多语言选择</label>
				<?php if(is_array($langList)): $i = 0; $__LIST__ = $langList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="radio" name="lang" value="<?php echo ($vo["alias"]); ?>" lang="<?php echo ($vo["alias"]); ?>"> <?php echo ($vo["title"]); ?>&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
            </li>
            <li>
                <label>栏目标题</label>
                <input name="title" id="title" value="<?php echo ($obj["title"]); ?>" class="type-text">
            </li>
            <li>
            	<label>
                 Url<a href="#" class="issue" title="前台跳转的地址，连接到本网站_ _APP_ _/Index；外网:http://xxxx.com">?</a>
                 </label>
                <input name="url" id="url" class="type-text" value="<?php echo ($obj["url"]); ?>">  
            </li>
            <li>
            		 <label>
                                描述
                            </label>
                            <textarea id="description" name="description" cols="100" rows="3"><?php echo ($obj["description"]); ?></textarea>
            </li>
           
            <li>
                <li>
                        	<label>操作模块<a href="#" class="issue" title="填写页面操作模块">?</a></label>
                            <input name="nowModule" id="nowModule" class="type-text" value="<?php echo ($obj["nowModule"]); ?>">
                        </li>
            </li>
            <li>
            	<li>
            		<label>别名<a href="#" class="issue" title="读取下级分类">?</a></label>
                    <input name="alias" id="alias" class="type-text" value="<?php echo ($obj["alias"]); ?>">
                </li>
            </li>
            <li>
                <label>
                                排序<a href="#" class="issue" title="使用倒序排列">?</a>
                            </label>
                            <input name="orderNum" id="ordernum" class="type-text" style="width:100px" value="<?php if(!empty($obj["orderNum"])): ?><?php echo ($obj["orderNum"]); ?><?php else: ?>10<?php endif; ?>"><em>提示：数字最大排最前（关联到前后台排序）</em>
            </li>
            <li>
                 <label>
                                现在发布<a href="#" class="issue" title="在网站前台显示">?</a>
                            </label>
                            <input type="checkbox" id="is_publish" name="is_publish" value="1"  <?php if($obj['is_publish'] == 1) echo 'checked'; ?>>
            </li>
            <li>
                <label></label>
				<?php if(!empty($obj)): ?><input type="submit" value="修改栏目" class="button" id="update_button2" />
				<?php else: ?>
				<input type="submit" value="添加栏目" class="button button-green" id="add_button" /><?php endif; ?>
				<input type="reset" value="重置" class="button button-red"  />
            </li>
        </ul>
    </fieldset>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$("#category_form li input[name=lang]").change(function(){
			$lang = $(this).val();
			ajaxPart($lang);
		})
	})
	function ajaxPart(lang){
		$lang = lang;
		$("#pid option").remove();
			$.ajax({
				type:'POST',
				url:'__APP__/Category/pidList',
				data:{'lang' : $lang},
				success:function(data){
					$("#pid").append(data);
				}
			});
		
	}
	$(document).ready(function(){
		if($("input[name=id]").val() == ''){
			$("input[name=lang]:eq(0)").attr({'checked' : 'checked'});
			$("input[name=is_publish]").attr({'checked' : 'checked'});
		}else{
			if($("input[name=getLang]").val()){
				$getLang = $("input[name=getLang]").val();
				$getPid = $("input[name=getPid]").val();
				//alert($getLang);
				$("#pid option[value="+ $getPid +"]").attr("selected", true);
				$("input[lang="+ $getLang +"]").attr({'checked' : 'checked'});
			}
		}
	})
	//删除
	function deletePart(){
				$getid = $("input[name=id]").val();
				if(!$getid){
					alert('请选择要删除的内容');
				}
				else{
					if(confirm('确定要删除记录吗?')){
						$.ajax({
							type:'POST',
							url:'__APP__/Category/deletePart',
							data:{'id':$getid},
							success:function(data){
									if(data == 1){
										alert('删除成功');
										parent.goToMainFrame('__APP__/Category/part');
									}else{
										alert('删除失败');
									}
								}
							});
						}
						return false;
				}
			}
</script>
</body>
</html>