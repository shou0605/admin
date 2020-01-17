<?php /*a:1:{s:72:"D:\phpStudy\PHPTutorial\WWW\blog\application\admin\view\test\editor.html";i:1579283160;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<div id="div1">
    <p>欢迎使用 wangEditor 富文本编辑器</p>
</div>

<script type="text/javascript" src="/static/wangEditor/release/wangEditor.min.js"></script>
<script type="text/javascript">
    var E = window.wangEditor
    var editor = new E('#div1')

    // 配置服务器端地址
    editor.customConfig.uploadImgServer = "<?php echo url('a'); ?>"

    editor.create()
</script>
</body>
</html>