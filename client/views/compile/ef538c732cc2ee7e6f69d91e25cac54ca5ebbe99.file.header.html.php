<?php /* Smarty version Smarty-3.1.8, created on 2014-05-24 15:31:11
         compiled from "/Users/cntnn11/www/www.konachina.com/client/views/52kona/header.html" */ ?>
<?php /*%%SmartyHeaderCode:182986516653804abf4649f5-35380806%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef538c732cc2ee7e6f69d91e25cac54ca5ebbe99' => 
    array (
      0 => '/Users/cntnn11/www/www.konachina.com/client/views/52kona/header.html',
      1 => 1391625034,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '182986516653804abf4649f5-35380806',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'keywords' => 0,
    'description' => 0,
    'page_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53804abf492ce4_35669155',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53804abf492ce4_35669155')) {function content_53804abf492ce4_35669155($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="baidu-tc-verification" content="a4917d8a408292cf07a569427822f5da" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php echo @PUBURL;?>
img/konachina.ico" type="image/x-icon" />
<html xmlns:wb="http://open.weibo.com/wb">
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
">
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
">
<link type="text/css" rel="stylesheet" href="<?php echo @PUBURL;?>
css/reset.css?0515" />
<link type="text/css" rel="stylesheet" href="<?php echo @PUBURL;?>
css/52kona.css?0515" />
<script type="text/javascript" src="<?php echo @PUBURL;?>
js/jquery_1.7.2.min.js"></script>
<script type="text/javascript">
$(function($){
	$("body").bgStretcher({
		images: ["<?php echo @PUBURL;?>
img/pagebg_default.jpg","<?php echo @PUBURL;?>
img/pagebg_gallery.jpg","<?php echo @PUBURL;?>
img/pagebg_index.jpg"],
		imageWidth: 1600,
		imageHeight: 1200,
		nextSlideDelay: 120000
	})
});
</script>
</head>
<body>
<div class="header_page">
	<div class="header_nav">
		<div class="header_weibo" style="text-align:right;">
			<a style="display:inline-block;"><wb:follow-button uid="2769500555" type="red_1" height="22px" >关注konachina</wb:follow-button></a>
		</div>
		<ul class="header_nav_ul">
			<li><a href="http://shop35011395.taobao.com/" target="_blank">购买</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['page_name']->value=='dealers'){?>class="nav_active"<?php }?> ><a href="/dealers.html">经销商</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['page_name']->value=='bikes'){?>class="nav_active"<?php }?> ><a href="/bikes">Kona车型</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['page_name']->value=='gallery'){?>class="nav_active"<?php }?> ><a href="/gallery">图集</a></li>
			<li ><a href="http://www.konaworld.com/team.cfm" target="_blank">KonaTeam</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['page_name']->value=='club'){?>class="nav_active"<?php }?> ><a href="/club.html">俱乐部</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['page_name']->value=='contact'){?>class="nav_active"<?php }?> ><a href="/contact.html">联系我们</a></li>
		</ul>
	</div>
	<div class="header_logo"><a href="<?php echo @WEBURL;?>
" target="_blank" alt="www.konachina.com"><img src="<?php echo @PUBURL;?>
img/logo.png" width="117" height="104" title='konachina' /></a></div>
	<div class="clear"></div>
</div>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script><?php }} ?>