<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class team_model extends CI_Model
{
	//数据表
	const TEAM_TABLE			= 'qy_team';

	/**
	 *	@DESC 获取图片的列表
	*/
	function getTeamList($where = array(), $offset = 0, $limit = 0)
	{
		$this->table	= self::TEAM_TABLE;
		return $this->limit($offset, $limit)->getall('*', $where);
	}
	function getTeamTotal($where = array())
	{
		$this->table	= self::TEAM_TABLE;
		return $this->countTable($where);
	}

	/**
	 *	@DESC 获取图片信息
	 *		只接受一个ID做为参数
	*/
	function getTeamInfoFromId($id = 0)
	{
		$this->table	= self::TEAM_TABLE;
		return $this->getone('*', array('id'=>$id));
	}

	/**
	 * @DESC 多条件修改图片的信息
	*/
	function updateTeamInfo($where = array(), $data = array())
	{
		$this->table	= self::TEAM_TABLE;
		return $this->update($data, $where);
	}

	/**
	 * @DESC 插入一条图片信息
	*/
	function insertTeam($data = array())
	{
		$this->table	= self::TEAM_TABLE;
		return $this->insert($data);
	}

}
?>