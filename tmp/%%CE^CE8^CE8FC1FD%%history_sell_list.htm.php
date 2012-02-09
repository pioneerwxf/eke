<?php /* Smarty version 2.6.14, created on 2008-11-06 15:50:53
         compiled from admin/history_sell_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'admin_pagination', 'admin/history_sell_list.htm', 60, false),)), $this); ?>
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
    <td width="97%"><span class="t_title">交易日志列表</span></td>
  </tr>
  <tr>
  	<td colspan="2">
	<form target="_self" method="post">
	<img src="img/nv_search.gif" width="16" height="16">&nbsp;	&nbsp;预订人:
	<input name="user" type="text" class="input_in" id="user" style="width:60px"/> 
	&nbsp;    &nbsp;&nbsp;预定日:
    <input name="date" type="text" class="input_in" id="date" style="width:60px"/>
     &nbsp;
     <select name="tag">
       <option value="0" selected>选择书籍状态</option>
       <option value="1">待售</option>
       <option value="2">预定</option>
       <option value="3">已售</option>
       <option value="-1">已删除</option>
     </select>
     <input type="image" src="img/go1.gif" name="Submit" value="" class="input_go"/>
	</form>
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="twidth">
  <tr class="table-field">
	<td width="30%" class="t_b">书名</td>
	<td width="20%" class="t_b">订购电话</td>
	<td width="15%" class="t_b">订购人</td>
	<td width="13%" class="t_b">书籍状态</td>
	<td width="22%" class="t_b">时间</td>
  </tr>
   <?php $_from = $this->_tpl_vars['thepager']->itemlist; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myitem']):
?>
  <tr>
    <td class="td1" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['title']; ?>
</td>
    <td class="td2" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['tele']; ?>
</td>
	<td class="td1" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['user']; ?>
</td>
	<td class="td2" style="text-align: center"><?php if ($this->_tpl_vars['myitem']['otag'] == 1): ?>待售<?php elseif ($this->_tpl_vars['myitem']['otag'] == 2): ?>预定<?php elseif ($this->_tpl_vars['myitem']['otag'] == 3): ?>已售<?php elseif ($this->_tpl_vars['myitem']['otag'] == '-1'): ?>删除<?php endif; ?></td>
	<td class="td2" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['date']; ?>
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