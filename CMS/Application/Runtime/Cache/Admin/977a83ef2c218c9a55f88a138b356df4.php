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
	<div id="tb">
		<select id="types" class="easyui-combobox" panelHeight="50">
        	<option value="File_Name">文件名</option>
            <option value="File_Ownner">上传人</option>
    	</select>
     	<input id="searchs" class="easyui-textbox">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="doSearch()">查询</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-remove" onclick="doDelete()" >删除</a> 
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" onclick="doOpen()">上传</a>
        
	</div>
    <div id="win" class="easyui-window" style="padding:10px" title="上传课件"  data-options="iconCls:'icon-save',modal:true,closed:true">
        <form id="upload" action="<?php echo U('upload');?>" method="post" enctype="multipart/form-data">
        	<input class="easyui-filebox" name="file"/>
            备注：
            <input name="other" class="easyui-textbox">
        	<a href="#" class="easyui-linkbutton" iconCls="icon-redo" onclick="doUpload()">上传</a>
        </form>
    </div>
	<table id="dg"></table>
</body>
<script type="text/javascript" src="/CMS/Public/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/CMS/Public/Js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/CMS/Public/Js/easyui-lang-zh_CN.js"></script>
<script type="text/javascript">
	$(function(){
		$('#dg').datagrid({
			url: "<?php echo U('getdownload');?>",
			method: 'post',
			title: '文件列表',
			iconCls: 'icon-save',
			fit: true,
			fitColumns: true,
			singleSelect: true,
			pagination:true,
			pageSize:20,
			toolbar:"#tb",
			rownumbers:true,
			columns:[[
				{field:'File_Name',title:'文件名',width:80},
				{field:'File_Ownner',title:'上传人',width:10},
				{field:'File_Time',title:'上传时间',width:20},
				{field:'File_Other',title:'备注',width:100},
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
	function doSearch(){
		$('#dg').datagrid('load', { 
		 	"types": $('#types').combobox('getValue'), 
			"searchs": $('#searchs').val() 
		}); 
    }
	function doOpen(){
		$('#win').window('open');
	}
	function doUpload(){
		$('#upload').submit();
	}
	function doDelete(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$.post("<?php echo U('delete');?>",
				{
					id:row.File_Id,
				},function(data){
					if(data==1){
						$.messager.alert('提示','删除成功!','info');
						$('#dg').datagrid('load'); 
					}else{
						alert(data);
					}
			});
		}else{
			$.messager.alert('提示','没有选中项!','info');
		}
    }
</script>
</html>