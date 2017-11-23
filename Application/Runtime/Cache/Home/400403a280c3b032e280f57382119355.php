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

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<?php if($data){?>
		<?php foreach($data as $v){?>
		<div class="col-sm-4">
			<div class="contact-box">
				<a href="javascript:" onclick="save(<?php echo $v['id']?>)">
					<div class="col-sm-4">
						<div class="text-center">
							<img alt="image" class="img-circle m-t-xs img-responsive" src="<?php echo $v['cover']?>">
							<div class="m-t-xs font-bold">CTO</div>
						</div>
					</div>
				</a><div class="col-sm-8"><a href="profile.html">
				<h3><strong><?php echo $v['name']?></strong></h3>
				<p><i class="fa fa-map-marker"></i> <?php if($v['sex']==1){echo '男';}else{echo '女';}?></p>
			</a><p><?php echo str_replace(array("\r\n", "\r", "\n"), "<br>", $v['info']);?></p>
			</div>
				<div class="clearfix"></div>

			</div>
		</div>
		<?php }}?>
	</div>
</div>
<script src="/Home/js/jquery.min.js?v=2.1.4"></script>
<script src="/Home/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Home/js/content.min.js?v=1.0.0"></script>
<script src="/Home/layer/layer.js"></script>
<!--<script src="/Home/js/layer.min.js"></script>-->
<script>
	$(document).ready(function(){$(".contact-box").each(function(){animationHover(this,"pulse")})});
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
<script>
	function save(id){
		var url = '/index.php/Home/Index/eidtFriend.html?id='+id;
		layer.open({
			type: 2,
			title: false,
			closeBtn: 1, //不显示关闭按钮
			shade: [0],
			area: ['1200px', '610px'],
			offset: '50px', //右下角弹出
//			time: 2000, //2秒后自动关闭
			anim: 2,
			content: [url, 'no'], //iframe的url，no代表不显示滚动条
			end: function(){ //此处用于演示
//				alert(1)
			}
		});
	}
</script>
</body>
</html>