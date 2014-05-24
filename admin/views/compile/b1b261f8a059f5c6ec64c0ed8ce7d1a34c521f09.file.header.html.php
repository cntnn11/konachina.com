<?php /* Smarty version Smarty-3.1.8, created on 2014-05-24 15:32:26
         compiled from "/Users/cntnn11/www/www.konachina.com/admin/views/0921/header.html" */ ?>
<?php /*%%SmartyHeaderCode:211177320453804b0a10db20-94677889%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1b261f8a059f5c6ec64c0ed8ce7d1a34c521f09' => 
    array (
      0 => '/Users/cntnn11/www/www.konachina.com/admin/views/0921/header.html',
      1 => 1391624982,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '211177320453804b0a10db20-94677889',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'css_arr' => 0,
    'row' => 0,
    'js_arr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53804b0a151302_06401887',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53804b0a151302_06401887')) {function content_53804b0a151302_06401887($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>管理后台欢迎您</title>
<link rel="stylesheet" href="<?php echo @PUBDIRAMAN;?>
css/style.default.css" type="text/css" />
<?php if ($_smarty_tpl->tpl_vars['css_arr']->value){?>
<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['css_arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['row']->key;
?>
<script type="text/javascript" src="<?php echo @PUBDIRAMAN;?>
css/<?php echo $_smarty_tpl->tpl_vars['row']->value;?>
"></script>
<?php } ?>
<?php }?>
<script type="text/javascript" src="<?php echo @PUBDIRAMAN;?>
js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="<?php echo @PUBDIRAMAN;?>
js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo @PUBDIRAMAN;?>
js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo @PUBDIRAMAN;?>
js/plugins/jquery.bxSlider.min.js"></script>
<script type="text/javascript" src="<?php echo @PUBDIRAMAN;?>
js/plugins/jquery.slimscroll.js"></script>

<?php if ($_smarty_tpl->tpl_vars['js_arr']->value){?>
<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['js_arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['row']->key;
?>
<script type="text/javascript" src="<?php echo @PUBDIRAMAN;?>
js/<?php echo $_smarty_tpl->tpl_vars['row']->value;?>
"></script>
<?php } ?>
<?php }?>

<script type="text/javascript" src="<?php echo @PUBDIRAMAN;?>
js/custom/general.js"></script>
<script type="text/javascript" src="<?php echo @PUBDIRAMAN;?>
js/custom/widgets.js"></script>
<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="<?php echo @PUBDIRAMAN;?>
css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="<?php echo @PUBDIRAMAN;?>
css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="<?php echo @PUBDIRAMAN;?>
css/css3-mediaqueries.js"></script>
<![endif]-->

<!-- 时间插件 -->
<!-- <script type="text/javascript" charset="utf-8" src="<?php echo @PUBURL;?>
datepicker/WdatePicker.js"></script> -->

<!-- 公共函数 -->
<script type="text/javascript" charset="utf-8" src="<?php echo @PUBDIRAMAN;?>
js/common.js"></script>
</head><?php }} ?>