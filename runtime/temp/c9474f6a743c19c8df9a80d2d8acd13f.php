<?php /*a:1:{s:72:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\test\images.html";i:1579285507;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>上传插件</title>
    <link href="/static/layui/css/layui.css" rel="stylesheet" media="all">
    <style>
        .btn_img{
            width: 15px;
            height: 15px;
            position:relative;
            z-index: 1;
            border: 1px solid #ccc;
            float: right;
        }
        .btn_img_left{top:20px;}
        .btn_img_right{top:20px;}
        .btn_img_del{top:20px;}
        .img_div{float: left;margin-right: 10px; height: 150px; width: 150px; z-index: 0;}
        .img_style{width: 150px;height: 150px;}
    </style>

    <script src="/static/layui/lay/modules/laydate.js"></script>
</head>
<body>

<div class="layui-upload">
    <button type="button" class="layui-btn" id="cover">上传封面</button>
</div>
<div class="layui-input-inline a">
    <div  class="img_div">
        <div>
            <img  class="btn_img btn_img_del" src="/static/layui/images/arrow/colse.png">
            <img  class="btn_img btn_img_right" src="/static/layui/images/arrow/right.png">
            <img  class="btn_img btn_img_left" src="/static/layui/images/arrow/left.png">
        </div>
        <img class="img_style"  src="http://blog.shoujun.work/home/images/banner/banner_01.jpg">
        <input type='hidden' name='b[]' value=''>
    </div>
    <div class="img_div">
        <div>
            <img  class="btn_img btn_img_del" src="/static/layui/images/arrow/colse.png">
            <img  class="btn_img btn_img_right" src="/static/layui/images/arrow/right.png">
            <img  class="btn_img btn_img_left" src="/static/layui/images/arrow/left.png">
        </div>
        <img class="img_style" src="http://blog.shoujun.work/home/images/banner/banner_02.jpg">
        <input type='hidden' name='b[]' value=''>
    </div>
    <div class="img_div">
        <div>
            <img  class="btn_img btn_img_del" src="/static/layui/images/arrow/colse.png">
            <img  class="btn_img btn_img_right" src="/static/layui/images/arrow/right.png">
            <img  class="btn_img btn_img_left" src="/static/layui/images/arrow/left.png">
        </div>
        <img class="img_style" src="http://blog.shoujun.work/home/images/banner/banner_03.jpg">
        <input type='hidden' name='b[]' value=''>
    </div>

</div>
<div class="b"></div>
<script src="/static/layui/layui.js"></script>
<script src="/static/layui/jq.js"></script>
<script>

    layui.use('upload', function() {
        var upload = layui.upload;
        var $ = layui.jquery;
        var uploadInst = upload.render({
            elem:'#cover',
            url:'index.php',
            accept:'file',  // 允许上传的文件类型
            auto:true, // 自动上传
            done:function(res) {<!--上传成功回调-->
                var img_html = "<img class='preview' width='300px' height='200px' src='" + res.url +"'>";
                $('.a').append(img_html);
                var a = "<input type='text' name='b[]' value='"+ res.url +"'>";
                $('.b').append(a);
            },
            error:function(index,upload) {
                return layer.msg(res.msg);
            }
        });
    });
    $('.btn_img_del').click(function(){
        $(this).parent().parent('.img_div').remove();
    })
    $('.btn_img_left').click(function(){
        var a = $(this).parent().parent('.img_div');
        var b = a.prev('.img_div');

        var n = a.next();
        p = b.prev();
        b.insertBefore(n);
        a.insertAfter(p);
    })
    $('.btn_img_right').click(function(){
        var a = $(this).parent().parent('.img_div');
        var b = a.next('.img_div');

        b.insertBefore(a);
        a.insertAfter(b);
    })

</script>
</body>
</html>