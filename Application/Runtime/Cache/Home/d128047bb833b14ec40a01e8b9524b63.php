<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>菜谱分类</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link href="/Home//img/1.jpg" rel="shortcut icon" />
    <!--标准mui.css-->
    <link rel="stylesheet" href="/Home/mui/css/mui.min.css">
</head>
<style>
    .mui-card-footer{padding-bottom: 0;padding-top: 0;}
</style>
<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title">菜谱分类</h1>
</header>
<div id="Gallery" class="mui-slider mui-content" style="margin-top:15px;">
    <div class="mui-slider-group">
        <div class="mui-slider-item">
            <ul class="mui-table-view mui-grid-view mui-grid-9">
                <?php foreach($data as $k=>$v){?>
                <?php if($k<12){?>
                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                    <a href="/index.php/Home/Index/caiPuList.html?id=<?php echo $v['id']?>&name=<?php echo $v['name']?>">
                        <span class="">
                            <img src="/Home/<?php echo $v['cover'];?>" style="width: 40px; height: 40px" alt="">
                        </span>
                        <div class="mui-media-body"><?php echo $v['name']?></div>
                    </a>
                </li>
                <?php }}?>
            </ul>
        </div>
        <div class="mui-slider-item">
            <ul class="mui-table-view mui-grid-view mui-grid-9">
                <?php foreach($data as $k=>$v){?>
                <?php if($k>12){?>
                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                    <a href="/index.php/Home/Index/caiPuList.html?id=<?php echo $v['id']?>&name=<?php echo $v['name']?>">
                        <span class="">
                            <img src="/Home/<?php echo $v['cover'];?>" style="width: 40px; height: 40px" alt="">
                        </span>
                        <div class="mui-media-body"><?php echo $v['name']?></div>
                    </a>
                </li>
                <?php }}?>
            </ul>
        </div>
    </div>
    <div class="mui-slider-indicator">
        <div class="mui-indicator mui-active"></div>
        <div class="mui-indicator"></div>
    </div>
</div>
<input type="hidden" value="" id="page">
<script src="/Home/mui/js/mui.min.js"></script>
<script src="/Home/js/jquery.min.js"></script>
<!--移动端layery-->
<script src="/Home/layer/mobile/layer.js"></script>
<script>
    mui.init();
    $(function(){

    });

</script>
</body>
</html>