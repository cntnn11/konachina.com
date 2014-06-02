<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class video_model extends CI_Model
{
	//数据表
	const VIDEO_TABLE	= 'qy_video';

	/**
	 *	@DESC 获取图片的列表
	*/
	function getVideoList($where = array(), $offset = 0, $limit = 0)
	{
		$this->table	= self::VIDEO_TABLE;
		return $this->limit($offset, $limit)->getall('*', $where);
	}
	function getVideoTotal($where = array())
	{
		$this->table	= self::VIDEO_TABLE;
		return $this->countTable($where);
	}

	/**
	 *	@DESC 获取图片信息
	 *		只接受一个ID做为参数
	*/
	function getVideoInfoFromId($id = 0)
	{
		$this->table	= self::VIDEO_TABLE;
		return $this->getone('*', array('id'=>$id));
	}

	/**
	 * @DESC 多条件修改图片的信息
	*/
	function updateVideoInfo($where = array(), $data = array())
	{
		$this->table	= self::VIDEO_TABLE;
		return $this->update($data, $where);
	}

	/**
	 * @DESC 插入一条图片信息
	*/
	function insertVideo($data = array())
	{
		$this->table	= self::VIDEO_TABLE;
		return $this->insert($data);
	}
}
?>