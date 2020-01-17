<?php /*a:3:{s:75:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\auth\menu_edit.html";i:1579173643;s:74:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\public\header.html";i:1554390875;s:74:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\public\footer.html";i:1482856936;}*/ ?>
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
        <input type="hidden" value="<?php echo htmlentities($info['id']); ?>" name="id">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>上级菜单：</label>
            <div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
				<select name="pid" class="select" id="pid">
                    <option value="">未选择</option>
                    <option value="0" <?php if($info['pid'] == 0): ?>selected<?php endif; ?>>顶级菜单</option>
                    <?php echo htmlspecialchars_decode($menu); ?>
                </select>
				</span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo htmlentities($info['name']); ?>" placeholder=""   name="name">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">链接地址：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo htmlentities($info['path']); ?>" placeholder="控制器/方法"   name="path">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">排序：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo htmlentities($info['sort']); ?>" placeholder="越大越前0-999"  name="sort">
            </div>
        </div>

        <div class="row cl menu_show">
            <label class="form-label col-xs-4 col-sm-2">icon：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo htmlentities($info['icon']); ?>" placeholder="h-ui icon"  name="icon">
            </div>
        </div>

        <div class="row cl menu_show">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否菜单：</label>
            <div class="formControls col-xs-8 col-sm-9 layui-input-block">
                <input type="radio"value="1" name="is_show" <?php if($info['is_show'] == 1): ?>checked<?php endif; ?>>是
                <input type="radio"value="0" name="is_show" <?php if($info['is_show'] == 0): ?>checked<?php endif; ?>>否
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
    /**初始化**/
    $(function(){
        if(<?php echo htmlentities($info['pid']); ?>!=0){
            $('.menu_show').hide();
        }
    })
    /**顶级分类显示**/
    $("#pid").change(function() {
        if($(this).val()==='0'){
            $('.menu_show').show();
        }else{
            $('.menu_show').hide();
        }
    })
    /**表单提交**/
    $("#myinfoup").validate({
        rules:{
            pid:{
                required:true,
            },
            name:{
                required:true,
                maxlength:20
            },
            path:{
                maxlength:20
            },
            sort:{
                minlength:0,
                max:999,
                min:0,
            },
        },
        onkeyup:false,
        focusCleanup:true,
        success:"valid",
        submitHandler:function(form){
            var formData = new FormData($( "#myinfoup" )[0]);

            $.ajax({
                url: "<?php echo url('menu_edit'); ?>" ,  /*这是处理文件上传的servlet*/
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