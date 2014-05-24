<?php /* Smarty version Smarty-3.1.8, created on 2014-05-24 15:32:31
         compiled from "/Users/cntnn11/www/www.konachina.com/admin/views/0921/52bike/img_lists.html" */ ?>
<?php /*%%SmartyHeaderCode:122967658853804b0f6a4df2-22631000%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '80d5038d80bd2dec27d217e8f65321e86eb238b5' => 
    array (
      0 => '/Users/cntnn11/www/www.konachina.com/admin/views/0921/52bike/img_lists.html',
      1 => 1391624982,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '122967658853804b0f6a4df2-22631000',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'flag_arr' => 0,
    'get' => 0,
    'page' => 0,
    'lists' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53804b0f7097b4_89401291',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53804b0f7097b4_89401291')) {function content_53804b0f7097b4_89401291($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/Users/cntnn11/www/www.konachina.com/system/libraries/libs/plugins/function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("0921/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body class="withvernav">

<div class="bodywrapper">
	<!-- 头部管理员信息 -->
	<?php echo $_smarty_tpl->getSubTemplate ("0921/top_header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<!-- 头部横排导航条 -->
	<?php echo $_smarty_tpl->getSubTemplate ("0921/nav_header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<!-- 左侧导航列表 -->
	<?php echo $_smarty_tpl->getSubTemplate ("0921/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	
	<!-- 右侧内容区 -->
	<div class="centercontent">
		<ul class="breadcrumbs">
			<li><a>52BIKE</a></li>
			<li>图片列表</li>
		</ul>
		<div class="pageheader notab">
			<ul class="hornav">
				<li class="current"><a href="<?php echo @BASEURL;?>
bike/imageList">图片列表</a></li>
				<li><a href="javascript:void('');" onclick="editImageInfo(0);">添加图片</a></li>
			</ul>
		</div>
		<div id="contentwrapper" class="contentwrapper widgetpage">
			<form action="<?php echo @BASEURL;?>
bike/imageList" method="get">
				<i>状态：</i>
				<select class="uniformselect" name='flag' id='flag'>
					<option value=''>全部</option>
					<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['flag_arr']->value,'selected'=>$_smarty_tpl->tpl_vars['get']->value['flag']),$_smarty_tpl);?>

				</select>

				<button class="radius3">点击查询</button>
			</form>
			<table cellpadding="0" cellspacing="0" border="0" class="margintop20 stdtable stdtablecb">
				<colgroup>
					<col class="con0" style="width: 4%" />
					<col class="con1" />
					<col class="con0" />
					<col class="con1" />
					<col class="con0" />
				</colgroup>
				<thead>
					<tr>
						<td colspan="8">
							<span class="floatright"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</span>
						</td>
					</tr>
					<tr>
						<th class="head0 nosort" style="width: 4%;"><input type="checkbox" class="checkall" /></th>
						<th class="head0">标题</th>
						<th class="head1">缩略图片</th>
						<th class="head1">添加时间</th>
						<th class="head0">操作</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="8">
							<span class="floatright"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</span>
						</td>
					</tr>
				</tfoot>
				<tbody>
				<!-- 列表数据循环主体 -->
				<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lists']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
					<tr>
						<td><input  id="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" name="sel_id[]" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" /></td>
						<td class="edit_title_<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</td>
						<td>
							<img src="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['row']->value['image_url'];?>
<?php $_tmp1=ob_get_clean();?><?php echo imageUrl($_tmp1,225);?>
" /><br/>
							<span class="edit_image_<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['image_url'];?>
</span>
						</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['createdate'];?>
</td>
						<td>
							 <a href="javascript:void('');" onclick="editImageInfo('<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
');" title="Edit">编辑</a>&nbsp;
							 <select id="changeFlag" onchange="changeFlagAjax(this)" url='<?php echo @BASEURL;?>
bike/ajaxChangeFlagImageLists' aid='<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
' aid='<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
' old="<?php echo $_smarty_tpl->tpl_vars['row']->value['flag'];?>
">
								<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['flag_arr']->value,'selected'=>$_smarty_tpl->tpl_vars['row']->value['flag']),$_smarty_tpl);?>

							</select>
							<img class="flagtip<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" src="" style="display:none;" />
						</td>
					</tr>
				<?php }
if (!$_smarty_tpl->tpl_vars['row']->_loop) {
?>
					<tr>
						<td colspan="8" class="aligncenter">暂时没有数据</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>

	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {  
	jQuery('input:checkbox, select.uniformselect, input:file').uniform();
});

function editImageInfo(id)
{
	var title	= '';
	var image	= '';
	var html	= '';
	if(id > 0)
	{
		title	= jQuery('.edit_title_'+id).html();
		image	= jQuery('.edit_image_'+id).html();	
	}

	html	= '<div id="contentwrapper" class="contentwrapper widgetpage updateImage">';
		html	+= '<form>';
			html	+= '<p><label>简短描述：</label><span class="field"><input class="mediuminput" type="text" id="img_title" value="'+title+'" /></span></p>';
			html	+= '<p><label>上传图片：</label>';
				html	+= '<span class="field"><input class="smallinput" type="file" name="fileToUpload" id="fileToUpload" url="<?php echo @BASEURL;?>
other/doImageUpload" folder="photo" onchange="fileCheck(this, \'image\')" /><font id="file_error_fileToUpload"></font></span></p>';
				html	+= '<p><label>图片地址：</label><span class="field"><input disabled class="mediuminput" type="text" name="upload_fileToUpload" id="upload_fileToUpload" value="'+image+'" /></span></p>';
		html	+= '</form></div>';
	
	jDialog(html, '编辑图片', function(){
		var title	= jQuery('#img_title').val();
		var image	= jQuery('#upload_fileToUpload').val();
		var suburl	= '<?php echo @BASEURL;?>
bike/ajaxDoEditImage?'+Math.random();
		if(image.length > 0)
		{
			jQuery.ajax({
				type:'POST',
				url: suburl,
				data:'&id='+id+'&title='+title+'&file_path='+image,
				dataType:'json',
				async: false,
				success:function(msg){
					if(msg.status == 'OK')
					{
						window.location.href=window.location.href;
					}
					else
					{
						jAlert('提交失败！');
						$("#popup_ok").removeAttr('disabled');
					}
				}
			});
		}
	});
}

</script>
</body><?php }} ?>