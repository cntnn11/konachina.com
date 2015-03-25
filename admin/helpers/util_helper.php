<?php
/**
 *	@DESC 判断管理员是否登录
 *	@param boolean $is_return 设置为true时，返回bool值来判断是否登录， false表示未登录跳转到登录页面
*/
function isAdminLogin()
{
	if(empty($_SESSION['webadmin']))
	{
		$login	= FALSE;
		redirect(BASEURL.'login/index', 'refresh');
	}
	else
	{
		GLOBAL $CI;
		//做一些验证操作
		//用户名和密码
		$login	= TRUE;
		$admin_info	= $_SESSION['webadmin'];
		$uri	= explode('/', uri_string());
		$admin_info['c']	= isset($uri[0]) ? $uri[0] : '';
		$admin_info['a']		= isset($uri[1]) ? $uri[1] : '';
		return $admin_info;
	}
}

function _ars($data, $stats = FALSE)
{
	$result = array();
	$result['data']		= $data;
	$result['status']	= $stats===TRUE ? 'OK' : 'FAIL';
	echo json_encode($result);
	exit();
}

/**
 *	@DESC 分页方法
 *	@date 2013-10-16
*/
function pageNew($url = '', $total = 0, $offset = 0, $limit = 15)
{
	global $CI;
	preg_match('/\/\?/', $url, $urlArr);
	$url	.= empty($urlArr) ? '/?' : '';	//如果传入的链接有/?，就表示该链接带参数了
	$config['base_url']				= $url;	//分页链接
	$config['total_rows']			= $total;	//总数据数
	$config['per_page']				= $limit;	//每次显示多少条数据，默认显示15条
	$config['num_links']			= 10;	//当前页的左右两边显示几个页码
	$config['use_page_numbers'] 	= FALSE;//在URL中显示当前页码还是从哪条记录开始的数 默认为false
	$config['page_query_string']	= TRUE;	//设置为TRUE使用 ?&per_page=num方式

	$config['full_tag_open']		= '<ul class="pagination">';
	$config['full_tag_close']		= '</ul>';
	$config['first_link']			= '&laquo; ';
	$config['first_tag_open']		= '<li class="first">';
	$config['first_tag_close']		= '</li>';
	$config['last_link']			= ' &raquo;';
	$config['last_tag_open']		= '<li class="last">';
	$config['last_tag_close']		= '</li>';
	$config['prev_link']			= ' &lt';
	$config['prev_tag_open']		= '<li class="previous">';
	$config['prev_tag_close']		= '</li>';
	$config['next_link']			= '&gt; ';
	$config['next_tag_open']		= '<li class="next">';
	$config['next_tag_close']		= '</li>';
	$config['num_tag_open']			= '<li>';
	$config['num_tag_close']		= '</li>';
	$config['cur_tag_open']			= '<li><a class="current" title="'.$offset.'">'; //当前页码使用的标签
	$config['cur_tag_close']		= '</a></li>';

	$CI->pagination->initialize($config);
	$re	= $CI->pagination->create_links();
	return $re;
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

/* 获取session中的值 */
function _ss($key, $default = '')
{
	$data	= '';
	$data	= isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
	return $data;
}

/**
 *	@DESC 模板页需要以get方式传递参数，所以使用该方法解码已编码的url参数
 *	@author cntnn11
 *	@date 2013-10-07
*/
function urlDeCodeForSmarty($url)
{
	return urldecode($url);
}

/**
 * 改变数组的键名，给字段加前缀。
 * 只适用于一维数组
 */
function funAddPrefix($array, $pre = '')
{
	$reArr	= array();
	if(is_array($array) && !empty($pre))
	{
		foreach($array as $k => $row)
		{
			$reArr[$pre.$k]	= $row;
		}
	}
	return $reArr;
}
/*
 *	@DESC 自行车详情页面
*/
function bikesUrl($bike_slug = 0)
{
	return site_url("/bikes/{$bike_slug}.html");
}
/*
 *	@DESC 新闻链接
*/
function newsUrl($news_id = 0)
{
	return site_url("/news/{$news_id}.html");
}

/**
 *	@DESC 手动记录一些错误日志
*/
function error_logs($error_info, $error_type = '')
{
	$file_path	= "/tmp/";
	//$file_path	= "E:/www/ciapp/tmp/";
	error_log(date("Y-m-d H:i:s")."\t".$error_info."\n", 3, $file_path.$error_type.'_error.log');
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

	if( strpos($image_path, 'http://') !== FALSE )
	{
		return $image_path;
	}
	if( is_file(PUBPATH.$file_path_size) )
	{
		return $url.$file_path_size;
	}
	else if( is_file(PUBPATH.$image_path) )
	{
		return $url.$image_path;
	}
	else
	{
		return $url.'img/'.$size.'_noimg.gif';
	}
}
function imageUrlNew($image_path, $size = '225', $url = '')
{
	$file_path_info	= pathinfo($image_path);
	$file_path_size	= $file_path_info['dirname'].DS.$file_path_info['filename'].'_'.$size.'.'.$file_path_info['extension'];
//var_array( PUBURL );
	$url	= $url ? $url : PUBURL;
	if( strpos($image_path, 'http://') !== FALSE )
	{
		return $image_path;
	}
	if( is_file(PUBPATH.$file_path_size) )
	{
		return $url.$file_path_size;
	}
	else if( is_file(PUBPATH.$image_path) )
	{
		return $url.$image_path;
	}
	else
	{
		return $url.'img/'.$size.'_noimg.gif';
	}
}

/**
 * 遍历获取目录下的指定类型的文件
 * @param $path
 * @param array $files
 * @return array
 */
function getfiles( $path , &$files = array() )
{
	if ( !is_dir( $path ) )
	{
		return null;
	}
	$handle = opendir( $path );
	while ( false !== ( $file = readdir( $handle ) ) )
	{
		if ( $file != '.' && $file != '..' )
		{
			$path2 = $path . '/' . $file;
			if ( is_dir( $path2 ) )
			{
				getfiles( $path2 , $files );
			}
			else
			{
				if ( preg_match( "/\.(gif|jpeg|jpg|png|bmp)$/i" , $file ) )
				{
					$files[] = $path2;
				}
			}
		}
	}
	return $files;
}

function thumbImage($folder = 'other', $file_info = array())
{
	GLOBAL $CI;
	$size_arr	= $CI->config->item('file_size');

	if( !isset($size_arr[$folder]) || !is_array($size_arr[$folder]) || empty($size_arr[$folder]) )
	{
		return false;
	}

	$CI->load->library('image_lib');
	$thumb_config['source_image']	= $file_info['full_path'];
	$thumb_config['create_thumb']	= TRUE;
	$thumb_config['maintain_ratio']	= TRUE;
	$thumb_config['master_dim']		= 'width';
	$thumb_config['thumb_marker']	= false;
	foreach ($size_arr[$folder] as $size)
	{
		$temp	= array();
		$width = $height = 0;
		$temp	= explode('*', $size);
		list($width, $height) = $temp;
		if(!$width)
		{
			continue;
		}
		$thumb_config['new_image']	= $file_info['file_path'].$width.'_'.$file_info['raw_name'].$file_info['file_ext'];
		$thumb_config['width']		= $width;
		if($height > 0)
		{
			$thumb_config['height']	= $height;
		}
		var_array($thumb_config);
		$CI->image_lib->initialize($thumb_config);
		if( !$CI->image_lib->resize() )
		{
			error_logs($CI->image_lib->display_errors(), 'imgThumb');
		}
		$CI->image_lib->clear();
	}
	return true;
}

/**
 *	@DESC 获取城市下拉框联动效果
 *	@date 2014-01-31
*/
function getCitySelect($provice_id = 0, $city_id = 0, $town_id = 0, $is_country = false)
{
	$data	= false;
	global $CI;
	$CI->load->database();
	if($is_country)
	{
		$where['country']	= $is_country ? 1 : 0;
	}

	if($where)
	{
		$CI->db->where($where);
	}
	$CI->db->from('city');
	$query	= $CI->db->get();
	if($query && $query->num_rows() > 0)
	{
		$city_data	= $query->result_array();
		$provice = $city = $town = array();
		foreach ($city_data as $key => $value)
		{
			if($value['parentid'] == 1)
			{
				$provice[$value['id']]		= $value;
			}
			else if($value['parentid'] >=2 && $value['parentid'] <= 34 || $value['parentid'] == 3358)
			{
				$city[$value['id']]	= $value;
			}
			else
			{
				$town[$value['id']]	= $value;
			}
		}
		$data['provice']	= $provice;
		$data['city']		= $city;
		$data['town']		= $town;
		$data['provice_id']	= $provice_id;
		$data['city_id']	= $city_id;
		$data['town_id']	= $town_id;
		echo $CI->load->view('0921/citySelect', $data, TRUE);
	}
}
