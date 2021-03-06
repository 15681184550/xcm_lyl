<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>周公解梦</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!--标准mui.css-->
    <link rel="stylesheet" href="/Home/mui/css/mui.min.css">

    <link href="/Home/jqweui/dist/lib/weui.min.css" rel="stylesheet">
</head>
<style>

</style>
<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title">周公解梦(<span style="color: #97b20b;font-weight: bold"><?php if($type){echo $type;}else{echo $keyword;}?></span>)</h1>
</header>
<div class="mui-content" id="list">
    <?php if($data){?>
    <?php foreach($data as $k=>$v){?>
    <div class="mui-card lists">
        <div class="mui-card-header"><?php echo ($k+1)."、".$v['title'];?></div>
        <div class="mui-card-content">
            <div class="mui-card-content-inner">
                <?php echo $v['content'];?>
            </div>
        </div>
    </div>
    <?php }?>
    <?php }else{?>
    <div style="text-align: center">
        <img src="/Home//img/noDate.png" alt="">
        <p>没有找到您的梦境,搜索关键字请尽量简短</p>
    </div>
    <?php }?>
</div>
<div class="weui-loadmore" style="display: none">
    <i class="weui-loading"></i>
    <span class="weui-loadmore__tips">正在加载</span>
</div>
<input type="hidden" value="1" id="page">
<script src="/Home/mui/js/mui.min.js"></script>
<script src="/Home/mui/js/mui.view.js"></script>
<!--weui-->
<script src="/Home/js/jquery.min.js"></script>
<script src="/Home/jqweui/dist/js/jquery-weui.min.js"></script>
<!--移动端layery-->
<script src="/Home/layer/mobile/layer.js"></script>
<script>
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
        var p     = $('#page').val();
        var key   = "<?php if(isset($keyword)){echo $keyword;}else{echo '';}?>";
        data.page = parseInt(p)+1;
        if(key){
            data.key  = key;
        }else{
            data.type = "<?php echo $type;?>";
        }
        var url   = '/index.php/Home/Index/untieDreamListAjax.html';
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
                layer.closeAll('loading'); //关闭加载层
                loading = false;
                $('#page').val(parseInt($('#page').val())+1);
                var data = eval('(' + data + ')');
                if(data.status == 1){
                    console.log(data);
                    for(var i=0; i<data.data.length; ++i){
                        var p = $('#page').val();
                        var n = (parseInt(p)-1)*10+parseInt(i+1);
                        var str = '<div class="mui-card lists">';
                            str += '<div class="mui-card-header">'+ n +'、'+data.data[i]['title'] +'</div>';
                            str += '<div class="mui-card-content">';
                            str += '<div class="mui-card-content-inner">'+ data.data[i]['content'];
                            str += '</div></div></div>';
                        $('.lists:last').after(str);
                    }
                }else{
                    $(document.body).destroyInfinite();
                    var str = '<div style="text-align: center;color: #555;font-size: 12px;padding: 8px 0">已无更多数据</div>';
                    $('#list').after(str);
                }
            }
        });
    }

</script>
</body>
</html>