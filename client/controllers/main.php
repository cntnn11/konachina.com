<?php
class main extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helpers("url", "util");
	}

	/**
	 *	@desc 首页
	*/
	function index()
	{
		
		$this->showpageone('index_list');
	}

	function notfound()
	{
		$this->showpageone('index_list.php');
	}
}


?>