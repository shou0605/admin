<?php /*a:3:{s:74:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\auth\auth_add.html";i:1579169398;s:74:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\public\header.html";i:1554390875;s:74:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\public\footer.html";i:1482856936;}*/ ?>
<!--包含头部文件-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/admin/hui/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/hui/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/hui/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/hui/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/hui/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/admin/hui/static/h-ui.admin/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/static/admin/css/common.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>o2o平台</title>
<meta name="keywords" content="tp5打造o2o平台系统">
<meta name="description" content="o2o平台">
</head>
<body>
<div class="page-container">
    <form action="#" id="myinfoup" method="POST" class="form form-horizontal" role="form" >
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>权限组名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder=""   name="title">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">简介：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder=""   name="description">
            </div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">权限：</label>
            <div class="formControls col-xs-8 col-sm-9"  style="border: 1px solid #ccc">
                <?php echo htmlspecialchars_decode($auth); ?>
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button  type="submit" class="btn btn-primary radius myinfobt" ><i class="Hui-iconfont">&#xe632;</i> 保存</button>

                <button onclick="layer_close()"  class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>
</div>
<!--包含尾部文件-->
<script type="text/javascript" src="/static/admin/hui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/admin/hui/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/static/admin/hui/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/static/admin/hui/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script type="text/javascript" src="/static/admin/hui/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/static/admin/hui/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>  
<script type="text/javascript" src="/static/admin/hui/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/static/admin/hui/static/h-ui.admin/js/H-ui.admin.js"></script>
</body>
</html>
<script>
    /**全选**/
    function SelectAll(obj) {
        $(':checkbox').each(function (index) {
            this.checked = obj.checked;
        });
    }

    $(".formControls>div :checkbox").change(function(){
        var obj = $(this).is(":checked");//判断是否选中
        var div_class = 'div_' + $(this).val();//拼接div的clss
        if($('div').hasClass(div_class)){
            div_class = '.' + div_class + ' :checkbox';
            $(div_class).each(function (index) {
                this.checked = obj;//赋值
            });
        }
    })

    /**表单提交**/
    $("#myinfoup").validate({
        rules:{
            title:{
                required:true,
                maxlength:20
            },

        },
        onkeyup:false,
        focusCleanup:true,
        success:"valid",
        submitHandler:function(form){
            var formData = new FormData($( "#myinfoup" )[0]);

            $.ajax({
                url: "<?php echo url('auth_add'); ?>" ,  /*这是处理文件上传的servlet*/
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success: function (returndata) {
                    var msg = returndata.message;
                    if(returndata.statusCode==200){

                        layer.msg(msg, {
                            icon: 1,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            parent.location.reload();//刷新父页面
                            layer_close()
                        });

                    }else{
                        layer.msg(msg,{icon:2});
                    }
                },
                error: function (returndata) {
                    layer.msg('请稍后再试 网络有延迟！',{icon:2});
                }
            });
            return false;
        }
    });
</script>