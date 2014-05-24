<?php /* Smarty version Smarty-3.1.8, created on 2014-05-24 15:32:30
         compiled from "/Users/cntnn11/www/www.konachina.com/admin/views/0921/52bike/bike_list.html" */ ?>
<?php /*%%SmartyHeaderCode:118070348453804b0e10f9f2-38330192%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4d930b36203c9af2d52c4c3a1a7a9e5694f0dc66' => 
    array (
      0 => '/Users/cntnn11/www/www.konachina.com/admin/views/0921/52bike/bike_list.html',
      1 => 1391624982,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '118070348453804b0e10f9f2-38330192',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'get' => 0,
    'year_conf' => 0,
    'flag_arr' => 0,
    'page' => 0,
    'lists' => 0,
    'row' => 0,
    'cate_type' => 0,
    'get_params' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53804b0e1982b7_22673712',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53804b0e1982b7_22673712')) {function content_53804b0e1982b7_22673712($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/Users/cntnn11/www/www.konachina.com/system/libraries/libs/plugins/function.html_options.php';
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
			<li><a>单车列表</a></li>
		</ul>
		<div class="pageheader notab">
			<ul class="hornav">
				<li class="current"><a href="<?php echo @BASEURL;?>
bike/bikeList">单车列表</a></li>
				<li><a href="<?php echo @BASEURL;?>
bike/bikeEdit">添加/编辑单车</a></li>
			</ul>
		</div>
		<div id="contentwrapper" class="contentwrapper widgetpage">
			<form action="<?php echo @BASEURL;?>
bike/bikeList" method="get">
				<i>查询时间：</i>
				<input type="text" name='dates' id='dates' value='<?php echo $_smarty_tpl->tpl_vars['get']->value['dates'];?>
' class="width125" />
				-&nbsp;&nbsp;<input type="text" name='datee' id='datee' value='<?php echo $_smarty_tpl->tpl_vars['get']->value['datee'];?>
' class="width125" />
				&nbsp;&nbsp;&nbsp;&nbsp;
				<i>单车名称：</i>
				<input type='text' name='bikename' id='bikename' value='<?php echo $_smarty_tpl->tpl_vars['get']->value['bikename'];?>
' class="width100" />
				&nbsp;&nbsp;&nbsp;&nbsp;
				<i>单车年代：</i>
				<select class="uniformselect" name='year' id='year'>
					<option value=''>--选择--</option>
					<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['year_conf']->value,'selected'=>$_smarty_tpl->tpl_vars['get']->value['year']),$_smarty_tpl);?>

				</select>
				&nbsp;&nbsp;&nbsp;&nbsp;
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
					<td colspan="11">
						<span class="floatright"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</span>
					</td>
					<tr>
						<th class="head0" style="width: 4%;"><input class="check-all" type="checkbox" id="checkall" /></th>
						<th class="head1">[年代][类别]名称</th>
						<th class="head0">价格</th>
						<th class="head1">简述</th>
						<th class="head1">创建时间</th>
						<th class="head0">操作</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="11">
						<span class="floatleft">
							<input type="button" class="stdbtn btn_orange" onclick="button_location('<?php echo @BASEURL;?>
bike/bikeEdit')" value="添 加" />
						</span>
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
					<td><input name="sel_id[]" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" /></td>
					<td>
						[<font><?php echo $_smarty_tpl->tpl_vars['row']->value['year'];?>
</font>][<font><?php echo $_smarty_tpl->tpl_vars['cate_type']->value[$_smarty_tpl->tpl_vars['row']->value['type']];?>
</font>]<b><a href="<?php echo bikesUrl($_smarty_tpl->tpl_vars['row']->value['id']);?>
" target="_blank" alt="<?php echo $_smarty_tpl->tpl_vars['row']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['name'];?>
</a></b>
					</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['price'];?>
￥</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['desc'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['createdate'];?>
</td>
					<td>
						 <a href="<?php echo @BASEURL;?>
bike/bikeEdit/?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
&get_params=<?php echo $_smarty_tpl->tpl_vars['get_params']->value;?>
" title="Edit">编辑</a>&nbsp;
						 <select id="changeFlag" onchange="changeFlagAjax(this)" url='<?php echo @BASEURL;?>
bike/ajaxBikeChangeFlag' aid='<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
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
						<td colspan="11" class="aligncenter">暂时没有数据</td>
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
	jQuery( "#dates" ).datepicker({dateFormat: 'yy-mm-dd'});
	jQuery( "#datee" ).datepicker({dateFormat: 'yy-mm-dd'});
});
</script>
</body>
</html>
<?php }} ?>