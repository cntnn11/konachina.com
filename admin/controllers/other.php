<?php
class other extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('qy_admin_user');
	}
	/**
	 * 报告操作提示项
	 */
	function resultPage()
	{
		$tipArr = array();
		$info	= $_GET;
		$tipArr['sta']	= $info['status'] ? "<font class='coGreen' >成功</font>" : "<font class='coRed' >失败</font>";
		$tipArr['url']	= $info['reurl'];
		$tip			= $this->_tipConfArr($info['tip']);
		$tipArr['tip']	= $tip ? $tip : '错误！请联系技术员处理';
		$this->tipArr	= $tipArr;
		$this->display('0921/other/result_page');
	}

	/**
	 *	@DESC 提示配置数组，根据代号返回相应的语句
	*/
	function _tipConfArr($tip_type = '', $return = true)
	{
		$arr	= array(
			'loginEmpty'	=> '请保证用户名和密码不为空！',
			'loginError'	=> '用户名或密码错误！',
			'noLogin'		=> '请先登录',

			'financeCateEdit'	=> '收支分类编辑',
			'bikeEdit'		=> '单车信息编辑',
			'bikenwesEdit'	=> '单车新闻信息编辑',

			'teamEdit'		=> '车手信息编辑',

			'shopEdit'		=> '经销商信息编辑',
		);
		if(isset($arr[$tip_type]) && !empty($arr[$tip_type]))
		{
			return $arr[$tip_type];
		}
		if($return)
		{
			return $arr;
		}
		else
		{
			return FALSE;
		}
		
	}

	/**
	 *	@DESC 图片上传
	*/
	function doImageUpload()
	{
		$folder			= _pv('folder', 'other');
		$elementname	= _pv('elementname', 'fileToUpload');
		$size			= _pv('size', 0);

		//PUBPATH.
		$file_upload_path	= UPFILEDIR.$folder.'/';
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
		$upload_result	= $this->upload->do_upload($elementname);

		if($upload_result === true)
		{
			$data	= $this->upload->data();
			if($data['is_image'] === true)
			{
				// 图片要调用缩略的方法
				$this->thumbImage($folder, $data);
			}
			$data['file_path']	= $file_upload_path.$data['raw_name'].$data['file_ext'];
			$data['url_path']	= imageUrl($file_upload_path.$data['raw_name'].$data['file_ext'], (int)$size);
			_ars($data, true);
		}
		else
		{
			$error	= $this->upload->display_errors();
			_ars($error, false);
		}
	}

	/**
	 *	@DESC 生成缩略图片 TIP:图片的路径最好使用绝对路径！不要用带url地址的路径
	 *	@param string $folder 文件所属类别，获取尺寸时用到
	 *	@param array $file_info 通过CI的upload类上传成功后返回的图片信息数组
	 *	@author cntnn11
	 *	@date 2013-10-13
	*/
	function thumbImage($folder = 'other', $file_info = array())
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
}
?>