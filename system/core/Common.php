<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Determines if the current version of PHP is greater then the supplied value
*
* Since there are a few places where we conditionally test for PHP > 5
* we'll set a static variable.
*
* @access	public
* @param	string
* @return	bool	TRUE if the current version is $version or higher
*/
if ( ! function_exists('is_php'))
{
	function is_php($version = '5.0.0')
	{
		static $_is_php;
		$version = (string)$version;

		if ( ! isset($_is_php[$version]))
		{
			$_is_php[$version] = (version_compare(PHP_VERSION, $version) < 0) ? FALSE : TRUE;
		}

		return $_is_php[$version];
	}
}

// ------------------------------------------------------------------------

/**
 * Tests for file writability
 *
 * is_writable() returns TRUE on Windows servers when you really can't write to
 * the file, based on the read-only attribute.  is_writable() is also unreliable
 * on Unix servers if safe_mode is on.
 *
 * @access	private
 * @return	void
 */
if ( ! function_exists('is_really_writable'))
{
	function is_really_writable($file)
	{
		// If we're on a Unix server with safe_mode off we call is_writable
		if (DIRECTORY_SEPARATOR == '/' AND @ini_get("safe_mode") == FALSE)
		{
			return is_writable($file);
		}

		// For windows servers and safe_mode "on" installations we'll actually
		// write a file then read it.  Bah...
		if (is_dir($file))
		{
			$file = rtrim($file, '/').'/'.md5(mt_rand(1,100).mt_rand(1,100));
			if (($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE)
			{
				return FALSE;
			}
			fclose($fp);
			@chmod($file, DIR_WRITE_MODE);
			@unlink($file);
			return TRUE;
		}
		elseif ( ! is_file($file) OR ($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE)
		{
			return FALSE;
		}

		fclose($fp);
		return TRUE;
	}
}

// ------------------------------------------------------------------------

/**
* Class registry
*
* This function acts as a singleton.  If the requested class does not
* exist it is instantiated and set to a static variable.  If it has
* previously been instantiated the variable is returned.
*
* @access	public
* @param	string	the class name being requested
* @param	string	the directory where the class should be found
* @param	string	the class name prefix
* @return	object
*/
if ( ! function_exists('load_class'))
{
	function &load_class($class, $directory = 'libraries', $prefix = 'CI_')
	{
		//echo $class,'<br />';
		static $_classes = array();

		// Does the class exist?  If so, we're done...
		if (isset($_classes[$class]))
		{
			return $_classes[$class];
		}

		$name = FALSE;

		// Look for the class first in the local application/libraries folder
		// then in the native system/libraries folder
		foreach (array(APPPATH, BASEPATH) as $path)
		{
			if (file_exists($path.$directory.'/'.$class.'.php'))
			{
				$name = $prefix.$class;

				if (class_exists($name) === FALSE)
				{
					require($path.$directory.'/'.$class.'.php');
				}

				break;
			}
		}

		// Is the request a class extension?  If so we load it too
		if (file_exists(APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php'))
		{
			$name = config_item('subclass_prefix').$class;

			if (class_exists($name) === FALSE)
			{
				require(APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php');
			}
		}

		// Did we find the class?
		if ($name === FALSE)
		{
			// Note: We use exit() rather then show_error() in order to avoid a
			// self-referencing loop with the Excptions class
			exit('Unable to locate the specified class: '.$class.'.php');
		}

		// Keep track of what we just loaded
		is_loaded($class);

		$_classes[$class] = new $name();
		return $_classes[$class];
	}
}

// --------------------------------------------------------------------

/**
* Keeps track of which libraries have been loaded.  This function is
* called by the load_class() function above
*
* @access	public
* @return	array
*/
if ( ! function_exists('is_loaded'))
{
	function is_loaded($class = '')
	{
		static $_is_loaded = array();

		if ($class != '')
		{
			$_is_loaded[strtolower($class)] = $class;
		}
		return $_is_loaded;
	}
}

// ------------------------------------------------------------------------

/**
* Loads the main config.php file
*
* This function lets us grab the config file even if the Config class
* hasn't been instantiated yet
*
* @access	private
* @return	array
*/
if ( ! function_exists('get_config'))
{
	function &get_config($replace = array())
	{
		static $_config;

		if (isset($_config))
		{
			return $_config[0];
		}

		// Is the config file in the environment folder?
		if ( ! defined('ENVIRONMENT') OR ! file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/config.php'))
		{
			$file_path = APPPATH.'config/config.php';
		}

		// Fetch the config file
		if ( ! file_exists($file_path))
		{
			exit('The configuration file does not exist.');
		}

		require($file_path);

		// Does the $config array exist in the file?
		if ( ! isset($config) OR ! is_array($config))
		{
			exit('Your config file does not appear to be formatted correctly.');
		}

		// Are any values being dynamically replaced?
		if (count($replace) > 0)
		{
			foreach ($replace as $key => $val)
			{
				if (isset($config[$key]))
				{
					$config[$key] = $val;
				}
			}
		}

		return $_config[0] =& $config;
	}
}

// ------------------------------------------------------------------------

/**
* Returns the specified config item
*
* @access	public
* @return	mixed
*/
if ( ! function_exists('config_item'))
{
	function config_item($item)
	{
		static $_config_item = array();

		if ( ! isset($_config_item[$item]))
		{
			$config =& get_config();

			if ( ! isset($config[$item]))
			{
				return FALSE;
			}
			$_config_item[$item] = $config[$item];
		}

		return $_config_item[$item];
	}
}

// ------------------------------------------------------------------------

/**
* Error Handler
*
* This function lets us invoke the exception class and
* display errors using the standard error template located
* in application/errors/errors.php
* This function will send the error page directly to the
* browser and exit.
*
* @access	public
* @return	void
*/
if ( ! function_exists('show_error'))
{
	function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered')
	{
		$_error =& load_class('Exceptions', 'core');
		echo $_error->show_error($heading, $message, 'error_general', $status_code);
		exit;
	}
}

// ------------------------------------------------------------------------

/**
* 404 Page Handler
*
* This function is similar to the show_error() function above
* However, instead of the standard error template it displays
* 404 errors.
*
* @access	public
* @return	void
*/
if ( ! function_exists('show_404'))
{
	function show_404($page = '', $log_error = TRUE)
	{
		$_error =& load_class('Exceptions', 'core');
		$_error->show_404($page, $log_error);
		exit;
	}
}

// ------------------------------------------------------------------------

/**
* Error Logging Interface
*
* We use this as a simple mechanism to access the logging
* class and send messages to be logged.
*
* @access	public
* @return	void
*/
if ( ! function_exists('log_message'))
{
	function log_message($level = 'error', $message, $php_error = FALSE)
	{
		static $_log;

		if (config_item('log_threshold') == 0)
		{
			return;
		}

		$_log =& load_class('Log');
		$_log->write_log($level, $message, $php_error);
	}
}

// ------------------------------------------------------------------------

/**
 * Set HTTP Status Header
 *
 * @access	public
 * @param	int		the status code
 * @param	string
 * @return	void
 */
if ( ! function_exists('set_status_header'))
{
	function set_status_header($code = 200, $text = '')
	{
		$stati = array(
							200	=> 'OK',
							201	=> 'Created',
							202	=> 'Accepted',
							203	=> 'Non-Authoritative Information',
							204	=> 'No Content',
							205	=> 'Reset Content',
							206	=> 'Partial Content',

							300	=> 'Multiple Choices',
							301	=> 'Moved Permanently',
							302	=> 'Found',
							304	=> 'Not Modified',
							305	=> 'Use Proxy',
							307	=> 'Temporary Redirect',

							400	=> 'Bad Request',
							401	=> 'Unauthorized',
							403	=> 'Forbidden',
							404	=> 'Not Found',
							405	=> 'Method Not Allowed',
							406	=> 'Not Acceptable',
							407	=> 'Proxy Authentication Required',
							408	=> 'Request Timeout',
							409	=> 'Conflict',
							410	=> 'Gone',
							411	=> 'Length Required',
							412	=> 'Precondition Failed',
							413	=> 'Request Entity Too Large',
							414	=> 'Request-URI Too Long',
							415	=> 'Unsupported Media Type',
							416	=> 'Requested Range Not Satisfiable',
							417	=> 'Expectation Failed',

							500	=> 'Internal Server Error',
							501	=> 'Not Implemented',
							502	=> 'Bad Gateway',
							503	=> 'Service Unavailable',
							504	=> 'Gateway Timeout',
							505	=> 'HTTP Version Not Supported'
						);

		if ($code == '' OR ! is_numeric($code))
		{
			show_error('Status codes must be numeric', 500);
		}

		if (isset($stati[$code]) AND $text == '')
		{
			$text = $stati[$code];
		}

		if ($text == '')
		{
			show_error('No status text available.  Please check your status code number or supply your own message text.', 500);
		}

		$server_protocol = (isset($_SERVER['SERVER_PROTOCOL'])) ? $_SERVER['SERVER_PROTOCOL'] : FALSE;

		if (substr(php_sapi_name(), 0, 3) == 'cgi')
		{
			header("Status: {$code} {$text}", TRUE);
		}
		elseif ($server_protocol == 'HTTP/1.1' OR $server_protocol == 'HTTP/1.0')
		{
			header($server_protocol." {$code} {$text}", TRUE, $code);
		}
		else
		{
			header("HTTP/1.1 {$code} {$text}", TRUE, $code);
		}
	}
}

// --------------------------------------------------------------------

/**
* Exception Handler
*
* This is the custom exception handler that is declaired at the top
* of Codeigniter.php.  The main reason we use this is to permit
* PHP errors to be logged in our own log files since the user may
* not have access to server logs. Since this function
* effectively intercepts PHP errors, however, we also need
* to display errors based on the current error_reporting level.
* We do that with the use of a PHP error template.
*
* @access	private
* @return	void
*/
if ( ! function_exists('_exception_handler'))
{
	function _exception_handler($severity, $message, $filepath, $line)
	{
		 // We don't bother with "strict" notices since they tend to fill up
		 // the log file with excess information that isn't normally very helpful.
		 // For example, if you are running PHP 5 and you use version 4 style
		 // class functions (without prefixes like "public", "private", etc.)
		 // you'll get notices telling you that these have been deprecated.
		if ($severity == E_STRICT)
		{
			return;
		}

		$_error =& load_class('Exceptions', 'core');

		// Should we display the error? We'll get the current error_reporting
		// level and add its bits with the severity bits to find out.
		if (($severity & error_reporting()) == $severity)
		{
			$_error->show_php_error($severity, $message, $filepath, $line);
		}

		// Should we log the error?  No?  We're done...
		if (config_item('log_threshold') == 0)
		{
			return;
		}

		$_error->log_exception($severity, $message, $filepath, $line);
	}
}

// --------------------------------------------------------------------

/**
 * Remove Invisible Characters
 *
 * This prevents sandwiching null characters
 * between ascii characters, like Java\0script.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('remove_invisible_characters'))
{
	function remove_invisible_characters($str, $url_encoded = TRUE)
	{
		$non_displayables = array();
		
		// every control character except newline (dec 10)
		// carriage return (dec 13), and horizontal tab (dec 09)
		
		if ($url_encoded)
		{
			$non_displayables[] = '/%0[0-8bcef]/';	// url encoded 00-08, 11, 12, 14, 15
			$non_displayables[] = '/%1[0-9a-f]/';	// url encoded 16-31
		}
		
		$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

		do
		{
			$str = preg_replace($non_displayables, '', $str, -1, $count);
		}
		while ($count);

		return $str;
	}
}

// ------------------------------------------------------------------------

/**
* Returns HTML escaped variable
*
* @access	public
* @param	mixed
* @return	mixed
*/
if ( ! function_exists('html_escape'))
{
	function html_escape($var)
	{
		if (is_array($var))
		{
			return array_map('html_escape', $var);
		}
		else
		{
			return htmlspecialchars($var, ENT_QUOTES, config_item('charset'));
		}
	}
}

/**
 * 格式序列化数组输出 var_dump()
 * @date 2012-04-25
 */
if( !function_exists('var_array') )
{
	function var_array($array)
	{
		echo '<pre>';
		var_dump($array);
		echo '</pre>';
	}
}
/**
 * 格式序列化数组输出 print_r()
 * @date 2012-04-25
 */
if( !function_exists('var_array2') )
{
	function var_array2($array)
	{
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
}

/**
 * 去掉字符串最后一位
 */
if(	!function_exists('killend') )
{
	function killend($str)
	{
		$str	= substr($str, 0, strlen($str)-1);
		return $str;
	}
}

/**
 * 获取config.XX.php文件
 */
if( !function_exists('getconfig'))
{
	function getconfig($string)
	{
		$config	= array();
		$arr	= explode('.', $string);
		include APPPATH.'configs'.DS.'config.'.$arr[0].'.php';
		if(!empty($config[$arr[1]]))
		{	return $config[$arr[1]];	}
		else
		{	return array();	}
	}
}

/**
 * 无限分类函数
 * 示例数组
 * 	$yArr    = array(
 *   1 => array('id'=>'1','parentid'=>0,'name'=>'一级栏目一'),
 *   2 => array('id'=>'2','parentid'=>0,'name'=>'一级栏目二'),
 *   3 => array('id'=>'3','parentid'=>1,'name'=>'二级栏目一'),
 *   4 => array('id'=>'4','parentid'=>1,'name'=>'二级栏目二'),
 *   5 => array('id'=>'5','parentid'=>2,'name'=>'二级栏目三'),
 *   6 => array('id'=>'6','parentid'=>3,'name'=>'三级栏目一'),
 *   7 => array('id'=>'7','parentid'=>3,'name'=>'三级栏目二'),
 *   8 => array('id'=>'8','parentid'=>2,'name'=>'二级栏目三'),
 *	);
 */
if( !function_exists('genCate') )
{
	function genCate($data, $psiff = '', $pid = 0, $level = 0)
	{
		if($level == 10) return;
		$l		= str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $level);
		$l		= empty($level) ? $l : $l.'└';
		static $arrcat	= array();
		$arrcat	= empty($level) ? array() : $arrcat;
		foreach($data as $k => $row)
		{
			/**
			 * 如果父ID为当前传入的id
			 */
			if($row[$psiff.'parentid'] == $pid)
			{
				//如果当前遍历的id不为空
				$row[$psiff.'name']	= $l.$row[$psiff.'name'];
				$row['level']		= $level;
				$arrcat[]			= $row;
				genCate($data, $psiff, $row[$psiff.'id'], $level+1);//递归调用
			}
		}
		return $arrcat;
	}
}

if( !function_exists('getChild'))
{
	
	function getChild($data, $psiff = '', $pid = 0)
	{
		$cldArr	= array();
		foreach($data as $k => $row)
		{
			//echo $row[$psiff.'parentid'].' -- '.$pid,'<br />';
			if($row[$psiff.'parentid'] == $pid)
			{	$cldArr[]	= $row;	}
		}
		return $cldArr;
	}
}

/**
 *	文章字符统计
 *	2012-08-29添加
*/
if( !function_exists('strcount'))
{
	function strcount($string, $char='utf8')
	{
		$count	= strlen($string);
		$i		= 0;	//当前的字节数
		$j		= 0;	//按照字符进行累加
		while ($i<$count)
		{
			//英文及半角特殊字符
			if(ord($string[$i]) >=0 && ord($string[$i]) <=126)
			{	$charset	= 'en';	}
			//汉字及全角字符
			else
			{	$charset	= $char;}

			switch (strtolower($charset))
			{
				case 'gb2312':
				case 'gbk':
					$i		+= 1;
					break;
				case 'utf8':
					$i		+= 2;
					break;
				case 'en':
				default:
					break;
			}
			$j++;
			$i++;
		}
		return $j;
	}
}



/**
 *	自定义字符串截取函数，防止mb_substr()没有开启
 *	通过用户输入的$char来判断当前汉字的字符集编码
 *	@param int $start 开始的字符数
 *	@param int $offest 偏移量，及从$start开始往后输出多少个字符
 *	@param str $char 使用者手动输入当前的汉字符编码
 *	@param str houzhui 连在截取后的字符串后边。比如 ……
 *	@author 谭宁宁
 *	@time 2012-08-05
 */	
if( !function_exists('strsub'))
{
	function strsub($string, $start=0, $offest=0, $char='utf8', $houzhui = '')
	{
		$count	= strlen($string);
		$rs		= '';
		$i		= 0;	//按字节数累计
		$j		= 0;	//按字符数累计
		$size	= 1;	//记录每次substr时的终止位置，汉字需要考虑gbk和utf8两种情况
		while ($i < $count)
		{
			//英文及半角特殊字符
			if(ord($string[$i]) >=0 && ord($string[$i]) <=126)
			{	$charset	= 'en';	}
			//汉字及全角字符
			else
			{	$charset	= $char;}
			
			switch (strtolower($charset))
			{
				case 'gb2312':
				case 'gbk':
					$i		+= 1;
					$size	= 2;
					break;
				case 'utf8':
					$i		+= 2;
					$size	= 3;
					break;
				case 'en':
				default:
					$size	= 1;
					break;
			}
			
			if($j < intval($start+$offest) && $j >= $start)
			{
				$tstart	= intval($i-$size)+1;
				$rs		.= substr($string, $tstart, $size);
			}
			$j++;
			$i++;
		}
		return $rs.$houzhui;
	}
}

/**
 *	统计当前日期段里的天数
 *		tip : 包含起始天和结束天，所以+1天
 *	@param $start datetime Y-m-d H:i:s 起始日期
 *	@param $end datetime Y-m-d H:i:s 结束日期
*/
if(!function_exists('daycount'))
{
	function daycount($start, $end='')
	{
		$start	= strtotime(substr($start, 0, 10).' 00:00:00');
		$end	= strtotime(substr($end, 0, 10).' 23:59:59');

		//如果起始日期减去结束日期大于等于86400，那么则认定为起始日期在结束日期之后，所以我们就把起始日期和结束日期调换位置
		if((int)$start - (int)$end >= 86400)
		{
			$temp	= $start;
			$start	= $end;
			$end	= $temp;
		}

		$day	= ceil(($end-$start)/86400);
		return $day;
	}
}

/**
 *	@DESC 查找一段日期数组中最大和最小的那个日期
 *	@param array $date_arr 一段包含多个日期的一维数组 日期格式 yyyy-mm-dd
 *			如果只传入了一个日期，那么将该日期做为起始日期算
 *	@return array 返回的是一个包含max、min的日期数组，日期格式 yyyy-mm-dd
 *	@author cntnn11
 *	@date 2013-09-09
*/
if(!function_exists('findMaxOrMinDate'))
{
	function findMaxMinDate($date_arr)
	{
		$result	= array();
		if(is_array($date_arr) && !empty($date_arr))
		{
			$date_arr	= array_filter($date_arr);
			if(count($date_arr) < 2)
			{
				return array('min'=>$date_arr[0]);
			}
			
			$time_up = $time_min = $time_min = $now_time = 0;
			foreach ($date_arr as $date)
			{
				$now_time	= strtotime($date);
				$result['max']	= date('Y-m-d', ($now_time-$time_up > 0 ? $now_time : $time_up));
				$result['min']	= date('Y-m-d', ($time_up <= 0 ? $now_time : ($now_time-$time_up < 0 ? $now_time : $time_up)));
				$time_up	= $now_time;
			}
		}
		return $result;
	}
}

/**
 *	获取两个数的比率
 *	@param $one number 第一个数
 *	@param $end number 第二个数
 *	@param $num int 决定返回小数点后几位 默认返回2位
*/
if(!function_exists('getRatio'))
{
	function getRatio($one, $two = 1, $num=2)
	{
		return number_format($one/$two, $num, '.', '');
	}
}
/* End of file Common.php */
/* Location: ./system/core/Common.php */