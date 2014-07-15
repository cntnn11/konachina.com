<?php
class main extends CI_Controller
{
	public $month_cn	= array(
		1	=> '一',
		2	=> '二',
		3	=> '三',
		4	=> '四',
		5	=> '五',
		6	=> '六',
		7	=> '七',
		8	=> '八',
		9	=> '九',
		10	=> '十',
		11	=> '十一',
		12	=> '十二',
	);
	function __construct()
	{
		parent::__construct();
		$this->load->helpers("url", "util");
		$this->load->model('main_model', 'main');
	}

	/**
	 *	@desc 首页
	*/
	function index()
	{
		$recommend_result	= $this->main->getRecommend(1);
		$recommend_list		= array();
		if( $recommend_result )
		{
			foreach ($recommend_result as $key => $value)
			{
				$recommend_list[$key]['image']	= '/public/'.$value['image_url'];
				$recommend_list[$key]['title']	= $value['title'];
				$recommend_list[$key]['url']	= $value['link_url'];
			}
		}
		$this->slides	= json_encode($recommend_list);

		$this->css_arr	= array('index.css', 'supersized/supersized.css', 'supersized/supersized.shutter.css');
		$this->js_arr	= array('supersized/jquery.easing.min.js', 'supersized/supersized.3.2.7.js', 'supersized/supersized.shutter.js', 'index_supersized.js');

		$this->display('52kona_v2/index');
	}

}