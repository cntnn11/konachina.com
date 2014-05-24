<?php
function _ars($data, $stats = FALSE)
{
	$result = array();
	$result['data']		= $data;
	$result['status']	= $stats===TRUE ? 'OK' : 'FAIL';
	echo json_encode($result);
	exit();
}

/* 使用CI类获取post提交数据 */
function _pv($argement, $default = '')
{
	global $CI;
	$data	= $CI->input->post($argement);
	$data	= $data ? $data : $default;
	return $data;
}

/* 使用CI类获取GET的数据 */
function _gv($argement, $default = '')
{
	global $CI;
	$data	= $CI->input->get($argement);
	$data	= $data ? $data : $default;
	return $data;
}
function _gvr($argement, $default = '')
{
	global $CI;
	$data	= $CI->input->get($argement);
	$data	= $data ? $data : $default;
	return $data;
}
function _rsg($num = 0, $default = '')
{
	global $CI;
	$data	= $CI->uri->rsegment($num);
	$data	= $data ? $data : $default;
	return $data;
}

/* 获取session中的值 */
function _ss($key, $default = '')
{
	$data	= '';
	$data	= isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
	return $data;
}

/**
 *	@DESC 车型一系列的URL
*/
function bikeListUrl($year = 0)
{
	return site_url("/bikes/".$year);
}
function bikesUrl($bike_id = 0)
{
	return site_url("/detail/{$bike_id}.html");
}
function newsUrl($news_id = 0)
{
	return site_url("/article/{$news_id}.html");
}
function newsCateUrl($cate_id = 0, $offset = 0)
{
	$url	= '/news';
	if($cate_id)
	{
		$url	.= '/category/'.$cate_id;
	}
	if($offset)
	{
		$url	.= '/'.$offset;
	}
	return site_url($url);
}
/**
 *	@DESC 获取图片的url访问路径 前后台需同步更新
 *	@param string $image_path 图片文件在系统上的相对路径
 *	@param int 输出相应尺寸的图片
 *	@param string url访问目录，默认为系统定义的PUBDIR常量
*/
function imageUrl($image_path, $size = '225', $url = '')
{
	$file_path_info	= pathinfo($image_path);
	$file_path_size	= $file_path_info['dirname'].DS.$size.'_'.$file_path_info['basename'];
	$url	= $url ? $url : PUBURL;

	if(is_file(PUBPATH.$file_path_size))
	{
		return $url.$file_path_size;
	}
	else if(is_file(PUBPATH.$image_path))
	{
		return $url.$image_path;
	}
	else
	{
		return $url.'img/'.$size.'_noimg.gif';
	}
}
/**
 *	@DESC 获取年份配置，从2012年开始
 *	@author cntnn11
*/
function getYearConf()
{
	$year_start	= "2012";
	$year_now	= date("Y");
	$year_end	= $year_now+1;
	$year_arr	= range($year_start, $year_end);
	return array_combine($year_arr, $year_arr);
}

/**
 *	@DESC 分页
*/
function pageWeb($url, $total, $offset = 0, $limit = 15, $uri = 3)
{
	global $CI;
	$config['base_url']				= $url;	//分页链接
	$config['total_rows']			= $total;	//总数据数
	$config['per_page']				= $limit;	//每次显示多少条数据，默认显示15条
	$config['num_links']			= 10;	//当前页的左右两边显示几个页码
	$config['uri_segment']			= (int)$uri;	//URI参数的位置

	$config['full_tag_open']		= '<ul>';
	$config['full_tag_close']		= '</ul>';
	$config['first_link']			= FALSE;
	$config['first_tag_open']		= '<li>';
	$config['first_tag_close']		= '</li>';
	$config['last_link']			= FALSE;
	$config['last_tag_open']		= '<li>';
	$config['last_tag_close']		= '</li>';
	$config['prev_link']			= ' &lt';
	$config['prev_tag_open']		= '<li>';
	$config['prev_tag_close']		= '</li>';
	$config['next_link']			= '&gt; ';
	$config['next_tag_open']		= '<li>';
	$config['next_tag_close']		= '</li>';
	$config['num_tag_open']			= '<li>';
	$config['num_tag_close']		= '</li>';
	$config['cur_tag_open']			= '<li class="thisclass">'; //当前页码使用的标签
	$config['cur_tag_close']		= '</li>';

	$CI->pagination->initialize($config);
	$re	= $CI->pagination->create_links();
	return $re;
}

