<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>徐昌茂</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/Home/mui/css/mui.min.css">
    <link rel="stylesheet" href="/Home/mui/css/xcmImg.css">
    <style type="text/css">
        /*span.mui-icon {*/
            /*font-size: 14px;*/
            /*color: #007aff;*/
            /*margin-left: -15px;*/
            /*padding-right: 10px;*/
        /*}*/
        .mui-off-canvas-left {
            color: #fff;
        }
        .title {
            margin: 35px 15px 10px;
        }
        .title+.content {
            margin: 10px 15px 35px;
            color: #bbb;
            text-indent: 1em;
            font-size: 14px;
            line-height: 24px;
        }
        input {
            color: #000;
        }
        .mui-table-view:before{background: none}
        .mui-table-view:after{background: none}
        .mui-navigate-right:after{color: #666}
        #holder {
            width: 300px;
            height: 300px;
            border: solid 1px #bbb;
            border-radius: 5px;
            margin: 50px auto;
            background-color: #fff;
        }
        #alert {
            text-align: center;
            padding: 20px 10px;
        }
        .mui-grid-view.mui-grid-9 .mui-table-view-cell{padding: 0 15px}
    </style>
</head>
<body>
<div class="mui-content" id="pssw" style="position: absolute;z-index: 50;display: none;top: 0;right: 0; left: 0;bottom: 0">
    <div id='holder' style="margin: auto;margin-top: 100px" class="mui-locker" data-locker-options='{"ringColor":"rgba(210,210,210,1)","fillColor":"#ffffff","pointColor":"rgba(0,136,204,1)","lineColor":"rgba(0,136,204,1)"}' data-locker-width='300' data-locker-height='300'></div>
    <div id='alert'></div>
</div>
<div id="offCanvasWrapper" class="mui-off-canvas-wrap mui-draggable">
    <!--侧滑菜单部分-->
    <aside id="offCanvasSide" class="mui-off-canvas-left" style="background: whitesmoke">
        <!--用户信息区域-->
        <ul class="mui-table-view" style="background: url('/Home/img/bg2.jpg')">
            <?php if(isset($m) && $m){?>
            <li class="mui-table-view-cell mui-media mem m">
                <a href="/index.php/Home/Index/login.html" style="margin: 0">
                    <img class="mui-media-object mui-pull-left" style="width: 45px;height: 45px;border-radius: 50%;" src="<?php echo $m['img'];?>">
                    <div class="mui-media-body" style="height: 45px;line-height: 45px">
                        <p class='mui-ellipsis' style="color: white;font-weight: bold; font-size: 20px"><?php echo $m['re_name'];?></p>
                    </div>
                </a>
            </li>
            <?php }else{?>
            <li class="mui-table-view-cell mui-media mem">
                <a href="/index.php/Home/Index/login.html" style="margin: 0">
                    <img class="mui-media-object mui-pull-left" style="width: 45px;height: 45px;border-radius: 50%;" src="/Home/img/deful.jpg">
                    <div class="mui-media-body" style="height: 45px;line-height: 45px">
                        <p class='mui-ellipsis' style="color: white;font-weight: bold; font-size: 20px">暂未登录</p>
                    </div>
                </a>
            </li>
            <?php }?>
        </ul>
        <!--菜单栏-->
        <!--知识点-->
        <ul class="mui-table-view mui-table-view-chevron" style="margin-top: 25px">
            <li class="mui-table-view-cell mui-collapse">
                <a class="mui-navigate-right" href="javascript:;">
                    <img class="mui-media-object mui-pull-left" style="width: 25px;height: 25px" src="/Home/img/student_on.png">
                    <div class="mui-media-body" style="height: 25px;line-height: 25px">
                        <p class='mui-ellipsis' style="color: #666">知识点回顾</p>
                    </div>
                </a>
                <ul class="mui-table-view mui-table-view-chevron">
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right" href='/index.php/Home/Index/knowledge.html?study=HTML'>
                            <img class="mui-media-object mui-pull-left" style="width: 20px;height: 20px;" src="/Home/img/html.png">
                            <div class="mui-media-body" style="height: 25px;line-height: 25px">
                                <p class='mui-ellipsis' style="color: #666">HTML知识点</p>
                            </div>
                        </a>
                    </li>
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right" href='/index.php/Home/Index/knowledge.html?study=CSS'>
                            <img class="mui-media-object mui-pull-left" style="width: 25px;height: 25px;" src="/Home/img/css.png">
                            <div class="mui-media-body" style="height: 25px;line-height: 25px">
                                <p class='mui-ellipsis' style="color: #666">CSS知识点</p>
                            </div>
                        </a>
                    </li>
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right" href='/index.php/Home/Index/knowledge.html?study=PHP'>
                            <img class="mui-media-object mui-pull-left" style="width: 20px;height: 20px;" src="/Home/img/PHP.png">
                            <div class="mui-media-body" style="height: 25px;line-height: 25px">
                                <p class='mui-ellipsis' style="color: #666">PHP知识点</p>
                            </div>
                        </a>
                    </li>
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right" href='/index.php/Home/Index/knowledge.html?study=Javascript'>
                            <img class="mui-media-object mui-pull-left" style="width: 20px;height: 20px;" src="/Home/img/JS.png">
                            <div class="mui-media-body" style="height: 25px;line-height: 25px">
                                <p class='mui-ellipsis' style="color: #666">Javascript知识点</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!--后台管理-->
        <ul class="mui-table-view mui-table-view-chevron">
            <li class="mui-table-view-cell mui-collapse">
                <a class="mui-navigate-right" href="javascript:;">
                    <img class="mui-media-object mui-pull-left" style="width: 25px;height: 25px" src="/Home/img/eidt_on.png">
                    <div class="mui-media-body" style="height: 25px;line-height: 25px">
                        <p class='mui-ellipsis' style="color: #666">后台管理</p>
                    </div>
                </a>
                <ul class="mui-table-view mui-table-view-chevron">
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right" href="javascript:;" id="pass">
                            <img class="mui-media-object mui-pull-left" style="width: 20px;height: 20px;" src="/Home/img/eidt2.png">
                            <div class="mui-media-body" style="height: 25px;line-height: 25px">
                                <p class='mui-ellipsis' style="color: #666">人员信息管理</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
    <!-- 主页面容器 -->
    <div class="mui-inner-wrap">
        <div id="offCanvasContentScroll" class="mui-content mui-scroll-wrapper">
            <div class="mui-scroll">
                <!-- 主界面具体展示内容 -->
                <!--首页轮播-->
                <div>
                    <div id="slider" class="mui-slider" style="position: relative">
                        <div style="position: absolute;z-index: 500;left: 10px; top: 10px">
                            <a href="#offCanvasSide" class="">
                                <img src="/Home/img/muiN.png" width="45px"; height="45px" alt="">
                            </a>
                        </div>
                        <div class="mui-slider-group mui-slider-loop">
                            <!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
                            <div class="mui-slider-item mui-slider-item-duplicate">
                                <a href="#">
                                    <img src="http://w.scydgl.com/data/upload/20170323/2017032313544442945.jpg" style="height: 250px;width: 100%" data-preview-src="" data-preview-group="1" >
                                    <p class="mui-slider-title">静静看这世界</p>
                                </a>
                            </div>
                            <div class="mui-slider-item">
                                <a href="#">
                                    <img src="/Home/img/yangtuo.jpeg" style="height: 300px;width: 100%" data-preview-src="" data-preview-group="1">
                                    <p class="mui-slider-title">静静看这世界</p>
                                </a>
                            </div>
                            <div class="mui-slider-item">
                                <a href="#">
                                    <img src="/Home/img/fengjin1.jpg" style="height: 300px;width: 100%" data-preview-src="" data-preview-group="1">
                                    <p class="mui-slider-title">安静的女汉子</p>
                                </a>
                            </div>
                            <div class="mui-slider-item">
                                <a href="#">
                                    <img src="/Home/img/dongW.jpg" style="height: 300px;width: 100%" data-preview-src="" data-preview-group="1">
                                    <p class="mui-slider-title">坑得批爆的娃娃</p>
                                </a>
                            </div>

                            <div class="mui-slider-item">
                                <a href="#">
                                    <img src="/Home/img/yingT.jpg" style="height: 300px;width: 100%" data-preview-src="" data-preview-group="1">
                                    <p class="mui-slider-title">静静看这世界</p>
                                </a>
                            </div>
                            <!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
                            <div class="mui-slider-item mui-slider-item-duplicate">
                                <a href="#">
                                    <img src="/Home/img/yangtuo.jpeg" style="height: 300px;width: 100%" data-preview-src="" data-preview-group="1" >
                                    <p class="mui-slider-title">静静看这世界</p>
                                </a>
                            </div>
                        </div>
                        <div class="mui-slider-indicator mui-text-right">
                            <div class="mui-indicator mui-active"></div>
                            <div class="mui-indicator"></div>
                            <div class="mui-indicator"></div>
                            <div class="mui-indicator"></div>
                        </div>
                    </div>
                </div>
                <!--九宫格菜单-->
                <div id="Gallery" class="mui-slider" style="margin-bottom: 15px">
                    <div class="mui-slider-group">
                        <div class="mui-content">
                            <ul class="mui-table-view mui-grid-view mui-grid-9" style="background: white">
                                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                                    <a href="/index.php/Home/Index/jiaApi.html?api=jia" class="info">
                                        <img src="/Home/img/img/che.png" style="width: 40px" alt="">
                                        <div class="mui-media-body" style="margin-top: 4px">驾驶知识</div>
                                    </a>
                                </li>
                                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                                    <a href="http://www.shangdiandian.cn/t/42rdsl" class="info">
                                        <img src="/Home/img/img/vr.png" style="width: 40px" alt="">
                                        <div class="mui-media-body" style="margin-top: 4px">旅游景点</div>
                                    </a>
                                </li>
                                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                                    <a href="/index.php/Home/Index/caiPuTypeList.html" class="info">
                                        <img src="/Home/img/img/yu.png" style="width: 40px;height: 40px" alt="">
                                        <div class="mui-media-body" style="margin-top: 4px">菜谱</div>
                                    </a>
                                </li>
                                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                                    <a href="/index.php/Home/Index/untieDream.html" class="info">
                                        <img src="/Home/img/img/zhouM.png" style="width: 40px;height: 40px" alt="">
                                        <div class="mui-media-body" style="margin-top: 4px">周公解梦</div>
                                    </a>
                                </li>
                                <?php for($i=0; $i<2; ++$i){?>
                                <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                                    <a href="#" class="info" dataid="uuu">
                                        <span class="mui-icon mui-icon-home"></span>
                                        <div class="mui-media-body">待开发</div>
                                    </a>
                                </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--懒加载图片列表-->
                <ul class="mui-table-view">
                    <?php if($data){?>
                    <?php foreach($data as $v){?>
                    <li class="mui-table-view-cell mui-media">
                        <a href="javascript:;">
                            <img class="mui-media-object mui-pull-left" style="width: 42px; height: 42px" src="<?php echo $v['cover'];?>" data-preview-src="" data-preview-group="1">
                            <div class="mui-media-body">
                                <p class='mui-ellipsis' style="line-height: 45px"><?php echo $v['name'];?></p>
                            </div>
                        </a>
                    </li>
                    <?php }}?>
                </ul>
            </div>
        </div>
        <!--向左边滑动，背景阴影遮盖层-->
        <div class="mui-off-canvas-backdrop"></div>
    </div>
</div>

<script src="/Home/js/jquery.min.js"></script>
<script src="/Home/mui/js/mui.min.js"></script>
<script src="/Home/mui/js/update.js" type="text/javascript" charset="utf-8"></script>
<!--图片查看的js-->
<script src="/Home/mui/js/mui.previewimage.js"></script>
<script src="/Home/mui/js/mui.zoom.js"></script>
<!--图片列表懒加载的js-->
<script src="/Home/mui/js/mui.lazyload.js"></script>
<script src="/Home/mui/js/mui.lazyload.img.js"></script>
<!--手势解锁-->
<script src="/Home/mui/js/mui.locker.js"></script>
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

    $(function () {
        mInfo();
    });

    /*用户信息*/
    function mInfo(){
        var mId = getCookie('memberId');
        var l   = $('.m').length;
        if(mId && l<1){
            var data = {};
            data.id = mId;
            $.ajax({
                cache: true,
                type: "POST",
                url: '/index.php/Home/Index/mInfo.html',
                data: data,// 你的formid
                async: false,
                error: function (request) {
                    console.log(request)
                },
                success: function (data) {
                    var data = eval('(' + data + ')');
                    if(data.status==1){
                        $('.mem').find('img').attr('src',data.img);
                        $('.mem').find('p').text(data.name);
                        $('.mem').addClass('m');
                    }
                }
            });
        }

    }

//    轮播图
    var slider = mui("#slider");
    slider.slider({
        interval: 1000
    });
//    图片查看
    mui.previewImage();
    mui.init();

    //点击跳转页面
    mui('body').on('tap', 'a', function() {
        var href = this.getAttribute('href');
        mui.openWindow({
            id: href ,
            url: href
        });
    });


    //主界面和侧滑菜单界面均支持区域滚动；
    mui('#offCanvasSideScroll').scroll();
    mui('#offCanvasContentScroll').scroll();
    //弹出手势解锁
    mui("body").on("tap","#pass",pwd);
    //显示手势解锁
    function pwd(){
        $('#pssw').show();
    };
    //隐藏手势解锁
    $('#pssw').click(function(){
        $('#pssw').hide();
    });

    (function($, doc) {
        $.init();
        var holder = doc.querySelector('#holder'),
                alert = doc.querySelector('#alert'),
                record = [];
        //处理事件
        holder.addEventListener('done', function(event) {
            var n = event.detail.points;
            n = n.join(",");
            console.log(n);
            var data = {};
            data.n = n;
            $.ajax({
                cache: true,
                type: "POST",
                url: '/index.php/Home/Index/verify.html',
                data: data,// 你的formid
                async: false,
                error: function (request) {
                    console.log(request)
                },
                success: function (data) {
                    var data = eval('(' + data + ')');
                    if(data.status==1){
                        location.href='/index.php/Home/Index/friendList.html';
                    }else{
                        alert.innerText = '密码错误';
                    }
                }
            });
        });
    }(mui, document));
</script>
</body>
</html>