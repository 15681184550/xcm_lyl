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
    *{font-family: 'Heiti SC', 'Microsoft YaHei'}
    .weui-cells:after{border: none}
    .weui-cell:before{border: none}
    .weui-cells:before{border: none}
    .weui-media-box__desc{overflow: inherit;display: block}
    .zanDiv{text-align: left;padding-left: 15px;padding-right: 15px;font-size: 13px;padding-bottom: 10px}
    .zanDiv img{margin-right: 5px}
</style>
<body ontouchstart style="">
<!--头部开始-->
<div style="width: 100%;height: 40px; background: darkseagreen;line-height: 40px;">
    <span class="goBack" style="font-weight: bold; color: white;float: left; position: absolute;padding-left: 5px"> <<返回</span>
    <p style="text-align: center;font-weight: bold;color: white">知识点详情</p>
</div>

<!--详情-->
<div class="weui-panel weui-panel_access" style="margin-top: 0">
    <div class="weui-panel__bd">
        <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__bd">
                <h4 class="weui-media-box__title"><?php echo $data['name']?>
                    <div style="color: #999;font-size: 12px;">
                        <span>
                            <span style="color: #666">作者：</span><?php echo $data['send_member_name']?>
                        </span>
                        <span style="float: right"><?php echo $data['create_time']?></span>
                    </div>
                </h4>
                <p style="margin-top: 20px;font-size: 16px;color: #444" class="weui-media-box__desc"><?php echo str_replace(array("\r\n", "\r", "\n"), "<br>", htmlentities($data['info']));?></p>
            </div>
        </a>
    </div>
</div>
<!--评论-->
<div style="text-align: center;height: 40px;line-height: 40px;padding-top: 10px;padding-bottom: 5px;background: #F5F5F5">
    <!--点赞、评论、转发等-->
    <div>
        <div class="weui-cells">
            <div class="weui-cell" style="padding-bottom: 5px">
                <div class="weui-cell__bd" style="float: left;text-align: left;font-size: 13px;color: #999">
                    <p>浏览<span><?php echo $data['look_count'];?></span>次</p>
                </div>
                <div class="weui-cell__ft" style="padding-right: 8%">
                    <img id="zan" token="<?php if(isset($isZan)){echo 1;}?>" src="<?php if(isset($isZan)){echo '/Home/img/zan_on.png';}else{echo '/Home/img/zan.png';}?>" alt="" width="20px">
                </div>
                <div class="weui-cell__ft" onclick="say(this)"><img id="sayC" src="/Home/img/say.png" alt="" width="23px"></div>
            </div>
            <div class="zanDiv">
                <?php if($data['zan_member_name'] && isset($data['mem'])){?>
                <span id="zanName">
                    <img src="/Home/img/dianZan.png" style="vertical-align: middle" width="15px" alt="">
                    <?php foreach($data['mem'] as $k=>$v){?>
                    <span class="z" data_name="<?php echo $v['name'];?>" data_id="<?php echo $v['id']?>" style="color: #1296DB"><?php echo $v['name'];?>
                    <?php if($k<count($data['mem'])-1){echo '<i>，</i>';}?>
                    </span>
                    <?php }?>
                </span>
                <?php }?>
            </div>
        </div>
    </div>

    <!--评论输入框-->
    <div id="say" token="" style="display: none">
        <input class="" type="text" placeholder="评论..." style="height: 35px;width: 70%;border-radius: 5px;border: 1px solid silver;padding-left: 5px;float: left;margin-right: 3%;margin-left: 2%">
        <a href="javascript:;" onclick="sendSay()" class="weui-btn weui-btn_mini weui-btn_default" style="height: 37px; width: 20%;line-height: 35px;float: left;color: #666;">发送</a>
    </div>
</div>
<!--评论信息-->
<div class="weui-cells" id="comment" style="font-size: 13px;height: 100%;padding-top: 25px;position: inherit">
    <?php if(isset($comment)){?>
    <?php foreach($comment as $v){?>
    <div class="weui-cell sayComment" style="padding: 3px 15px">
        <div class="weui-cell__bd" style="flex: inherit">
            <p><span style="color: #0066cc;"><?php echo $v['say_member_name'];?></span>&nbsp;回复&nbsp;<span style="color: #0066cc"><?php echo $data['send_member_name']?></span>&nbsp;:&nbsp;</p>
        </div>
        <div class="weui-cell__ft" style="color: #332f2f;"><?php echo $v['say_info']?></div>
    </div>
    <?php }?>
    <?php }?>
</div>
<script src="/Home/js/jquery.min.js"></script>
<script src="/Home/js/jquery.min.js"></script>
<script src="/Home/jqweui/dist/js/jquery-weui.min.js"></script>
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

    $('.goBack').click(function(){
        window.history.back(-1);  //返回上一页
    });
    //  点赞
    $('#zan').click(function(){
        var memberId = getCookie('memberId');
        if(memberId){
            if(!$(this).attr('token')){     //没有点赞
                $(this).attr('src','/Home/img/zan_on.png');
                $(this).attr('token',1);
                $('#zan').css('transform','scale(2) rotate(0deg)');
                setTimeout("$('#zan').css('transform','scale(1) rotate(0deg)')",200);
                var len = $('.zanDiv').find('.z').length;
                if(len < 1){
                    var str = '<img src="/Home/img/dianZan.png" style="vertical-align: middle" width="15px" alt=""><span id="zanName"><span class="z" data_id="'+memberId+'" style="color: #1296DB"><?php if(isset($memberName)){echo $memberName;}?></span></span>';
                    $('.zanDiv').append(str);
                }else{
                    var str = '<span class="z" data_id="<?php if(isset($memberId)){echo $memberId;}?>" data_name="<?php if(isset($memberName)){echo $memberName;}?>" style="color: #1296DB"><i>，</i><?php if(isset($memberName)){echo $memberName;}?></span>';
                    $('.zanDiv').find('.z:last').after(str);
                }
                var data = {};
                data.id  = "<?php echo $id;?>";
                $.ajax({
                    cache: true,
                    type: "POST",
                    url: '<?php echo U("saveZan");?>',
                    data: data,// 你的formid
                    async: false,
                    error: function (request) {
                        alert("Connection error");
                    }
                });
            }else{                      //已经点赞
                var len = $('.zanDiv').find('.z').length;
                if(len==1){
                    $('.zanDiv').find('img').remove();
                    $('.zanDiv').find('#zanName').remove();
                }else{
                    var zm    = [];
                    for(var i=0; i<len; ++i){
                        var dataZ = {};
                        if($('.zanDiv').find('.z').eq(i).attr('data_id') != memberId){
                            dataZ.data_id = $('.zanDiv').find('.z').eq(i).attr('data_id');
                            dataZ.name    = $('.zanDiv').find('.z').eq(i).attr('data_name');
                            zm[i] = dataZ;
                        }
                    }
                    $('.zanDiv').find('.z').remove();
                    for(var i=0; i<zm.length; ++i){
                        var s = '';
                        if(i<zm.length-1){
                            var s = '，';
                        }
                        var str = '<span class="z" data_name="'+zm[i].name+'" data_id="'+zm[i].data_id+'" style="color: #1296DB">'+zm[i].name+s+'</span>';
                        if($('#zanName').find('.z').length>0){
                            $('#zanName').find('.z:last').after(str);
                        }else{
                            $('#zanName').find('img').after(str);
                        }
                    }
                }
                $(this).attr('src','/Home/img/zan.png');
                $(this).attr('token','');
                var data = {};
                data.id  = "<?php echo $id;?>";
                $.ajax({
                    cache: true,
                    type: "POST",
                    url: '<?php echo U("jianZan");?>',
                    data: data,// 你的formid
                    async: false,
                    error: function (request) {
                        alert("Connection error");
                    }
                });
            }
            //没有登录
        }else{
            layer.open({
                content: '请登录后进行操作'
                ,btn: ['去登录', '不用了']
                ,yes: function(index){
                    location.href='<?php echo U("person");?>';
                }
            });
        }

    });

    function say(){
        if(!$('#say').attr('token')){
            $('#sayC').attr('src','/Home/img/say_on.png');
            $('#say').show();
            $('#say').attr('token','1')
        }else{
            $('#sayC').attr('src','/Home/img/say.png');
            $('#say').hide();
            $('#say').attr('token','')
        }
    }
    //点击发送评论
    function sendSay(){
        var memberId = getCookie('memberId');
        if(!memberId){
            layer.open({
                content: '请登录后进行操作'
                ,btn: ['去登录', '不用了']
                ,yes: function(index){
                    location.href='<?php echo U("person");?>';
                }
            });
        }else{
            var data = {};
            data.say_info     = $('#say').find('input').val();
            if(!data.say_info){
                $.toast("您还没有填写评论信息", "cancel");
                return false;
            }
            data.say_member_id = memberId;
            data.knowledge_id = "<?php echo $id;?>";
            $('#say').find('a').attr('onclick','');
            $.showLoading();
            $.ajax({
                cache: true,
                type: "POST",
                url:'<?php echo U("addSay");?>',
                data:data,// 你的formid
                async: false,
                error: function(request) {
                    $.hideLoading();
                    alert("Connection error");
                },
                success: function(data) {
                    $.hideLoading();
                    var data = eval('(' + data + ')');
                    //评论成功
                    if(data.status==1){
                        var str = dataStr(data.sayMemberName,data.sayInfo);
                        var len = $('#comment').find('.sayComment').length;
                        if(len > 0){
                            $('#comment').find('.sayComment:first').before(str);
                        }else{
                            $('#comment').append(str);
                        }
                        say();
                    }else{
                        layer.open({
                            content: data.msg
                            ,btn: '我知道了'
                        });
                    }
                }
            });
        }
    }

    function dataStr(sayMemberName,sayInfo){
        var s = '<div class="weui-cell sayComment" style="padding: 3px 15px">\
                <div class="weui-cell__bd" style="flex: inherit">\
                <p><span style="color: #0066cc;">'+sayMemberName+'</span>&nbsp;回复&nbsp;<span style="color: #0066cc"><?php echo $data["send_member_name"]?></span>&nbsp;:&nbsp;</p>\
                </div><div class="weui-cell__ft" style="color: #332f2f;">'+ sayInfo +'</div></div>';
        return s;
    }
</script>
</body>
</html>