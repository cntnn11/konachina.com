<?php
class team extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->admin		= isAdminLogin();
		$this->load->model('team_model', 'team');
		$this->flag_arr		= $this->config->item('flag_arr');
	}

	function index()
	{

		parse_str($_SERVER['QUERY_STRING'], $_GET);
		$reInfo = $where = $totalArr = $count = array();
		$limit			= 25;
		$offset			= isset($_GET['per_page']) ? $_GET['per_page'] : 0;
		$get_params		= '&per_page='.$offset;

		$team_list	= $this->team->getTeamList($where, $like, $offset, $limit);
		if(is_array($team_list) && !empty($team_list))
		{
			foreach ($team_list as $key => $row)
			{
				$team_list[$key]['desc']	= strsub($row['desc'], 0, 20, 'utf8', '...');
			}
		}
		$team_total			= $this->team->getTeamTotal($where, $like);
		$this->page			= pageNew(BASEURL.'team/index/?'.$get_params, $team_total, $offset, $limit);
		$this->lists		= $team_list;
		$this->get			= $_GET;
		$this->get_params	= urlencode($get_params);

		$this->js_arr	= array('plugins/jquery.dataTables.min.js', 'plugins/jquery.uniform.min.js');
		$this->display('0921/52bike/team_index');
	}

	function teamEdit()
	{
		$id	= _gv('id', 0);
		if($id)
		{
			$info	= $this->team->getTeamInfoFromId($id);
			$info['content']	= htmlspecialchars_decode($info['content']);
		}
		$info['more_image']		= unserialize($info['more_image']);
		$info['more_video']		= unserialize($info['more_video']);
		$info['more_article']	= unserialize($info['more_article']);
		$this->info				= (array)$info;

		$this->load->model('video_model', 'video');
		$this->load->model('bike_model', 'bike');
		$video_data				= $this->video->getVideoConf();
		$this->video_data		= $video_data;
		$this->video_data_json	= json_encode( $video_data );
		$art_data_result		= $this->bike->getNewsList(array('flag >'=>0));
		if( $art_data_result )
		{
			foreach ($art_data_result as $key => $value)
			{
				$art_data[$value['id']]['id']		= $value['id'];
				$art_data[$value['id']]['title']	= $value['title'];
			}
		}
		$this->art_data			= $art_data;
		$this->art_data_json	= json_encode( (array)$art_data );

		$this->js_arr			= array('plugins/jquery.dataTables.min.js', 'plugins/jquery.uniform.min.js', 'plugins/jquery.ajaxfileupload.js', 'ueditor/ueditor.all.js', 'ueditor/lang/zh-cn/zh-cn.js');
		$this->display('0921/52bike/team_edit');
	}

	function doEditTeamInfo()
	{
		$id						= _pv('id');
		$info					= _pv('info');
		$get_params				= _pv('get_params');
		$data['name']			= $info['name'];
		$data['desc']			= $info['desc'];
		$data['info']			= $info['info'];
		$data['bike_ids']		= $info['bike_ids'];
		$data['sort']			= (int)$info['sort'];	//999999

		$data['more_image']		= serialize( (array)$info['more_image'] );
		$data['more_article']	= serialize( (array)$info['more_article'] );
		$data['more_video']		= serialize( (array)$info['more_video'] );

		if($id > 0)
		{
			//修改
			$upd	= $this->team->updateTeamInfo(array('id'=>$id), $data);
		}
		else
		{
			//添加
			$data['flag']	= 1;
			$upd	= $this->team->insertTeam($data);
		}

		$get_params	= urldecode($get_params);
		if($upd !== FALSE)
		{
			$id	= is_numeric($upd)&&$upd>0 ? $upd : $id;
			redirect(BASEURL.'team/index?'.$get_params);
		}
		else
		{
			redirect(BASEURL.'other/resultPage?&reurl='.urlencode(BASEURL.'team/teamEdit?id='.$id.'&get_params='.$get_params).'&tip=teamEdit&status=0');
		}
	}
}