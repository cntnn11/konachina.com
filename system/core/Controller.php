<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CI_Controller
{
	private static $instance;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;

		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');//加载类

		$this->load->initialize();//初始化方法
		$this->output->set_header("Content-Type: text/html; charset=utf-8");//设置字符集
		log_message('debug', "Controller Class Initialized");
		$this->load->helper(array('form', 'url', 'captcha', 'number', 'smiley', 'text'));
		$this->load->library(array('ci_smarty', 'pagination', 'session', 'encrypt'));
		$this->load->database();
	}
	
	public static function &get_instance()
	{
		if( self::$instance == null )
		{
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 *	@DESC 标准的加载视图页方法，使用CI原生
	*/
	function showpage($tpl, $data = array())
	{
		if(isset($data['header']) && is_array($data['header']) && !empty($data['header']))
		{
			$this->load->view("header", $data['header']);
		}
		if(isset($data['body']) && is_array($data['body']) && !empty($data['body']))
		{
			$this->load->view($tpl, $data['body']);
		}
		if(isset($data['footer']) && is_array($data['footer']) && !empty($data['footer']))
		{
			$this->load->view("footer", $data['footer']);
		}
		exit();
	}

	/**
	 *	@DESC 使用CI原生的视图加载单一的页面
	*/
	function showpageone($tpl, $data = array())
	{
		echo $this->load->view($tpl, $data, TRUE);
		exit();
	}
	
	/**
	 *	@DESC 使用smarty模板
	*/
	public function display($tpl='')// 重定义smarty的display方法
	{
		//模版自动赋值
		$this->put(get_object_vars( $this ));
		$tpl = $this->tpl($tpl);
		//显示view
		$this->ci_smarty->display($tpl);
		exit;
	}
	
	protected function fetch($tpl='')// 重定义smarty的fetch方法
	{
		//模版自动赋值
		$this->put(get_object_vars( $this ));
		$tpl = $this->tpl($tpl);
		return $this->ci_smarty->fetch($tpl);//smarty类的fetch方法
	}
	
	private function put($array)
	{
		if ( !is_array( $array ) )
		{
			return false;
		}
		foreach ( $array as $k => $v )
		{
			if(gettype($v) != 'object')
			{
				$this->assign($k,$v);
			}
		}
	}
	
	private function assign($name, $value)
	{
		$this->ci_smarty->assign($name, $value);
	}
	
	private function set($name, $value)
	{
		$this->assign($name, $value);
	}
	
	/**
	 *	@DESC 传入的视图文件名不能出现两个 ‘.’，只能 文件名.后缀 
	 *		文件名命名规则一律为 xxx_xx.suffix 即使用 '_' 分割
	 *	@author cntnn11
	 *	@date 2013-09-08
	*/
	protected function tpl($tpl = '')
	{
		// 海报模板处理
		$suffix_arr	= array('html', 'htm', 'tpl');
		$tpl_arr	= explode('.', $tpl);

		if(!isset($tpl_arr[1]) || !in_array($tpl_arr[1], $suffix_arr))
		{
			$tpl	.= '.html';
		}

		return $tpl;
	}

	/**
	 * 加密函数
	 * @params string $string
	 */
	function encode($string = '')
	{
		$code	= '';
		$code	= base64_encode($string);
		$code	= md5($code);
		$code	= base64_encode($code);
		return $code;
	}

}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */