<?php
class bike extends CI_Controller
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

		$this->video_list	= $this->main->getIndexVideoUrl();

		$this->title	= "KonaChina.com";
		$this->keywords	= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description	= "北京52bike乐骑士自行车店是Kona科纳山地车中国大陆总代理，是北京专业山地车组装车店，最早专业经营自行车组装、单车装备的商家之一。经营Dahon大行、KHS、Birdy等高、中、低档折叠车；进口、国产等各类自行车配件，组装各种山地车、攀爬车、街市车。";
		if(is_file(PUBPATH.'img/pagebg_index.jpg'))
		{
			$this->image	= 'pagebg_index.jpg';
		}
		else
		{
			$this->image	= $this->image;
		}
		$this->page_name	= 'index';
		$this->display('52kona/index');
	}

	/**
	 *	@desc 经销商 静态
	*/
	function dealers()
	{
		$this->title	= "KonaChina.com";
		$this->keywords	= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description	= "京52bike乐骑士自行车店诚邀各地代理商，我们拥有雄厚的实力，专业的技术，以及良好的车友口碑。欢迎加入我们，一起将Kona这个品牌做强做大，让更多的车友体验到Kona山地车的快乐与激情。";
		if(is_file(PUBPATH.'img/pagebg_dealers.jpg'))
		{
			$this->image	= 'pagebg_dealers.jpg';
		}
		else
		{
			$this->image	= $this->image;
		}
		$this->page_name	= 'dealers';
		$this->display('52kona/dealers');
	}

	/**
	 *	@desc 车型列表
	*/
	function bikes()
	{
		
		$year	= $this->uri->segment(2);
		$year_now	= '2014';

		$where['flag >=']	= 1;
		// 接收年份参数
		if($year && $year_now-$year <= 3 && $year_now-$year >= -1)
		{
			$where['year']	= $year;
		}
		else
		{
			$where['year']	= $year_now;
		}

		$bike_lists	= $this->main->getProductList($where);
		$bike_type	= $this->main->getProductCateConf(array('flag >='=>1));
		$lists	= array();
		foreach ($bike_type as $type => $type_str)
		{
			foreach ($bike_lists as $bike_info)
			{
				if($type == $bike_info['type'])
				{
					$lists[$type][]	= $bike_info;
				}
			}
		}

		
		$year_arr	= getYearConf();
		$end		= end($year_arr);
		$temp_total	= $this->main->getProductTotal(array('flag >='=>1, 'year'=>$end));
		if(empty($temp_total))
		{
			array_pop($year_arr);
		}

		$this->lists	= $lists;
		$this->bike_type= $bike_type;
		$this->year		= $where['year'];
		$this->year_arr	= $year_arr;
		$this->title	= "KonaChina.com";
		$this->keywords	= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description	= "来自美国的kona品牌，相信他能带给大家非常棒的骑行感受";
		if(is_file(PUBPATH.'img/pagebg_bikes.jpg'))
		{
			$this->image	= 'pagebg_bikes.jpg';
		}
		else
		{
			$this->image	= $this->image;
		}
		$this->page_name	= 'bikes';
		$this->display('52kona/bikes');
	}

	function detail()
	{
		$id_str	= $this->uri->segment(2);
		if(!strpos($id_str, '.html'))
		{
			redirect('/', 404);
		}
		$this->load->model('main_model', 'main');
		$id	= intval(str_replace('.html', '', $id_str));
		$bike_info	= $this->main->getProductInfoFromId($id);
		if(empty($bike_info) || $bike_info['flag'] < 1)
		{
			redirect('/', 404);
		}

		$bike_type	= $this->main->getProductCateConf();
		$bike_info['type']	= $bike_type[$bike_info['type']];
		$bike_info['desc']	= nl2br($bike_info['desc']);
		for ($i = 0; $i < 6; $i++)
		{
			$virtue_arr = array();
			$virtue_arr	= (array)json_decode($bike_info['virtue'.($i+1)]);
			if(!empty($virtue_arr['tit']) && !empty($virtue_arr['desc']))
			{
				$bike_virtue['virtue'.($i+1)]	= array();
				$bike_virtue['virtue'.($i+1)]['tit']	= $virtue_arr['tit'];
				$bike_virtue['virtue'.($i+1)]['desc']	= $virtue_arr['desc'];
			}
		}

		$this->bike_info	= $bike_info;
		$this->bike_virtue	= $bike_virtue;

		$this->title	= "{$bike_info['name']}_KonaChina.com";
		$this->keywords	= "{$bike_info['name']},KonaChina.com,kona中国,52bike乐骑士";
		$this->description	= strsub($virtue_arr['desc'], 0, 30, 'utf8', '...');
		if(is_file(PUBPATH.'img/pagebg_detail.jpg'))
		{
			$this->image	= 'pagebg_detail.jpg';
		}
		else
		{
			$this->image	= $this->image;
		}
		$this->page_name	= 'bikes';
		$this->display('52kona/detail');
	}

	/**
	 *	@desc 图片墙
	*/
	function gallery()
	{
		$offset	= _gv(2);
		$limit	= 16;
		$this->load->model('main_model', 'main');
		$where['flag >=']	= 1;
		$gallery_lists	= $this->main->getImageList($where, $offset, $limit);
		$gallery_total	= $this->main->getImageTotal($where);
		$this->gallery_lists	= $gallery_lists;
		if(is_file(PUBPATH.'img/pagebg_gallery.jpg'))
		{
			$this->image	= 'pagebg_gallery.jpg';
		}
		else
		{
			$this->image	= $this->image;
		}
		$this->title		= "图片墙_KonaChina.com";
		$this->keywords		= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description	= "kona活动图片，这里展现各个骑行玩家使用kona的精彩表演";
		$this->page_name	= 'gallery';

		$this->page			= pageWeb(WEBURL.'gallery', $gallery_total, $offset, $limit, 2);
		$this->display('52kona/gallery');
	}

	/**
	 *	@desc 俱乐部 静态
	*/
	function club()
	{
		if(is_file(PUBPATH.'img/pagebg_club.jpg'))
		{
			$this->image	= 'pagebg_club.jpg';
		}
		else
		{
			$this->image	= $this->image;
		}
		$this->title	= "越野阳光俱乐部_KonaChina.com";
		$this->keywords	= "越野阳光俱乐部,KonaChina.com,kona中国,52bike乐骑士";
		$this->description	= "越野阳光俱乐部活动图片，这里展现越野阳光骑行玩家们的精彩表演";
		$this->page_name	= 'club';
		$this->display('52kona/club');
	}

	/**
	 *	@desc 联系我们 静态
	*/
	function contact()
	{
		if(is_file(PUBPATH.'img/pagebg_contact.jpg'))
		{
			$this->image	= 'pagebg_contact.jpg';
		}
		else
		{
			$this->image	= $this->image;
		}
		$this->title		= "联系我们_KonaChina.com";
		$this->keywords		= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description	= "吕翔Geoff 手机：130-0107-7266 QQ：1833958 座机：010-84074520 邮箱：geoff_lv@52bike.com";
		$this->page_name	= 'contact';
		$this->display('52kona/contact');
	}

	function news()
	{
		$page_type	= _rsg(3);
		$limit		= 5;

		if($page_type == 'category')
		{
			$cate_id	= _rsg(4);
			$offset		= _rsg(5);
			$page_url	= WEBURL.'news/category/'.$cate_id.'/';
			$page_uri	= 4;
			$where['cate_id']	= $cate_id;
		}
		else
		{
			$offset		= _rsg(3);
			$page_url	= WEBURL.'news';
			$page_uri	= 2;
		}
		$where['flag >']	= 0;

		$lists	= $this->main->getNewsList($where, array(), (int)$offset, (int)$limit);
		$total	= $this->main->getNewsTotal($where);
		if(is_array($lists))
		{
			foreach ($lists as $key => $row)
			{
				$row['content']	= strip_tags(htmlspecialchars_decode($row['content']));
				$lists[$key]['content']	= strsub($row['content'], 0, 125, 'utf8', '...');
				if((int)$row['focus_type'] === 1 && strpos($row['focus'], 'http:') === FALSE)
				{
					$lists[$key]['focus']	= imageUrl($row['focus']);
				}
				$lists[$key]['month']	= date('Y-m', strtotime($row['createdate']));
				$lists[$key]['day']		= date('d', strtotime($row['createdate']));
			}
		}

		$this->month_cn		= $this->month_cn;
		$this->lists		= $lists;
		$this->right_data	= $this->_getNewsRight();
		$this->title		= "新闻_KonaChina.com";
		$this->keywords		= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description	= "关于单车的一切，评测，试骑，发售";
		$this->page_name	= 'news';
		$this->page			= pageWeb($page_url, $total, $offset, $limit, $page_uri);
		$this->display('52kona/news');
	}

	function newsDetail()
	{
		$id	= $this->uri->rsegment(3);
		if(!$id)
		{
			redirect('/', 404);
		}

		$info	= $this->main->getNewsInfoById($id);
		if(!is_array($info) || empty($info))
		{
			redirect('/', 404);
		}
		$info['content']	= htmlspecialchars_decode($info['content']);
		if((int)$info['focus_type'] === 1 && strpos($info['focus'], 'http:') === FALSE)
		{
			$info['focus']	= imageUrl($info['focus']);
		}
		$info['month']	= $this->month_cn[date('n', strtotime($info['createdate']))].'月';
		$info['day']		= date('d', strtotime($info['createdate']));
		$this->info	= $info;

		$this->right_data	= $this->_getNewsRight($info['cate_id']);
		$this->title		= $info['title']."_新闻_KonaChina.com";
		$this->keywords		= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description	= "关于单车的一切，评测，试骑，发售";
		$this->display('52kona/news_detail');
	}
	function _getNewsRight($cate_id = 0)
	{
		$data	= FALSE;
		$data['cate']	= $this->main->getNewsCateList(array('flag >'=>0));
		if($cate_id > 0)
		{
			$where['cate_id']	= $cate_id;
		}
		$data['other']	= $this->main->getNewsList((array)$where, array(), 0, 6);


		return $data;
	}

	/**
	 *	@DESC 单车专用404
	*/
	function notfound()
	{
		$this->display('52kona/404');
	}
}


?>