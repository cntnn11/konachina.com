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

	/**
	 *	@desc 更新图片
	 *	@author cntnn11
	 *	@date 2014-07-24
	*/
	function updateimage()
	{
		echo '<p>开始 -> '.date('Y-m-d H:i:s').'</p>';
		exit('2014-07-24 23:37:12 本地已执行完毕');
		$dir_source	= '/Users/cntnn11/www/www.konachina.com/public/upload';

		$this->load->model('main_model', 'main');
		$lists = $this->main->getProductList();
		foreach ($lists as $bike)
		{
			$image_arr	= unserialize($bike['image_url']);
			if( $image_arr && is_array($image_arr) )
			{
				$file	= $image_arr[0];
				$file_info['full_path']	= '/Users/cntnn11/www/www.konachina.com/public/'.$file;
//echo $file.'<br/>';
				if( is_file($file_info['full_path']) )
				{
echo 'old -> '.$file_info['full_path'].'<br/>';
					$path_info	= pathinfo($file);
					$file_info['raw_name']	= $path_info['filename'];
					$file_info['file_ext']	= $path_info['extension'];
					$file_info['file_path']	= $dir_source.'/bike_new/';
					$this->_thumbImage( 'bike', $file_info );
				}
			}
		}
		exit('<p>OVER! -> '.date('Y-m-d H:i:s').'</p>');
	}

	function copyImage()
	{
		echo '<p>开始 -> '.date('Y-m-d H:i:s').'</p>';
		exit('2014-07-24 23:52:50 本地已执行完毕');
		$dir_source	= '/Users/cntnn11/www/www.konachina.com/public/upload';
		$this->load->model('main_model', 'main');
		$lists = $this->main->getProductList();
		foreach ($lists as $bike)
		{
			$image_arr	= unserialize($bike['image_url']);
			if( $image_arr && is_array($image_arr) )
			{
				$file				= $image_arr[0];
				$file_path_source	= '/Users/cntnn11/www/www.konachina.com/public/'.$file;
echo $file.' --- '.$file_path_source.'<br/>';
				if( is_file($file_path_source) )
				{
					$path_info	= pathinfo($file);
					$file_path_new		= $dir_source.'/bike_new/'.$path_info['filename'].'.'.$path_info['extension'];
echo $file_path_new.'<br/>';
					if( !copy($file_path_source, $file_path_new) )
					{
						echo '<p style="color:red;">ERROR --- >'.$bike['id'].' - '.$file.'</p>';
					}
				}
			}
echo '<br/>';
		}
		exit('<p>OVER! -> '.date('Y-m-d H:i:s').'</p>');
	}

	/**
	 *	@DESC 生成缩略图片 TIP:图片的路径最好使用绝对路径！不要用带url地址的路径
	 *	@param string $folder 文件所属类别，获取尺寸时用到
	 *	@param array $file_info 通过CI的upload类上传成功后返回的图片信息数组
	 *	@author cntnn11
	 *	@date 2013-10-13
	*/
	function _thumbImage($folder = 'other', $file_info = array())
	{
		$file_size	= array(
			'bike'	=> array('150*92', '220*130', '620*356'),
			'photo'	=> array('225*152', '800*0'),
			'ueditor'	=> array('100*0', '600*0'),
			'team'	=> array('260*260', '225*150'),
			'recommend'	=> array('220*130'),
		);

		$this->load->library('image_lib');
		$thumb_config['source_image']		= $file_info['full_path'];
		$thumb_config['create_thumb']		= TRUE;
		$thumb_config['maintain_ratio']	= TRUE;
		$thumb_config['master_dim']		= 'width';
		$thumb_config['thumb_marker']	= false;
		foreach ($file_size[$folder] as $size)
		{
			$temp	= array();
			$width = $height = 0;
			$temp	= explode('*', $size);
			list($width, $height) = $temp;
			if(!$width)
			{
				continue;
			}
			$thumb_config['new_image']	= $file_info['file_path'].$file_info['raw_name'].'_'.$width.'.'.$file_info['file_ext'];
echo 'NEW -> '.$thumb_config['new_image'].'<br/>';
			$thumb_config['width']		= $width;
			if($height > 0)
			{
				$thumb_config['height']	= $height;
			}
			$this->image_lib->initialize($thumb_config);
			if( !$this->image_lib->resize() )
			{
				var_array( $this->image_lib->display_errors() );
				exit();
			}
			$this->image_lib->clear();
		}
		echo '<br/>';
		return true;
	}


}


?>