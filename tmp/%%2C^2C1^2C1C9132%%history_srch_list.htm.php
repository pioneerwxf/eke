<?php /* Smarty version 2.6.14, created on 2008-11-05 18:05:38
         compiled from admin/history_srch_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'admin_pagination', 'admin/history_srch_list.htm', 64, false),)), $this); ?>
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
    <td width="97%"><span class="t_title">搜索日志列表</span></td>
  </tr>
  <tr>
  	<td colspan="2">
	<form target="_self" method="post">
	<img src="img/nv_search.gif" width="16" height="16">&nbsp;	&nbsp;搜索时间:
	<input name="time" type="text" class="input_in" id="time" style="width:60px"/> 
	&nbsp;IP:
    <input name="ip" type="text" class="input_in" id="ip" style="width:60px"/>
    &nbsp;
    关键字: 
	<input name="keyword" type="text" class="input_in" id="keyword" style="width:60px"/>
	&nbsp;
	<select name="type" id="type">
		  <option value="">搜索字段</option>
		  <option>书名</option>
		  <option>作者</option>
		  <option>出版社</option>
		  <option>店名</option>
		  <option>店主</option>
		  <option>广告</option>
		  <option>学院</option>
	</select>
	<input type="image" src="img/go1.gif" name="Submit" value="" class="input_go"/>
	</form>
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="twidth">
  <tr class="table-field">
	<td width="25%" class="t_b">时间</td>
	<td width="25%" class="t_b">登录IP</td>
	<td width="30%" class="t_b">关键字</td>
	<td width="20%" class="t_b">类型</td>
  </tr>
   <?php $_from = $this->_tpl_vars['thepager']->itemlist; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myitem']):
?>
  <tr>
    <td class="td1" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['srtime']; ?>
</td>
    <td class="td2" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['srip']; ?>
</td>
	<td class="td1" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['keyword']; ?>
</td>
	<td class="td2" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['type']; ?>
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