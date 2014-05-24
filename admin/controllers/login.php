<?php
class login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('qy_admin_user');
	}

	/**
	 * 网站首页，菜单管理
	 */
	function index()
	{
		if(isset($_POST['l']) && !empty($_POST['l']))
		{
			$form	= $_POST['l'];
			//login::checkCode(strtolower($form['code']));
			/*
			 *	判断用户名和密码是否正确
			*/
			if(!empty($form['user']) && !empty($form['pwd']))
			{
				$this->_checkPwd($form);
			}
			else
			{
				redirect(BASEURL.'other/resultPage?&reurl='.urlencode(BASEURL.'login/index').'&tip=loginEmpty&status=0');
			}
			redirect(BASEURL.'main/index');
		}
		$this->display('0921/login.html');
	}
	
	/**
	 * 验证输入的验证码是否正确！
	 * @param string $codeIn
	 */
	function checkCode($codeIn)
	{
		if(strtolower($_SESSION['scode']) != $codeIn || empty($_SESSION['scode']) || empty($codeIn))
		{
			unset($_SESSION['scode']);
			report(BASEURL.'login/index', '验证码不正确,请重新输入！', false);
		}
	}
	
	/**
	 * 验证用户名密码是否一致
	 * @param array $infoArr
	 */
	function _checkPwd($infoArr)
	{
		$one	= $this->qy_admin_user->getone('*', array('u_user'=>$infoArr['user'], 'u_pwd'=>$this->encode($infoArr['pwd']), 'u_status'=>1));
		if(!empty($one))
		{
			$_SESSION['webadmin']	= $one;
		}
		else
		{
			redirect(BASEURL.'other/resultPage?&reurl='.urlencode(BASEURL.'login/index').'&tip=loginError&status=0');
		}
	}
}
?>