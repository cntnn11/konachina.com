jQuery(function(){

	// 单车详情页面tab切换
	jQuery('.tab_btn').click(function(){
		var sel_obj	= jQuery(this);
		var tabname	= sel_obj.attr('tabname');
		jQuery('#tab_div').find('.tab_content').each(function(){
			if( tabname == jQuery(this).attr('tabname') )
			{
				// 选中
				jQuery(this).removeClass('hidden');
				sel_obj.addClass('tab_current');
			}
			else
			{
				// 未选中
				jQuery(this).addClass('hidden');
				jQuery('.tab_btn').each(function(){
					if( tabname != jQuery(this).attr('tabname') )
					{
						jQuery(this).removeClass('tab_current');
					}
				})
				
			}
		});
	});

	jQuery.noConflict();
	jQuery(document).ready(function($){
		jQuery(".guidelist li").hover(
			function () {
				$(this).attr("class", "mouseon");
			  },
			  function () {
				$(this).attr("class", "mouseout");
			  }
		);
		jQuery(".ftoollist li").mouseover(function(){
			$(this).siblings().removeClass("on");
			$(this).addClass("on");
			var preNumber=$(this).prevAll().size();
			$(".fimglist li").removeClass("onpre");
			$(".fimglist li:nth-child("+preNumber+")").addClass("onpre");
			var margin = 610;
			margin = margin *preNumber; 
			margin = margin * -1;
			$(".fimglist").stop().animate({marginLeft: margin + "px"}, {duration: 500});
		});
	});

});