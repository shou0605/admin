<?php /*a:3:{s:76:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\admin\user_list.html";i:1579008347;s:74:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\public\header.html";i:1554390875;s:74:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\public\footer.html";i:1482856936;}*/ ?>
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
<style>
    .select_style{
        padding: 4px;height: 31px;border-color: #ddd
    }
</style>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 开发管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>



<div class="page-container">
    <form  action="<?php echo url('user_list'); ?>" method="post">
        <div class="text-c">
                <select name="keyword" class="select_style"style="width:100px;">
                    <option value="username" <?php echo $param['keyword']=='username' ? 'selected'  :   ''; ?>>用户名</option>
                    <option value="nickname" <?php echo $param['keyword']=='nickname' ? 'selected'  :   ''; ?>>昵称</option>
                </select>
                <input type="text" style="width:150px" class="input-text" value="<?php echo htmlentities($param['keyvalue']); ?>" placeholder="" id="" name="keyvalue">
                <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
        </div>
    </form>

    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <a href="javascript:;" onclick="layer_show('添加管理员','<?php echo url("user_add"); ?>','','400')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加</a>
        <a href="javascript:;" onclick="dels()" class="btn btn-danger radius"><i class="Hui-iconfont"></i> 批量删除</a>
    </div>

    <div>
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th width="40"><input name="" type="checkbox" value=""></th>
                <th width="80">ID</th>
                <th width="80">用户名</th>
                <th width="100">昵称</th>
                <th width="30">权限组</th>
                <th width="150">最后登录时间</th>
                <th width="150">最后登录ip</th>
                <th width="150">状态</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($list as $v): ?>
            <tr class="text-c">
                <td><input name="" type="checkbox" value="<?php echo htmlentities($v['id']); ?>"></td>
                <td><?php echo htmlentities($v['id']); ?></td>
                <td><?php echo htmlentities($v['username']); ?></td>
                <td><?php echo htmlentities($v['nickname']); ?></td>
                <td class="text-c"><?php echo htmlentities($v['desc']); ?></td>
                <td><?php echo htmlentities($v['last_login_time']); ?></td>
                <td><?php echo htmlentities($v['last_login_ip']); ?></td>
                <td class="td-status"><a href="javascript:;" class="upstate" up-id="<?php echo htmlentities($v['id']); ?>" up-state="<?php echo $v['status']==1 ? 0  :  1; ?>" title="点击修改状态"><?php echo $v['status']==1 ? "正常" : "禁用"; ?></a></td>
                <td class="td-manage">
                    <a style="text-decoration:none" class="ml-5" onClick="layer_show('编辑','<?php echo url("user_edit",["id"=>$v["id"]]); ?>','','400')" href="javascript:;" title="编辑">
                        <i class="Hui-iconfont">&#xe6df;</i>
                    </a>
                    <a style="text-decoration:none" class="ml-5" onClick="del(<?php echo htmlentities($v['id']); ?>)" href="javascript:;" title="删除">
                        <i class="Hui-iconfont">&#xe6e2;</i>
                    </a>
                </td>

            </tr>
            <?php endforeach; ?>

            </tbody>

        </table>
        <div><?php echo $page; ?></div>

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
    /**状态修改**/
    $('.upstate').click(function(){
        var obj_a = $(this);
        var id = obj_a.attr('up-id');
        var state = obj_a.attr('up-state');
        //询问框
        layer.confirm("是否修改状态？", {
            btn: ['确定','取消'], //按钮
            shade: false //不显示遮罩
        }, function(){
            $.ajax({
                type:'POST',
                url:"<?php echo url('user_upstate'); ?>",
                data:{
                    'id':id,
                    'state' :state,
                },
                dataType:"json",
                success:function(data) {
                    layer.msg(data.message, {icon: 6});
                    obj_a.attr('up-state',data.up.state);
                    obj_a.text(data.up.txt);
                }
            });

        }, function(){
            layer.msg('已取消', {shift: 6});
        });
    })

    /**批量删除**/
    function dels(){
        var ids = "";
        $("td>input[type='checkbox']:checked").each(function (index, item) {
            ids += $(this).val() + ",";
        });

        ids = ids.substr(0,ids.length-1);
        if(ids==''){
            layer.msg('请选择要删除的数据', {shift: 6});
            return false;
        }

        del(ids);
    }
    /**删除**/
    function del(ids){
        //询问框
        layer.confirm("确定要删除数据吗？", {
            btn: ['确定','取消'], //按钮
            shade: false //不显示遮罩
        }, function(){
            $.ajax({
                type:'POST',
                url:"<?php echo url('user_del'); ?>",
                data:{
                    'ids':ids
                },
                dataType:"json",
                success:function(data) {
                    layer.msg(data.message, {icon: 6}, function(){
                        window.location.reload();
                    });
                }
            });

        }, function(){
            layer.msg('已取消', {shift: 6});
        });
    }
</script>