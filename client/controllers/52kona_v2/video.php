<?php
class video extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helpers("url", "util");
		$this->load->model('main_model', 'main');
	}

	function index()
	{
		$limit					= 6;
		$page_num				= _rsg(3);
		$offset					= $page_num > 0 ? ($page_num-1)*$limit : 0;
		$this->load->model('main_model', 'main');
		$where['flag >=']		= 1;
		$video_lists			= $this->main->getVideoList($where, $offset, $limit);
		$video_total			= $this->main->getVideoTotal($where);
		$this->video_lists		= $video_lists;
		$this->page				= pageWeb(WEBURL.'video', $video_total, $offset, $limit, 2);

		$this->title			= "精彩视频_KonaChina.com";
		$this->keywords			= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description		= "kona活动视频，这里展现各个骑行玩家使用kona的精彩表演";
		$this->action			= 'video';
		$this->css_arr			= array('video.css');
		$this->display('52kona_v2/video');
	}
}