<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>菜谱</title>
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
    <h1 class="mui-title">菜谱</h1>
</header>
<div class="mui-content">
    <ul class="mui-table-view mui-grid-view mui-grid-9" id="fenLei">
        <!--<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">-->
            <!--<a href="#">-->
                <!--<span class="mui-icon mui-icon-home"></span>-->
                <!--<div class="mui-media-body">Home</div>-->
            <!--</a>-->
        <!--</li>-->
    </ul>
</div>
<input type="hidden" value="" id="page">
<script src="/Home/mui/js/mui.min.js"></script>
<script src="/Home/js/jquery.min.js"></script>
<!--移动端layery-->
<script src="/Home/layer/mobile/layer.js"></script>
<script>
    mui.init();
    $(function(){
        showList();
    });

    function showList(n){
//        layer.open({
//            type: 2
//            ,content: '加载中'
//        });
        n ? n : 1;
        var data  = {};
        data.page = n;
        var url  = '/index.php/Home/Index/caiPuAjax.html';
        $.ajax({
            cache: true,
            type: "POST",
            url:url,
            data:data,// 你的formid
            async: false,
            error: function(request) {
                layer.closeAll('loading'); //关闭加载层
                console.log(request)
            },
            success: function(data) {
                var data = eval('(' + data + ')');
                console.log(data)
                if(data){
                   for(var i=0; i<data.tngou.length; ++i){
                       var str = datas(data.tngou[i]);
                       $('#fenLei').append(str);
                   }
                }
            }
        });
    }

    function datas(i){
        var str = '<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><a href="http://www.tngou.net/api/cook/list?id='+ i.id+'&rows=10" data_seq="'+ i.seq +'" data_id="'+ i.id +'" data-cookclass="'+ i.cookclass +'"><span class="mui-icon mui-icon-home"></span><div class="mui-media-body">'+ i.name +'</div></a></li>';
        return str;
    }
</script>
</body>
</html>