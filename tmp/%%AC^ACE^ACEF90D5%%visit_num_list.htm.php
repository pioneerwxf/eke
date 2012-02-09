<?php /* Smarty version 2.6.14, created on 2008-11-04 20:13:10
         compiled from admin/visit_num_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'admin_pagination', 'admin/visit_num_list.htm', 49, false),)), $this); ?>
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
    <td width="97%"><span class="t_title">访问统计</span></td>
  </tr>
</table>
<div><img src="img/blank.gif" width="1" height="8"></div>
<form target="_self" method="post">
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="twidth">
  <tr class="table-field">
    <td width="33%" class="t_b">当日访问量</td>
    <td width="33%" class="t_b">累计访问量</td>
    <td width="34%" class="t_b">截止日期</td>
  </tr>
   <?php $_from = $this->_tpl_vars['thepager']->itemlist; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myitem']):
?>
  <tr>
    <td class="td2" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['number']; ?>
</td>
    <td class="td1" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['total']; ?>
</td>
    <td class="td2" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['date']; ?>
</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
</table>
<div><img src="img/blank.gif" width="1" height="8"></div>
      <table border="0" cellspacing="0" cellpadding="0" width="500" id="table1">
	  <tr>
	  <td valign="middle">
	  <input type="hidden" id="act" name="act" value="delete">
      <input type="hidden" id="con" name="con" value="list">
      <input type="hidden" id="selAll_nid[]" name="selAll_nid[]" value="">
      <input type="hidden" id="tid" name="tid" value="<?php echo $this->_tpl_vars['tid']; ?>
">
	 </td>
	 </tr>
	 </table>
</div>
</form>
<table border="0" cellspacing="0" cellpadding="0" width="500" id="table1">
	  <tr>
	  <td valign="middle">
	 <?php echo smarty_function_admin_pagination(array('pager' => $this->_tpl_vars['thepager'],'hiddenstr' => $this->_tpl_vars['hiddenstr']), $this);?>
 
	 </td>
	 </tr>
	 </table>
</body>


</html>