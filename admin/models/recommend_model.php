<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class recommend_model extends CI_Model
{
	// 推荐内容管理表
	const RECOMMEND_TABLE			= 'recommend';

	/**
	 *	@DESC 获取图片的列表
	*/
	function getRecommendList($where = array(), $offset = 0, $limit = 0)
	{
		$this->table	= self::RECOMMEND_TABLE;
		return $this->limit($offset, $limit)->getall('*', $where);
	}
	function getRecommendTotal($where = array())
	{
		$this->table	= self::RECOMMEND_TABLE;
		return $this->countTable($where);
	}

	/**
	 *	@DESC 获取推荐内容信息
	 *		只接受一个ID做为参数
	*/
	function getRecommendInfoFromId($id = 0)
	{
		$this->table	= self::RECOMMEND_TABLE;
		return $this->getone('*', array('id'=>$id));
	}

	/**
	 * @DESC 多条件修改推荐内容的信息
	*/
	function updateRecommendInfo($where = array(), $data = array())
	{
		$this->table	= self::RECOMMEND_TABLE;
		return $this->update($data, $where);
	}

	/**
	 * @DESC 插入信息
	*/
	function insertRecommend($data = array())
	{
		$this->table	= self::RECOMMEND_TABLE;
		return $this->insert($data);
	}

}
?>