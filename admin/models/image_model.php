<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class image_model extends CI_Model
{
	//数据表
	const IMAGES_TABLE			= 'qy_images';

	/**
	 *	@DESC 获取图片的列表
	*/
	function getImageList($where = array(), $offset = 0, $limit = 0)
	{
		$this->table	= self::IMAGES_TABLE;
		return $this->limit($offset, $limit)->getall('*', $where);
	}
	function getImageTotal($where = array())
	{
		$this->table	= self::IMAGES_TABLE;
		return $this->countTable($where);
	}

	/**
	 *	@DESC 获取图片信息
	 *		只接受一个ID做为参数
	*/
	function getImageInfoFromId($id = 0)
	{
		$this->table	= self::IMAGES_TABLE;
		return $this->getone('*', array('id'=>$id));
	}

	/**
	 * @DESC 多条件修改图片的信息
	*/
	function updateImageInfo($where = array(), $data = array())
	{
		$this->table	= self::IMAGES_TABLE;
		return $this->update($data, $where);
	}

	/**
	 * @DESC 插入一条图片信息
	*/
	function insertImage($data = array())
	{
		$this->table	= self::IMAGES_TABLE;
		return $this->insert($data);
	}

}
?>