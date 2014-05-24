<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

class CI_Model
{
	protected $in;
	protected $like;
	protected $orderby;
	protected $groupby;
	protected $limit;
	protected $where;
	/**
	 * Constructor
	 *
	 * @access public
	 */
	function __construct()
	{
		log_message('debug', "Model Class Initialized");
	}

	/**
	 * __get
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string
	 * @access private
	 */
	function __get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	
	/**
	 * notin查询，分and和or
	 * @param array $array
	 * @param str $type
	 * @return CI_Model|boolean $this
	 *	array('field1'=>'value1', 'field2'=>'value2')
	 *	array('field'=>array(value1, value2))
	 */
	function notin($array, $type='and')
	{
		if(is_array($array) && !empty($array))
		{
			if($type == 'or')
			{
				foreach($array as $k => $v)
				{
					if(!empty($v))
					{	$this->db->or_where_not_in($k, $v);	}
				}
			}
			else
			{
				foreach($array as $k => $v)
				{
					if(!empty($v))
					{	$this->db->where_not_in($k, $v);	}
				}
			}
			return $this;
		}
	}
	
	/**
	 * in查询，分and和or
	 * @param array $array
	 * @param string $type
	 * @return CI_Model|boolean
	 * 	array('field1'=>'value1', 'field2'=>'value2')|
	 *	array('field'=>array(value1, value2))
	 */
	function in($array, $type='and')
	{
		if(is_array($array) && !empty($array))
		{
			if($type == 'or')
			{
				foreach($array as $k => $v)
				{
					if(!empty($v))
					{	$this->db->or_where_in($k, $v);	}
				}
			}
			else
			{
				foreach($array as $k => $v)
				{
					if(!empty($v))
					{	$this->db->where_in($k, $v);	}
				}
			}
			return $this;
		}
		else
		{	return false;	}
	}
	
	/**
	 * not like()
	 * @param array $array
	 * @param string $type and/or
	 * @param string $dis both/before/after
	 * 	array('field1'=>'value1', 'field2'=>'value2')
	 */
	function notlike($array, $type='and', $dis='both')
	{
		if(is_array($array) && !empty($array))
		{
			if($type == 'or')
			{
				foreach($array as $k => $v)
				{	$this->db->or_not_like($k, $v, $dis);}
			}
			else
			{
				foreach($array as $k => $v)
				{	$this->db->not_like($k, $v, $dis);	}
			}
		}
		return $this;
	}
	
	/**
	 * like() 同not like()
	 * @param array $array
	 * @param string $type and/or
	 * @param string $dis both/before/after
	 * 	array('field1'=>'value1', 'field2'=>'value2')
	 */
	function like($array, $type='and', $dis='both')
	{
		if(is_array($array) && !empty($array))
		{
			if($type == 'or')
			{
				foreach($array as $k => $v)
				{
					$this->db->or_like($k, $v, $dis);
				}
			}
			else
			{
				foreach($array as $k => $v)
				{
					$this->db->like($k, $v, $dis);
				}
			}
		}
		return $this;
	}
	
	/**
	 * groupby 分组字段
	 * @param array $array
	 *	array('field1', 'field2')
	 */
	function groupby($array)
	{
		$this->db->group_by($array);
		return $this;
	}
	
	/**
	 * orderby 排序用
	 * @param array $array
	 * 	array('field1'=>'desc/asc', 'fild2'=>'desc/asc')
	 */
	function orderby($array)
	{
		if(is_array($array) && !empty($array))
		{
			foreach($array as $k => $v)
			{
				$this->db->order_by($k, $v);
			}
			return $this;
		}
	}
	
	/**
	 * limit分页用
	 * @param integer $row
	 * @param integer $start
	 * @return CI_Model
	 */
	function limit($start = 1,  $row= 1)
	{
		if($row > 0)
		{
			$this->db->limit($row, $start);
		}
		return $this;
	}

	/**
	 * insert()插入新数据，返回一当前插入数据的ID
	 * 如果没有ID，那么则返回影响行数
	 */
	function insert($data)
	{
		$this->db->insert($this->table, $data);
		$rs	= $this->db->insert_id();
		if(empty($rs))
		{
			return $this->db->affected_rows();
		}
		else 
		{
			return $rs;
		}
	}
	
	/**
	 * update()修改数据
	 * 返回影响行数
	 */
	function update($data, $where, $re_type = 'row')
	{
		$this->db->where($where);
		$this->db->update($this->table, $data);
		if($re_type == 'id')
			return $this->db->insert_id();
		else
			return $this->db->affected_rows();
	}
	
	/**
	 * delete()删除数据
	 * 返回影响行数
	 */
	function delete($where)
	{
		$this->db->where($where);
		$this->db->delete($this->table, $where);
		return $this->db->affected_rows();
	}
	
	/**
	 * 获取全部数据，带条件
	 * 返回一个多维数组
	 * @param string/array $field
	 * @param string/array $where
	 */
	function getall($field='*', $where=array(), $type='and')
	{
		$fieldStr	= $this->handleField($field);
		$this->db->select($fieldStr, FALSE);

		if(!empty($where))
		{
			if($type == 'or')
				$this->db->or_where($where);
			else
				$this->db->where($where);
		}
		$rs	= $this->db->get($this->table);
		return $this->resultArr($rs);		
	}

	/**
	 * 获取单条数据，类似getall
	 * 返回一个一维数组 数据条数为最后一条
	 * @param string/array $field
	 * @param string/array $where
	 */
	function getone($field='*', $where=array(), $type='and')
	{
		$fieldStr	= $this->handleField($field);
		$this->db->select($fieldStr, FALSE);
		if(!empty($where))
		{
			if($type == 'or')
				$this->db->or_where($where);
			else
				$this->db->where($where);
		}
		$rs	= $this->db->get($this->table);
		return $this->resultArrOne($rs);
	}
	
	function countTable($where=array(), $type='and')
	{
		if($type == 'or')
		{
			$this->db->or_where($where);
		}
		else
		{
			$this->db->where($where);
		}
		return $this->db->count_all_results($this->table);
	}
	
	/**
	 * 处理字段设置，全部加·· 该设置将允许用户使用数组或者字符串组建field查询字段
	 * @return string
	 * @param unknown_type $field
	 */
	function handleField($field = '*')
	{
		$rs	= '';
		if($field != '*')
		{
			$field	= !is_array($field) ? explode(',', $field) : $field;
			if(is_array($field) && !empty($field))
			{
				$rs	= implode(',', $field);
			}
		}
		else
		{
			$rs	= '*';
		}
		return $rs;
	}
	
	/**
	 * 执行一条sql语句，根据传入的$type值，可以选择相应的返回结果
	 * @param string $sql
	 * @update 2012-07-08
	 */
	function execute($sql, $type = 'rows')
	{
		$type	= strtolower($type);
		$rs	= $this->db->query($sql);
		switch($type)
		{
			case 'getall':
				return $this->resultArr($rs);
				break;
			case 'getone':
				return $this->resultArrOne($rs);
				break;
			case 'rows':
			default:
				return $this->db->affected_rows();
				break;
		}
	}
	
	
	/**
	 * 将结果集以二维数组形式返回
	 * @param unknown_type $rs
	 */
	function resultArr($rs)
	{
		$rsArr = $rarr = array();
		$rarr	= $rs->result_array();
		if(is_array($rarr))
		{
			foreach($rarr as $row)
			{
				$rsArr[]	= $row;
			}
		}
		return $rsArr;
	}
	
	/**
	 * 将结果集以一维数组形式返回
	 * @param unknown_type $rs
	 */
	function resultArrOne($rs)
	{
		$rsArr = $rarr = array();
		$rarr	= $rs->result_array();
		return $rarr[0];
	}
}
// END Model Class

/* End of file Model.php */
/* Location: ./system/core/Model.php */