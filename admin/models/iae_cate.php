<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class iae_cate extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table	= 'iae_cate';
	}

	//通过ID获取分类列表，倒序排序输出
	function getListFromIdD()
	{
		$rs = $re = array();
		$rs	= $this->orderby(array('iae_id'=>'desc'))->getAll('iae_id,iae_name');
		foreach($rs as $row)
		{	$re[$row['iae_id']]	= $row['iae_name'];	}
		return $re;
	}
}
?>