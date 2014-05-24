<style type="text/css">
.diyselect
{ min-width: 70px; height: 32px; line-height: 32px; border: solid 1px #fff; margin-right: 2px;}
</style>
<script type="text/javascript">
var provice		= <?php echo is_array($provice) ? json_encode($provice) : '';?>;
var city		= <?php echo is_array($city) ? json_encode($city) : '';?>;
var town		= <?php echo is_array($town) ? json_encode($town) : '';?>;
var provice_id	= <?php echo (int)$provice_id;?>;
var city_id		= <?php echo (int)$city_id;?>;
var town_id		= <?php echo (int)$town_id;?>;
var no_value	= '<option value="0" selected=selected >--请选择--</option>';
</script>
<select class="diyselect" name='provice_id' id='provice_id' onchange="changeProvice(this.value);">
	<option value="0">--请选择--</option>
	<?php
	foreach ((array)$provice as $key => $row)
	{
		$chk	= $provice_id == $row['id'] ? 'selected=selected' : ''; 
		echo "<option value='{$row['id']}' {$chk} >{$row['name']}</option>";
	}
	?>
</select>
<select class="diyselect" name='city_id' id='city_id' onchange="changeCity(this.value);"><option value="0" >--请选择--</option></select>
<select class="diyselect" name='town_id' id='town_id'><option value="0" >--请选择--</option></select>
<script type="text/javascript">
function genSelect(provice_id, city_id, town_id)
{
	if(provice_id && city_id)
	{
		changeProvice(provice_id, city_id);
	}
	if(city_id && city_id)
	{
		changeCity(city_id, town_id);
	}
}
function changeProvice(provice_id, city_id)
{
	if(provice_id && city)
	{
		jQuery('#city_id').text('');
		jQuery('#town_id').text('');
		var chk			= '';
		var city_html	= new Array();
			city_html.push(no_value);
		for(var i in city)
		{
			if(city[i]['parentid'] == provice_id)
			{
				chk	= city[i]['id'] == city_id ? 'selected=selected' : '';
				city_html.push('<option value="'+city[i]['id']+'" '+chk+' >'+city[i]['name']+'</option>');
			}
		}
		jQuery('#city_id').html(city_html.join(''));
		jQuery('#town_id').html(no_value);
	}
}
function changeCity(city_id, town_id)
{
	if(city_id && town)
	{
		jQuery('#town_id').text('');
		var chk			= '';
		var town_html	= new Array();
			town_html.push(no_value);
		for(var i in town)
		{
			if(town[i]['parentid'] == city_id)
			{
				chk	= town[i]['id'] == town_id ? 'selected=selected' : '';
				town_html.push('<option value="'+town[i]['id']+'" '+chk+' >'+town[i]['name']+'</option>');
			}
		}
		jQuery('#town_id').html(town_html.join(''));
	}
}
jQuery(document).ready(function(){
	genSelect(provice_id, city_id, town_id);
});
</script>

