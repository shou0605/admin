<?php /*a:3:{s:78:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\admin\operat_list.html";i:1579260014;s:74:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\public\header.html";i:1554390875;s:74:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\public\footer.html";i:1482856936;}*/ ?>
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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 开发管理 <span class="c-gray en">&gt;</span> 操作日志 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form  action="<?php echo url('operat_list'); ?>" method="post">
        <div class="text-c"> 日期范围：
                <input type="text" onfocus="WdatePicker()" id="datemin" class="input-text Wdate" style="width:180px;" name="start_time" value="<?php echo htmlentities($param['start_time']); ?>">
                -
                <input type="text" onfocus="WdatePicker()" id="datemax" class="input-text Wdate" style="width:180px;"  name="end_time" value="<?php echo htmlentities($param['end_time']); ?>">
               <!--搜索：-->
                <select name="keyword" class="select_style"style="width:100px;">
                    <option value="name" <?php echo $param['keyword']=='name' ? 'selected'  :   ''; ?>>操作用户</option>
                    <option value="url" <?php echo $param['keyword']=='url' ? 'selected'  :   ''; ?>>url</option>
                </select>
                <input type="text" style="width:150px" class="input-text" value="<?php echo htmlentities($param['keyvalue']); ?>" placeholder="" id="" name="keyvalue">
                <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
        </div>
    </form>

    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th width="100">url</th>
                <th width="30">操作用户</th>
                <th width="150">操作时间</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($list as $v): ?>
            <tr class="text-c">
                <td><?php echo htmlentities($v['id']); ?></td>
                <td><?php echo htmlentities($v['url']); ?></td>
                <td class="text-c"><?php echo htmlentities($v['name']); ?></td>
                <td><?php echo htmlentities($v['create_time']); ?></td>
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
