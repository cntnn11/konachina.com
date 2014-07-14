<?php
if(!defined('ROOT')) define('ROOT', str_replace('\\', '/', dirname(__FILE__)));
if (!defined('DS')) define('DS', '/');
define('ENVIRONMENT', 'development');
if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(E_ALL & ~E_NOTICE);
			break;
		case 'testing':
			error_reporting(E_ERROR | E_WARNING | E_PARSE);
			break;
		case 'production':
			//error_reporting(0);
			break;
		default:
			exit('The application environment is not set correctly.');
	}
}
$system_path		= 'system';	//核心文件路径
$application_folder	= 'admin/';//入口文件指向的目录
$application_name	= 'admin';//默认应用程序文件夹名
$public				= '/admin/public';//站点公共引入文件

if (realpath($system_path) !== FALSE)
{
	$system_path = realpath($system_path).DS;
}
$system_path = rtrim($system_path, DS).DS;

//设置系统[system]文件夹路径
if ( ! is_dir($system_path))
{
	exit("你的系统文件夹的路径好像错了，请联系技术员处理");
}
define('BASEPATH', $system_path);
define('SYSDIR', trim(strrchr(trim(BASEPATH, DS), DS), DS));

//设置你的项目的文件夹路径
if (is_dir($application_folder))
{
	define('APPPATH', $application_folder.DS);
}
else
{
	if ( ! is_dir(BASEPATH.$application_folder.DS))
	{
		exit("你的项目文件夹路径好像错了，请联系技术员处理");
	}
	define('APPPATH', BASEPATH.$application_folder.DS);
}

//当前文件的文件名
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
//网站的绝对路径 用于smarty配置
define('FCPATH', str_replace(SELF, '', __FILE__));
//APPNAME 应用程序名 用于smarty配置
define('APPNAME', $application_name);
//加载控制器类
require_once BASEPATH.'core'.DS.'CodeIgniter.php';
