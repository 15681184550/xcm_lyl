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
<!--图片上传-->
<script src="/Home/layui/layui.js" charset="utf-8"></script>
<link href="/Home/layui/css/layui.css" rel="stylesheet">
<style>
    #imgs img{margin-right: 5px}
    .border1 { border:2px solid #FF0000;}
    .border2 { border:2px solid #008000;}
</style>
<body ontouchstart style="background: #1E97A8;background: url('/Home/img/bg.jpg')">
<div style='height: 200px;margin-bottom: 20px;text-align: right'>
    <div style="height: 40px;width: 45px;padding-top: 5px">
        <a href="javascript:;" onclick="goBack()"><img src="/Home/img/left.png" width="35px" alt=""></a>
    </div>
    <!--头像-->
    <div style="width: 120px;height: 120px;border-radius: 50%;margin: 0 auto;overflow: hidden; background: url('/Home/img/deful.jpg')" id="uploder" onclick="uploder()">
        <img src="" alt="">
    </div>
</div>
<div style="display: none">
    <input type="file" name="file" class="layui-upload-file up">
</div>
<div class="weui-cells weui-cells_form" style="width: 90%;margin: 0 auto;border-radius: 5px;margin-bottom: 15px;">
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label" style="color: #5D5D5D">登录名:</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="name" value="" type="text" placeholder="请输入您的登录名">
        </div>
    </div>
</div>
<div class="weui-cells weui-cells_form" style="width: 90%;margin: 0 auto;border-radius: 5px;margin-bottom: 15px;">
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label" style="color: #5D5D5D">真实姓名:</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="reName" value="" type="text" placeholder="请输入您的真实姓名">
        </div>
    </div>
</div>
<div class="weui-cells weui-cells_form" style="width: 90%;margin: 0 auto;border-radius: 5px;margin-bottom: 15px;">
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label" style="color: #5D5D5D">手机:</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="phone" value="" type="number" placeholder="请输入您的手机号码">
        </div>
    </div>
</div>
<div class="weui-cells weui-cells_form" style="width: 90%;margin: 0 auto;border-radius: 5px;margin-bottom: 15px;">
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label" style="color: #5D5D5D">密码:</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="password" value="" type="password" placeholder="请输入您的密码">
        </div>
    </div>
</div>
<div class="weui-cells weui-cells_form" style="width: 90%;margin: 0 auto;border-radius: 5px;margin-bottom: 35px;">
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label" style="color: #5D5D5D">确认密码:</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="relPassword" value="" type="password" placeholder="请再次输入您的密码">
        </div>
    </div>
</div>

<a href="javascript:;"id="save" onclick="save()" class="weui-btn weui-btn_disabled weui-btn_primary" style="width: 90%;background: #7AC4FA;color: white">
    立即注册
</a>
<div style="width: 90%;margin: 0 auto;margin-top: 10px;font-size: 15px;">
    <a href="javascript:;" style="color: #009900" onclick="cut()"><img src="/Home/img/qieHuan.png" alt="" width="20px" style="vertical-align: middle">切换<span class="isLog">登录</span></a>
</div>


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
        setItem('shangUrl','person');
        //    图片上传
        layui.use('upload', function(){
            layui.upload({
                elem: ".up",
                url: '<?php echo U("upload");?>'
                ,ext: 'jpg|png|gif|jpeg', //那么，就只会支持这三种格式的上传。注意是用|分割。
                before: function(input){
                    $.showLoading();
                }
                ,success: function(res){
                    console.log(res);
                    $.hideLoading();
                    if(res.savepath && res.savename){
                        var img = '/Application/Home/Public/'+res.savepath+res.savename;
                        $('#uploder').find('img').attr('src',img);
                        var imgSrc = $('#uploder').find('img').attr("src");
                        getImageWidth(imgSrc,function(w,h){
                            if(w < h){
                                $('#uploder').find('img').attr('width','120px');
                            }else{
                                $('#uploder').find('img').attr('height','120px');
                            }
                        });
                    }else{
                        $.toast('上传失败', "forbidden");
                    }
                }
            });
        });

        function getImageWidth(url,callback){
            var img = new Image();
            img.src = url;

            // 如果图片被缓存，则直接返回缓存数据
            if(img.complete){
                callback(img.width, img.height);
            }else{
                // 完全加载完毕的事件
                img.onload = function(){
                    callback(img.width, img.height);
                }
            }
        }
    });

    //存到缓存
    function setCookie(name, value) {
        var Days = 300;
        var exp = new Date();
        exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
        document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString() + ';path=/';
    }
    //    获取缓存
    function getCookie(name) {
        var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");

        if (arr = document.cookie.match(reg)) {
            //console.log(arr);
            return unescape(arr[2]);
        }
        else {
            return null;
        }
    }
//    点击切换
    function cut(){
        yesInput();
        var len = $('#save').length;
        if(len==1){
            //当前出现的按钮是注册
            cutZC();
        }else{
            //当前出现的按钮是登录
            cutDL();
        }
    }
//当前出现的按钮是注册
    function cutZC(){
        $('.weui-cells_form').find('input').val('');
        $('#relPassword').parent().parent().hide();
        $('#phone').parent().parent().parent().hide();
        $('#reName').parent().parent().hide();
        $('.isLog').text('注册');
        $('#save').attr('onclick','login()');
        $('#save').text('登录');
        $('#save').attr('id','login');
    }
//当前出现的按钮是登录
    function cutDL(){
        $('.weui-cells_form').find('input').val('');
        $('#relPassword').parent().parent().show();
        $('#phone').parent().parent().parent().show();
        $('#reName').parent().parent().show();
        $('.isLog').text('登录');
        $('#login').attr('onclick','save()');
        $('#login').text('立即注册');
        $('#login').attr('id','save');
    }

//    点击注册
    function save(){
        $('#save').attr('onclick','');
        var data = {};
        var partten = /^1[3,5,7,8]\d{9}$/;
        var reg = /[\u4E00-\u9FA5\uF900-\uFA2D]/;
        data.name   = $('#name').val();
        data.reName = $('#reName').val();
        data.phone  = $('#phone').val();
        data.pass   = $('#password').val();
        var relP    = $('#relPassword').val();
        data.img    = $('#uploder').find('img').attr('src');
        if(!data.name){
            mage('请填写名称');
            return false;
        }
        if(!data.reName){
            mage('请填写您的真实姓名');
            return false;
        }
        if(!reg.test(data.reName)){
            mage('请正确填写您的真实姓名');
            return false;
        }
        if(!data.phone){
            mage('请填写您的手机号码');
            return false;
        }
        if(!partten.test(data.phone)){
            mage('您的手机号码填写不正确');
            return false;
        }
        if(!data.pass){
            mage('请填写密码');
            return false;
        }
        if(!relP){
            mage('请再次填写密码');
            return false;
        }
        if(relP!=data.pass){
            mage('保持两次密码填写一致');
            return false;
        }
        if(!data.img){
            a = 0;
            shanSuo();
            mage('请上传头像');
            return false;
        }
        $.showLoading();
        $.ajax({
            cache: true,
            type: "POST",
            url:'<?php echo U("ZC");?>',
            data:data,// 你的formid
            async: false,
            error: function(request) {
                $.hideLoading();
                alert("Connection error");
            },
            success: function(data) {
                $.hideLoading();
                var data = eval('(' + data + ')');
                if(data.status==1){
                    $.toast("注册成功");
                    noInput();
                    setCookie('memberId',data.id);
                }else{
                    $.toast(data.msg, "cancel");
                    $('#save').attr('onclick','save()');
                }
            }
        });
    }
//    点击登录
    function login(){
        $('#login').attr('onclick','');
        var data = {};
        data.name = $('#name').val();
        data.pass = $('#password').val();
        if(!data.name){
            $.toast('请填写登录名', "forbidden");
            $('#login').attr('onclick','login()');
            return false;
        }
        if(!data.pass){
            $.toast('请填写密码', "forbidden");
            $('#login').attr('onclick','login()');
            return false;
        }
        $.ajax({
            cache: true,
            type: "POST",
            url:'<?php echo U("login");?>',
            data:data,// 你的formid
            async: false,
            error: function(request) {
                $.hideLoading();
                alert("Connection error");
            },
            success: function(data) {
                $.hideLoading();
                var data = eval('(' + data + ')');
                if(data.status==1){
                    $.toast("登录成功");
                    $('#uploder').find('img').attr('src',data.img);
                    setCookie('memberId',data.id);
                }else{
                    $.toast(data.msg, "cancel");
                    $('#login').attr('onclick','login()');
                }
            }
        });
    }
//    错误提示信息
    function mage(str){
        $.toast(str, "forbidden");
        $('#save').attr('onclick','save()');
    }

/**
 * 头像上传
 */
    function uploder(){
        $('.up').click();
    }
//    边框闪烁
    var a = 0;
    function shanSuo(){
        var div=$("#uploder");
        var borderFlag=false;
        var time;
        blinkBorder();
        function blinkBorder()
        {
            time=0;
            for(var i=0;i<10;i++)
            {
                time+=100;
                setTimeout(function()
                {modifyBorder();},time);
            }
        }
        function modifyBorder()
        {
            a+=1;
            borderFlag=!borderFlag;
            if(borderFlag)
            {
                div.removeClass("border1").addClass("border2");
            }
            else
            {
                div.removeClass("border2").addClass("border1");
            }
            if(a==10){
                div.removeClass();
            }
        }
    }

//    设置form表单不能输入
    function noInput(){
        $('.weui-cells_form').find('input').attr('readonly',true);
        $('#save').css('background','#777');
    }
//    恢复表单输入
    function yesInput(){
        $('.weui-cells_form').find('input').attr('readonly',false);
        $('#save').css('background','#7AC4FA');
    }

    function goBack(){
        window.history.back();  //返回上一页
    }
</script>
</body>
</html>