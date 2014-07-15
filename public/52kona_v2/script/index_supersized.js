$(function($){
	$.supersized({
		// Functionality
		navigation				:	1,			// 是否展示导航按钮。
		slideshow               :   1,			// 是否显示展示工具条，包括标题、图片数字和导航按钮。
		autoplay				:	1,			// 是否自动播放。
		start_slide             :   0,			// Start slide (0 is random)
		stop_loop				:	0,			// Pauses slideshow on last slide
		random					:	0,			// 是否随机切换图片
		slide_interval          :   3000,		// 图片切换间隔时间（毫秒）
		transition              :   5, 			// 图片切换效果，0-无，1-淡入淡出，2-向上滑动，3-向右滑动，4-向下滑动，5-向左滑动。
		transition_speed		:	1000,		// 切换速度，默认750。
		new_window				:	1,			// 在新窗口打开链接
		pause_hover             :   0,			// 是否鼠标滑向图片时暂停图片切换。
		keyboard_nav            :   1,			// 是否支持键盘操作切换。
		performance				:	0,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
		image_protect			:	0,			// 禁用图像拖动和左右拖动 Disables image dragging and right click with Javascript
		min_width				:	1600,		// Min width allowed (in pixels)
		min_height				:	646,		// Min height allowed (in pixels)
		vertical_center			:	0,			// 是否让图像垂直居中，如果为0，则图像为顶端对齐。
		horizontal_center		:	1,			// 背景水平居中
		fit_always				:	1,			// 图像不会超过浏览器宽高
		fit_portrait			:	1,			// Portrait images will not exceed browser height
		fit_landscape			:	0,			// Landscape images will not exceed browser width

		slide_links				:	'blank',	// 链接打开方式 (Options: false, 'num', 'name', 'blank')
		thumb_links				:	1,			// Individual thumb links for each slide
		thumbnail_navigation	:	1,			// 缩略图导航
		slide_counter			:	1,			// 是否显示切换图片的数字。
		slide_captions			:	1,			// 是否显示图片标题。
		thumbnail_navigation	:	0,			// 为1时可以通过单击缩略图导航切换图片，为0时，缩略图不显示。
		slides					:	slides,
		// Theme Options 
		progress_bar			:	1,			// Timer for each slide
		mouse_scrub				:	0
		
	});
});