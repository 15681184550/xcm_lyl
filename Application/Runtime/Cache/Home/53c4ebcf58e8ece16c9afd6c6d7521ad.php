<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>徐昌茂</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="//res.layui.com/layui/build/css/layui.css"  media="all">
</head>
<link href="/Home//img/1.jpg" rel="shortcut icon" />
<link href="/Home/jqweui/dist/lib/weui.min.css" rel="stylesheet">
<link href="/Home/jqweui/dist/css/jquery-weui.min.css" rel="stylesheet">

<style>
    #imgs img{margin-right: 5px}
</style>
<body ontouchstart style="background: #F5F5F5">
<!--头部开始-->
<div style="width: 100%;height: 40px; background: darkseagreen;line-height: 40px;padding-left: 5px; padding-right: 5px">
    <span class="goBack" style="font-weight: bold; color: white;float: left; position: absolute"> <<返回</span>
    <p style="text-align: center;font-weight: bold;color: white">九宫格数据管理列表</p>
</div>
<!--添加列-->
<div class="weui-cells" style="margin-bottom: 20px;margin-top: 0">
    <a href="<?php echo U('jiu');?>">
        <div class="weui-cell">
            <div class="weui-cell__hd"><img width="30px" src="/Home//img/jia.png"></div>
            <div class="weui-cell__bd">
                <p style="color: #23BEAE">添加数据</p>
            </div>
            <div class="weui-cell__ft"> <img width="15px" src="/Home//img/you.png"> </div>
        </div>
    </a>
</div>
<!--九宫格数据列表开始-->
<?php if(isset($data) && $data){?>
<?php foreach($data as $v){?>
<div class="weui-cells" style="margin-top: 5px">
    <div class="weui-cell">
        <div class="weui-cell__hd">
            <img src="<?php echo $v['cover']?>" width="40px" style="max-height: 35px">
        </div>
        <div class="weui-cell__bd">
            <p><?php echo $v['name']?></p>
        </div>
        <div class="weui-cell__ft">
            <a href="/index.php/Home/Index/jiu.html?id=<?php echo $v['id']?>"><img src="/Home//img/gai.png" width="18px"></a>
            <a href="javascript:;" onclick="delJiuList(<?php echo $v['id']?>,this)"><img src="/Home//img/del.png" width="20px"></a>
        </div>
    </div>
</div>
<?php }?>
<?php }?>
<!--九宫格数据列表结束-->
<script src="/Home/js/jquery.min.js"></script>
<script src="/Home/js/jquery.min.js"></script>
<script src="/Home/jqweui/dist/js/jquery-weui.min.js"></script>
<script>
    $(function(){
        //设置
        function setItem(key,val){
            val = JSON.stringify(val);
            window.localStorage[key] = val;
        };
        setItem('shangUrl','jiuList')
    });

    function delJiuList(id,obj){
        var data = {}
        data.id = id;
        $.confirm({
            title: '删除九宫格数据',
            text: '确定要删除吗？',
            onOK: function () {
                //点击确认
                $.ajax({
                    cache: true,
                    type: "POST",
                    url:'/index.php/Home/Index/delJiuList.html',
                    data:data,
                    async: false,
                    error: function(request) {
                        alert("Connection error");
                    },
                    success: function(data) {
                        var rst = eval('(' + data + ')');
                        if(rst.status==1){
                            $.toast("操作成功");
                            setTimeout('$(obj).parent().parent().parent().remove()',1000)
                        } else{
                            $.toast("操作失败", "forbidden");
                        }
                    }
                });
            },
            onCancel: function () {
            }
        });
    }

    $('.goBack').click(function(){
        location.href='<?php echo U("index");?>'
    });
</script>
</body>
</html>