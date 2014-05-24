<?php
class main extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->admin	= isAdminLogin();
		$this->load->model('qy_admin_user');
	}
	
	/**
	 * 网站首页，菜单管理
	 */
	function index()
	{
		$this->display('0921/main_index.html');
	}

	function welcome()
	{
		$this->local = '欢迎回来 welcome()';
		
		$rs	= $this->qy_admin_user->in(array('u_id'=>array(1,2)))->groupby(array('u_id'))->getall('*');
		$this->display('main_welcome.html');
	}
	
	/**
	 * 退出登录
	 */
	function logout()
	{
		session_destroy();
		redirect(BASEURL.'login/index', 'location');
	}

}
?>