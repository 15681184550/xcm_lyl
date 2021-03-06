<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>徐昌茂</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/Home/mui/css/mui.min.css">
    <link rel="stylesheet" href="/Home/mui/css/xcmImg.css">
    <style type="text/css">
        /*span.mui-icon {*/
            /*font-size: 14px;*/
            /*color: #007aff;*/
            /*margin-left: -15px;*/
            /*padding-right: 10px;*/
        /*}*/
        .mui-off-canvas-left {
            color: #fff;
        }
        .title {
            margin: 35px 15px 10px;
        }
        .title+.content {
            margin: 10px 15px 35px;
            color: #bbb;
            text-indent: 1em;
            font-size: 14px;
            line-height: 24px;
        }
        input {
            color: #000;
        }
    </style>
</head>
<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title"><?php echo $data['name']?></h1>
</header>
<div class="mui-content">
    <div class="mui-content-padded">
        <p><?php echo $data['message'];?></p>
        <p><?php echo $data['description'];?></p>
        <p>
            <img src="<?php echo $data['img']?>" style="width: 100%" data-preview-src="" data-preview-group="1" />
        </p>
    </div>
</div>

<script src="/Home/js/jquery.min.js"></script>
<script src="/Home/mui/js/mui.min.js"></script>
<script src="/Home/mui/js/update.js" type="text/javascript" charset="utf-8"></script>
<!--图片查看的js-->
<script src="/Home/mui/js/mui.previewimage.js"></script>
<script src="/Home/mui/js/mui.zoom.js"></script>
<!--图片列表懒加载的js-->
<script src="/Home/mui/js/mui.lazyload.js"></script>
<script src="/Home/mui/js/mui.lazyload.img.js"></script>
<script>
//    图片查看
    mui.previewImage();
//    懒加载图片列表
    mui.init();


</script>
</body>
</html>