<?php
class bikenews extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->admin	= isAdminLogin();
		$this->load->model('bike_model', 'bike');
		$this->flag_arr	= $this->config->item('flag_arr');
	}

	/**
	 *	@DESC 新闻类别
	 *	@author cntnn11
	 *	@date 2013-10-26
	*/
	function newsCate()
	{
		$list	= $this->bike->getNewsCateList(array(), 0, 0, 'desc');
		$this->list		= $list;
		$this->total	= $total;
		$this->flag_arr	= $this->config->item('flag_arr');

		$this->js_arr	= array('plugins/jquery.dataTables.min.js', 'plugins/jquery.uniform.min.js', 'custom/tables.js');
		$this->display('0921/52bike/news_cate_list');
	}
	
	/**
	 * 商品类别添加和编辑
	 */
	function newsCateEdit()
	{
		$id			= $_GET['id'];
		if($id > 0)
		{
			$info	= $this->bike->getNewsCateInfoById($id);
		}

		$this->flag_arr	= $this->config->item('flag_arr');
		$this->info	= (array)$info;
		$this->display('0921/52bike/news_cate_edit');
	}

	function doEditNewsCate()
	{
		$id		= _pv('id', 0);

		$data['name']	= trim(_pv('model_name'));
		$data['title']	= trim(_pv('title'));
		$data['desc']	= trim(_pv('desc'));
		$data['sortnum']= _pv('sortnum', 0);

		if($id > 0)
		{
			$where['id']	= $id;
			$rs	= $this->bike->updateNewsCate($where, $data);
			$this->_sync($id);
		}
		else
		{
			$data['flag']	= 1;
			$rs	= $this->bike->insertNewsCate($data);
		}
		redirect(BASEURL.'bikenews/newsCate');
	}

	function ajaxNewsCateChangeFlag()
	{
		$id		= $_POST['id'];
		$flag	= $_POST['flag'];
		if($id)
		{
			$this->bike->updateNewsCate(array('id'=>$id), array('flag'=>(int)$flag));
			_ars('OK', TRUE);
		}
		_ars('NO', FALSE);
	}


	/**
	 *	@DES 新闻内容列表
	*/
	function newsList()
	{
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		$reInfo = $where = $totalArr = $count = array();
		$limit			= 25;
		$offset			= isset($_GET['per_page']) ? $_GET['per_page'] : 0;
		$get_params		= '&per_page='.$offset;
		
		if($_GET['title'])
		{
			$like['title']	= $_GET['title'];
			$get_params		.= '&title='.$_GET['title'];
		}
		if($_GET['flag'] != '')
		{
			$where['flag']	= $_GET['flag'];
			$get_params		.= '&flag='.$_GET['flag'];
		}
		if($_GET['cate_id'] != '')
		{
			$where['cate_id']	= $_GET['cate_id'];
			$get_params		.= '&cate_id='.$_GET['cate_id'];
		}
		if($_GET['dates'])
		{
			$where['createdate >=']	= $_GET['dates'].' 00:00:00';
			$get_params		.= '&dates='.$_GET['dates'];
		}
		if($_GET['datee'])
		{
			$where['createdate <=']	= $_GET['datee'].' 23:59:59';
			$get_params		.= '&datee='.$_GET['datee'];
		}

		$this->cate_type	= $this->_getCateArr();
		$bike_list	= $this->bike->getNewsList($where, $like, $offset, $limit);

		if(is_array($bike_list) && !empty($bike_list))
		{
			foreach ($bike_list as $key => $row)
			{
				$bike_list[$key]['cate_name']	= $this->cate_type[$row['cate_id']];
				$row['content']	= strip_tags(htmlspecialchars_decode($row['content']));
				$bike_list[$key]['content']	= strsub($row['content'], 0, 20, 'utf8', '...');
			}
		}
		$bike_total			= $this->bike->getNewsTotal($where, $like);
		$this->page			= pageNew(BASEURL.'bikenews/newsList/?'.$get_params, $bike_total, $offset, $limit);
		$this->lists		= $bike_list;
		$this->get			= $_GET;
		$this->get_params	= urlencode($get_params);

		$this->js_arr	= array('plugins/jquery.dataTables.min.js', 'plugins/jquery.uniform.min.js');
		$this->display('0921/52bike/news_lists');
	}

	function newsEdit()
	{
		$id	= _gv('id', 0);
		if($id)
		{
			$info	= $this->bike->getNewsInfoById($id);
			$info['content']	= htmlspecialchars_decode($info['content']);
		}

		$this->info				= (array)$info;
		$this->cate_type		= $this->_getCateArr(1);
		$this->news_focus_type	= $this->config->item('news_focus_type');
		$this->js_arr			= array('plugins/jquery.dataTables.min.js', 'plugins/jquery.uniform.min.js', 'plugins/jquery.ajaxfileupload.js', 'ueditor/ueditor.all.js', 'ueditor/lang/zh-cn/zh-cn.js');
		$this->display('0921/52bike/news_edit');
	}

	function doEditNewsInfo()
	{
		$id	= _pv('id', 0);
		$get_params	= _pv('get_params');

		$data['title']		= _pv('title', 0);
		$data['cate_id']	= _pv('cate_id', 0);
		$data['focus_type']	= _pv('focus_type', 0);
		$data['focus']		= _pv('upload_focus_val', '');
		$data['author']		= _pv('author', 'admin');
		$data['sortnum']	= _pv('sortnum', 0);
		$data['content']	= htmlspecialchars(_pv('content', ''));
		$data['group_month']= date('Y年n月');

		if($id)
		{
			$upd	= $this->bike->updateNewsInfo(array('id'=>$id), $data);
		}
		else
		{
			$data['flag']	= 0;
			$upd	= $this->bike->insertNewsInfo($data);
		}

		$get_params	= urldecode($get_params);
		if($upd !== FALSE)
		{
			$this->_sync($data['cate_id']);

			$id	= is_numeric($upd)&&$upd>0 ? $upd : $id;
			redirect(BASEURL.'bikenews/newsList?'.$get_params);
		}
		else
		{
			redirect(BASEURL.'other/resultPage?&reurl='.urlencode(BASEURL.'bikenews/newsEdit?id='.$id.'&get_params='.$get_params).'&tip=bikenwesEdit&status=0');
		}

		exit();
	}

	function ajaxNewsChangeFlag()
	{
		$id		= $_POST['id'];
		$flag	= $_POST['flag'];
		if($id)
		{
			$this->bike->updateNewsInfo(array('id'=>$id), array('flag'=>(int)$flag));
			_ars('OK', TRUE);
		}
		_ars('NO', FALSE);
	}

	/**
	 *	@DESC 获取分类数组
	*/
	function _getCateArr($flag = '')
	{
		$data = $cate_date = $where = array();
		if(is_numeric($flag))
		{
			$where['flag >= ']	= (int)$flag;
		}
		$cate_data	= $this->bike->getNewsCateList($where);
		if(is_array($cate_data) && !empty($cate_data))
		{
			foreach ($cate_data as $row)
			{
				if($row['flag'] <= 0)
				{
					$data[$row['id']]	= '(<font class="coRed">分类已删除</font>)'.$row['name'];
				}
				else
				{
					$data[$row['id']]	= $row['name'];
				}
			}
		}
		return $data;
	}

	/**
	 *	@DESC 同步更新新闻分类中的冗余总数字段
	 *	@author cntnn11
	 *	@date 2013-12-24 00:36
	*/
	function _sync($cate_id = 0)
	{
		if($cate_id)
		{
			// 给信息分类同步更新一个冗余字段，统计共有多少篇文章
			$total	= $this->bike->getNewsTotal(array('cate_id'=>$cate_id, 'flag >'=>0));
			$this->bike->updateNewsCate(array('id'=>$cate_id), array('total'=>$total));
		}
	}

}