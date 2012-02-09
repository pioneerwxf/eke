<?php /* Smarty version 2.6.14, created on 2008-11-05 13:26:20
         compiled from admin/history_oper_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'admin_pagination', 'admin/history_oper_list.htm', 78, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADMIN | POWERED BY 王先锋</title>
<LINK href="css/css_table.css" type=text/css rel=stylesheet>
<script language="javascript" src="js/common.js"></script>
<script src='js/pagination.js' type='text/javascript'></script>

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="3%"><img border="0" src="img/page.gif" width="18" height="18"></td>
    <td width="97%"><span class="t_title">操作日志列表</span></td>
  </tr>
	<tr>
		<td colspan="2">
		<form target="_self" method="post">
	<img src="img/nv_search.gif" width="16" height="16">&nbsp;用户名:
	<input name="name" type="text" class="input_in" id="name" style="width:60px"/> 
	&nbsp;时间:
	<input name="time" type="text" class="input_in" id="time" style="width:60px"/> 
	&nbsp;IP: 
	<input name="ip" type="text" class="input_in" id="ip" style="width:60px"/>
	&nbsp;
	<select name="opertype" id="opertype">
		  <option value="0">--选择操作事件--</option>
		  <option value="20">退出系统</option>
		  <option value="1">登录系统</option>
		  <option value="2">修改前台配置</option>
		  <option value="3">增加管理员</option>
		  <option value="4">删除管理员</option>
		  <option value="5">修改管理员</option>
		  <option value="6">增加书店</option>
		  <option value="7">删除书店</option>
		  <option value="8">修改书店</option>
		  <option value="9">增加书籍</option>
		  <option value="10">删除书籍</option>
		  <option value="11">修改书籍</option>
		  <option value="12">添加新闻</option>
		  <option value="13">删除新闻</option>
		  <option value="14">终端用户销户</option>
		  <option value="15">修改终端用户</option>
		  <option value="16">批量增加用户</option>
		  <option value="17">会话日志查询</option>
		  <option value="18">下载日志查询</option>
		  <option value="19">搜索日志查询</option>
	</select> 
	<input type="image" src="img/go1.gif" name="Submit" value="" class="input_go"/>
</form>
		</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="twidth">
  <tr class="table-field">
    <td width="15%" class="t_b">操作员</td>
	<td width="30%" class="t_b">时间</td>
	<td width="30%" class="t_b">事件</td>
	<td width="10%" class="t_b">结果</td>
    <td width="15%" class="t_b">登录IP</td>
  </tr>
   <?php $_from = $this->_tpl_vars['thepager']->itemlist; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myitem']):
?>
  <tr>
    <td class="td2" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['name']; ?>
</td>
    <td class="td1" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['optime']; ?>
</td>
    <td class="td2" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['descrip']; ?>
</td>
	<td class="td1" style="text-align: center"><?php if ($this->_tpl_vars['myitem']['result'] == 0): ?><span style="color: #339900">成功</span><?php else: ?><span style="color: #FF0000">失败</span><?php endif; ?></td>
    <td class="td2" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['ip']; ?>
</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
</table>
<div><img src="img/blank.gif" width="1" height="8"></div>
</div>
<table border="0" cellspacing="0" cellpadding="0" width="500" id="table1">
	  <tr>
	  <td valign="middle">
	 <?php echo smarty_function_admin_pagination(array('pager' => $this->_tpl_vars['thepager'],'hiddenstr' => $this->_tpl_vars['hiddenstr']), $this);?>
 
	 </td>
	 </tr>
	 </table>
</body>


</html>