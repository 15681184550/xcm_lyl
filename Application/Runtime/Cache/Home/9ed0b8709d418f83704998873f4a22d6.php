<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>徐昌茂</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
</head>
<link href="/Home//img/1.jpg" rel="shortcut icon" />
<link href="/Home/jqweui/dist/lib/weui.min.css" rel="stylesheet">
<link href="/Home/jqweui/dist/css/jquery-weui.min.css" rel="stylesheet">
<script src="/Home/js/jquery.min.js"></script>
<script src="/Home/js/layer.js"></script>
<script src="/Home/jqweui/dist/js/swiper.js"></script>
<style>
    .swiper-wrapper img{width: 100%;height: 300px;}
    .weui-grids img{width: 70px;height: 70px}
    .weui-grid{padding: 10px 5px}
    .weui-grid__icon+.weui-grid__label{margin-top: 10px}
    .weui-photo-browser-modal{z-index: 1000}
    .weui-grid__icon{width: 70px;height: 70px}
</style>
<body ontouchstart style="background: #F5F5F5">
<!--首页开始-->
<div id="tag1" style="display: none">
    <!--轮播开始-->
    <div class="swiper-container" style="background: #F5F5F5" data-space-between='10' data-pagination='.swiper-pagination' data-autoplay="1000">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="/Home//img/1.jpg" width="100%" alt="" onclick="showImgB(this.src)"></div>
            <div class="swiper-slide"><img src="/Home//img/bannerC.jpg" alt="" onclick="showImgB(this.src)"></div>
            <div class="swiper-slide"><img src="/Home//img/bannerWT.jpeg" alt="" onclick="showImgB(this.src)"></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <!--轮播结束-->
    <!--热门开始-->
    <div class="weui-cells" style="margin-top: 0">
        <div class="weui-cell">
            <div class="weui-cell__hd"><img src="/Home//img/ren.png" width="22px"></div>
            <div class="weui-cell__bd">
                <p style="color: #1296db">人员列表</p>
            </div>
        </div>
        <div class="weui-grids">
            <?php if(isset($data) && $data){?>
            <?php foreach($data as $k=>$v){?>
            <a href="javascript:;" class="weui-grid js_grid" onclick="showImg<?php echo $k;?>()" style="position: relative">
                <div class="weui-grid__icon">
                    <img src="<?php echo $v['cover']?>" alt="">
                    <p class="weui-grid__label" style="margin-top: 0;position: absolute;width: 70px;top: 60px;color: white;background: black;opacity: 0.5">&nbsp;</p>
                    <div style="width: 70px;text-align: center;position: absolute;top: 58px;color: white"><?php echo $v['name']?></div>
                </div>
            </a>
            <script>
//                九宫格图片查看
                function showImg<?php echo $k;?>(){
                    var pb<?php echo $k;?> = $.photoBrowser({
                        items: ["<?php echo $v['cover']?>"]
                    });
                    pb<?php echo $k;?>.open();
                }
            </script>
            <?php }?>
            <?php }else{?>
            <?php for($i=0; $i<9; ++$i){?>
            <a href="/?m=weixin.wap.visa.index&a=visaList" class="weui-grid js_grid">
                <div class="weui-grid__icon">
                    <img src="/Home/img/1.jpg" alt="">
                </div>
                <p class="weui-grid__label">
                    Button
                </p>
            </a>
            <?php }}?>
        </div>
    </div>
    <!--热门结束-->
</div>
<!--首页结束-->
<!--管理开始-->
<div id="tag2" style="display: none">
    <div class="weui-cells" style="margin-top: 10px">
        <a href="javascipt:;">
            <div class="weui-cell">
                <div class="weui-cell__hd"><img width="25px" src="/Home/img/banner.png"></div>
                <div class="weui-cell__bd">
                    <p style="color: #333">banner管理</p>
                </div>
                <div class="weui-cell__ft" style="color: #1296DB;font-weight: bold"> > </div>
            </div>
        </a>
    </div>
    <div class="weui-cells" style="margin-top: 10px">
        <a href="javascript:;" onclick="jiu()">
            <div class="weui-cell">
                <div class="weui-cell__hd"><img width="25px" src="/Home/img/jiu.png"></div>
                <div class="weui-cell__bd">
                    <p style="color: #333">九宫格</p>
                </div>
                <div class="weui-cell__ft" style="color: #1296DB;font-weight: bold"> > </div>
            </div>
        </a>
    </div>

    <div class="weui-cells" style="margin-top: 10px">
        <a href="javascript:;" onclick="person()">
            <div class="weui-cell">
                <div class="weui-cell__hd"><img width="25px" src="/Home/img/person.png"></div>
                <div class="weui-cell__bd">
                    <p style="color: #333">个人中心</p>
                </div>
                <div class="weui-cell__ft" style="color: #1296DB;font-weight: bold"> > </div>
            </div>
        </a>
    </div>
</div>
<!--管理结束-->
<!--知识回顾开始-->
<div id="tag3" style="display: none">
    <div class="weui-cells" style="margin-top: 10px">
        <a href='/index.php/Home/Index/knowledge.html?study=Javascript'>
            <div class="weui-cell">
                <div class="weui-cell__hd"><img src="/Home//img/JS.png" width="30px"></div>
                <div class="weui-cell__bd">
                    <p style="color: #333">Javascript知识点</p>
                </div>
                <div class="weui-cell__ft"><img width="15px" src="/Home/img/you.png"></div>
            </div>
        </a>
    </div>

    <div class="weui-cells" style="margin-top: 10px">
        <a href='/index.php/Home/Index/knowledge.html?study=PHP'>
            <div class="weui-cell">
                <div class="weui-cell__hd"><img src="/Home//img/php.png" width="30px"></div>
                <div class="weui-cell__bd">
                    <p style="color: #333">PHP知识点</p>
                </div>
                <div class="weui-cell__ft"><img width="15px" src="/Home/img/you.png"></div>
            </div>
        </a>
    </div>

    <div class="weui-cells" style="margin-top: 10px">
        <a href='/index.php/Home/Index/knowledge.html?study=CSS'>
            <div class="weui-cell">
                <div class="weui-cell__hd"><img src="/Home//img/css.png" width="30px"></div>
                <div class="weui-cell__bd">
                    <p style="color: #333">CSS知识点</p>
                </div>
                <div class="weui-cell__ft"><img width="15px" src="/Home/img/you.png"></div>
            </div>
        </a>
    </div>

    <div class="weui-cells" style="margin-top: 10px">
        <a href='/index.php/Home/Index/knowledge.html?study=HTML'>
            <div class="weui-cell">
                <div class="weui-cell__hd"><img src="/Home//img/html.png" width="30px"></div>
                <div class="weui-cell__bd">
                    <p style="color: #333">HTML知识点</p>
                </div>
                <div class="weui-cell__ft"><img width="15px" src="/Home/img/you.png"></div>
            </div>
        </a>
    </div>
</div>
<!--知识回顾结束-->
<!--底部导航开始-->
<div class="weui-tab" style="margin-top: 50px">
    <div class="weui-tabbar" style="position: fixed">
        <a href="javascript:;" onclick="tag1()" class="weui-tabbar__item">
            <div class="weui-tabbar__icon">
                <img src="/Home/img/home_on.png" id="homeImg" alt="">
            </div>
            <p class="weui-tabbar__label" id="home" style="color: #1296DB">首页</p>
        </a>
        <a href="javascript:;" onclick="tag3()" class="weui-tabbar__item">
            <div class="weui-tabbar__icon">
                <img src="/Home/img/student.png" id="studentImg" alt="">
            </div>
            <p class="weui-tabbar__label" id="student">知识回顾</p>
        </a>
        <a href="javascript:;" onclick="tag2()" class="weui-tabbar__item">
            <div class="weui-tabbar__icon">
                <img src="/Home/img/eidt.png" id="eidtImg" alt="">
            </div>
            <p class="weui-tabbar__label" id="eidt">管理</p>
        </a>
    </div>
</div>
<!--底部导航结束-->
<?php
 $str=file_get_contents('/Application/Home/View/Index/SJ/student.html'); echo $str; ?>
<script src="/Home/jqweui/dist/js/jquery-weui.min.js"></script>
<script src="/Home/jqweui/dist/js/swiper.min.js"></script>
<script src="/Home/jqweui/dist/js/city-picker.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    //设置
    function setItem(key,val){
        val = JSON.stringify(val);
        window.localStorage[key] = val;
    };
    //获取
    function getItem(key){
        var rest = null;
        var val = window.localStorage[key];
        if(val){
            var rest = JSON.parse(val);
        }
        return rest;
    };
    $(function(){
        /*不是移动端访问*/
        if(!navigator.userAgent.match(/mobile/i)) {
            $('body').css('max-width','400px');
            $('body').css('margin','0 auto');
            $('.swiper-wrapper img').css('width','400px');
            $('.weui-tabbar').css('width','400px');
            $('html').css('height','800px');
        }
        isShow();
    });

    function isShow(){
        var shangUrl = getItem('shangUrl');
        console.log(shangUrl);
        var url = 'knowledge';
        var url1 = 'jiuList';
        var url2 = 'person';

        if(url==shangUrl){
            console.log(3)
            tag3();
        }else if(url1==shangUrl || url2==shangUrl){
            console.log(2)
            tag2();
        }else{
            console.log(1)
            tag1();
        }
        setItem('shangUrl','');
    }

    /*九宫格管理入口*/
    function jiu(){
        $.prompt({
            title: '验证',
            text: '输入验证口令',
            input: '',
            empty: false, // 是否允许为空
            onOK: function (input) {
                //点击确认
                var data = {};
                data.token = input;
                $.ajax({
                    cache: true,
                    type: "POST",
                    url:'<?php echo U("admin");?>',
                    data:data,// 你的formid
                    async: false,
                    error: function(request) {
                        alert("Connection error");
                    },
                    success: function(data) {
                        console.log(data);
                        var obj = eval('(' + data + ')');
                        if(obj.status == 1){
                            location.href="<?php echo U('jiuList');?>";
                        }else{
                            $.toast("你不是管理员，不能进入", "forbidden");
                        }
                    }
                });
            },
            onCancel: function () {
                console.log(2)
                //点击取消
            }
        });
    }

    //初始化轮播组件
    var mySwiper = new Swiper('.swiper-container', {
        loop: true,
        pagination: '.swiper-pagination',
        autoplay:1500,
        preloadImages: false,
        lazyLoading: true
    });

    function tag1(){
        $('#tag2').hide();
        $('#tag3').hide();
        $('#eidt').css('color','#999');
        $('#student').css('color','#999');
        $('#homeImg').attr('src','/Home/img/home_on.png');
        $('#tag1').show();
        $('#home').css('color','#1296DB');
        $('#eidtImg').attr('src','/Home/img/eidt.png');
        $('#studentImg').attr('src','/Home/img/student.png');
    }
    function tag2(){
        $('#tag1').hide();
        $('#tag3').hide();
        $('#home').css('color','#999');
        $('#student').css('color','#999');
        $('#homeImg').attr('src','/Home/img/home.png');
        $('#studentImg').attr('src','/Home/img/student.png');
        $('#tag2').show();
        $('#eidt').css('color','#1296DB');
        $('#eidtImg').attr('src','/Home/img/eidt_on.png');
    }
    function tag3(){
        $('#tag1').hide();
        $('#tag2').hide();
        $('#home').css('color','#999');
        $('#eidt').css('color','#999');
        $('#homeImg').attr('src','/Home/img/home.png');
        $('#eidtImg').attr('src','/Home/img/eidt.png');
        $('#tag3').show();
        $('#student').css('color','#1296DB');
        $('#studentImg').attr('src','/Home/img/student_on.png');
    }

    /**
     * banner图片查看
     */
    function showImgB(url){
        console.log(url)
        var one = $.photoBrowser({items: [url]});
        one.open();
    }

    /**
     * 跳转个人中心
     */
    function person(){
        window.location.href="<?php echo U('person');?>";
    }
</script>
</body>
</html>