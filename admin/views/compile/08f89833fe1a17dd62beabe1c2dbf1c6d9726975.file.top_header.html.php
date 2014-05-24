<?php /* Smarty version Smarty-3.1.8, created on 2014-05-24 15:32:27
         compiled from "/Users/cntnn11/www/www.konachina.com/admin/views/0921/top_header.html" */ ?>
<?php /*%%SmartyHeaderCode:192876523853804b0bd46d42-61105051%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08f89833fe1a17dd62beabe1c2dbf1c6d9726975' => 
    array (
      0 => '/Users/cntnn11/www/www.konachina.com/admin/views/0921/top_header.html',
      1 => 1391624982,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '192876523853804b0bd46d42-61105051',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'admin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53804b0bd53f52_39376212',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53804b0bd53f52_39376212')) {function content_53804b0bd53f52_39376212($_smarty_tpl) {?><div class="topheader">
	<div class="left">
		<h1 class="logo"><?php echo $_smarty_tpl->tpl_vars['admin']->value['u_user'];?>
</h1>
		<span class="slogo"></span>
		<br clear="all" />
	</div>
	
	<div class="right">
		<div class="userinfo">
			<span><?php echo $_smarty_tpl->tpl_vars['admin']->value['u_user'];?>
</span>
		</div>
		
		<div class="userinfodrop">
			<div class="userdata">
				<h4><?php echo $_smarty_tpl->tpl_vars['admin']->value['u_user'];?>
</h4>
				<ul>
					<!-- <li><a href="editprofile.html">编辑账户资料</a></li> -->
					<li><a href="<?php echo @BASEURL;?>
sysuser/uppwd">重设密码</a></li>
					<li><a href="<?php echo @BASEURL;?>
main/logout/">退出登录</a></li>
				</ul>
			</div><!--userdata-->
		</div><!--userinfodrop-->
	</div><!--right-->
</div><!--topheader--><?php }} ?>