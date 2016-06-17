<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>下载编辑</title>

<!-- layout::Inc:edit_page::0 -->

<link href="__ADMIN__/Public/css/swfupload.css" rel="stylesheet" type="text/css" />
<link href="__ADMIN__/Public/css/idtabs.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__ADMIN__/Public/js/swfupload/swfupload.js"></script>
<script type="text/javascript" src="__ADMIN__/Public/js/swfupload/handlers.js"></script>
<script type="text/javascript" src="__ADMIN__/Public/js/swfupload/fileprogress.js"></script>

<script>

var swfu;
window.onload = function () {
    swfu = new SWFUpload({
        // Backend Settings
        upload_url: "__APP__/Admin/Download/upload/",
        post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},

        // File Upload Settings
        file_size_limit : "20 MB",	// 10MB
        file_types : "*.*",
        file_types_description : "AllFiles",
        file_upload_limit : "0",
        file_queue_limit: "1",
        
        // Event Handler Settings - these functions as defined in Handlers.js
        //  The handlers are not part of SWFUpload but are part of my website and control how
        //  my website reacts to the SWFUpload events.
        file_queued_handler : fileQueued,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess,
        upload_complete_handler : uploadComplete,

        // Button Settings
        button_image_url : "",
        button_placeholder_id : "spanButtonPlaceholder",
        button_width: 62,
        button_height: 22,
        button_text : '<span >浏览...</span>',
        button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12px;width:30px; }',
        button_text_top_padding: 0,
        button_text_left_padding: 18,
        button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_cursor: SWFUpload.CURSOR.HAND,

        // Flash Settings
        flash_url : "__ADMIN__/Public/js/swfupload/swfupload.swf",

        custom_settings : {
            progressTarget : "fsUploadProgress",
            cancelButtonId : "btnCancel"
        },

        // Debug Settings
        debug: false
    });
};

function uploadSuccess(file, serverData) {

   try {
		var arry = new Array();
		arry = serverData.split(":");
		
		if(arry[1]=='error'){
			alert(arry[2]);
		}else{	
			 
	   		$("#downfile").val(arry[2]);
	   		$('#size').val(file.size);
		}
	} catch (ex) {
       this.debug(ex);
   }
}
</script>

</head>
<body>
<div class="nav-site"><?php getNavSite($nav_site,$_GET['cid']);?> > 编辑内容</div>
<form action="__APP__/Admin/Download/<?php echo $obj==null?'add':'update'; ?>" method="post" enctype="multipart/form-data" class="form">  
<input type="hidden" name="id" value="<?php echo ($obj["id"]); ?>">
<input type="hidden" name="my_id" value="<?php echo ($obj["my_id"]); ?>">
<?php if( !isMultilingual($custom) ) { ?>
<input type="hidden" name="lang" value="<?php echo ($obj["lang"]); ?>">
<?php } ?>
<?php if( $_GET['lang']=='mobile' ) { ?>
<input type="hidden" name="lang" value="<?php echo $_GET["lang"];?>">
<?php } ?>
   <fieldset>
       <ul class="align-list align_list_li">
       		<?php if( isShowMobile($custom) ) { ?>
            <li>
                <label>
                    选择设备
                </label><input type="radio" value="<?php echo $lang; ?>" name="mode" checked="checked">&nbsp;电脑版&nbsp;&nbsp;&nbsp; <input type="radio" value="mobile" name="mode">&nbsp;移动版
            </li>
            <?php } ?>
			<?php if( $_GET['lang']!='mobile' ) { ?>
			<li id="li_lang" style="display:none;">
            <?php isLang();?>
			</li>
			<?php } ?>
			   <label>当前分类</label>
               <?php getCurCategoryNav($_GET['cid']);?>
           <li>
               <label>标题</label>
               <input type="text" id="title" name="title" value="<?php echo ($obj["title"]); ?>" class="type-text">
           </li>
           
           <li >
               <label style="float:left;">上传文件</label>               
                <div class="fieldset flash" id="fsUploadProgress" style="float:left;">
                <span class="legend">上传队列</span>                           
                </div>                			
           </li>
           <li>
               <label style="float:left;"></label>
               <input type="text" id="downfile" name="downfile" value="<?php echo ($obj["downfile"]); ?>"  size="40" style="float:left;">
               <span style="border: solid 1px #7FAAFF; background-color: #C5D9FF;margin-left:20px;float:left;height:20px;">
                <span id="spanButtonPlaceholder" ></span>&nbsp; 
                                                          
                </span><input type="button" value="上传" class="btn_startupload" onClick="swfu.startUpload();" style="float:left;"/>   
           </li>
           <li>
               <label>文件大小</label>
              <span style="vertical-align:middle"> <input type="text" id="size" name="size" value="<?php echo ($obj["size"]); ?>"  size="40"></span>
           </li>
           <li>
               <label>封面</label>
               <?php if( !empty($obj['image']) ) { ?>
               <span id="span_image">
			   <img alt="" align="middle" height="80" vspace="5" src="<?php echo __PUBLIC__.'/images/Public/images/download/s_'.$obj['image']; ?>">
           	   <a href="javascript:void(0)" id="delete_image" style="color:red;text-decoration:underline;">删除封面</a>&nbsp;&nbsp;&nbsp;&nbsp;
           	   </span>
           	   <?php } ?>
			    <input type="file" name="image">
			    宽：<input name="imgwidth" value="300" style="width:50px;">&nbsp;&nbsp;
			    高：<input name="imgheight" value="300" style="width:50px;"> <span style="color:#999;">(缩略图显示尺寸)</span>
           </li>       
           <li>
               <label>标签</label>
               <input type="text" id="tag" name="tag" value="<?php echo ($obj["tag"]); ?>" class="type-text">
           </li>
		   <?php if( $_GET['lang']!='mobile' ) { ?>
			<?php if( isShowMobile($custom) ) { ?>
            <li id="li_synch_mobile">
                <label>
                    手机同步
                </label>
                <input type="checkbox" name="synch_mobile" id="synch_mobile" value="1">
            </li>
			<?php isCategory($mobileOneCategoryList,$mobileTwoCategoryList,$mobileThreeCategoryList,'手机分类','mobile');?>
			<script>$('#li_mobile_category').hide();</script>
            <?php } ?>
			<?php } ?>
           <li>
               <label>现在发布<a href="#" class="issue" title="在网站前台显示">?</a></label>
               <input type="checkbox" id="is_publish" name="is_publish" value="1">
           </li>
            <li>
                <label></label>
            </li>
           <li>
              
                <input type="hidden" value="<?php echo ($_GET['cid']); ?>" name="category_id" />
                <input type="submit" value="确定并保存" id="btnSubmit" name="save"  class="button button-green button-big" />
            </li>
        </ul>
    </fieldset>
</form>

</body>
</html>