<?php
/**
 *	@DESC ueditor百度编辑CI集成方法
*/
class ueditor extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 *	@DESC 生成缩略图片 TIP:图片的路径最好使用绝对路径！不要用带url地址的路径
	 *	@param string $folder 文件所属类别，获取尺寸时用到
	 *	@param array $file_info 通过CI的upload类上传成功后返回的图片信息数组
	 *	@author cntnn11
	 *	@date 2013-10-13
	*/
	function thumbImageBak($folder = 'other', $file_info = array())
	{
		$size_arr	= $this->config->item('file_size');

		if( !isset($size_arr[$folder]) || !is_array($size_arr[$folder]) || empty($size_arr[$folder]) )
		{
			return false;
		}

		$this->load->library('image_lib');
		$thumb_config['source_image']		= $file_info['full_path'];
		$thumb_config['create_thumb']		= TRUE;
		$thumb_config['maintain_ratio']	= TRUE;
		$thumb_config['master_dim']		= 'width';
		$thumb_config['thumb_marker']	= false;
		foreach ($size_arr[$folder] as $size)
		{
			$temp	= array();
			$width = $height = 0;
			$temp	= explode('*', $size);
			list($width, $height) = $temp;
			if(!$width)
			{
				continue;
			}
			$thumb_config['new_image']	= $file_info['file_path'].$width.'_'.$file_info['raw_name'].$file_info['file_ext'];
			$thumb_config['width']		= $width;
			if($height > 0)
			{
				$thumb_config['height']	= $height;
			}
			$this->image_lib->initialize($thumb_config);
			if( !$this->image_lib->resize() )
			{
				error_logs($this->image_lib->display_errors(), 'imgThumb');
			}
			$this->image_lib->clear();
		}
		return true;
	}

	/**
	 *	@DESC 编辑器图片上传处理方法
	 *	@author cntnn11
	 *	@date 2013-11-05
	*/
	function editorUploadImage()
	{
		$title		= _pv('pictitle');
		$folder		= 'ueditor';
		$postname	= 'ueditorImage';
		$date		= date('Ymd');

		//上传图片按天存放
		$file_upload_path	= UPFILEDIR.$folder.'/'.$date.'/';
		if(!is_dir(PUBPATH.$file_upload_path))
		{
			mkdir(PUBPATH.$file_upload_path);
		}
		$upload_config['upload_path']	= PUBPATH.$file_upload_path;
		$upload_config['allowed_types']	= 'gif|jpg|png|jpeg';
		$upload_config['encrypt_name']	= true;
		$upload_config['remove_spaces']	= true;
		$this->load->library('upload');
		$this->upload->initialize($upload_config);
		$upload_result	= $this->upload->do_upload($postname);
		if($upload_result === true)
		{
			$data	= $this->upload->data();
			echo '{"url":"/'.$date.'/'.$data['raw_name'].$data['file_ext'].'","title":"'.$title.'","original":"'.$data['orig_name'].'","state":"SUCCESS"}';
		}
		else
		{
			$error	= $this->upload->display_errors();
			echo "{'url':'','title':'','original':'','state':'ERROR'}";
		}
		exit();
	}

	/**
	 *	@DESC 百度ueditor编辑图片在线管理集成CI
	*/
	function editorImageManage()
	{
		//需要遍历的目录列表，最好使用缩略图地址，否则当网速慢时可能会造成严重的延时。地址使用绝对路径
		$path = PUBPATH.'/upload/ueditor/';
		$action = htmlspecialchars( $_POST[ "action" ] );
		$action = 'get';
		if ( $action == "get" )
		{
			$files = array();
			$tmp = getfiles( $path );
			if($tmp)
			{
				$files = array_merge($files, $tmp);
			}
			if ( !count($files) )
			{
				echo '';
			}
			rsort($files,SORT_STRING);
			$str = "";
			foreach ( $files as $file )
			{
				$file	= str_replace($path, '', $file);
				$str .= $file . "ue_separate_ue";
			}
			echo $str;
		}
		exit();
	}
}
?>