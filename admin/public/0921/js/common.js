//跳转页面方法
function button_location(url,targ)
{
	if(!targ)
	{
		window.location=url;
	}
	else
	{
		if(confirm('确认是否执行该操作！'))
		{
			window.location=url;
		}
	}
}
//选择一堆复选框，然后提交。一般用于列表的批量操作，exp：批量删除
function select_control(action,please_control)
{
	var n=0;
	jQuery("input:checked").each(function(){
		if(jQuery(this).attr('id') != 'checkall' && jQuery(this).attr('type') == 'checkbox')
		{
			n++;
		}
	});

	if(n==0)
	{
		alert("提示:没有选择要操作项");
		return false;
	}
	else
	{
		if(please_control != 'null')
		{
			if(confirm(please_control))
			{
				submitform(action);
			}
		}
		else
		{	submitform(action);	}
	}
}


//提交表单
function submitform(action)
{
	jQuery(".stdform").attr("action", action);
	jQuery(".stdform:first").submit();
}

//待验证的表单提交
function submitformcheck(action,checkid)
{
	var check = new Array();
	checkid	+= ',';
	check = checkid == 'undefined' ? 0 : checkid.split(',');
	var ret = true;
	for(var i=0;i<check.length;i++)
	{
		if(check[i]=='ruser_id' || check[i]=='qchannel_id')
		{
			jQuery('#'+check[i]+' option').each(function(){
				jQuery(this).attr('selected','selected');
			});
		}
		else
		{
			var val=jQuery("#"+check[i]).val();
			if(val=='' || val=='undefined')
			{
				alert("提示："+checkTip(check[i]));
				ret = false;
				return false;
			}
		}
	}

	if(ret)
	{	submitform(action);	}
}
/*
  * 根据传入ID返回相应的提示语句
  *  checkTip(checkid)
  *  checkid:通过其他方法调用传进来的ID，
  * 编写人：谭宁宁
  * 编写时间：2012-07-01
  * 添加时间：2012-01-01
  */
function checkTip(checkid)
{
	var tipstr = new Array();
	tipstr['dates']	= "请输入开始时间";
	tipstr['user']	= "请输入登录名！";
	tipstr['name']	= "请输入名字";
	tipstr['pwd']	= "请输入密码！";

	if(typeof(tipstr[checkid])=='undefined' || typeof(tipstr[checkid])=='null')
	{
		return "没有该ID："+checkid;
	}
	else
	{
		return tipstr[checkid];
	}
}

/**
 *	@desc Ajax提交修改单个记录的flag
*/
function changeFlagAjax(obj)
{
	var obj	= jQuery(obj);
	var url	= obj.attr('url');
	var val	= obj.val();
	var old	= obj.attr('old');
	var id	= obj.attr('aid');

	if(url != '' && val != '' && id != '')
	{
		jQuery('.flagtip'+id).show();
		jQuery.ajax({
			type:'POST',
			url:url,
			data:'&id='+id+'&flag='+val+'&old='+old,
			dataType:'json',
			//async: false,
			success:function(msg){
				if(msg.status == 'OK')
				{
					jQuery('.flagtip'+id).attr('src', '/admin/public/0921/images/loaders/loader2.gif?1013');
					jQuery('.flagtip'+id).hide();
					obj.attr('old', val);
				}
				else
				{
					obj.val(old);
				}
			}
		});
	}
}

/**
 *	@DESC JS简单验证文件
 *		只做了格式验证
*/
function fileCheck(obj, file_type)
{
	var id	= jQuery(obj).attr('id');
	var msg	= '';
	var file_ext_arr		= new Array('pdf', 'image');
	file_ext_arr['pdf']		= ['.pdf'];
	file_ext_arr['image']	= ['.jpg', '.jpeg','.png','.gif'];

	if(!id || !obj)
	{
		msg	= '程序未知错误！';
		return false;
	}
	if(obj.value == '')
	{
		msg	= "请选择一个文件进行上传";
	}
	else if(obj.value != '')
	{
		var ext = obj.value.substr(obj.value.lastIndexOf(".")).toLowerCase();
		//判断文件类型是否允许上传
		if(file_ext_arr[file_type] == 'undefined' || jQuery.inArray(ext, file_ext_arr[file_type]) < 0)
		{
			msg	= "该文件类型不允许上传。请上传 "+file_ext_arr[file_type].join(',')+"格式文件，当前文件类型为 "+ext;
		}
	}

	if(msg != "")
	{
		jQuery('#file_error_'+id).css("color","red").html(msg);
		jQuery('#'+id).val('');
		return false;
	}
	else
	{
		jQuery('#file_error_'+id).css("color","green").html('OK');
		ajaxfileupload(obj);
		return true;
	}
}

/**
 *	@DESC js ajax上传图片
*/
function ajaxfileupload(obj)
{
	var url	= jQuery(obj).attr('url');
	var elementname	= jQuery(obj).attr('id');
	var folder		= jQuery(obj).attr('folder');
	var size		= jQuery(obj).attr('size');
	// 上传图片的状态显示 其实只是在上传中显示‘菊花’图片，结束后将其隐藏
	jQuery("#file_error_"+elementname).ajaxStart(function(){
		jQuery(this).html('<img src="/admin/public/0921/images/loaders/loader2.gif?1013" />');
		//jQuery('#upload_'+elementname).val('上传中……');
	}).ajaxComplete(function(){
		jQuery(this).hide();
	});
	// 上传主体程序
	jQuery.ajaxFileUpload({
		url:url+'?'+Math.random(),
		secureuri:false,
		fileElementId:elementname,
		dataType: 'json',
		data:{folder:folder, elementname:elementname, size:size},
		success: function (data, status)
		{
			if(typeof(data) != 'undefined')
			{
				if(data.status == 'OK')
				{
					jQuery('#upload_'+elementname).val(data.data.file_path);
					jQuery('#file_view_'+elementname).attr('src', data.data.url_path);
					jQuery('#file_view_'+elementname).show();
				}
				else
				{
					jQuery('#upload_'+elementname).val('');
					jQuery('#file_error_'+elementname).css("color","red").html(data.data);
				}
			}
			//return true;
		},
		error: function (data, status, e)
		{
console.log('ERROR ', data, status, e);
			alert(data+"\n 请重新上传，图片是否太大，网络是否不好？");
		}
	});
	return false;
}