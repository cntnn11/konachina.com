<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class finance_model extends CI_Model
{
	const IAE_CATE_TABLE	= 'iae_cate';
	const IAE_DETAILED_TABLE= 'iae_detailed';

	/**
	 *	@DESC 获取收支选项的分类
	 *	@author cntnn11
	 *	@date 2013-09-08
	*/
	function getIaeCateListByWhere($where = array(), $offset = 0, $limit = 0, $sort = 'desc')
	{
		$this->table	= self::IAE_CATE_TABLE;
		$sort			= ($sort == 'desc' ? 'desc' : 'asc');
		return $this->limit($offset, $limit)->orderby(array('iae_add_date'=>$sort))->getAll('*', $where);
	}

	/**
	 *	@DESC 获取收支选项的总记录
	 *	@author cntnn11
	 *	@date 2013-09-08
	*/
	function getIaeCateTotalByWhere($where = array())
	{
		$this->table	= self::IAE_CATE_TABLE;
		return $this->countTable($where);
	}

	/**
	 *	@DESC 获取收支分类的详情
	 *	@author cntnn11
	 *	@date 2013-09-08
	*/
	function getIaeCateInfoById($id = 0)
	{
		$this->table	= self::IAE_CATE_TABLE;
		if($id > 0)
		{
			return $this->getone('*', array('iae_id'=>$id));
		}
		return false;		
	}

	/**
	 *	@DESC 生成一段由cate分类组成配置数组
	 *		格式 array( 'id' => '描述');
	*/
	function genIaeCateConf()
	{
		$data	= array();
		$cate_lists	= $this->getIaeCateListByWhere(array('flag > '=>0));
		if(is_array($cate_lists) && !empty($cate_lists))
		{
			foreach ($cate_lists as $row)
			{
				$data[$row['iae_id']]	= $row['iae_name'];
			}
		}
		return $data;
	}

	/**
	 *	@DESC 通过ID修改分类信息
	 *	@author cntnn11
	 *	@date 2013-09-09
	*/
	function updateIaeCateInfoById($id, $data)
	{
		$this->table	= self::IAE_CATE_TABLE;
		$result	= false;
		if($id > 0)
		{
			$result	= $this->update($data, array('iae_id'=>$id));
		}
		return $result;
	}
	/**
	 *	@DESC 插入一条新的收支分类
	 *	@author cntnn11
	 *	@date 2013-09-09
	*/
	function insertIaeCate($data = array())
	{
		$this->table	 = self::IAE_CATE_TABLE;
		$result	= false;
		if(is_array($data) && !empty($data))
		{
			$result	= $this->insert($data);
		}
		return $result;
	}

	function getFinanceListByWhere($where = array(), $offset = 0, $limit = 0, $sort = 'desc')
	{
		$this->table	= self::IAE_DETAILED_TABLE;
		$sort	= ($sort == 'desc' ? 'desc' : 'asc');
		$data	= $this->limit($offset, $limit)->orderby(array('de_add_date'=>$sort))->getAll('*', $where);
		return $data;
	}
	/**
	 *	@DESC 获取收支记录总数
	*/
	function getFinanaceTotalByWhere($where = array())
	{
		$this->table	= self::IAE_DETAILED_TABLE;
		$data	= 0;
		if(is_array($where))
		{
			$data	= $this->countTable($where);
		}
		return $data;
	}

	/**
	 *	@DESC 获取各个收入、支出、其他属性的总记录数以及总的金额
	 *	@author cntnn11
	 *	@date 2013-09-09
	*/
	function getFinanceTotalGroupByAttr($where = array())
	{
		$this->table	= self::IAE_DETAILED_TABLE;
		$data	= $this->groupby(array('de_attr'))->getAll('`de_attr`, SUM(`de_cost`) `cost`, count(*) `total`', $where);
		return $data;
	}

	/**
	 *	@DESC 根据ID获取财务收支详情
	*/
	function getFinanceInfoById($id = 0)
	{
		$data	= array();
		if($id)
		{
			$this->table	= self::IAE_DETAILED_TABLE;
			$data	= $this->getone('*', array('de_id'=>$id));
		}
		return $data;
	}

	/**
	 *	@ESC 通过记录ID修改财务详情
	*/
	function updFinanceDetailById($id, $array = array())
	{
		$data	 = false;
		if($id > 0)
		{
			$this->table	= self::IAE_DETAILED_TABLE;
			$data	= $this->update($array, array('de_id'=>$id));
		}
		return $data;
	}

	/**
	 *	@DESC 插入一条数据
	*/
	function insFinanceDetail($array)
	{
		$data	= false;
		if(isset($array) && is_array($array) && !empty($array))
		{
			$this->table	= self::IAE_DETAILED_TABLE;
			$data	= $this->insert($array);
		}
		return $data;
	}

}
?>