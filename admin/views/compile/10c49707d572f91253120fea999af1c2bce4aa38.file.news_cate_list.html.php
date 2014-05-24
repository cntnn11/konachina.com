<?php /* Smarty version Smarty-3.1.8, created on 2014-05-24 15:32:32
         compiled from "/Users/cntnn11/www/www.konachina.com/admin/views/0921/52bike/news_cate_list.html" */ ?>
<?php /*%%SmartyHeaderCode:6942573953804b106cf300-81368892%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10c49707d572f91253120fea999af1c2bce4aa38' => 
    array (
      0 => '/Users/cntnn11/www/www.konachina.com/admin/views/0921/52bike/news_cate_list.html',
      1 => 1391624982,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6942573953804b106cf300-81368892',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'row' => 0,
    'flag_arr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53804b10721ba6_54959705',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53804b10721ba6_54959705')) {function content_53804b10721ba6_54959705($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/Users/cntnn11/www/www.konachina.com/system/libraries/libs/plugins/function.html_options.php';
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
			<li>新闻类别</li>
		</ul>
		<div class="pageheader notab">
			<ul class="hornav">
				<li class="current"><a href="<?php echo @BASEURL;?>
bikenews/newsCate">新闻类别列表</a></li>
				<li><a href="<?php echo @BASEURL;?>
bikenews/newsCateEdit">添加/编辑新闻类别</a></li>
			</ul>
		</div>
		<div id="contentwrapper" class="contentwrapper widgetpage">
			<table cellpadding="0" cellspacing="0" border="0" class="margintop20 stdtable stdtablecb" id="tablemain">
				<colgroup>
					<col class="con0" style="width: 4%" />
					<col class="con1" />
					<col class="con0" />
					<col class="con1" />
					<col class="con0" />
					<col class="con1" />
					<col class="con0" />
					<col class="con1" />
				</colgroup>
				<thead>
					<tr>
						<th class="head0 nosort" style="width: 4%;"><input type="checkbox" class="checkall" /></th>
						<th class="head1">排序ID</th>
						<th class="head0">类别名称</th>
						<th class="head1">英文标识</th>
						<th class="head0">类别描述</th>
						<th class="head1">添加时间</th>
						<th class="head0 nosort">操作</th>
					</tr>
				</thead>
				<tbody>
				<!-- 列表数据循环主体 -->
				<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
					<tr>
						<td>
							<input name="sel_id[]" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" />
							<input type='hidden' name='catid[]' value='<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
' />
						</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['sortnum'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['name'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['desc'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['createdate'];?>
</td>
						<td>
							<!-- Icons -->
							<a href="<?php echo @BASEURL;?>
bikenews/newsCateEdit/?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" title="Edit">编辑</a>&nbsp;
							<select id="changeFlag" onchange="changeFlagAjax(this)" url='<?php echo @BASEURL;?>
bikenews/ajaxNewsCateChangeFlag' aid='<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
' old="<?php echo $_smarty_tpl->tpl_vars['row']->value['flag'];?>
">
								<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['flag_arr']->value,'selected'=>$_smarty_tpl->tpl_vars['row']->value['flag']),$_smarty_tpl);?>

							</select>
							<img class="flagtip<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" src="/admin/public/0921/images/loaders/loader2.gif?1013" style="display:none;" />
						</td>
					</tr>
				<?php }
if (!$_smarty_tpl->tpl_vars['row']->_loop) {
?>
					<tr>
						<td colspan="7" class="aligncenter">暂时没有数据</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#tablemain').dataTable({
		"sPaginationType": "full_numbers",
		"fnDrawCallback": function(oSettings) {
			jQuery('input:checkbox,input:radio').uniform();
		}
	});
	jQuery('input:checkbox').uniform();
});
</script>
</body>

<?php }} ?>