<?php
class gallery extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helpers("url", "util");
		$this->load->model('main_model', 'main');
	}

	function index()
	{
		$limit					= 16;
		$page_num				= _rsg(3);
		$offset					= $page_num > 0 ? ($page_num-1)*$limit : 0;
		$this->load->model('main_model', 'main');
		$where['flag >=']		= 1;
		$gallery_lists			= $this->main->getImageList($where, $offset, $limit);
		$gallery_total			= $this->main->getImageTotal($where);
		$this->gallery_lists	= $gallery_lists;
		$this->page				= pageWeb(WEBURL.'gallery', $gallery_total, $offset, $limit, 2);

		$this->title			= "图片墙_KonaChina.com";
		$this->keywords			= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description		= "kona活动图片，这里展现各个骑行玩家使用kona的精彩表演";
		$this->action			= 'gallery';
		$this->css_arr			= array('gallery.css');
		$this->js_arr			= array('jquery.colorbox.min.js');
		$this->display('52kona_v2/gallery');
	}
}