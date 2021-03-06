<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>知识点回顾</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!--标准mui.css-->
    <link rel="stylesheet" href="/Home/mui/css/mui.min.css">
</head>
<style>
    .mui-navigate-right:after{color: #23BEAE}
    .mui-views, .mui-view, .mui-pages, .mui-page, .mui-page-content {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        background-color: #efeff4;
    }
    .mui-pages {
        top: 46px;
        height: auto;
    }
    .mui-scroll-wrapper,
    .mui-scroll {
        background-color: #efeff4;
    }
    .mui-page.mui-transitioning {
        -webkit-transition: -webkit-transform 300ms ease;
        transition: transform 300ms ease;
    }
    .mui-page-left {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }
    .mui-ios .mui-page-left {
        -webkit-transform: translate3d(-20%, 0, 0);
        transform: translate3d(-20%, 0, 0);
    }
    .mui-navbar {
        position: fixed;
        right: 0;
        left: 0;
        z-index: 10;
        height: 44px;
        background-color: #f7f7f8;
    }
    .mui-navbar .mui-bar {
        position: absolute;
        background: transparent;
        text-align: center;
    }
    .mui-page-shadow {
        position: absolute;
        right: 100%;
        top: 0;
        width: 16px;
        height: 100%;
        z-index: -1;
        content: '';
    }
    .mui-page-shadow {
        background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 10%, rgba(0, 0, 0, .01) 50%, rgba(0, 0, 0, .2) 100%);
        background: linear-gradient(to right, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 10%, rgba(0, 0, 0, .01) 50%, rgba(0, 0, 0, .2) 100%);
    }
    .mui-navbar-inner.mui-transitioning,
    .mui-navbar-inner .mui-transitioning {
        -webkit-transition: opacity 300ms ease, -webkit-transform 300ms ease;
        transition: opacity 300ms ease, transform 300ms ease;
    }
    .mui-page {
        display: none;
    }
    .mui-pages .mui-page {
        display: block;
    }
    .mui-input-row .mui-input-clear ~ .mui-icon-clear{right: 18%}
    p{margin-bottom: 0}
</style>
<body>

<!--页面主结构开始-->
<div id="app" class="mui-views">
    <div class="mui-view">
        <div class="mui-navbar">
        </div>
        <div class="mui-pages">
        </div>
    </div>
</div>
<!--知识点-->
<div id="setting" class="mui-page">
    <!--页面标题栏开始-->
    <div class="mui-navbar-inner mui-bar mui-bar-nav">
        <button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">
            <span class="mui-icon mui-icon-left-nav"></span>
        </button>
        <h1 class="mui-center mui-title">知识点回顾(<span style="color: #FFA211"><?php echo $study;?></span>)</h1>
    </div>
    <!--添加知识点-->
    <div class="mui-card">
        <ul class="mui-table-view mui-table-view-chevron">
            <li class="mui-table-view-cell mui-media">
                <a class="mui-navigate-right" href="#general">
                    <img class="mui-media-object mui-pull-left" src="/Home//img/jia.png" style="width: 30px; height: 30px">
                    <div class="mui-media-body" style="height: 30px;line-height: 33px;color: #23BEAE">
                        发表知识
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <?php if($data){?>
    <?php foreach($data as $k=>$v){?>
    <!--知识点列表-->
    <div class="mui-card">
        <div class="mui-card-header mui-card-media">
            <img src="<?php echo $v['cover'];?>" />
            <div class="mui-media-body">
                <?php echo $v['send_member_name'];?>
                <p>发表于 <?php echo $v['create_time'];?></p>
            </div>
        </div>
        <div class="mui-card-content" style="padding: 10px">
            <p style="margin-bottom: -10px;color: #227544">《<?php pre; echo htmlentities($v['name']);?>》</p>
            <p style="margin-bottom: 0"><pre><?php pre; echo htmlentities($v['info']);?></pre></p>
        </div>
        <div class="mui-card-footer">
            <p class="mui-card-link">点赞次数:<span class="zCount"><?php echo $v['zCount'];?></span></p>
            <?php if(isset($v['zan_token']) && $v['zan_token']==1){?>
            <a class="mui-card-link" style="padding-left: 45%"><img src="/Home/img/zan_on.png" data_t="zanI<?php echo $k;?>" data_id="<?php echo $v['id']?>" data_token="1" onclick="zan(this)" width="20px" alt=""></a>
            <?php }else{?>
            <a class="mui-card-link" style="padding-left: 45%"><img src="/Home/img/zan.png" data_t="zanI<?php echo $k;?>" data_id="<?php echo $v['id']?>" data_token="" onclick="zan(this)" width="20px" alt=""></a>
            <?php }?>
            <a class="mui-card-link say" data_c="say<?php echo $k;?>" data_token=""><img src="/Home/img/say.png" width="20px" alt=""></a>
        </div>
        <div class="mui-input-row say<?php echo $k;?>" style="padding-left: 10px;padding-right: 10px;display: none">
            <input type="text" class="mui-input-clear" placeholder="填写评论信息" style="width: 82%">
            <button type="button" onclick="faBiao(this)" data_k="say<?php echo $k;?>" data-id="<?php echo $v['id'];?>" class="" style="width: 15%;padding: 0;height: 40px">发送</button>
        </div>
        <div id="zanI<?php echo $k;?>">
            <?php if(isset($v['zan'])){?>
            <p class="mui-card-link" style="padding-left: 15px;padding-right: 15px">
                <img src="/Home/img/dianZan.png" width="20px" alt="">
                <?php foreach($v['zan'] as $t=>$p){?>
                <?php if($t<count($v['zan'])-1){?>
                <span class="zanC" data_id="<?php echo $p['zan_id'];?>" style="color: #1296DB"><?php echo $p['zan_name'];?></span><span>、</span>
                <?php }else{?>
                <span class="zanC" data_id="<?php echo $p['zan_id'];?>" style="color: #1296DB"><?php echo $p['zan_name'];?></span>
                <?php }}?>
            </p>
            <?php }?>
        </div>
        <!--评论信息-->
        <div id="say<?php echo $k;?>" style="padding-left: 15px;padding-right: 15px;margin-bottom: 10px">
            <?php if(isset($v['say']) && $v['say']){?>
            <?php foreach($v['say'] as $o){?>
            <div style="color: #555"><span style="color: #1296DB"><?php echo $o['sayName'];?></span>：<span><?php echo $o['say_info'];?></span></div>
            <?php }?>
            <?php }?>
        </div>
    </div>

    <?php }?>
    <?php }else{?>
    <div style="text-align: center">
        <img src="/Home//img/noDate.png" alt="">
        <p>还没有数据,去添加一点吧！！！</p>
    </div>
    <?php }?>
    <!--页面主内容区结束-->
</div>

<!--添加页码-->
<div id="general" class="mui-page">
    <div class="mui-navbar-inner mui-bar mui-bar-nav">
        <button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">
            <span class="mui-icon mui-icon-left-nav"></span>返回
        </button>
        <h1 class="mui-center mui-title">发表知识点(<span style="color: #FFA211"><?php echo $study;?></span>)</h1>
    </div>
    <div class="mui-page-content">
        <div class="mui-content">
            <div class="mui-content-padded" style="margin: 5px;">
                <form class="mui-input-group" style="margin: 10px 5px">
                    <div class="mui-input-row">
                        <label>标题：</label>
                        <input type="text" id="title" class="mui-input-clear" placeholder="填写发表知识标题">
                    </div>
                </form>
                <div class="mui-input-row" style="margin: 10px 6px;">
                    <textarea id="textarea" rows="10" placeholder="具体知识描述："></textarea>
                    <div style="position: absolute;right: 20px;bottom: 30px;color: #b2b2b2"><span id="num">500</span>/500</div>
                </div>
                <div style="margin: 10px 5px">
                    <button type="button" class="mui-btn-block mui-btn-primary" id="save" onclick="save()" style="padding: 5px 0">提交</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/Home/mui/js/mui.min.js"></script>
<script src="/Home/mui/js/mui.view.js"></script>
<script src="/Home/js/jquery.min.js"></script>
<!--移动端layery-->
<script src="/Home/layer/mobile/layer.js"></script>
<script>
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
    /*字数限制*/
    $("#textarea").on("input propertychange", function() {
        var $this = $(this),
                _val = $this.val(),
                count = "";
        if (_val.length > 500) {
            $this.val(_val.substring(0, 500));
        }
        count = 500 - $this.val().length;
        $("#num").text(count);
    });

    mui.init();
    //初始化单页view
    var viewApi = mui('#app').view({
        defaultPage: '#setting'
    });
    var view = viewApi.view;
    (function($) {
        //处理view的后退与webview后退
        var oldBack = $.back;
        $.back = function() {
            if (viewApi.canBack()) { //如果view可以后退，则执行view的后退
                viewApi.back();
            } else { //执行webview后退
                oldBack();
            }
        };
        //监听页面切换事件方案1,通过view元素监听所有页面切换事件，目前提供pageBeforeShow|pageShow|pageBeforeBack|pageBack四种事件(before事件为动画开始前触发)
        //第一个参数为事件名称，第二个参数为事件回调，其中e.detail.page为当前页面的html对象
        view.addEventListener('pageBeforeShow', function(e) {
            //				console.log(e.detail.page.id + ' beforeShow');
        });
        view.addEventListener('pageShow', function(e) {
            //				console.log(e.detail.page.id + ' show');
        });
        view.addEventListener('pageBeforeBack', function(e) {
            //				console.log(e.detail.page.id + ' beforeBack');
        });
        view.addEventListener('pageBack', function(e) {
            //				console.log(e.detail.page.id + ' back');
        });
    })(mui);
    //初始化单页的区域滚动
    mui('.mui-scroll-wrapper').scroll();

    mui('body').on('tap', '.say', function() {
        var data_c = this.getAttribute("data_c");
        var token  = this.getAttribute("data_token");
        if(!token){
            $('.'+data_c).show();
            $('.'+data_c).addClass('sayInput');
            $(this).attr('data_token',1);
            $(this).find('img').attr('src','/Home/img/say_on.png');
            $('.'+data_c).find('input').focus();
        }else{
            $('.'+data_c).hide();
            $('.sayInput').removeClass('sayInput');
            $(this).attr('data_token','');
            $(this).find('img').attr('src','/Home/img/say.png');
            $('.'+data_c).find('input').blur();
        }
    });

    /*任意点击，关闭输入框*/
    window.addEventListener("dragend",function(){
        console.log(11);
        $('.sayInput').hide();
        $('.sayInput').parent().find('.say').find('img').attr('src','/Home/img/say.png');
        $('.sayInput').removeClass('sayInput');
    });

    /*添加知识*/
    function save(){
        var mId = getCookie('memberId');
        if(!mId){
            location.href='/index.php/Home/Index/login.html';
        }else{
            $('#save').attr('onclick','');
            var data    = {};
            data.name   = $('#title').val();
            data.info   = $('#textarea').val();
            data.send_member_id = mId;
            data.study  = "<?php echo $study;?>";
            console.log(data)
            if(!data.name){
                msg('请填写标题');
                $('#save').attr('onclick','save()');
                return false;
            }
            if(!data.info){
                msg('请填写具体描述');
                $('#save').attr('onclick','save()');
                return false;
            }
            if(!data.send_member_id || !data.study){
                msg('数据异常');
                $('#save').attr('onclick','save()');
                return false;
            }
            $.ajax({
                cache: true,
                type: "POST",
                url:'/index.php/Home/Index/knowledgeAdd.html',
                data:data,// 你的formid
                async: false,
                error: function(request) {
        //                console.log(request)
                },
                success: function(data) {
                    var data =  eval('(' + data + ')');
                    if(data.status == 1){
                        location.reload();
                    }else{
                        msg(data.msg);
                    }
                }
            });
        }
    }

    function msg(s){
        layer.open({
            content: s
            ,skin: 'msg'
            ,time: 2 //2秒后自动关闭
        });
    }


    /*点击赞*/
    function zan(obj){
        $(obj).attr('onclick','');
        var mId   = getCookie('memberId');
        var mName = getCookie('memberName');
        if(!mId){
           location.href='/index.php/Home/Index/login.html';
           return false;
        }
        var token  = $(obj).attr('data_token');
        var idC    = $(obj).attr('data_t');
        var counts = $(obj).parent().parent().find('.zCount').text();
        if(!token){
            var url = '/index.php/Home/Index/saveZan.html';
            //没有点赞
            $(obj).attr('data_token',1);
            $(obj).css('transform','scale(2) rotate(0deg)');
            $(obj).addClass('zanClass');
            setTimeout("$('.zanClass').css('transform','scale(1) rotate(0deg)')",200);
            setTimeout("$('.zanClass').removeClass('zanClass')",500);
            $(obj).attr('src','/Home/img/zan_on.png');
            if($('#'+idC).find('.zanC').length>0){
                var str = '<span>、</span><span class="zanC" data_id="'+mId+'" style="color: #1296DB">'+mName+'</span>';
                $('#'+idC).find('.zanC:last').after(str);
            }else{
                var str = '<p class="mui-card-link" style="padding-left: 15px;padding-right: 15px">';
                    str += '<img src="/Home/img/dianZan.png" width="20px" alt="">&nbsp;';
                    str += '<span class="zanC" data_id="'+mId+'" style="color: #1296DB">'+mName+'</span></p>';
                $('#'+idC).append(str);
            }
            $(obj).parent().parent().find('.zCount').text(Number(counts)+1);
        }else{
            var len = $('#'+idC).find('.zanC').length;
            var arr = [];
            for(var i=0; i<len; ++i){
                var objc= {};
                if($('#'+idC).find('.zanC').eq(i).attr('data_id') != mId){
                    objc.id   = $('#'+idC).find('.zanC').eq(i).attr('data_id');
                    objc.name = $('#'+idC).find('.zanC').eq(i).text();
                    arr[i]    = objc;
                }
            }
            if(arr.length>0){
                $('#'+idC).html('');
                var s = '';
                s += '<p class="mui-card-link" style="padding-left: 15px;padding-right: 15px"><img src="/Home/img/dianZan.png" width="20px" alt="">&nbsp;';
                for(var i=0; i<arr.length; ++i){
                    s += '<span class="zanC" data_id="'+arr[i].id+'" style="color: #1296DB">'+arr[i].name+'</span>';
                    if(i < arr.length-1){
                        s += '<span>、</span>';
                    }
                }
                s += '</p>';
                $('#'+idC).html(s);
            }else{
                $('#'+idC).html('');
            }
            var url = '/index.php/Home/Index/jianZan.html';
            //已经点赞，待取消
            $(obj).attr('data_token','');
            $(obj).attr('src','/Home/img/zan.png');
            $(obj).parent().parent().find('.zCount').text(Number(counts)-1);
        }
        var data = {};
        data.id = $(obj).attr('data_id');
        $.ajax({
            cache: true,
            type: "POST",
            url:url,
            data:data,// 你的formid
            async: false,
            error: function(request) {
                $(obj).attr('onclick','zan(this)');
                //                console.log(request)
            },
            success: function(data) {
                $(obj).attr('onclick','zan(this)');
            }
        });
    }

    mui(document.body).on('tap', '.mui-btn', function(e) {
        mui(this).button('loading');
        setTimeout(function() {
            mui(this).button('reset');
        }.bind(this), 2000);
    });

    /*点击发表评论*/
    function faBiao(obj){
        var info = $(obj).parent().find('input').val();
        var sayId= $(obj).attr('data_k');
        if(info){
            var mId   = getCookie('memberId');
            var mName = getCookie('memberName');
            if(mId && mName){
                var data = {};
                data.say_info       = info;
                data.knowledge_id   = $(obj).attr('data-id');
                data.say_member_id  = mId;
                data.say_member_name= mName;
                $.ajax({
                    cache: true,
                    type: "POST",
                    url:'/index.php/Home/Index/addSay.html',
                    data:data,// 你的formid
                    async: false,
                    error: function(request) {
                        //                console.log(request)
                    },
                    success: function(data) {
                        var data =  eval('(' + data + ')');
                        if(data.status==1){
                            var str = '<div style="color: #555"><span style="color: #1296DB">'+mName+'</span>：<span>'+info+'</span></div>';
                            $('#'+sayId).append(str);
                        }else{
                            msg(data.msg);
                        }
                        console.log(data);
                    }
                });
            }else{
                location.href='/index.php/Home/Index/login.html';
                return false;
            }
        }
    }
</script>
</body>

</html>