<?php
class news extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helpers("url", "util");
		$this->load->model('main_model', 'main');
		
	}

	function index()
	{
		$limit					= 10;
		$this->load->model('main_model', 'main');
		$page_num				= 0;
		$page_url				= '/page';
		if( _rsg(3) == 'category' )
		{
			$where['cate_id']	= str_replace( '.html', '', _rsg(4) );
			$page_url			= '/category/'.$where['cate_id'].$page_url;
			if( _rsg(6) )
			{
				$page_num		= str_replace( '.html', '', _rsg(6) );
				$page_uri		= 5;
			}
			
		}
		else if( _rsg(3) == 'page')
		{
			$page_num			= str_replace( '.html', '', _rsg(4) );
			$page_uri			= 3;
		}
		$offset					= $page_num > 0 ? ($page_num-1)*$limit : 0;

		$where['flag >']		= 0;
		$news_total				= $this->main->getNewsTotal($where);
		if( $news_total )
		{
			$lists					= $this->main->getNewsList($where, array(), $offset, $limit);
			foreach ($lists as $key => $value)
			{
				$value['month']		= date('Y-m', strtotime($value['createdate']) );
				$value['day']		= date('d', strtotime($value['createdate']) );
				$value['content']	= mb_substr(strip_tags(htmlspecialchars_decode($value['content'])), 0, 200, 'utf-8');
				$lists[$key]		= $value;
			}
		}
		$this->page				= pageWeb(WEBURL.'news/'.$page_url, $news_total, $offset, $limit, $page_uri);

		// 近期新闻，取最新的11篇，去掉当前
		$where_last['flag >']	= 0;
		$news_last				= $this->main->getNewsList($where_last, array(), $offset, 11);
		$this->news_last		= $news_last;

		// 推荐车型
		$adv_bike				= $this->main->getRecommend(2);
		$this->adv_bike			= $adv_bike;

		$this->news_cate		= $this->_getCateConf();
		$this->news_lists		= $lists;
		$this->news_total		= $news_total;

		$this->title			= "KONA车系_KonaChina.com";
		$this->keywords			= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description		= "Kona车系世界";
		$this->action			= 'news';
		$this->css_arr			= array('news.css');
		$this->display('52kona_v2/news');
	}

	function show()
	{
		$slug	= _rsg(3);
		$prev	= _gv('prev');

		$news_info				= $this->main->getNewsInfoById( $slug );
		if( $news_info['flag'] <= 0 && $prev != 'news' )
		{
			exit('没有篇新闻哦，看看其他的吧！');
		}
		$news_info['month']		= date('Y-m', strtotime($news_info['createdate']) );
		$news_info['day']		= date('d', strtotime($news_info['createdate']) );
		$news_info['content']	= htmlspecialchars_decode($news_info['content']);

		$this->news_cate		= $this->_getCateConf();
		$this->news_info		= $news_info;

		// 相关新闻
		$where_other['cate_id']	= $news_info['cate_id'];
		$news_other				= $this->main->getNewsList($where_other, 0, 11);
		$this->news_other		= $news_other;

		// 推荐车型
		$adv_bike				= $this->main->getRecommend(2);
		$this->adv_bike			= $adv_bike;

		$this->title			= $news_info['name']."_KONA新闻_KonaChina.com";
		$this->keywords			= "KonaChina.com,kona中国,52bike乐骑士";
		$this->description		= "Kona车系世界";
		$this->action			= 'news';
		$this->css_arr			= array('news.css');
		$this->display('52kona_v2/news_detail');
	}

	function _getCateConf()
	{
		$where['flag > ']	= 0;
		$lists	= $this->main->getNewsCateList($where);
		if( $lists && is_array($lists) )
		{
			foreach ($lists as $key => $value)
			{
				$value['name_s']	= mb_substr($value['name'], 0, 15, 'utf-8');
				$data[$value['id']]	= $value;
			}
		}
		return $data;
	}
}