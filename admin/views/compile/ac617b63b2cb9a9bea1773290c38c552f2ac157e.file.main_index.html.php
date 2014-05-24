<?php /* Smarty version Smarty-3.1.8, created on 2014-05-24 15:32:27
         compiled from "/Users/cntnn11/www/www.konachina.com/admin/views/0921/main_index.html" */ ?>
<?php /*%%SmartyHeaderCode:11352809353804b0bd19d81-05719173%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac617b63b2cb9a9bea1773290c38c552f2ac157e' => 
    array (
      0 => '/Users/cntnn11/www/www.konachina.com/admin/views/0921/main_index.html',
      1 => 1391624982,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11352809353804b0bd19d81-05719173',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'admin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53804b0bd42b54_26716843',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53804b0bd42b54_26716843')) {function content_53804b0bd42b54_26716843($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("0921/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
		<div class="pageheader notab">
			<h1 class="pagetitle">Hello! <?php echo $_smarty_tpl->tpl_vars['admin']->value['u_user'];?>
</h1>
			<span class="pagedesc"></span>
		</div>

		<div id="contentwrapper" class="contentwrapper widgetpage">
			<div class="one_half last">
				<div class="widgetbox">
					<div class="title"><h3>日历</h3></div>
					<div class="widgetcontent">
						<div id="datepicker"></div>
					</div><!--widgetcontent-->
				</div><!--widgetbox-->
			</div><!--one_half last-->
							
		</div><!--contentwrapper-->
		
	</div><!-- centercontent -->
	
	
</div><!--bodywrapper-->

</body>
	
</html>
<?php }} ?>