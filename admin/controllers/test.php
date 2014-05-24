<?php
class test extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->admin	= isAdminLogin();
	}
	
	function imgupload()
	{
		$this->js_arr	= array('plugins/jquery.dataTables.min.js', 'plugins/jquery.uniform.min.js', 'plugins/jquery.ajaxfileupload.js');
		$this->display('0921/test/imgupload');
	}

	function imgurl()
	{
		$image_name	= 'upload/photo/56e4f4fa1da00df82cf519eb6f917c3c.jpg';
		$type	= 'photo';
		echo imageUrl($image_name, '225');


		exit();
	}

	function imagewate()
	{
		$image_path	= "E:\www\ciapp\public\upload\bike\\440_bf23b4f3b3b45ded5ef4e9a8ec8624f1.jpg";
		$wate_img	= "E:\www\ciapp\public\img\\150_noimg.gif";
		$font_path	= "";
		$new_image	= 'E:/www/ciapp/tmp/new_image.jpg';

		$this->load->library('image_lib');
		$thumb_config['source_image']		= $image_path;
		$thumb_config['new_image'] 			= $new_image;	// 最好使用linux下的分隔符 / 抛弃win
		$thumb_config['create_thumb']		= TRUE;
		$thumb_config['thumb_marker']		= false;

		// 加图片水印必须
		$thumb_config['wm_type']			= 'overlay';
		$thumb_config['wm_overlay_path']	= $wate_img;
		$thumb_config['wm_hor_offset']		= 20;	// 水平偏移，距离左边侧距离
		$thumb_config['wm_vrt_offset']		= 20;	// 垂直偏移，距离顶部距离

		$this->image_lib->initialize($thumb_config);
		if(!$this->image_lib->watermark())
		{
			echo '水印图片添加失败：<br/>';
			var_array($this->image_lib->display_errors());
		}
		$this->image_lib->clear();

		// 重新加载配置信息
		$thumb_config['source_image']		= $new_image;
		$thumb_config['new_image'] 			= $new_image;	// 最好使用linux下的分隔符 / 抛弃win
		$thumb_config['create_thumb']		= false;		// 添加完图片水印后加文字水印，直接操作加水印后的图片，不生成缩略图
		$thumb_config['thumb_marker']		= false;

		// 加文字水印必须
		$thumb_config['wm_type']			= 'text';
		$thumb_config['wm_text']			= "this is font!";
		$thumb_config['wm_font_path']		= "E:/www/ciapp/public/code/consola.ttf";
		$thumb_config['wm_font_size']		= "16";
		$thumb_config['wm_font_color']		= "ff0000";
		$thumb_config['wm_hor_offset']		= 20;	// 水平偏移，距离左边侧距离
		$thumb_config['wm_vrt_offset']		= 100;	// 垂直偏移，距离顶部距离
		$this->image_lib->initialize($thumb_config);
		if(!$this->image_lib->watermark())
		{
			echo '水印文字添加失败：<br/>';
			var_array($this->image_lib->display_errors());
		}
		$this->image_lib->clear();
		exit();
	}
}
?>