<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
	<link rel="stylesheet" type="text/css" href="/CMS/Public/Css/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="/CMS/Public/Css/easyui/icon.css">
    <link rel="stylesheet" type="text/css" href="/CMS/Public/Css/myStyle.css">
</head>

<body>
 	<table id="dg" ></table>
    <div id="tb">
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" onclick="doLook()" >详情</a>	
	</div>
    <div id="win1" class="easyui-window" style="padding:10px" title="详情"  data-options="iconCls:'icon-save',modal:true,closed:true">
        <form id="form1" method="post">
           	<div style="padding:20px; text-align:center">
    			标题：<input class="easyui-textbox" style="width:300px" type="text" name="title" readonly>
    			时间：<input class="easyui-textbox" type="text" name="time" readonly>
    		</div>
    		<textarea name="content" style="width:100%; height:300px" readonly></textarea>
            <div style="text-align:center; margin-top:5px">
           		<a href="#" class="easyui-linkbutton" type="submit" icon="icon-cancel" onclick="doClose()">关闭</a>
            </div>	
     	</form>	     
        
    </div>
 
	<script type="text/javascript" src="/CMS/Public/Js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="/CMS/Public/Js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="/CMS/Public/Js/easyui-lang-zh_CN.js"></script>
<script type="text/javascript">
	
	$(function(){
		$('#dg').datagrid({
			url: "<?php echo U('getmessage');?>",
			method: 'post',
			title: '反馈信息',
			iconCls: 'icon-save',
			fit: true,
			fitColumns: true,
			singleSelect: true,
			pagination:true,
			pageSize:20,
			toolbar:"#tb",
			rownumbers:true,
			columns:[[
				{field:'Message_Title',title:'标题',width:60},
				{field:'Message_Content',title:'内容',width:100},
				{field:'Message_Sender',title:'反馈人',width:20},
				{field:'Message_Time',title:'反馈时间',width:40}
			]],
			onHeaderContextMenu: function(e, field){
				e.preventDefault();
				if (!cmenu){
					createColumnMenu();
				}
				cmenu.menu('show', {
					left:e.pageX,
					top:e.pageY
				});
			}
		});
	});
	var cmenu;
	function createColumnMenu(){
		cmenu = $('<div/>').appendTo('body');
		cmenu.menu({
			onClick: function(item){
				if (item.iconCls == 'icon-ok'){
					$('#dg').datagrid('hideColumn', item.name);
					cmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-empty'
					});
				} else {
					$('#dg').datagrid('showColumn', item.name);
					cmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-ok'
					});
				}
			}
		});
		var fields = $('#dg').datagrid('getColumnFields');
		for(var i=0; i<fields.length; i++){
			var field = fields[i];
			var col = $('#dg').datagrid('getColumnOption', field);
			cmenu.menu('appendItem', {
				text: col.title,
				name: field,
				iconCls: 'icon-ok'
			});
		}
	}
	function doLook(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$('#win1').window('open');
			$('#form1').form('load',{
				title:row.Message_Title,
				content:row.Message_Content,
				time:row.Message_Time, 
			});	
		}else{
			$.messager.alert('提示','没有选中项!','info');
		}
	}
	function doClose(){
		$('#win1').window('close');
	}
    
</script>
</body>
</html>