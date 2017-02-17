<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>无标题文档</title>
    <link rel="stylesheet" type="text/css" href="/PCM/Public/Css/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="/PCM/Public/Css/easyui/icon.css">
    <link rel="stylesheet" type="text/css" href="/PCM/Public/Css/myStyle.css">    
</head>

<body>
    <table id="dg" ></table>
    <div id="tb">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" onclick="doAdd()" >添加</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" onclick="doEdit()" >编辑</a>	
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" onclick="doDelete()" >删除</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" onclick="doExcel()" >导入</a>
		<select id="types" class="easyui-combobox">
        	<option value="Mana_Num">工号</option>
        	<option value="Mana_Name">姓名</option>
    	</select>
     	<input id="searchs" class="easyui-textbox">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="doSearch()">查询</a>	
	</div>
    <div id="win" class="easyui-window" style="padding:10px" title="编辑"  data-options="iconCls:'icon-save',modal:true,closed:true">
        <form id="form" method="post">
            <table>
                <tr>
                    <td>姓名:</td>
                    <td><input class="easyui-textbox" type="text" name="Mana_Name"></input></td>
                </tr>
            </table>
            <input type="hidden" name="Mana_Num"></input>
     	</form>	     
        <div style="text-align:center; margin-top:5px"><a href="#" class="easyui-linkbutton" type="submit" icon="icon-ok" onclick="doSave()">保存</a></div>
    </div>
    <div id="win1" class="easyui-window" style="padding:10px" title="添加"  data-options="iconCls:'icon-save',modal:true,closed:true">
        <form id="form1" method="post">
            <table>
            	<tr>
                    <td>工号:</td>
                    <td><input class="easyui-textbox" type="text" name="Mana_Num"></input></td>
                </tr>
                <tr>
                    <td>姓名:</td>
                    <td><input class="easyui-textbox" type="text" name="Mana_Name"></input></td>
                </tr>
            </table>
     	</form>	     
        <div style="text-align:center; margin-top:5px"><a href="#" class="easyui-linkbutton" type="submit" icon="icon-ok" onclick="doSave1()">保存</a></div>
    </div>
    		

<script type="text/javascript" src="/PCM/Public/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/PCM/Public/Js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/PCM/Public/Js/easyui-lang-zh_CN.js"></script>
<script type="text/javascript">

	$(function(){
		$('#dg').datagrid({
			url: "<?php echo U('getteamessage');?>",
			method: 'post',
			title: '教师',
			iconCls: 'icon-save',
			fit: true,
			fitColumns: true,
			singleSelect: true,
			pagination:true,
			pageSize:20,
			toolbar:"#tb",
			rownumbers:true,
			columns:[[
				{field:'Mana_Num',title:'工号',width:40},
				{field:'Mana_Name',title:'姓名',width:40},
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
	function doDelete(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$.post("<?php echo U('teadelete');?>",
				{
					Mana_Num:row.Mana_Num,
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
	function doEdit(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$('#win').window('open');
			$('#form').form('load',{
				Mana_Num:row.Mana_Num,
				Mana_Name:row.Mana_Name,
			});				
		}else{
			$.messager.alert('提示','没有选中项!','info');
		}
	}
	function doAdd(){
		$('#win1').window('open');	
	}
	function doSave(){
		$('#form').form('submit', {
    		url:"<?php echo U('teasave');?>",
    		success:function(data){
				if(data==1){
					$('#win').window('close');
					$.messager.alert('提示','保存成功!','info');
					$('#dg').datagrid('load'); 
				}else{
					$.messager.alert('提示','保存失败!','info');
				}
    		}
		});
			
	}
	function doSave1(){
		$('#form1').form('submit', {
    		url:"<?php echo U('teasave1');?>",
    		success:function(data){
				if(data==1){
					$('#win').window('close');
					$.messager.alert('提示','添加成功!','info');
					$('#dg').datagrid('load');
				}else if(data==2){
					$.messager.alert('提示','添加失败!该用户已存在','info');
				}else{
					$.messager.alert('提示','添加失败!','info');
				}
    		}
		});
			
	}
    
</script>
</body>
</html>