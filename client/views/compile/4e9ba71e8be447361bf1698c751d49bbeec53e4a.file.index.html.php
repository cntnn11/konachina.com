<?php /* Smarty version Smarty-3.1.8, created on 2014-05-24 15:31:11
         compiled from "/Users/cntnn11/www/www.konachina.com/client/views/52kona/index.html" */ ?>
<?php /*%%SmartyHeaderCode:68368017453804abf42dd46-08112871%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e9ba71e8be447361bf1698c751d49bbeec53e4a' => 
    array (
      0 => '/Users/cntnn11/www/www.konachina.com/client/views/52kona/index.html',
      1 => 1391625034,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '68368017453804abf42dd46-08112871',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'video_list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53804abf4619c9_88950519',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53804abf4619c9_88950519')) {function content_53804abf4619c9_88950519($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("52kona/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="body_index">
	<div class="body_index_back"></div>
	<div class="body_index_font">
		<h3>享受骑行</h3>
		<h1>The KONA Long Sweet Ride</h1>
	</div>
</div>

<div class="footer_index">
	<div class="footer_back"></div>
	<div class="video_index">
		<ul>
			<?php if ($_smarty_tpl->tpl_vars['video_list']->value['url1']){?>
			<li>
				<embed src="<?php echo $_smarty_tpl->tpl_vars['video_list']->value['url1'];?>
" allowFullScreen="true" quality="high" width="162" height="110" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
			</li>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['video_list']->value['url2']){?>
			<li>
				<embed src="<?php echo $_smarty_tpl->tpl_vars['video_list']->value['url2'];?>
" allowFullScreen="true" quality="high" width="162" height="110" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
			</li>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['video_list']->value['url3']){?>
			<li>
				<embed src="<?php echo $_smarty_tpl->tpl_vars['video_list']->value['url3'];?>
" allowFullScreen="true" quality="high" width="162" height="110" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
			</li>
			<?php }?>
			<li class="video_font">
				<h1>Videos:</h1>
				<h3><a href="<?php echo $_smarty_tpl->tpl_vars['video_list']->value['url_index'];?>
" target="_blank">more +</a></h3>
			</li>
		</ul>
	</div>
</div>
</body>
</html><?php }} ?>