<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>驾照考试</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link href="/Home//img/1.jpg" rel="shortcut icon" />
    <!--标准mui.css-->
    <link rel="stylesheet" href="/Home/mui/css/mui.min.css">
</head>
<style>
    .mui-card-footer{padding-bottom: 0;padding-top: 0;}
</style>
<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title">驾校考试第<span class="numP mui-badge mui-badge-warning" style="vertical-align: text-bottom">1</span>页</h1>
</header>
<!--内容盒子-->
<div id="kaoShi" style="margin-top: 55px">

</div>
<input type="hidden" value="" id="page">
<script src="/Home/mui/js/mui.min.js"></script>
<script src="/Home/js/jquery.min.js"></script>
<!--移动端layery-->
<script src="/Home/layer/mobile/layer.js"></script>
<script>
    mui.init();
    $(function(){
        showList();
    });
    //数据列表
    function showList(n){
        layer.open({
            type: 2
            ,content: '加载中'
        });
        n ? n : 1;
        var data  = {};
        data.page = n;
        var url  = '/index.php/Home/Index/jiaApiAjax.html';
        $.ajax({
            cache: true,
            type: "POST",
            url:url,
            data:data,// 你的formid
            async: false,
            error: function(request) {
                layer.closeAll('loading'); //关闭加载层
                console.log(request)
            },
            success: function(data) {
                var data = eval('(' + data + ')');
                console.log(data)
                layer.closeAll('loading'); //关闭加载层
                var p    = $('#page').val();
                $('.contents'+p).hide();
                var page    = data.result.pagenum;
                $('.numP').text(page);
                var nextP   = parseInt(page)+1;
                var beforeP = parseInt(page)-1;
                $('#page').val(page);
                var list = data.result.list;
                if(data){
                    var s = '<div class="mui-content listC contents'+page+'" style="margin-bottom: 15px"></div>';
                    if($('.listC').length<1){
                        $('#kaoShi').append(s);
                    }else{
                        $('.listC:last').after(s);
                    }
                    if(page>1){
                        var jinY = '<li><a href="javascript:;" onclick="beforePage('+beforeP+')">上一页</a></li>';
                    }else{
                        var jinY = '<li class="mui-disabled"><span> 上一页 </span></li>';
                    }
                    for(var i=0; i<list.length; ++i){
                        var str = datas(list[i],i+1);
                        if(i==list.length-1){
                            str += '<div class="mui-card"><div class="mui-card-footer">';
                            str += '<button type="button"  onclick="answers('+page+')" class="mui-btn mui-btn-success new_page="'+page+'" mui-btn-outlined">获取答案</button>';
                            str += '<div class="mui-content-padded"><ul class="mui-pager">'+jinY+'<li style="margin-left: 5px"><a href="javascript:;" onclick="nextPage('+nextP+')">下一页</a></li></ul></div>';
                            str += '</div>';
                        }
                        $('.contents'+page).append(str);
                    }
                }
            }
        });
    }
    //驾照数据页面代码
    function datas(i,n){
        var str = '';
        str += '<div class="mui-card">';
        str += '<span class="mui-card-header">'+ n+'、'+i.chapter+'</span>';
        str += '<div class="mui-card-content">';
        str += '<div class="mui-card-content-inner">'+ i.question+'</div></div>';
        if(i.ben_di_pic){
            str += '<ul class="mui-table-view mui-grid-view">';
            str += '<li class="mui-table-view-cell mui-media mui-col-xs-6">'
            str += '<a href="javascript:;"><img class="mui-media-object" src="'+ i.ben_di_pic+'"></a></li></ul>';
        }
        var classA = '';
        var classB = '';
        if(i.option1 && i.option2 && i.option3 && i.option4){
            var classC = '';
            var classD = '';
            if(i.answer == 'A'){
                classA = 'yesAnswer';
            }else if(i.answer == 'B'){
                classB = 'yesAnswer';
            }else if(i.answer == 'C'){
                classC = 'yesAnswer';
            }else if(i.answer == 'D'){
                classD = 'yesAnswer';
            }
            str += '<div class="mui-card-footer '+classA+'">';
            str += '<div class="mui-input-row mui-radio" style="width: 100%">';
            str += '<label>'+i.option1+'</label><input name="radio1'+n+'" type="radio"></div></div>';
            str += '<div class="mui-card-footer '+classB+'">';
            str += '<div class="mui-input-row mui-radio" style="width: 100%">';
            str += '<label>'+i.option2+'</label><input name="radio1'+n+'" type="radio"></div></div>';
            str += '<div class="mui-card-footer '+classC+'">';
            str += '<div class="mui-input-row mui-radio" style="width: 100%">';
            str += '<label>'+i.option3+'</label>';
            str += '<input name="radio1'+n+'" type="radio"></div></div>';
            str += '<div class="mui-card-footer '+classD+'">';
            str += '<div class="mui-input-row mui-radio" style="width: 100%">';
            str += '<label>'+i.option4+'</label>';
            str += '<input name="radio1'+n+'" type="radio"></div></div>';
            str += '<div class="mui-card-footer answer" style="display: none;"><div class="mui-input-row mui-radio" style="width: 100%; color: #23BEAE;padding: 7px 0">答：'+ i.explain +'</div></div>'
        }else{
            if(i.answer == '对'){
                classA = 'yesAnswer';
            }else if(i.answer == '错'){
                classB = 'yesAnswer';
            }
            str += '<div class="mui-card-footer '+classA+'">';
            str += '<div class="mui-input-row mui-radio" style="width: 100%">';
            str += '<label>对</label>';
            str += '<input name="radio1'+n+'" type="radio"></div></div>';
            str += '<div class="mui-card-footer '+classB+'">';
            str += '<div class="mui-input-row mui-radio" style="width: 100%">';
            str += '<label>错</label>';
            str += '<input name="radio1'+n+'" type="radio"></div></div>';
            str += '<div class="mui-card-footer answer" style="display: none;"><div class="mui-input-row mui-radio" style="width: 100%; color: #23BEAE;padding: 7px 0">答：'+ i.explain +'</div></div>'
        }
        str += '</div>';
        return str;
    }

    /*下一页数据*/
    function nextPage(nn){
        var l = $('.contents'+nn).length;
        if(l > 0){
            $('.numP').text(nn);
            $('.listC').hide();
            $('.contents'+nn).show();
        }else{
            showList(nn);
        }
    }

    /*上一页数据*/
    function beforePage(bn){
        $('.numP').text(bn);
        $('.listC').hide();
        $('.contents'+bn).show();
    }

    /*点击查看答案*/
    function answers(p){
        var l = $('.contents'+p).find('.mui-card').length;
        for(var i=0; i<l; ++i){
            $('.contents'+p).find('.mui-card').eq(i).find('.answer').show();
            $('.contents'+p).find('.mui-card').eq(i).find('.yesAnswer').css('color','#23BEAE');
            $('.contents'+p).find('.mui-card').eq(i).find('.yesAnswer').css('border','1px solid');
        }

    }
</script>
</body>
</html>