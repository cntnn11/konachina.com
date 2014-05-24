<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class iae_detailed extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table	= 'iae_detailed';
	}
}
?>