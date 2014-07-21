<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *	@DESC 网站自定义配置文档
 *	@author cntnn11
*/
$config['flag_arr']		= array(
	-1	=> '已删除',
	0	=> '未审核',
	1	=> '已审核',
	2	=> '推荐',
);

$config['de_attr']	= array(
	1	=> '支出',
	2	=> '收入',
);

$config['file_size']	= array(
	'bike'	=> array('150*92', '220*0', '620*0'),
	'photo'	=> array('225*152', '800*0'),
	'ueditor'	=> array('100*0', '600*0'),
	'team'	=> array('260*260', '225*150'),
	'recommend'	=> array('220*130'),

);
$config['news_focus_type']	= array(
	0	=> '没有',
	1	=> '图片',
	2	=> '视频链接',
);
$config['month_cn']	= array(
	0	=> '一',
	1	=> '二',
	2	=> '三',
	3	=> '四',
	4	=> '五',
	6	=> '七',
	7	=> '八',
	8	=> '九',
	9	=> '十',
	10	=> '十一',
	11	=> '十二',
);
$config['bike_tag']	= array(
	1	=> array('id'=>1, 'title'=>'山地车', 'en'=>'mountain'),
	2	=> array('id'=>2, 'title'=>'公路车', 'en'=>'road'),
);
/* End of file config.php */
/* Location: ./application/config/config.php */