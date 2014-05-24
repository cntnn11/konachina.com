<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class video extends CI_Model
{
	//数据表
	const VIDEO_INDEXURL_TABLE	= 'qy_video_indexurl';

	function getIndexVideoUrl()
	{
		$this->table	= self::VIDEO_INDEXURL_TABLE;
		return $this->getone('*', array('id'=>1));
	}

	function updateIndexVideoUrl($data = array())
	{
		$this->table	= self::VIDEO_INDEXURL_TABLE;
		return $this->update($data, array('id'=>1));
	}
}
?>