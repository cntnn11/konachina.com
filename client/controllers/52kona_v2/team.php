<?php
class team extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helpers("url", "util");
		$this->load->model('main_model', 'main');
	}

	function index()
	{
		$this->load->model('main_model', 'main');

		$where['flag >']	= 0;
		$team_total			= $this->main->getTeamTotal($where);
		if( $team_total )
		{
			$lists				= $this->main->getTeamList($where);
			foreach ($lists as $key => $value)
			{
				$value['more_image']	= unserialize($value['more_image']);
				$value['more_article']	= unserialize($value['more_article']);
				$value['more_video']	= unserialize($value['more_video']);
				$team_lists[]			= $value;
			}
		}
		$_search['year']	= $where['year'];
		$_search['tag_id']	= (int)$where['tag_id'];
		$_search['type']	= (int)$where['type'];

		$this->team_lists	= $team_lists;
		$this->team_total	= $team_total;

		$this->title		= "KONA车手_KonaChina.com";
		$this->keywords		= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description	= "Kona车手";
		$this->action		= 'team';
		$this->css_arr		= array('team.css');
		$this->display('52kona_v2/team');
	}

	/**
	 *	@desc 车型详情页面
	*/
	function show()
	{
		$slug	= _rsg(3);
		$prev	= _gv('prev');

		$where['flag >']	= 0;
		if( (int)$slug > 0 )
		{
			$driver_info			= $this->main->getTeamInfoFromId( $slug );
		}
		else
		{
			$slug					= str_replace('_', ' ', $slug);
			$driver_info			= $this->main->getTeamInfoFromName( $slug );
		}
		if( $driver_info['flag'] <= 0 && $prev != 'team' )
		{
			exit('抱歉！我们还没有签下这位车手~');
		}
		$video_list					= $this->_getVideoConf();

		$driver_info['desc']		= nl2br($driver_info['desc']);
		
		$more_image					= unserialize($driver_info['more_image']);
		if( $more_image && is_array($more_image) )
		{
			foreach ($more_image as $key => $image_url)
			{
				if( $image_url )
				{
					$more_image[$key]	= strpos($image_url, 'http://')!== FALSE ? $image_url : imageUrl($row['index_img'], 260);
				}
				else
				{
					unset($more_image[$key]);
				}
			}
			$driver_info['index_img']	= $more_image[0];	// 取第一张作为大图展示
			$driver_info['image']		= $more_image;
			$class['image']['class']	= 'tab_current';
			$class['image']['show']		= '';
		}

		$more_video		= unserialize($driver_info['more_video']);
		if( $more_video && is_array($more_video) )
		{
			foreach ($more_video as $key => $video_id)
			{
				$video_info	= $this->main->getViedoFromId( $video_id );
				if( $video_info )
				{
					$driver_info['video'][$key]	= $video_info;
					$class['video']['class']	= $class['image'] ? '' : 'tab_current';
					$class['video']['show']		= $class['image'] ? 'hidden' : '';
				}
			}
		}
		
		$more_article	= unserialize($driver_info['more_article']);
		if( $more_article && is_array($more_article) )
		{
			foreach ($more_article as $key => $article_id)
			{
				$article	= $this->main->getNewsInfoById( $article_id );
				if( $article )
				{
					$article['createdate']					= date( 'Y-m-d', strtotime($article['createdate']) );
					$driver_info['article'][$key]		= $article;
					$class['article']['class']			= $class['image']||$class['video'] ? '' : 'tab_current';
					$class['article']['show']			= $class['image']||$class['video'] ? 'hidden' : '';
				}
			}
		}

		$this->class			= $class;
		$this->driver_info		= $driver_info;
		$this->title			= $driver_info['name']."_KONA中国车队车手_KonaChina.com";
		$this->keywords			= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description		= "Kona签约车手";
		$this->action			= 'team';

		$this->css_arr			= array('team.css');
		$this->js_arr			= array('common.js', 'jquery.colorbox.min.js',);
		$this->display('52kona_v2/team_driver');
	}

	/**
	 *	@desc 获取视频数据
	 *	@date 2014-07-12
	*/
	function _getVideoConf()
	{
		$where['flag >']	= 0;
		$video	= $this->main->getVideoList( $where );
		$data	= false;
		foreach ($video as $key => $value)
		{
			$data[$value['id']]['id']		= $value['id'];
			$data[$value['id']]['title']	= $value['title'];
			$data[$value['id']]['video_url']= $value['video_url'];
		}
		return $data;
	}
}