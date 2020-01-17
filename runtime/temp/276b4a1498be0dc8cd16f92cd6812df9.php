<?php /*a:2:{s:73:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\index\system.html";i:1578648430;s:74:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\public\header.html";i:1554390875;}*/ ?>
﻿<!--包含头部文件-->
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
	<p class="f-20 text-success">欢迎使用H-ui.admin <span class="f-14">v3.1</span>后台模版！</p>
	<p>登录次数：<?php echo session('admin.login_num'); ?> </p>
	<p>上次登录IP：<?php echo session('admin.last_login_ip'); ?>  上次登录时间：<?php echo session('admin.last_login_time'); ?></p>

	<!--
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th colspan="7" scope="col">信息统计</th>
			</tr>
			<tr class="text-c">
				<th>统计</th>
				<th>资讯库</th>
				<th>图片库</th>
				<th>产品库</th>
				<th>用户</th>
				<th>管理员</th>
			</tr>
		</thead>
		<tbody>
			<tr class="text-c">
				<td>总数</td>
				<td>92</td>
				<td>9</td>
				<td>0</td>
				<td>8</td>
				<td>20</td>
			</tr>
			<tr class="text-c">
				<td>今日</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>昨日</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>本周</td>
				<td>2</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>本月</td>
				<td>2</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
		</tbody>
	</table>
	-->

	<!--服务器参数-->
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
			<tr>
				<th colspan="2" scope="col">服务器参数:</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($data['server']) || $data['server'] instanceof \think\Collection || $data['server'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['server'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<tr >
				<td width="30%"><?php echo htmlentities($vo['0']); ?>：</td>
				<td><span id="lbServerName"><?php echo htmlentities($vo['1']); ?></span></td>
			</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>

	<!--PHP已编译模块检测-->
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
		<tr>
			<th colspan="2" scope="col">PHP已编译模块检测:</th>
		</tr>
		</thead>
		<tbody>
		<?php $__FOR_START_1024248944__=0;$__FOR_END_1024248944__=ceil( count($data['module'])/20 );for($n=$__FOR_START_1024248944__;$n < $__FOR_END_1024248944__;$n+=1){ ?>
		<tr >
			<td  colspan="2">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php $_result=array_slice($data['module'],$n,$n+20);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<?php echo htmlentities($vo); ?>&nbsp;
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</td>
		</tr>
		<?php } ?>
		</tbody>
	</table>

	<!--PHP相关参数-->
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
		<tr>
			<th colspan="2" scope="col">PHP相关参数:</th>
		</tr>
		</thead>
		<tbody>
		<?php if(is_array($data['php_config']) || $data['php_config'] instanceof \think\Collection || $data['php_config'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['php_config'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		<tr >
			<td width="30%"><?php echo htmlentities($vo['0']); ?>：</td>
			<td><?php echo htmlspecialchars_decode($vo['1']); ?></td>
		</tr>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>

	<!--组件支持-->
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
		<tr>
			<th colspan="2" scope="col">组件支持:</th>
		</tr>
		</thead>
		<tbody>
		<?php if(is_array($data['subassembly']) || $data['subassembly'] instanceof \think\Collection || $data['subassembly'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['subassembly'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		<tr >
			<td width="30%"><?php echo htmlentities($vo['0']); ?>：</td>
			<td><?php echo htmlspecialchars_decode($vo['1']); ?></td>
		</tr>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>

	<!--第三方组件-->
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
		<tr>
			<th colspan="2" scope="col">第三方组件:</th>
		</tr>
		</thead>
		<tbody>
		<?php if(is_array($data['thirdparty']) || $data['thirdparty'] instanceof \think\Collection || $data['thirdparty'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['thirdparty'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		<tr >
			<td width="30%"><?php echo htmlentities($vo['0']); ?>：</td>
			<td><?php echo htmlspecialchars_decode($vo['1']); ?></td>
		</tr>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>

	<!--数据库支持-->
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
		<tr>
			<th colspan="2" scope="col">数据库支持:</th>
		</tr>
		</thead>
		<tbody>
		<?php if(is_array($data['database']) || $data['database'] instanceof \think\Collection || $data['database'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['database'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		<tr >
			<td width="30%"><?php echo htmlentities($vo['0']); ?>：</td>
			<td><?php echo htmlspecialchars_decode($vo['1']); ?></td>
		</tr>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
</div>
<footer class="footer mt-20">
	<div class="container">
		<p>感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br>
			Copyright &copy;2015-2017 H-ui.admin v3.1 All Rights Reserved.<br>
			本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
	</div>
</footer>
<!--<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> -->
<!--<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>-->
</body>
</html>