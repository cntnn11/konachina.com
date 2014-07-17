<?php
class test extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 *	@desc 首页 跑脚本更新url链接
	*/
	function updyear()
	{
		$this->load->model('main_model', 'main');
		$lists = $this->main->getProductList();
exit('本地已完成 2013年07月14日21:38:32');
		if(is_array($lists) && !empty($lists))
		{
			foreach ($lists as $row)
			{
				switch ($row['year']) 
				{
					case 2013:
						$replace_url	= 'http://2k13.konaworld.com/';
						break;
					case 2012:
						$replace_url	= 'http://2k12.konaworld.com/';
						break;
					default:
						$replace_url	= '';
						break;
				}
				$url = str_replace('http://www.konaworld.com/', $replace_url, $row['detail_url']);
				echo $row['id'].' -- '.$url.' --> ';
				if($this->main->updateUrl($row['id'], $url))
				{
					echo "<font style='color:green;'>Success</font><br/>";
				}
				else
				{
					echo "<font style='color:red;'>Fail</font><br/>";
				}
			}
		}

		exit();
	}

	// 更新车型亮点数据
	function updateBikeVirtue()
	{
		$this->load->model('main_model', 'main');
		$lists = $this->main->getProductList();
exit('本地已完成 2014年07月14日21:38:32');
		if(is_array($lists) && !empty($lists))
		{
			foreach ($lists as $row)
			{
				$virtue			= array();
				for($i = 1; $i<=7; $i++)
				{
					if( $row['virtue'.$i] )
					{
						$temp		= json_decode($row['virtue'.$i], true);
						$virtue[]	= $temp['desc'];
					}
				}
				$bikes_v2_info['virtue']	= serialize($virtue);
				$res = $this->main->updateV2Data( $row['id'], $bikes_v2_info );
				if( !$res )
				{
					echo "ERROR！{$row['id']}";
				}
			}
		}
	}

	// 更新车型的图片数据
	function updateBikeImage()
	{
		$this->load->model('main_model', 'main');
		$lists = $this->main->getProductList();
exit('本地已完成 2014年07月14日21:38:32');
		if(is_array($lists) && !empty($lists))
		{
			foreach ($lists as $row)
			{
				if( !unserialize($row['image_url']) )
				{
					$bikes_v2_image['image_url']	= serialize( array(0=>$row['image_url']) );
					$res = $this->main->updateV2Data( $row['id'], $bikes_v2_image );
				}
				
				if( !$res )
				{
					echo "ERROR！{$row['id']}";
				}
			}
		}
	}

}


?>