<?php
class recommend extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->admin	= isAdminLogin();
		$this->load->model('recommend_model', 'recommend');
		$this->flag_arr	= $this->config->item('flag_arr');
		$this->recommend_info	= json_encode( array('title'=>'', 'link_url'=>'', 'image_url'=>'', 'location'=>'', 'start_date'=>'', 'end_date'=>'', 'sort'=>'') );
	}

	function index()
	{
		$where = $search = array();
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		$reInfo = $where = $search = $totalArr = $count = array();
		$limit			= 2;
		$offset			= isset($_GET['per_page']) ? $_GET['per_page'] : 0;
		$get_params		= '&per_page='.$offset;

		if($_GET['flag'] != '')
		{
			$where['flag']	= $_GET['flag'];
			$get_params		.= '&flag='.$_GET['flag'];
		}

		$lists			= $this->recommend->getRecommendList($where, $offset, $limit);
		$total			= $this->recommend->getRecommendTotal($where);
		$this->lists	= $lists;
		$this->get		= $_GET;
		$this->page		= pageNew(BASEURL.'recommend?'.$get_params, $total, $offset, $limit);
		$this->get_params= urlencode($get_params);
		$this->js_arr	= array('plugins/jquery.dataTables.min.js', 'plugins/jquery.uniform.min.js', 'plugins/jquery.ajaxfileupload.js', 'plugins/jquery.alerts.js', 'custom/tables.js');

		$this->display('0921/52bike/recommend_lists');
	}

	function ajaxDoEditRecommend()
	{
		$id			= _pv('id');
		$data['location']	= _pv('location', 1);
		$data['title']		= _pv('title', '');
		$data['image_url']	= _pv('image_url', '');
		$data['link_url']	= _pv('link_url', '');
		$data['start_date']	= _pv('start_date', 0);
		$data['end_date']		= _pv('end_date', 0);
		$data['sort']		= _pv('sort', 0);
		$data['updatedate']	= date('Y-m-d H:i:s');

		if($id > 0)
		{
			$rs	= $this->recommend->updateRecommendInfo(array('id'=>$id), $data);
		}
		else
		{
			$data['flag']	= 1;
			$data['createdate']	= date('Y-m-d H:i:s');
			$rs	= $this->recommend->insertRecommend($data);
		}

		if($rs)
		{
			_ars('OK', TRUE);
		}
		else
		{
			_ars('NO', FALSE);
		}
	}
	function ajaxChangeFlagRecommendLists()
	{
		$id		= _pv('id', 0);
		$flag	= _pv('flag');
		if($id)
		{
			$this->recommend->updateRecommendInfo(array('id'=>$id), array('flag'=>(int)$flag));
			_ars('OK', TRUE);
		}
		_ars('NO', FALSE);
	}
}