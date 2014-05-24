<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ciapp默认设置
$route['default_controller']= 'main/index';
$route['404_override']		= 'main/notfound';


// 52kona路由设置
$route['default_controller']		= "52kona/bike/index";
$route['404_override']				= '52kona/bike/notfound';
$route['club.html']					= '52kona/bike/club';
$route['contact.html']				= '52kona/bike/contact';
$route['bikes(:any)?']				= '52kona/bike/bikes';
$route['detail/([0-9]+)?.(:any)']	= '52kona/bike/detail/$0';
$route['gallery(/[0-9]+)?']			= '52kona/bike/gallery/$1';
$route['dealers.html']				= '52kona/bike/dealers';
$route['news.html']					= '52kona/bike/news';
$route['news(/[0-9]+)?']			= '52kona/bike/news$1';
$route['news/category/([0-9]+)?(/[0-9]+)?']	= '52kona/bike/news/category/$1$2';
$route['article/([0-9]+)?.html']	= '52kona/bike/newsDetail/$1';