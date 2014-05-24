<?php /* Smarty version Smarty-3.1.8, created on 2014-05-24 15:32:26
         compiled from "/Users/cntnn11/www/www.konachina.com/admin/views/0921/login.html" */ ?>
<?php /*%%SmartyHeaderCode:1824387853804b0a0e2361-84802764%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e716c8253e5bf1ff5b05e2713167bccdf351d8e' => 
    array (
      0 => '/Users/cntnn11/www/www.konachina.com/admin/views/0921/login.html',
      1 => 1391624982,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1824387853804b0a0e2361-84802764',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53804b0a10a207_47109387',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53804b0a10a207_47109387')) {function content_53804b0a10a207_47109387($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("0921/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body class="loginpage">

	<div class="loginbox">
		<div class="loginboxinner">
			
			<div class="logo">
				<h1>管理后台</h1>
			</div><!--logo-->
			
			<br clear="all" /><br />
			
			<div class="nousername">
				<div class="loginmsg">The password you entered is incorrect.</div>
			</div><!--nousername-->
			
			<div class="nopassword">
				<div class="loginmsg">The password you entered is incorrect.</div>
				<div class="loginf">
					<div class="thumb"><img alt="" src="<?php echo @PUBDIRAMAN;?>
images/thumbs/avatar1.png" /></div>
					<div class="userlogged">
						<h4></h4>
						<a href="index.html">Not <span></span>?</a> 
					</div>
				</div><!--loginf-->
			</div><!--nopassword-->
			
			<form id="login" action="<?php echo @BASEURL;?>
login" method="post">
			   <div class="username">
					<div class="usernameinner">
						<input type="text" name="l[user]" id="username" />
					</div>
				</div>
				
				<div class="password">
					<div class="passwordinner">
						<input type="password" name="l[pwd]" id="password" />
					</div>
				</div>
				<input type="submit" class="submit radius2" value="登 录" />
			</form>
			
		</div><!--loginboxinner-->
	</div><!--loginbox-->


</body>
</html>
<?php }} ?>