<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class qy_admin_user extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table	= 'qy_admin_user';
	}
}
?>