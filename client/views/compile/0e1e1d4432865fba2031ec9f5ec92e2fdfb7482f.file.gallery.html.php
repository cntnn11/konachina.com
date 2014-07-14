<?php /* Smarty version Smarty-3.1.8, created on 2014-05-24 15:31:13
         compiled from "/Users/cntnn11/www/www.konachina.com/client/views/52kona/gallery.html" */ ?>
<?php /*%%SmartyHeaderCode:143599776153804ac1d4fb37-56962250%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e1e1d4432865fba2031ec9f5ec92e2fdfb7482f' => 
    array (
      0 => '/Users/cntnn11/www/www.konachina.com/client/views/52kona/gallery.html',
      1 => 1391625034,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '143599776153804ac1d4fb37-56962250',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'gallery_lists' => 0,
    'images' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53804ac1dc9741_97169195',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53804ac1dc9741_97169195')) {function content_53804ac1dc9741_97169195($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("52kona/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="body_page">
	<div class="body_bg"></div>
	<div class="body_content">
		<div class="content_title">
			<span>美丽图片</span>
			<hr/>
		</div>
		<div class="content_gallery">
			<ul id="img">
				<?php  $_smarty_tpl->tpl_vars['images'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['images']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['gallery_lists']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['images']->key => $_smarty_tpl->tpl_vars['images']->value){
$_smarty_tpl->tpl_vars['images']->_loop = true;
?>
				<li>
					<a class='gallerylist' href="<?php echo imageUrl($_smarty_tpl->tpl_vars['images']->value['image_url'],800);?>
" title="<?php echo $_smarty_tpl->tpl_vars['images']->value['title'];?>
"><img src="<?php echo imageUrl($_smarty_tpl->tpl_vars['images']->value['image_url'],225);?>
" width="225px" height="152px" alt="<?php echo $_smarty_tpl->tpl_vars['images']->value['title'];?>
" ></a>
				</li>
				<?php } ?>
				<div class="clear"></div>
			</ul>
		</div>
		<div class="pagination"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo @PUBURL;?>
js/jquery.colorbox.min.js"></script>
<script type="text/javascript">
$(function(){
	$(".gallerylist").colorbox({rel:'gallerylist', transition:"fade", initialWidth:'800'});
})
	
</script>
</body>
</html><?php }} ?>