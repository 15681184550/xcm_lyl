<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<title>H+ 后台主题UI框架 - 联系人</title>
	<meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
	<meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
	<link rel="shortcut icon" href="favicon.ico">
	<link href="/Home/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
	<link href="/Home/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
	<link href="/Home/css/animate.min.css" rel="stylesheet">
	<link href="/Home/css/style.min.css?v=4.1.0" rel="stylesheet">
	<link href="/Home/css/custom.css" rel="stylesheet">
	<!--圖片上傳-->
	<link href="/Home/uploder/webuploader.css" rel="stylesheet">
	<script src="/Home/js/jquery-2.1.4.js"></script>
	<script src="/Home/uploder/webuploader.custom.min.js"></script>
	<!--<script src="/Home/uploder/webuploader.js"></script>-->
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>基本信息</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
							<i class="fa fa-wrench"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
							<li><a href="form_basic.html#">选项1</a>
							</li>
							<li><a href="form_basic.html#">选项2</a>
							</li>
						</ul>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<form class="form-horizontal m-t" id="commentForm" novalidate="novalidate">
						<div class="form-group">
							<label class="col-sm-3 control-label">姓名：</label>
							<div class="col-sm-8">
								<input id="name" name="name" minlength="2" type="text" class="form-control" required="" aria-required="true">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label text-right">性别：</label>
							<div class="col-sm-6">
								<label class="checkbox-inline" style="min-width: 72px; padding-left: 0">
									<input type="radio" style="margin-top: 2px; width: 20px;height: 20px" class="yd-lines-type sex" value="1" name="visaTypeIdCombo">男</label>
								<label class="checkbox-inline" style="min-width: 72px; padding-left: 0">
									<input type="radio" style="margin-top: 2px; width: 20px;height: 20px" class="yd-lines-type sex" value="2" checked="" name="visaTypeIdCombo">女</label>
							</div>
							<div class="col-sm-2"></div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">说明：</label>
							<div class="col-sm-8">
								<textarea id="info" name="comment" class="form-control" required="" aria-required="true"></textarea>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-3"></div>
							<div id="uploader-demo" class="col-sm-9">
								<!--用来存放item-->
								<div id="fileList" class="uploader-list col-sm-9"></div>
							</div>
						</div>
						<div id="filePicker" class="col-sm-4" style="text-align: right">选择图片</div>

						<div class="form-group">
							<div class="col-sm-12" style="text-align: center">
								<button class="btn btn-primary" type="button" id="save" onclick="saves()">提交</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="/Home/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Home/js/content.min.js?v=1.0.0"></script>
<script src="/Home/layer/layer.js"></script>
<script>
	$(document).ready(function(){$(".contact-box").each(function(){animationHover(this,"pulse")})});
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
<script>
	function saves(){
		$('#save').attr('onclick','');
		var data = {};
		data.name = $('#name').val();
		data.sex  = $('.sex:checked').val();
		data.info = $('#info').val();
		data.cover= '';
		var len  = $('#fileList').find('img').length;
		if(len > 0){
			for(var i=0; i<len; ++i){
				data.cover += $('#fileList').find('img').eq(i).parent().find('.tokenCover').val();
				if(i < len-1){
					data.cover += ','
				}
			}
		}
		if(!data.name){
			layer.msg('请填写名字');
			$('#save').attr('onclick','saves()');
			return false;
		}
		if(!data.info){
			layer.msg('请填写说明');
			$('#save').attr('onclick','saves()');
			return false;
		}
		if(!data.cover){
			layer.msg('请至少上传一张照片');
			$('#save').attr('onclick','saves()');
			return false;
		}
		console.log(data);
		return;
		$.ajax({
			cache: true,
			type: "POST",
			url:'<?php echo U("saveInfo");?>',
			data:data,// 你的formid
			async: false,
			error: function(request) {
				alert("Connection error");
			},
			success: function(data) {
				var obj = eval('(' + data + ')');
				if(obj.status == 1){
					layer.msg('提交成功');
				}else{
					layer.msg('提交失败');
				}
			}
		});
	}

	var uploader = WebUploader.create({
		auto: true, // 选完文件后，是否自动上传
		swf: '/Home/uploder/Uploader.swf', // swf文件路径
		server: "<?php echo U('upload');?>", // 文件接收服务端
		pick: '#filePicker', // 选择文件的按钮。可选
		// 只允许选择图片文件。
		accept: {
			title: 'Images',
			extensions: 'gif,jpg,jpeg,bmp,png',
			mimeTypes: '.jpg,.png,.jpeg,.gif'
		}
	});
	uploader.on( 'fileQueued', function( file , res) {
		var $list = $("#fileList"),
				$li = $(
						'<span style="width:110px;float:left;margin-right:10px" id="' + file.id + '" class="file-item thumbnail">' +
						'<img>' +
						'<span class="info">' + file.name + '</span>' +
						'</span>'
				),
				$img = $li.find('img');
		// $list为容器jQuery实例
		$list.append( $li );
		// 创建缩略图
		uploader.makeThumb( file, function( error, src ) {
			if ( error ) {
				$img.replaceWith('<span>不能预览</span>');
				return;
			}
			$img.attr( 'src', src );
		}, 100, 100 ); //100x100为缩略图尺寸
	});
	// 文件上传过程中创建进度条实时显示。
	uploader.on( 'uploadProgress', function( file, percentage ) {
		var $li = $( '#'+file.id ),
				$percent = $li.find('.progress span');
		// 避免重复创建
		if ( !$percent.length ) {
			$percent = $('<p class="progress"><span></span></p>')
					.appendTo( $li )
					.find('span');
		}
		$percent.css( 'width', percentage * 100 + '%' );
	});

	// 文件上传成功，给item添加成功class, 用样式标记上传成功。
	uploader.on( 'uploadSuccess', function( file, res ) {
		var url = '/Application/Home/Public/'+res.savepath+res.savename;
		var str = '<input type="hidden" value="'+ url +'" class="tokenCover">';
		$( '#'+file.id ).append(str);
		$( '#'+file.id ).addClass('upload-state-done');
	});

	// 完成上传完了，成功或者失败，先删除进度条。
	uploader.on( 'uploadComplete', function( file ) {
		$( '#'+file.id ).find('.progress').remove();
	});

</script>
</body>
</html>