<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
abstract class Kona_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 *	@desc 获取页脚处的数据
	*/
	public function getFooterData()
	{
		// 获取关于KONA的信息，线上ID=6

		// 
	}
}