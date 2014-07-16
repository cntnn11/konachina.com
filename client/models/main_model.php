<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class main_model extends CI_Model
{
	//数据表
	const PRODUCT_TABLE			= 'qy_bike';
	const PRODUCTCATE_TABLE		= 'qy_product_cate';
	const VIDEO_INDEXURL_TABLE	= 'qy_video_indexurl';
	const IMAGES_TABLE			= 'qy_images';
	const BIKENEWSCATE_TABLE	= 'bike_news_cate';
	const BIKENEWS_TABLE		= 'bike_news';
	const RECOMMEND_TABLE		= 'recommend';
	const VIDEO_TABLE			= 'qy_video';
	const BIKESHOP_TABLE		= 'bike_shop';
	const TEAM_TABLE			= 'qy_team';

	/**
	 *	@desc 获取车型分类列表
	*/
	function getProductCateList($where = array(), $offset = 0, $limit = 0, $sort = 'asc')
	{
		$this->table	= self::PRODUCTCATE_TABLE;
		return $this->limit($offset, $limit)->orderby(array('sort'=>'desc', 'id'=>'desc'))->getall('*', $where);
	}
	/**
	 *	@DESC 获取产品类型的分类配置数组
	*/
	function getProductCateConf()
	{
		$cate_arr	= array();
		$cate_list	= $this->getProductCateList();
		foreach ($cate_list as $row)
		{
			$cate_arr[$row['id']]['id']		= $row['id'];
			$cate_arr[$row['id']]['title']	= $row['model_name'];
		}
		return $cate_arr;
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

	/**
	 *	@DESC 获取车型的列表
	*/
	function getProductList($where = array(), $offset = 0, $limit = 0)
	{
		$this->table	= self::PRODUCT_TABLE;
		$data	= $this->limit($offset, $limit)->orderby(array('createdate'=>'asc','year'=>'desc','sort'=>'desc'))->getall('*', $where);
		return $data;
	}
	function getProductTotal($where = array())
	{
		$this->table	= self::PRODUCT_TABLE;
		$data	= $this->countTable($where);
		return $data;
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
	function getProductInfoFromName($prod_id = 0)
	{
		$this->table	= self::PRODUCT_TABLE;
		return $this->getone('*', array('name'=>$prod_id));
	}

	/**
	 *	@DESC 获取视频链接
	*/
	function getIndexVideoUrl()
	{
		$this->table	= self::VIDEO_INDEXURL_TABLE;
		return $this->getone('*', array('id'=>1));
	}

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
	 *	@DESC 只是修改url链接
	*/
	function updateUrl($id, $url)
	{
		$result = FALSE;
		if($id && $url)
		{
			$result	= $this->update(array('detail_url'=>$url), array('id'=>$id));
		}
		return $result;
	}


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
	function getNewsList($where = array(), $like = array(), $offset = 0, $limit = 0)
	{
		$this->table	= self::BIKENEWS_TABLE;
		return $this->limit($offset, $limit)->like($like)->orderby(array('sortnum'=>'desc','createdate'=>'desc'))->getall('*', $where);
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
			$data	= $this->getone('*', array('flag >'=> 0, 'id'=>$id));
		}
		return $data;
	}
	

	/**
	 *	@desc 获取首页推荐位置的广告图
	 *	@author cntnn11
	 *	@date 2014-07-10
	*/
	function getRecommend( $location = 0, $limit = 5 )
	{
		$data	= FALSE;
		if( $location )
		{
			$this->table		= self::RECOMMEND_TABLE;
			$where['location']	= $location;
			$data				= $this->limit($offset, $limit)->orderby(array('sort'=>'desc', 'id'=>'desc'))->getall('*', $where);
		}
		return $data;
	}

	/**
	 *	@DESC 获取视频数据
	 *	@author cntnn11
	 *	@date 2014-07-11
	*/
	function getVideoList($where = array(), $offset = 0, $limit = 0)
	{
		$this->table	= self::VIDEO_TABLE;
		return $this->limit($offset, $limit)->orderby(array('id'=>'desc'))->getall('*', $where);
	}
	function getVideoTotal($where = array())
	{
		$this->table	= self::VIDEO_TABLE;
		return $this->countTable($where);
	}
	function getViedoFromId($id = 0)
	{
		$this->table	= self::VIDEO_TABLE;
		return $this->getone('*', array('id'=>$id));
	}

	/**
	 *	@DESC 获取视频数据
	 *	@author cntnn11
	 *	@date 2014-07-11
	*/
	function getAgentList($where = array(), $offset = 0, $limit = 0)
	{
		$this->table	= self::BIKESHOP_TABLE;
		return $this->limit($offset, $limit)->orderby(array('id'=>'desc'))->getall('*', $where);
	}
	function getAgentTotal($where = array())
	{
		$this->table	= self::BIKESHOP_TABLE;
		return $this->countTable($where);
	}

	/**
	 *	@DESC 初始化52kona_v2版的数据
	*/
	function updateV2Data($id, $data)
	{
		$result = FALSE;
		if($id)
		{
			$result	= $this->update($data, array('id'=>$id));
		}
		return $result;
	}

	/**
	 *	@DESC 获取车手的列表
	*/
	function getTeamList($where = array(), $offset = 0, $limit = 0)
	{
		$this->table	= self::TEAM_TABLE;
		$data	= $this->limit($offset, $limit)->orderby(array('sort'=>'desc', 'id'=>'desc'))->getall('*', $where);
		return $data;
	}
	function getTeamTotal($where = array())
	{
		$this->table	= self::TEAM_TABLE;
		$data	= $this->countTable($where);
		return $data;
	}
	/**
	 *	@DESC 获取产品的详细数据
	 *		只接受一个ID做为参数
	*/
	function getTeamInfoFromId($id = 0)
	{
		$this->table	= self::TEAM_TABLE;
		return $this->getone('*', array('id'=>$id));
	}
	function getTeamInfoFromName($name = 0)
	{
		$this->table	= self::TEAM_TABLE;
		return $this->getone('*', array('name'=>$name));
	}

}
?>