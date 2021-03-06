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

    <link href="/Home/jqweui/dist/lib/weui.min.css" rel="stylesheet">
</head>
<style>
    .mui-card-footer{padding-bottom: 0;padding-top: 0;}
</style>
<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title"><?php echo $name;?></h1>
</header>
<img src="/Home/img/moren.gif" style="display: none;" alt="">
<div class="mui-content" id="list">
    <!--<ul class="mui-table-view">-->
        <!--<li class="mui-table-view-cell mui-media">-->
            <!--<a href="javascript:;">-->
                <!--<img class="mui-media-object mui-pull-left" src="../images/shuijiao.jpg">-->
                <!--<div class="mui-media-body">-->
                    <!--幸福-->
                    <!--<p class='mui-ellipsis'>能和心爱的人一起睡觉，是件幸福的事情；可是，打呼噜怎么办？</p>-->
                <!--</div>-->
            <!--</a>-->
        <!--</li>-->
    <!--</ul>-->
    <!--<div class="mui-content-padded"><ul class="mui-pager"><li class="mui-disabled"><span> 上一页 </span></li><li style="margin-left: 5px"><a href="javasrcipt:;" onclick="nextPage(2)">下一页</a></li></ul></div>-->
</div>

<div class="weui-loadmore">
    <i class="weui-loading"></i>
    <span class="weui-loadmore__tips">正在加载</span>
</div>
<input type="hidden" value="1" id="page">
<script src="/Home/mui/js/mui.min.js"></script>
<script src="/Home/js/jquery.min.js"></script>
<!--移动端layery-->
<script src="/Home/layer/mobile/layer.js"></script>
<!--weui-->
<script src="/Home/js/jquery.min.js"></script>
<script src="/Home/jqweui/dist/js/jquery-weui.min.js"></script>
<script>
    mui.init();
    $(function(){
        showList();
    });

    //初始化瀑布流开始
    var loading = false;  //状态标记
    $(document.body).infinite(20).on("infinite", function() {
        $('.weui-loadmore').show();
        if(loading) return;
        loading  = true;
        setTimeout(function() {
            showList();
            $('.weui-loadmore').hide();
        }, 300);
    });

    function showList(){
        layer.open({
            type: 2
            ,content: '加载中'
        });
        var data  = {};
        var p = $('#page').val();
        data.page = p;
        data.id   = "<?php echo $id;?>";
        var url   = '/index.php/Home/Index/caiPuListAjax.html';
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
                loading = false;
                layer.closeAll('loading'); //关闭加载层
                $('#page').val(parseInt(p)+1);
                var data = eval('(' + data + ')');
                if(data.length>0){
                    for(var i=0; i<data.length; ++i){
                        var str = datas(data[i]);
                        $('#list').append(str);
                    }
                }else{
                    $(document.body).destroyInfinite();
                    var str = '<div style="text-align: center;color: #555;font-size: 12px;padding: 8px 0">已无更多数据</div>';
                    $('#list').after(str);
                }
            }
        });
    }

    function datas(i){
        var str = '<ul class="mui-table-view"><li class="mui-table-view-cell mui-media">';
//        str += '<a href="/index.php/Home/Index/caiPuShow.html?id='+ i.data_id+'"><img class="mui-media-object mui-pull-left" style="width: 68px; height: 68px; max-width: 68px" src="'+ i.img +'">';
        str += '<a href="javascript:;" onclick="alert(\'那个龟儿子把接口关了，等我收拾了他再说\')"><img class="mui-media-object mui-pull-left" style="width: 68px; height: 68px; max-width: 68px" src="/Home/img/moren.gif">';
        str += '<div class="mui-media-body" style="color: cadetblue">'+ i.name +'<p class=\'mui-ellipsis\'>材料：'+ i.food+'</p>';
        str += '<p class=\'mui-ellipsis\'>做法：'+ i.description+'</p></div></a></li></ul>';
        return str;
    }
</script>
</body>
</html>