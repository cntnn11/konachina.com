<?php /* Smarty version Smarty-3.1.8, created on 2014-05-24 15:32:27
         compiled from "/Users/cntnn11/www/www.konachina.com/admin/views/0921/left_menu.html" */ ?>
<?php /*%%SmartyHeaderCode:214635301553804b0bd5bf13-19017246%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'adf8fa198a794a5eaa4c94b1bd3b1a39ea5a086e' => 
    array (
      0 => '/Users/cntnn11/www/www.konachina.com/admin/views/0921/left_menu.html',
      1 => 1391624982,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214635301553804b0bd5bf13-19017246',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'admin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53804b0bda3048_69479504',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53804b0bda3048_69479504')) {function content_53804b0bda3048_69479504($_smarty_tpl) {?><div class="vernav2 iconmenu">
	<ul>
		<li <?php if ($_smarty_tpl->tpl_vars['admin']->value['c']=='bike'||$_smarty_tpl->tpl_vars['admin']->value['c']=='bikenews'){?>class="current"<?php }?>><a href="#52bike" class="52bike">52BIKE</a>
			<span class="arrow"></span>
			<ul id="52bike" <?php if ($_smarty_tpl->tpl_vars['admin']->value['controller']=='bike'){?>style="display:block;"<?php }?> >
				<li <?php if ($_smarty_tpl->tpl_vars['admin']->value['a']=='video'){?>class="current"<?php }?>><a href="<?php echo @BASEURL;?>
bike/video">视频URL链接添加</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['admin']->value['a']=='bikeCateList'){?>class="current"<?php }?>><a href="<?php echo @BASEURL;?>
bike/bikeCateList">产品分类</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['admin']->value['a']=='bikeList'){?>class="current"<?php }?>><a href="<?php echo @BASEURL;?>
bike/bikeList">产品内容</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['admin']->value['a']=='imageList'){?>class="current"<?php }?>><a href="<?php echo @BASEURL;?>
bike/imageList">图片集</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['admin']->value['a']=='newsCate'){?>class="current"<?php }?>><a href="<?php echo @BASEURL;?>
bikenews/newsCate">新闻类别</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['admin']->value['a']=='newsList'){?>class="current"<?php }?>><a href="<?php echo @BASEURL;?>
bikenews/newsList">新闻内容</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['admin']->value['a']=='shop'){?>class="current"<?php }?>><a href="<?php echo @BASEURL;?>
bike/shop">经销商管理</a></li>
			</ul>
		</li>
		<li <?php if ($_smarty_tpl->tpl_vars['admin']->value['c']=='sysuser'){?>class="current"<?php }?>><a href="#sysuser" class="sysuser">系统内容</a>
			<span class="arrow"></span>
			<ul id="sysuser">
				<li <?php if ($_smarty_tpl->tpl_vars['admin']->value['a']=='uppwd'){?>class="current"<?php }?>><a href="<?php echo @BASEURL;?>
sysuser/uppwd">管理员操作</a></li>
			</ul>
		</li>
		<!-- <li><a href="filemanager.html" class="gallery">File Manager</a></li> -->
	</ul>
	<a class="togglemenu"></a>
	<br /><br />
</div><?php }} ?>