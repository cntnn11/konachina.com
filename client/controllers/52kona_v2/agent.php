<?php
class agent extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helpers("url", "util");
		$this->load->model('main_model', 'main');
	}

	function index()
	{
		$limit					= 12;
		$page_num				= _rsg(3);
		$offset					= $page_num > 0 ? ($page_num-1)*$limit : 0;
		$this->load->model('main_model', 'main');
		$where['flag >=']		= 1;
		$agent_lists			= $this->main->getAgentList($where);
		$agent_total			= $this->main->getAgentTotal($where);
		$this->agent_lists		= $agent_lists;
		//$this->page				= pageWeb(WEBURL.'agent', $agent_total, $offset, $limit, 2);

		$this->title			= "经销商_KonaChina.com";
		$this->keywords			= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description		= "KonaChina中国经销商代理";
		$this->action			= 'agent';
		$this->css_arr			= array('agent.css');
		$this->display('52kona_v2/agent');
	}
}