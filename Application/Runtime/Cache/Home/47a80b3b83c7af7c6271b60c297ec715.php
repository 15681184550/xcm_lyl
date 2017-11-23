<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>徐昌茂</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/Home/layui/css/layui.css"  media="all">
</head>
<link href="/Home//img/1.jpg" rel="shortcut icon" />
<link href="/Home/jqweui/dist/lib/weui.min.css" rel="stylesheet">
<link href="/Home/jqweui/dist/css/jquery-weui.min.css" rel="stylesheet">
<!--图片上传-->
<script src="/Home/layui/layui.js" charset="utf-8"></script>
<link href="/Home/layui/css/layui.css" rel="stylesheet">

<style>
    #imgs img{margin-right: 5px}
</style>
<body ontouchstart style="background: #F5F5F5">
<!--头部开始-->
<div style="width: 100%;height: 40px; background: darkseagreen;line-height: 40px;">
    <span class="goBack" style="font-weight: bold; color: white;float: left; position: absolute;padding-left: 5px"> <<返回</span>
    <p style="text-align: center;font-weight: bold;color: white">知识点回顾(<?php echo $study;?>)</p>
</div>
<!--添加列-->
<div class="weui-cells" style="margin-bottom: 20px;margin-top: 0">
    <a href="<?php echo U('knowledgeAdd?study='.$study);?>">
        <div class="weui-cell">
            <div class="weui-cell__hd"><img width="30px" src="/Home//img/jia.png"></div>
            <div class="weui-cell__bd">
                <p style="color: #23BEAE">添加数据</p>
            </div>
            <div class="weui-cell__ft"> <img width="15px" src="/Home//img/you.png"> </div>
        </div>
    </a>
</div>
<!--知识点列表-->
<?php if($data){?>
<?php foreach($data as $v){?>
<div class="weui-cells" style="margin-top: 5px">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p><?php echo $v['name']?></p>
        </div>
        <div class="weui-cell__ft">
            <a href="/index.php/Home/Index/knowledgeShow.html?id=<?php echo $v['id']?>"><img src="/Home//img/show.png" width="25px"></a>
        </div>
    </div>
</div>
<?php }}else{?>
<div style="text-align: center">
    <img src="/Home//img/noDate.png" alt="">
    <p>还没有数据,去添加一点吧！！！</p>
</div>
<?php }?>
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
        setItem('shangUrl','knowledge')
    });

    $('.goBack').click(function(){
        window.history.back(-1);  //返回上一页
    });

</script>
</body>
</html>