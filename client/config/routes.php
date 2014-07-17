<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ciapp默认设置
$route['default_controller']= 'main/index';
$route['404_override']		= 'main/notfound';


// 52kona路由设置
/* v1版本
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
$route['article/([0-9]+)?.html']	= '52kona/bike/newsDetail/$1'; */


/* 2014-07-10 v2版本 */
$route['default_controller']		= "52kona_v2/main/index";
$route['index(.html|.php)?']		= "52kona_v2/main/index";
$route['404_override']				= '52kona_v2/bike/notfound';

$route['gallery(/:num)?(.html)?']	= '52kona_v2/gallery/index$1';
$route['video(/:num)?(.html)?']		= '52kona_v2/video/index$1';
$route['agent(/:num)?(.html)?']		= '52kona_v2/agent/index$1';
$route['(bikes|bikes.html)']		= '52kona_v2/bikes/index';
$route['bikes(/\w*)?(.html)?']		= '52kona_v2/bikes/show$1';
$route['(team|team.html)']			= '52kona_v2/team/index';
$route['team(/\w*)?(.html)?']		= '52kona_v2/team/show$1';
$route['news/article(/\w*)?(.html)?']	= '52kona_v2/news/show$1';
$route['news(/.*)?(.html)?']		= '52kona_v2/news/index$1$2';
$route['news.html']					= '52kona_v2/news/index';

//$route['(news(/:num)?|news(/:num)?.html)']	= '52kona_v2/news/index/$1';
//$route['news/category/([0-9]+)?(/[0-9]+)?']	= '52kona/bike/news/category/$1$2';


$route['contact.html']				= '52kona_v2/bike/contact';
$route['dealers.html']				= '52kona_v2/bike/dealers';
$route['news/category/([0-9]+)?(/[0-9]+)?']	= '52kona/bike/news/category/$1$2';
$route['article/([0-9]+)?.html']	= '52kona/bike/newsDetail/$1';