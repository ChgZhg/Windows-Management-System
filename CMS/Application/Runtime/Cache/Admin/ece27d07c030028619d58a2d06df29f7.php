<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/djb/Public/Css/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="/djb/Public/Css/easyui/icon.css">
    <link rel="stylesheet" type="text/css" href="/djb/Public/Css/myStyle.css"> 
<title>无标题文档</title>
</head>

<body>
<form id="form" method="post">   
    <div style="padding:20px; text-align:center">
    	标题：<input class="easyui-textbox" style="width:300px" type="text" name="title">
    	时间：<input class="easyui-textbox" type="text" name="time" value="<?php echo ($date); ?>">
    </div>
    <script id="container" name="content" type="text/plain"></script>
    <div style="text-align:center; margin-top:5px"><a href="#" class="easyui-linkbutton" type="submit" icon="icon-ok" onclick="doAdd()">保存</a></div>
</form>
	<script type="text/javascript" src="/djb/Public/Js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="/djb/Public/Js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="/djb/Public/Js/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="/djb/Public/Ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/djb/Public/Ueditor/ueditor.all.js"></script>
    <script type="text/javascript">
       	var ue = UE.getEditor('container',{
    		toolbars: [
        		['fullscreen', 'source', 'undo', 'redo', 'bold','indent','italic','underline','strikethrough','fontborder','fontfamily','fontsize','simpleupload','justifyleft','justifyright','justifycenter','justifyjustify','forecolor','attachment','imagecenter']
    		],
    		autoHeightEnabled: true,
    		autoFloatEnabled: true
		});
		function doAdd(){
		$('#form').form('submit', {
    		url:"<?php echo U('add');?>",
    		success:function(data){
				if(data==1){					
					$.messager.alert('提示','保存成功!','info');
				}else{
					$.messager.alert('提示','保存失败!','info');
				}
    		}
		});
			
	}
    </script>
</body>
</html>