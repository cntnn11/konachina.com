<?php
class sysuser extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->admin	= isAdminLogin();
		$this->load->model('qy_admin_user');
	}

	/**
	 *	@DESC 管理员账号资料修改
	*/
	function profileEdit()
	{
		//var_array($_SESSION);

		$this->display('0921/sysuser/profile_edit');
	}

	/**
	 * 单独修改密码功能
	 */
	function uppwd()
	{
		$this->js_arr	= array('plugins/jquery.validate.min.js', 'plugins/jquery.uniform.min.js');
		$this->display('0921/sysuser/sysuser_uppwd');
	}

	/**
	 *	@DESC AJAX修改密码
	 *	@date 2013-09-21
	*/
	function ajaxDoUpdpwd()
	{
		isAdminLogin();
		$pwd	= _pv('pwd');
		$newpwd	= _pv('new');

		$id		= $_SESSION['webadmin']['u_id'];
		if(!$id)
		{
			_ars('noLogin', FALSE);
		}

		if($info['npwd'] != $info['repwd'])
		{
			_ars('两次输入的密码不一致！', FALSE);
		}
		//验证原密码是否正确
		$checkPwd	= $this->qy_admin_user->getAll('*', array('u_id'=>$id, 'u_pwd'=>$this->encode($pwd)));
		if(empty($checkPwd))
		{
			_ars('原密码输入错误！', FALSE);
		}

		$result		= $this->qy_admin_user->update(array('u_pwd' => $this->encode($newpwd)), array('u_id'=>$id));
		if($result)
		{
			_ars('密码修改成功', TRUE);
		}
		else
		{
			_ars('密码修改失败', FALSE);
		}
	}

	/**
	 * 更新session信息，当编辑当前用户时
	 * @param unknown_type $id
	 */
	function upSession($id)
	{
		if($_SESSION['webadmin']['u_id'] == $id)
		{
			$rs	= $this->qy_admin_user->getone('*', array('u_id'=>$id));
			foreach($rs as $k => $v)
			{
				$_SESSION['webadmin'][$k]	= $v;
			}
		}
		unset($_SESSION['webadmin']['u_pwd']);
	}
}
?>