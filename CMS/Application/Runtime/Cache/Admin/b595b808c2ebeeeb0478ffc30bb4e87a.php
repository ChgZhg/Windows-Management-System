<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8>
	<title>机房计算机管理系统</title>
	<link rel="stylesheet" type="text/css" href="/CMS/Public/Css/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="/CMS/Public/Css/easyui/icon.css">
    <link rel="stylesheet" type="text/css" href="/CMS/Public/Css/myStyle.css"> 
</head>
<body>
<img src="/CMS/Public/Image/backjpeg.jpg" style="width:100%"/>
<div class="easyui-window" title="机房计算机管理系统" data-options="iconCls:'icon-man',collapsible:false,minimizable:false,maximizable:false,closable:false" style="width:400px;padding:50px 70px 50px 70px;">
	<div style="margin-bottom:20px">
        <input class="easyui-textbox" id="logname" style="width:100%;height:30px;padding:12px" data-options="required:true,prompt:'教师工号或管理员账号',iconCls:'icon-man',iconWidth:38,novalidate:true">
    </div>
    <div id="a" style="margin-bottom:20px">
        <input type="password" class="easyui-textbox style_input"  name="logpass" id="logpass" onKeyPress="onKeyPress(event)"  style="width:100%; ;padding:12px; height:30px" data-options="required:true,prompt:'登录密码',iconCls:'icon-lock',iconWidth:38,novalidate:true">
    </div>
    <div id="info" style="width:100%;height:20px;margin-bottom:20px;display:none">
    	<div style="font-size:15px; color:#F00; text-align:center;"><img width="12" height="12" src="/CMS/Public/Css/easyui/icons/cancel.png"/>账号或密码错误</div>
    </div>
    <div>
        <a href="#" id="login" class="easyui-linkbutton" data-options="iconCls:'icon-ok'" style="padding:5px 0px;width:100%;">登录</a>
    </div>
</div>
<script type="text/javascript" src="/CMS/Public/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/CMS/Public/Js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/CMS/Public/Js/easyui-lang-zh_CN.js"></script>
<script>
$(function(){
    $("input",$("#logpass").next("span")).keypress(function(event){

        if(event.keyCode== 13) 
        {
            Login();
        }
    });
})

function Login()
{
	$('input.textbox-text').validatebox('enableValidation').validatebox('validate');
		var logname = $("#logname").val();
		var logpass = $("#logpass").val();
		if(logname!=""&&logpass!=""){
    		$.post("<?php echo U('login');?>",
			{
				username:logname,
				password:logpass
			},function(data){
   	 			if(data==1){
					window.location.href="<?php echo U('Admin/index');?>";
				}else{
					$("#info").show();
					setTimeout("$('#info').hide()",3000);
				}
			});
		}
}
$(document).ready(function(){
	$('input.textbox-text').validatebox().bind('blur', function(){
    	$(this).validatebox('enableValidation').validatebox('validate');
	});
	$("#logname").next("span").find("input").val("");
	$("#logpass").next("span").find("input").val("");
	$("#logpass").next("span").find("input").focus(function(){
		$(this).attr("type","password");
	});
	$("#login").click(function(){
		Login();
	});
}); 
</script>
</body>
</html>