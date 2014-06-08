<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class bike_model extends CI_Model
{
	//数据表
	const PRODUCT_TABLE			= 'qy_bike';
	const PRODUCTCATE_TABLE		= 'qy_product_cate';
	const PRODUCTIMAGES_TABLE	= 'qy_product_images';
	const VIDEO_INDEXURL_TABLE	= 'qy_video_indexurl';	// 废弃不用，包括所属方法
	const IMAGES_TABLE			= 'qy_images';
	const BIKENEWSCATE_TABLE	= 'bike_news_cate';
	const BIKENEWS_TABLE		= 'bike_news';
	const BIKESHOP_TABLE		= 'bike_shop';

	public $bikeDB	= '';

	function __construct()
	{
		$this->bikeDB	= $this->load->database('bike');
	}

	/**
	 *	@desc 获取车型分类列表
	*/
	function getProductCateList($where = array(), $offset = 0, $limit = 0, $sort = 'asc')
	{
		$this->table	= self::PRODUCTCATE_TABLE;
		return $this->orderby(array('createdate'=>$sort))->limit($offset, $limit)->getall('*', $where);
	}
	function getProductCateTotal($where = array())
	{
		$this->table	= self::PRODUCTCATE_TABLE;
		return $this->countTable($where);
	}
	function getProductCateInfo($id = 0, $field = '*')
	{
		if($id)
		{
			$this->table	= self::PRODUCTCATE_TABLE;
			return $this->getone($field, array('id'=>$id));
		}
		return FALSE;
	}
	function updateCate($id, $data = array())
	{
		if(is_array($data) && !empty($data) && intval($id))
		{
			$this->table	= self::PRODUCTCATE_TABLE;
			return $this->update($data, array('id'=>$id));
		}
		else
		{
			return FALSE;
		}
	}
	function insetCate($data)
	{
		if(is_array($data) && !empty($data))
		{
			$this->table	= self::PRODUCTCATE_TABLE;
			return $this->insert($data);
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 *	@DESC 获取车型的列表
	*/
	function getProductList($where = array(), $like = array(), $offset = 0, $limit = 0)
	{
		$this->table	= self::PRODUCT_TABLE;
		return $this->limit($offset, $limit)->like($like)->orderby(array('sort'=>'asc','createdate'=>'desc'))->getall('*', $where);
	}
	/* 有like查询的统计 */
	function getProductLikeTotal($where = array(), $like = array())
	{
		$this->table	= self::PRODUCT_TABLE;
		if(is_array($where) && !empty($where))
		{
			$this->db->where($where);
		}
		if(is_array($like) && !empty($like))
		{
			$this->db->like($like);
		}
		$data = $this->db->count_all_results(self::PRODUCT_TABLE);
		return (int)$data;
	}
	function getProductTotal($where = array())
	{
		$this->table	= self::PRODUCT_TABLE;
		return $this->countTable($where);
	}

	/**
	 *	@DESC 获取产品的详细数据
	 *		只接受一个ID做为参数
	*/
	function getProductInfoFromId($prod_id = 0)
	{
		$this->table	= self::PRODUCT_TABLE;
		return $this->getone('*', array('id'=>$prod_id));
	}

	/**
	 * @DESC 多条件修改产品的信息
	*/
	function updateProductInfo($where = array(), $data = array())
	{
		$this->table	= self::PRODUCT_TABLE;
		return $this->update($data, $where);
	}

	/**
	 * @DESC 插入一条产品信息
	*/
	function insertProduct($data = array())
	{
		$this->table	= self::PRODUCT_TABLE;
		return $this->insert($data);
	}

	/**
	 *	@DESC 获取自行车首页的视频链接
	*/
	function getIndexVideoUrl()
	{
		$this->table	= self::VIDEO_INDEXURL_TABLE;
		return $this->getone('*', array('id'=>1));
	}
	/**
	 *	@DESC 修改自行车首页的视频链接
	*/
	function updateIndexVideoUrl($data = array())
	{
		$this->table	= self::VIDEO_INDEXURL_TABLE;
		return $this->update($data, array('id'=>1));
	}

	// -----------------------------自行车图片集 开始-------------------------------------------
	/**
	 *	@DESC 获取图片的列表
	*/
	function getImageList($where = array(), $offset = 0, $limit = 0)
	{
		$this->table	= self::IMAGES_TABLE;
		return $this->limit($offset, $limit)->orderby(array('id'=>'desc'))->getall('*', $where);
	}
	function getImageTotal($where = array())
	{
		$this->table	= self::IMAGES_TABLE;
		return $this->countTable($where);
	}

	/**
	 *	@DESC 获取图片信息
	 *		只接受一个ID做为参数
	*/
	function getImageInfoFromId($id = 0)
	{
		$this->table	= self::IMAGES_TABLE;
		return $this->getone('*', array('id'=>$id));
	}

	/**
	 * @DESC 多条件修改图片的信息
	*/
	function updateImageInfo($where = array(), $data = array())
	{
		$this->table	= self::IMAGES_TABLE;
		return $this->update($data, $where);
	}

	/**
	 * @DESC 插入一条图片信息
	*/
	function insertImage($data = array())
	{
		$this->table	= self::IMAGES_TABLE;
		return $this->insert($data);
	}
	// -----------------------------自行车图片集 结束-------------------------------------------

	// -----------------------------自行车新闻 开始-------------------------------------------
	function getNewsCateList($where = array(), $offset = 0, $limit = 0, $sort = 'desc')
	{
		$this->table	= self::BIKENEWSCATE_TABLE;
		return $this->orderby(array('createdate'=>$sort))->limit($offset, $limit)->getall('*', $where);
	}
	function getNewsCateInfoById($id)
	{
		$data	= FALSE;
		if($id > 0)
		{
			$this->table	= self::BIKENEWSCATE_TABLE;
			$data	= $this->getone('*', array('id'=>$id));
		}
		return $data;
	}
	function updateNewsCate($where = array(), $data = array())
	{
		$result	= FALSE;
		if($where && $data)
		{
			$this->table	= self::BIKENEWSCATE_TABLE;
			$result	= $this->update($data, $where);
		}
		return $result;
	}
	function insertNewsCate($data)
	{
		$insert_id	= FALSE;
		if(is_array($data) && !empty($data))
		{
			$this->table	= self::BIKENEWSCATE_TABLE;
			$insert_id	= $this->insert($data);
		}
		return $insert_id;
	}

	function getNewsList($where = array(), $like = array(), $offset = 0, $limit = 0)
	{
		$this->table	= self::BIKENEWS_TABLE;
		return $this->limit($offset, $limit)->like($like)->orderby(array('sortnum'=>'asc','createdate'=>'desc'))->getall('*', $where);
	}
	function getNewsTotal($where = array(), $like = array())
	{
		$this->table	= self::BIKENEWS_TABLE;
		return $this->like($like)->countTable($where);
	}
	function getNewsInfoById($id = 0)
	{
		$data	= FALSE;
		if($id > 0)
		{
			$this->table	= self::BIKENEWS_TABLE;
			$data	= $this->getone('*', array('id'=>$id));
		}
		return $data;
	}
	function updateNewsInfo($where = array(), $field = array())
	{
		$data	= FALSE;
		if($where && is_array($where) && $field && is_array($field))
		{
			$this->table	= self::BIKENEWS_TABLE;
			$data	= $this->update($field, $where);
		}
		return $data;
	}
	function insertNewsInfo($field)
	{
		$data	= FALSE;
		if($field && is_array($field))
		{
			$this->table	= self::BIKENEWS_TABLE;
			$data	= $this->insert($field);
		}
		return $data;
	}
	// -----------------------------自行车新闻 结束-------------------------------------------


	// -----------------------------经销商管理 开始-------------------------------------------
	function getShopList($where = array(), $like = array(), $offset = 0, $limit = 25)
	{
		$this->table	= self::BIKESHOP_TABLE;
		return $this->limit($offset, $limit)->like($like)->orderby(array('sort'=>'desc','createdate'=>'desc'))->getall('*', $where);
	}
	function getShopTotal($where = array(), $like = array(), $offset = 0, $limit = 25)
	{
		$this->table	= self::BIKESHOP_TABLE;
		return $this->like($like)->countTable($where);
	}
	function getShopInfoById($id = 0, $field = '*')
	{
		if($id > 0)
		{
			$this->table	= self::BIKESHOP_TABLE;
			return $this->getone($field, array('id'=>$id));
		}
		return FALSE;
	}
	function updateShopInfoById($id, $data = array())
	{
		if(is_array($data) && !empty($data) && intval($id) > 0)
		{
			$this->table	= self::BIKESHOP_TABLE;
			return $this->update( $data, array('id'=>$id) );
		}
		return FALSE;
	}
	function insertShopInfo($data)
	{
		if(is_array($data) && $data)
		{
			$this->table	= self::BIKESHOP_TABLE;
			return $this->insert($data);
		}
		return FALSE;
	}
	// -----------------------------经销商管理 结束-------------------------------------------

}
?>