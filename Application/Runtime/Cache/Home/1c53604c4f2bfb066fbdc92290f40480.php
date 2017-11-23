<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>朋友信息列表</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/Home/mui/css/mui.min.css">
    <link rel="stylesheet" href="/Home/mui/css/xcmImg.css">
    <style type="text/css">

    </style>
</head>
<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title">朋友信息列表</h1>
</header>

<div class="mui-content">
    <div class="mui-card">
        <ul class="mui-table-view mui-table-view-chevron">
            <li class="mui-table-view-cell mui-media">
                <a class="mui-navigate-right" href="javascript:;" onclick="add()">
                    <img class="mui-media-object mui-pull-left" src="/Home//img/jia.png" style="width: 30px; height: 30px">
                    <div class="mui-media-body" style="height: 30px;line-height: 33px;color: #23BEAE">
                        增加信息
                    </div>
                </a>
            </li>
        </ul>
    </div>

    <ul id="OA_task_2" class="mui-table-view mui-card">
        <?php foreach($data as $k=>$v){?>
        <li class="mui-table-view-cell" style="padding-top: 4px;padding-bottom: 2px">
            <div class="mui-slider-right mui-disabled">
                <a class="mui-btn mui-btn-grey mui-icon mui-icon-trash" href="javascript:;" onclick="shan(<?php echo $v['id'];?>)"></a>
                <a class="mui-btn mui-btn-yellow mui-icon mui-icon-gear" href="javascript:;" onclick="save(<?php echo $v['id'];?>)"></a>
            </div>
            <div class="mui-slider-handle">
                <div class="mui-table-cell">
                    <img src="<?php echo $v['cover']?>" width="40px" height="40px" alt="">
                    <div style="height: 45px;float: right;line-height: 45px;padding-left: 10px"><?php echo $v['name']?></div>
                </div>
            </div>
        </li>
        <?php }?>
    </ul>
</div>
<script src="/Home/js/jquery.min.js"></script>
<script src="/Home/mui/js/mui.min.js"></script>
<script src="/Home/mui/js/update.js" type="text/javascript" charset="utf-8"></script>
<!--图片查看的js-->
<script src="/Home/mui/js/mui.previewimage.js"></script>
<script src="/Home/mui/js/mui.zoom.js"></script>
<!--移动端layery-->
<script src="/Home/layer/mobile/layer.js"></script>
<script>
    mui.init();
    function shan(id){
        var data = {};
        data.id  = id;
        //询问框
        layer.open({
            content: '您确定删除该条数据吗？'
            ,btn: ['删除', '点错了']
            ,yes: function(index){
                $.ajax({
                    cache: true,
                    type: "POST",
                    url:'/index.php/Home/Index/delFriendData.html',
                    data:data,// 你的formid
                    async: false,
                    error: function(request) {
                        layer.closeAll('loading'); //关闭加载层
                        console.log(request)
                    },
                    success: function(data) {
                        var data = eval('(' + data + ')');
                        if(data.status==1){
                            reload();
                        }else{
                            layer.open({
                                content: '删除失败'
                                ,skin: 'msg'
                                ,time: 2 //2秒后自动关闭
                            });
                        }
                        console.log(data);
                        layer.close(index);
                    }
                });
            }
        });

    }

    //增加朋友信息
    function add(){
        location.href='/index.php/Home/Index/saveFriendData.html';
    }

    //执行修改
    function save(id){
        location.href='/index.php/Home/Index/saveFriendData.html?id='+id;
    }

    //执行刷新
    function reload(){
        location.reload();
    }
</script>
</body>
</html>