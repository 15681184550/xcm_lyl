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
<div style="width: 100%;height: 40px; box-shadow:0 1px 6px #ccc;line-height: 40px;padding-left: 5px; padding-right: 5px">
    <span class="goBack" style="float: left; position: absolute;font-size: 17px;color: #007AFF"> <返回 </span>
    <!--<p style="text-align: center;font-weight: bold;color: white">九宫格数据管理</p>-->
    <h1 style="text-align: center;font-size: 17px">九宫格数据管理</h1>
</div>
<!--头部结束-->
<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">姓名:</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="name" value="<?php if(isset($data)){echo $data['name'];}?>" type="text" placeholder="请输入姓名">
        </div>
    </div>
</div>
<!--图片上传开始-->
<div style="margin-top: 10px">
    <input type="file" name="file" class="layui-upload-file up">
</div>
<div id="imgs" style="margin-top: 10px;padding: 10px;background: white; height: 80px;">
    <?php if(isset($data) && $data['cover']){?>
    <?php foreach($data['cover'] as $v){?>
    <img src="<?php echo $v?>" width="30%" height="80px" alt="" style="position: absolute">
    <i onclick="delImg(this)" class="weui-icon-cancel" style="position: relative;padding-left: 24%"></i>
    <?php }?>
    <?php }?>
    <!--<img src="/Application/Home/Public/Uploads/2017-04-07/kbChuiNAimage.jpg" width="30%" height="80px" alt="" style="position: absolute">-->
    <!--<i onclick="delImg(this)" class="weui-icon-cancel" style="position: relative;padding-left: 24%"></i>-->
</div>

<!--图片上传结束-->
<div style="margin-top: 20px">
    <a style="width: 70%" href="javascript:;" class="weui-btn weui-btn_primary" id="save" onclick="save()">提交</a>
</div>
<input type="hidden" id="id" value="<?php if(isset($data)){echo $data['id'];}?>">
<script src="/Home/js/jquery.min.js"></script>
<script src="/Home/js/jquery.min.js"></script>
<script src="/Home/jqweui/dist/js/jquery-weui.min.js"></script>
<script>
    $('.goBack').click(function(){
        window.history.back();  //返回上一页
    });

    //    图片上传
    layui.use('upload', function(){
        layui.upload({
            elem: ".up",
            url: '<?php echo U("upload");?>'
            ,ext: 'jpg|png|gif', //那么，就只会支持这三种格式的上传。注意是用|分割。
            before: function(input){
                $.showLoading();
            }
            ,success: function(res){
                $.hideLoading();
                if(res.name){
                    var url = '/Application/Home/Public/'+res.savepath+res.savename;
                    var str = '<img src="'+ url +'" width="30%" height="80px" alt="" style="position: absolute"><i onclick="delImg(this)" class="weui-icon-cancel" style="position: relative;padding-left: 24%"></i>'
                    $('#imgs').append(str);
                }else{
                    $.toast("上传失败", "forbidden");
                }
            }
        });
    });

    //    删除图片
    function delImg(obj){
        $.confirm({
            title: '图片删除',
            text: '确定要删除吗？',
            onOK: function () {
                //点击确认
                var data = {};
                data.url = $(obj).prev().attr('src');
//                console.log(data);return;
                $.ajax({
                    cache: true,
                    type: "POST",
                    url:'<?php echo U("delFile");?>',
                    data:data,// 你的formid
                    async: false,
                    error: function(request) {
                        alert("Connection error");
                    },
                    success: function(data) {
                        console.log(data);
                        $(obj).prev().remove();
                        $(obj).remove();
                    }
                });
            },
            onCancel: function () {
            }
        });
    }

    //    提交保存
    function save(){
        $('#save').attr('onclick','');
        $('.weui-btn_primary').css('background-color','#999');
        var data = {};
        data.name = $('#name').val();
        var len  = $('#imgs').find('img').length;
        data.cover = '';
        if(len > 0){
            for(var i=0; i<len; ++i){
                data.cover += $('#imgs').find('img').eq(i).attr('src');
                if(i < len-1){
                    data.cover += ',';
                }
            }
        }else{
            $.toast("请上传图片", "forbidden");
            $('#save').attr('onclick','save()');
            $('.weui-btn_primary').css('background-color','#1aad19');
            return false;
        }
        if(!data.cover){
            $.toast("请上传图片", "forbidden");
            $('#save').attr('onclick','save()');
            $('.weui-btn_primary').css('background-color','#1aad19');
            return false;
        }
        if(!data.name){
            $.toast("请填写名字", "forbidden");
            $('#save').attr('onclick','save()');
            $('.weui-btn_primary').css('background-color','#1aad19');
            return false;
        }
        var id = $('#id').val();
        if(id){
            data.dataId = id
        }
        $.showLoading();
        $.ajax({
            cache: true,
            type: "POST",
            url:'<?php echo U("saveFriendDataAjax");?>',
            data:data,// 你的formid
            async: false,
            error: function(request) {
                alert("Connection error");
            },
            success: function(data) {
                $.hideLoading();
                var obj = eval('(' + data + ')');
                if(obj.status==1){
                    $.toast("操作成功");
                    setTimeout("location.href='<?php echo U("friendList");?>'",1000);
                }else{
                    $.toast("操作失败", "forbidden");
                }
            }
        });
        console.log(data);
    }
</script>
</body>
</html>