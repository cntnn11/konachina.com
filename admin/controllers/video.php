<?php
class video extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->admin	= isAdminLogin();
		$this->load->model('video_model', 'video');
		$this->flag_arr	= $this->config->item('flag_arr');
		$this->video_info	= json_encode( array('title'=>'', 'video_url'=>'', 'width'=>'', 'height'=>'', 'sort'=>'') );
	}

	function videoLists()
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

		$lists			= $this->video->getVideoList($where, $offset, $limit);
		$total			= $this->video->getVideoTotal($where);
		
		$this->lists	= $lists;
		$this->get		= $_GET;
		$this->page		= pageNew(BASEURL.'video/videoLists/?'.$get_params, $total, $offset, $limit);
		$this->get_params= urlencode($get_params);
		$this->js_arr	= array('plugins/jquery.dataTables.min.js', 'plugins/jquery.uniform.min.js', 'plugins/jquery.ajaxfileupload.js', 'plugins/jquery.alerts.js', 'custom/tables.js');

		$this->display('0921/52bike/video_lists');
	}

	function ajaxDoEditVideo()
	{
		$id			= _pv('id');
		$data['title']		= _pv('title', '');
		$data['video_url']	= _pv('url', '');
		$data['width']		= _pv('width', 0);
		$data['height']		= _pv('height', 0);
		$data['sort']		= _pv('sort', 0);
		$data['updatedate']	= date('Y-m-d H:i:s');

		if($id > 0)
		{
			$rs	= $this->video->updateVideoInfo(array('id'=>$id), $data);
		}
		else
		{
			$data['flag']	= 1;
			$data['createdate']	= date('Y-m-d H:i:s');
			$rs	= $this->video->insertVideo($data);
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
	function ajaxChangeFlagVideoLists()
	{
		$id		= _pv('id', 0);
		$flag	= _pv('flag');
		if($id)
		{
			$this->video->updateVideoInfo(array('id'=>$id), array('flag'=>(int)$flag));
			_ars('OK', TRUE);
		}
		_ars('NO', FALSE);
	}
}