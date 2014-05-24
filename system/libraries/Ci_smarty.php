<?php
require (BASEPATH."libraries".DS."libs".DS."Smarty.class.php");//APPPATH是ci系统预定义      // 的:application/ ,ROOT.DS是第三步的1定义的
class Ci_smarty extends Smarty
{
	//继承smarty类,Ci_smarty注意如果文件名为大写,类名必须也大写
	function __construct()
	{
		parent::__construct();
		self::loadsmarty();
	}
	
	function loadsmarty()
	{
		//配置smarty
		$this->template_dir		= FCPATH.APPNAME.DS.'views'.DS;	//静态模板文件路径
		$this->compile_dir		= FCPATH.APPNAME.DS.'views'.DS.'compile'.DS;	//编译完成的文件路径
		$this->config_dir		= FCPATH.APPNAME.DS.'configs'.DS;//配置文件路径
		$this->cache_dir		= FCPATH.APPNAME.DS.'views'.DS.'cache'.DS;	//缓存文件

		$this->left_delimiter	= '{%';
		$this->right_delimiter	= '%}';
	}
}



?>