<?php
class bikes extends CI_Controller
{
	public $bike_tag	= array(
		1	=> array('id'=>1, 'title'=>'山地车', 'en'=>'mountain'),
		2	=> array('id'=>2, 'title'=>'公路车', 'en'=>'road'),
	);


	function __construct()
	{
		parent::__construct();
		$this->load->helpers("url", "util");
		$this->load->model('main_model', 'main');
		$this->date_year	= getyearconf();
		$this->bike_type	= $this->main->getProductCateConf(array('flag >='=>1));
	}

	function index()
	{
		$this->load->model('main_model', 'main');
		$skey					= _gv('skey');

		$where					= $this->_filter( $skey );
		$lists					= $this->main->getProductList($where);
		$bike_total				= $this->main->getProductTotal($where);
		foreach ($this->bike_type as $type => $type_str)
		{
			foreach ($lists as $bike_info)
			{
				$bike_info['image_url']	= unserialize($bike_info['image_url']);
				if($type == $bike_info['type'])
				{
					$bike_lists[$type][]	= $bike_info;
				}
			}
		}

		$_search['year']		= $where['year'];
		$_search['tag_id']		= (int)$where['tag_id'];
		$_search['type']		= (int)$where['type'];

		$this->bike_lists		= $bike_lists;
		$this->bike_total		= $bike_total;
		$this->bike_year		= $this->date_year;
		$this->bike_type		= $this->bike_type;
		$this->bike_tag			= $this->bike_tag;
		$this->search			= $_search;

		$this->title			= "KONA车系_KonaChina.com";
		$this->keywords			= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description		= "Kona车系世界";
		$this->action			= 'bikes';
		$this->css_arr			= array('bikes.css');
		$this->display('52kona_v2/bikes');
	}

	/**
	 *	@desc 筛选
	*/
	function _filter( $skey )
	{
		list($year, $tag_id, $type)	= explode('-', $skey);
		// 主推年代
		$where['year']		= $year ? $year : 2014;
		if( $tag_id )
		{
			$where['tag_id']	= $tag_id;
		}
		if( $type )
		{
			$where['type']		= $type;
		}
		$where['flag >=']	= 1;
		return $where;
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
			$bikes_info				= $this->main->getProductInfoFromId( $slug );
		}
		else
		{
			$slug					= str_replace('_', ' ', $slug);
			$bikes_info				= $this->main->getProductInfoFromName( $slug );
		}
		if( $bikes_info['flag'] <= 0 && $prev != 'bike' )
		{
			exit('没有这款车！');
		}
		$video_list					= $this->_getVideoConf();

		$bikes_info['desc']			= nl2br($bikes_info['desc']);
		$bikes_info['bike_type']	= $this->bike_type[$bikes_info['type']];
		$bikes_info['image_url']	= unserialize($bikes_info['image_url']);
		$bikes_info['index_img']	= $bikes_info['image_url'][0];	// 取第一张作为大图展示
		unset($bikes_info['image_url'][0]);
		
		$bikes_info['more_video']	= unserialize($bikes_info['more_video']);
		if( $bikes_info['more_video'] && is_array($bikes_info['more_video']) )
		{
			foreach ($bikes_info['more_video'] as $key => $video_id)
			{
				$bikes_info['more_video'][$key]	= $video_list[$video_id];
			}
		}
		
		$bikes_info['more_article']	= unserialize($bikes_info['more_article']);
		if( $bikes_info['more_article'] && is_array($bikes_info['more_article']) )
		{
			foreach ($bikes_info['more_article'] as $key => $article_id)
			{
				$article	= $this->main->getNewsInfoById( $article_id );
				$article['createdate']				= date( 'Y-m-d', strtotime($article['createdate']) );
				$bikes_info['more_article'][$key]	= $article;
			}
		}
		
		$bikes_info['virtue']		= unserialize($bikes_info['virtue']);
		$bikes_info['virtue']		= array_filter($bikes_info['virtue']);

		// 找相关车型（同分类下的其他车型）
		$where_other['type']	= $bikes_info['type'];
		$where_other['flag >=']	= 1;
		$other_bikes	= $this->main->getProductList( $where_other );
		if( $other_bikes && is_array($other_bikes) )
		{
			foreach ($other_bikes as $key => $value)
			{
				if( $value['id'] == $bikes_info['id'] )
				{
					unset($other_bikes[$key]);
				}
				else
				{
					$other_bikes[$key]['image_url']	= unserialize($value['image_url']);
				}
			}
			$this->other_bikes	= $other_bikes;
		}

		$this->bikes_info		= $bikes_info;
		$this->title			= "KONA车系_KonaChina.com";
		$this->keywords			= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description		= "Kona车系世界";
		$this->action			= 'bikes';

		$this->css_arr			= array('bike_detail.css');
		$this->js_arr			= array('common.js', );
		$this->display('52kona_v2/bikes_detail');
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