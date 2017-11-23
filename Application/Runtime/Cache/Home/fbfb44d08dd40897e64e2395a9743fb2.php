<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>梦境分类</title>
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
    <h1 class="mui-title">梦境分类</h1>
</header>
<div id="Gallery" class="mui-slider mui-content" style="margin-top:15px;">
    <div class="mui-input-row mui-search" style="width: 78%;margin-left: 2%">
        <input type="search" id="search" class="mui-input-clear" placeholder="填写搜索梦境关键字">
    </div>
    <div style="position: absolute;right: 2%;top: 45px;">
        <button type="button" class="mui-btn" onclick="sousuo()">搜索</button>
    </div>
    <div class="mui-slider-group">
        <div class="mui-slider-item">
            <ul class="mui-table-view mui-grid-view mui-grid-9" style="background: white">
                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                    <a href="/index.php/Home/Index/untieDreamList.html?type=生活类" style="padding: 0">
                        <span class="">
                            <img src="/Home/img/zhouM/shengH.png" style="width: 40px; height: 40px" alt="">
                        </span>
                        <div class="mui-media-body" style="margin-top: 0">生活类</div>
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                    <a href="/index.php/Home/Index/untieDreamList.html?type=物品类" style="padding: 0">
                        <span class="">
                            <img src="/Home/img/zhouM/wuP.png" style="width: 40px; height: 40px" alt="">
                        </span>
                        <div class="mui-media-body" style="margin-top: 0">物品类</div>
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                    <a href="/index.php/Home/Index/untieDreamList.html?type=人物类" style="padding: 0">
                        <span class="">
                            <img src="/Home/img/zhouM/renW.png" style="width: 40px; height: 40px" alt="">
                        </span>
                        <div class="mui-media-body" style="margin-top: 0">人物类</div>
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                    <a href="/index.php/Home/Index/untieDreamList.html?type=植物类" style="padding: 0">
                        <span class="">
                            <img src="/Home/img/zhouM/zhiW.png" style="width: 40px; height: 40px" alt="">
                        </span>
                        <div class="mui-media-body" style="margin-top: 0">植物类</div>
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                    <a href="/index.php/Home/Index/untieDreamList.html?type=活动类" style="padding: 0">
                        <span class="">
                            <img src="/Home/img/zhouM/huoD.png" style="width: 40px; height: 40px" alt="">
                        </span>
                        <div class="mui-media-body" style="margin-top: 0">活动类</div>
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                    <a href="/index.php/Home/Index/untieDreamList.html?type=建筑类" style="padding: 0">
                        <span class="">
                            <img src="/Home/img/zhouM/jianZ.png" style="width: 40px; height: 40px" alt="">
                        </span>
                        <div class="mui-media-body" style="margin-top: 0">建筑类</div>
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                    <a href="/index.php/Home/Index/untieDreamList.html?type=动物类" style="padding: 0">
                        <span class="">
                            <img src="/Home/img/zhouM/dongW.png" style="width: 40px; height: 40px" alt="">
                        </span>
                        <div class="mui-media-body" style="margin-top: 0">动物类</div>
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                    <a href="/index.php/Home/Index/untieDreamList.html?type=自然类" style="padding: 0">
                        <span class="">
                            <img src="/Home/img/zhouM/ziR.png" style="width: 40px; height: 40px" alt="">
                        </span>
                        <div class="mui-media-body" style="margin-top: 0">自然类</div>
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                    <a href="/index.php/Home/Index/untieDreamList.html?type=鬼神类" style="padding: 0">
                        <span class="">
                            <img src="/Home/img/zhouM/guiS.png" style="width: 40px; height: 40px" alt="">
                        </span>
                        <div class="mui-media-body" style="margin-top: 0">鬼神类</div>
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                    <a href="/index.php/Home/Index/untieDreamList.html?type=其他类" style="padding: 0">
                        <span class="">
                            <img src="/Home/img/zhouM/qiT.png" style="width: 40px; height: 40px" alt="">
                        </span>
                        <div class="mui-media-body" style="margin-top: 0">其他类</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="mui-slider-indicator">
        <div class="mui-indicator mui-active"></div>
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
    function sousuo(){
        var keyword = $('#search').val();
        if(!keyword){
            return false;
        }
        location.href='/index.php/Home/Index/untieDreamList.html?keyword='+keyword;
    }
</script>
</body>
</html>