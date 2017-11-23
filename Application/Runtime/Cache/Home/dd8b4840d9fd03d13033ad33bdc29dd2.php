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
<!--&lt;!&ndash;图片上传&ndash;&gt;-->
<!--<script src="/Home/layui/layui.js" charset="utf-8"></script>-->
<link href="/Home/layui/css/layui.css" rel="stylesheet">
<!--&lt;!&ndash;文本编辑器&ndash;&gt;-->
<!--<script src="/Home/ueidit/ueditor.config.js"></script>-->
<!--<script src="/Home/ueidit/ueditor.all.js"></script>-->
<style>
    /*body{overflow-x: hidden!important;}*/
    .edui-default .edui-editor-toolbarboxinner{padding: 0!important;}
    .edui-default .edui-editor{border: none!important;}
</style>
<body ontouchstart style="background: #F5F5F5">
<!--头部开始-->
<div style="width: 100%;height: 40px; background: darkseagreen;line-height: 40px;">
    <span class="goBack" style="font-weight: bold; color: white;float: left; position: absolute;padding-left: 5px"> <<返回</span>
    <p style="text-align: center;font-weight: bold;color: white">知识(<?php echo $study;?>)内容书写</p>
</div>
<!--名称开始-->
<div class="weui-cells weui-cells_form" style="margin-bottom: 15px">
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">标题:</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="name" value="<?php if(isset($data)){echo $data['name'];}?>" type="text" placeholder="请输入知识点标题">
        </div>
    </div>
</div>

<div class="weui-cells__title">具体内容描述:</div>
<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <textarea class="weui-textarea" placeholder="请输入文本" rows="10"></textarea>
            <div class="weui-textarea-counter"><span id="num">0</span>/500</div>
        </div>
    </div>
</div>
<!--提交-->
<div style="margin-top: 20px">
    <a style="width: 70%" href="javascript:;" class="weui-btn weui-btn_primary" id="save" onclick="save()">提交</a>
</div>

<!-- 实例化编辑器 -->
<!--<script type="text/javascript">-->
    <!--var ue = UE.getEditor('container');-->
<!--</script>-->

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
    /*字数限制*/
    $(".weui-textarea").on("input propertychange", function() {
        var $this = $(this),
                _val = $this.val(),
                count = "";
        if (_val.length > 500) {
            $this.val(_val.substring(0, 500));
        }
        count = 500 - $this.val().length;
        $("#num").text(count);
    });

    $('.goBack').click(function(){
        window.history.back();  //返回上一页
    });

    //    提交保存
    function save(){
        $('#save').attr('onclick','');
        var data = {};
        data.name = $('#name').val();   //标题
//        data.info = ue.getContent();
        data.info = $('.weui-textarea').val();
        if(!data.name){
            $.toast("请填写名字", "forbidden");
            $('#save').attr('onclick','save()');
            $('.weui-btn_primary').css('background-color','#1aad19');
            return false;
        }
        if(!data.info){
            $.toast("请填写具体内容", "forbidden");
            $('#save').attr('onclick','save()');
            $('.weui-btn_primary').css('background-color','#1aad19');
            return false;
        }
        data.study = "<?php echo $study;?>";
        var memberId = getCookie('memberId');
        if(!memberId) {
            layer.open({
                content: '请登录后进行操作'
                , btn: ['去登录', '不用了']
                , yes: function (index) {
                    location.href = '<?php echo U("person");?>';
                },
                btn0:function(index){
                    console.log(555);
                }
            });
        }else{
            $.showLoading();
            $.ajax({
                cache: true,
                type: "POST",
                url:'<?php echo U("knowledgeAdd");?>',
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
                        setTimeout("locationH()",1000);
                    }else{
                        $.toast("操作失败", "forbidden");
                    }
                }
            });
        }
        console.log(data);
    }
    function locationH(){
        location.href="<?php echo U('knowledge?study='.$study);?>";
    }
</script>
</body>
</html>