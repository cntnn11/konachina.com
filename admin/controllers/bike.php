<?php
class bike extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->admin	= isAdminLogin();
		$this->load->model('bike_model', 'bike');
		$this->flag_arr	= $this->config->item('flag_arr');
	}

	function video()
	{
		if(isset($_POST['info']) && !empty($_POST['info']))
		{
			$data['url1']	= trim($_POST['info']['url1']);
			$data['url2']	= trim($_POST['info']['url2']);
			$data['url3']	= trim($_POST['info']['url3']);
			$data['url_index']	= trim($_POST['info']['url_index']);
			$this->bike->updateIndexVideoUrl($data);
		}
		if(isset($data) && !empty($data) && is_array($data))
		{
			$this->info	= $data;
		}
		else
		{
			$info	= $this->bike->getIndexVideoUrl();
			$this->info	= $info;
		}
		$this->display('0921/52bike/video_edit');
	}
	function doEditVideo()
	{
		$data['url1']	= trim(_pv('url1'));
		$data['url2']	= trim(_pv('url2'));
		$data['url3']	= trim(_pv('url3'));
		$data['url_index']	= trim(_pv('url_index'));
		$this->bike->updateIndexVideoUrl($data);
		redirect(BASEURL.'bike/video');
	}


	/**
	 *	@DESC 图片集
	*/
	function imageList()
	{
		$where = $search = array();
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		$reInfo = $where = $search = $totalArr = $count = array();
		$limit			= 15;
		$offset			= isset($_GET['per_page']) ? $_GET['per_page'] : 0;
		$get_params		= '&per_page='.$offset;

		if($_GET['flag'] != '')
		{
			$where['flag']	= $_GET['flag'];
			$get_params		.= '&flag='.$_GET['flag'];
		}

		$lists			= $this->bike->getImageList($where, $offset, $limit);
		$total			= $this->bike->getImageTotal($where);
		
		$this->lists	= $lists;
		$this->get		= $_GET;
		$this->page		= pageNew(BASEURL.'bike/imageList/?'.$get_params, $total, $offset, $limit);
		$this->get_params= urlencode($get_params);
		$this->js_arr	= array('plugins/jquery.dataTables.min.js', 'plugins/jquery.uniform.min.js', 'plugins/jquery.ajaxfileupload.js', 'plugins/jquery.alerts.js', 'custom/tables.js');
		$this->display('0921/52bike/img_lists');
	}

	function ajaxDoEditImage()
	{
		$id	= _pv('id');
		$title		= _pv('title', '');
		$file_path	= _pv('file_path', '');

		if(!$file_path)
		{
			_ars('需要上传一张图片！', FALSE);
		}

		$data['title']		= $title;
		$data['image_url']	= $file_path;
		if($id > 0)
		{
			$rs	= $this->bike->updateImageInfo(array('id'=>$id), $data);
		}
		else
		{
			$data['flag']	= 1;
			$rs	= $this->bike->insertImage($data);
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
	function ajaxChangeFlagImageLists()
	{
		$id		= _pv('id', 0);
		$flag	= _pv('flag');
		if($id)
		{
			$this->bike->updateImageInfo(array('id'=>$id), array('flag'=>(int)$flag));
			_ars('OK', TRUE);
		}
		_ars('NO', FALSE);
	}

	function bikeCateList()
	{
		$list	= $this->bike->getProductCateList(array(), 0, 0, 'desc');
		$total	= $this->bike->getProductCateTotal();

		$this->list		= $list;
		$this->total	= $total;
		$this->flag_arr	= $this->config->item('flag_arr');

		$this->js_arr	= array('plugins/jquery.dataTables.min.js', 'plugins/jquery.uniform.min.js', 'custom/tables.js');
		$this->display('0921/52bike/bike_cate_list');
	}
	
	/**
	 * 商品类别添加和编辑
	 */
	function bikeCateEdit()
	{
		$id			= $_GET['id'];
		if(isset($id))
		{
			$info	= $this->bike->getProductCateInfo($id, '*');
		}

		$this->flag_arr	= $this->config->item('flag_arr');
		$this->info	= (array)$info;
		$this->display('0921/52bike/bike_cate_edit');
	}

	function doEditBikeCate()
	{
		$id		= _pv('id', 0);

		$data['model_name']	= trim(_pv('model_name'));
		$data['description']= _pv('description');
		$data['sort']		= _pv('sort', 1000);

		if($id > 0)
		{
			$rs	= $this->bike->updateCate($id, $data);
		}
		else
		{
			$data['flag']	= 1;
			$rs	= $this->bike->insetCate($data);
		}
		redirect(BASEURL.'bike/bikeCateList');
	}

	function ajaxBikeCateChangeFlag()
	{
		$id		= $_POST['id'];
		$flag	= $_POST['flag'];
		if($id)
		{
			$this->bike->updateCate($id, array('flag'=>(int)$flag));
			_ars('OK', TRUE);
		}
		_ars('NO', FALSE);
	}


	function bikeList()
	{
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		$reInfo = $where = $totalArr = $count = array();
		$limit			= 25;
		$offset			= isset($_GET['per_page']) ? $_GET['per_page'] : 0;
		$get_params		= '&per_page='.$offset;

		if($_GET['bikename'])
		{
			$like['name']	= $_GET['bikename'];
			$get_params		.= '&bikename='.$_GET['bikename'];
		}
		if($_GET['flag'] != '')
		{
			$where['flag']	= $_GET['flag'];
			$get_params		.= '&flag='.$_GET['flag'];
		}
		if($_GET['year'] != '')
		{
			$where['year']	= $_GET['year'];
			$get_params		.= '&year='.$_GET['year'];
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
		$bike_list	= $this->bike->getProductList($where, $like, $offset, $limit);

		if(is_array($bike_list) && !empty($bike_list))
		{
			foreach ($bike_list as $key => $row)
			{
				$bike_list[$key]['desc']	= strsub($row['desc'], 0, 20, 'utf8', '...');
			}
		}
		$bike_total			= $this->bike->getProductLikeTotal($where, $like);
		$this->page			= pageNew(BASEURL.'bike/bikeList/?'.$get_params, $bike_total, $offset, $limit);
		$this->year_conf	= $this->_getYearConf();
		$this->lists		= $bike_list;
		$this->get			= $_GET;
		$this->get_params	= urlencode($get_params);

		$this->js_arr	= array('plugins/jquery.dataTables.min.js', 'plugins/jquery.uniform.min.js');
		$this->display('0921/52bike/bike_list');
	}

	function bikeEdit()
	{
		$id	= _gv('id');
		if($id > 0)
		{
			$info	= $this->bike->getProductInfoFromId($id);
			if(is_array($info) && !empty($info))
			{
				//循环处理亮点
				for ($i = 0; $i <= 5; $i++)
				{
					$key	= 'virtue'.($i+1);
					$info[$key]	= (array)json_decode($info[$key]);
				}
			}
		}

		$this->info	= (array)$info;
		$this->cate_type	= $this->_getCateArr();
		$this->year_conf	= $this->_getYearConf();
		$this->get_params	= urlencode(_gv('get_params'));

		$this->js_arr	= array('plugins/jquery.dataTables.min.js', 'plugins/jquery.uniform.min.js', 'plugins/jquery.ajaxfileupload.js');
		$this->display('0921/52bike/bike_edit');
	}

	function doEditBikeInfo()
	{
		$id		= _pv('id');
		$info	= _pv('info');
		$get_params	= _pv('get_params');
		$data['type']	= _pv('type');
		$data['year']	= _pv('year');
		$data['image_url']	= _pv('upload_fileToUpload');
		$data['pdf_url']	= _pv('pdf_url');

		$data['name']	= $info['b_name'];
		$data['price']	= $info['price'];
		$data['desc']	= $info['desc'];
		$data['detail_url']	= $info['detail_url'];
		$data['sort']	= empty($info['sort']) ? 0 : (int)$info['sort'];	//999999

		//循环获取亮点
		for ($i = 0; $i < 6; $i++)
		{
			if(!empty($info['virtue'.($i+1)]))
			{
				$key	= 'virtue'.($i+1);
				$virtue_arr	= $info[$key];
				$data[$key]	= json_encode($virtue_arr);
			}
		}

		if($id > 0)
		{
			//修改
			$upd	= $this->bike->updateProductInfo(array('id'=>$id), $data);
		}
		else
		{
			//添加
			$data['flag']	= 1;
			$upd	= $this->bike->insertProduct($data);
		}

		$get_params	= urldecode($get_params);
		if($upd !== FALSE)
		{
			$id	= is_numeric($upd)&&$upd>0 ? $upd : $id;
			redirect(BASEURL.'bike/bikeList?'.$get_params);
		}
		else
		{
			redirect(BASEURL.'other/resultPage?&reurl='.urlencode(BASEURL.'bike/bikeEdit?id='.$id.'&get_params='.$get_params).'&tip=bikeEdit&status=0');
		}
	}


	/**
	 *	@DESC 获取分类数组
	*/
	function _getCateArr()
	{
		$data = $cate_date = array();
		$cate_data	= $this->bike->getProductCateList(array('flag >'=>0));
		if(is_array($cate_data) && !empty($cate_data))
		{
			foreach ($cate_data as $row)
			{
				$data[$row['id']]	= $row['model_name'];
			}
		}
		return $data;
	}

	function ajaxBikeChangeFlag()
	{
		$id		= $_POST['id'];
		$flag	= $_POST['flag'];
		if($id)
		{
			$this->bike->updateProductInfo(array('id'=>$id), array('flag'=>(int)$flag));
			_ars('OK', TRUE);
		}
		_ars('NO', FALSE);
	}

	/**
	 *	@DESC 获取年份配置，从2012年开始
	 *	@author cntnn11
	*/
	function _getYearConf()
	{
		$year_start	= "2012";
		$year_now	= date("Y");
		$year_end	= $year_now+1;
		$year_arr	= range($year_start, $year_end);
		return array_combine($year_arr, $year_arr);
	}

	/**
	 *	@DESC 经销商/加盟商后台操作
	 *	@date 2014-01-31
	*/
	function shop()
	{
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		$reInfo = $where = $totalArr = $count = array();
		$limit			= 25;
		$offset			= isset($_GET['per_page']) ? $_GET['per_page'] : 0;
		$get_params		= '&per_page='.$offset;

		if($_GET['dates'])
		{
			$where['createdate >=']	= $_GET['dates'].' 00:00:00';
			$get_params				.= '&dates='.$_GET['dates'];
		}
		if($_GET['datee'])
		{
			$where['createdate <=']	= $_GET['datee'].' 23:59:59';
			$get_params				.= '&datee='.$_GET['datee'];
		}
		if($_GET['flag'] != '')
		{
			$where['flag']			= $_GET['flag'];
			$get_params				.= '&flag='.$_GET['flag'];
		}
		if($_GET['shopname'])
		{
			$like['name']			= $_GET['shopname'];
			$get_params				.= '&shopname='.$_GET['shopname'];
		}
		if($_GET['provice_id'] > 0)
		{
			$where['provice_id']		= $_GET['provice_id'];
			$get_params				.= '&provice_id='.$_GET['provice_id'];
		}
		if($_GET['city_id'] > 0)
		{
			$where['city_id']		= $_GET['city_id'];
			$get_params				.= '&city_id='.$_GET['city_id'];
		}
		if($_GET['town_id'] > 0)
		{
			$where['town_id']		= $_GET['town_id'];
			$get_params				= '&town_id='.$_GET['town_id'];
		}

		//$bike_list	= $this->bike->getProductList($where, $like, $offset, $limit);
		/*if(is_array($bike_list) && !empty($bike_list))
		{
			foreach ($bike_list as $key => $row)
			{
				$bike_list[$key]['desc']	= strsub($row['desc'], 0, 20, 'utf8', '...');
			}
		}
		$bike_total			= $this->bike->getProductLikeTotal($where, $like);*/
		$this->page			= pageNew(BASEURL.'bike/shop/?'.$get_params, $total, $offset, $limit);
		$this->lists		= $shop_list;
		$this->get			= $_GET;
		$this->get_params	= urlencode($get_params);

		$this->js_arr	= array('plugins/jquery.dataTables.min.js', 'plugins/jquery.uniform.min.js');
		$this->display('0921/52bike/shop_list');
	}

	/**
	 *	@DESC 经销商信息编辑
	 *	@date 2014-01-31
	*/
	function shopEdit()
	{
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		$id	= $_GET['id'];

		if($id)
		{
			$info	= $this->bike->getShopInfoById($id);
		}

		$this->id	= $id;
		$this->info	= (array)$info;
		$this->js_arr	= array('plugins/jquery.uniform.min.js', 'plugins/jquery.ajaxfileupload.js', 'plugins/jquery.validate.min.js');
		$this->display('0921/52bike/shop_edit');
	}
}