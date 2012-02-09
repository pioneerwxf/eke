<?php /* Smarty version 2.6.14, created on 2008-11-04 22:33:40
         compiled from admin/feedback_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'admin_pagination', 'admin/feedback_list.htm', 59, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理学课程网站后台管理系统 | POWERED BY 杭州创蓝网络科技有限公司</title>
<LINK href="css/css_table.css" type=text/css rel=stylesheet>
<script language="javascript" src="js/common.js"></script>
<script src='js/pagination.js' type='text/javascript'></script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="3%"><img border="0" src="img/page.gif" width="18" height="18"></td>
    <td width="97%"><span class="t_title">Message List</span></td>
  </tr>
</table>
<div><img src="img/blank.gif" width="1" height="8"></div>
<form target="_self" method="post">
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="twidth">
  <tr class="table-field">
    <td width="20%" class="t_b">Status</td>
    <td width="36%" class="t_b">Message</td>
    <td width="17%" class="t_b">Time</td>
    <td width="15%" class="t_b">Operate</td>
    <td width="12%" class="t_b">Selecte</td>
  </tr>
   <?php $_from = $this->_tpl_vars['thepager']->itemlist; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myitem']):
?>
  <tr>
    <td class="td2" style="text-align: center"><?php if ($this->_tpl_vars['myitem']['tag'] == 1): ?>审核通过<?php else: ?>新留言<?php endif; ?></td>
    <td class="td1" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['content']; ?>
</td>
    <td class="td2" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['date']; ?>
</td>
    <td class="td1" style="text-align: center">[<a href="<?php echo $this->_tpl_vars['addurl']; ?>
?con=addup&id=<?php echo $this->_tpl_vars['myitem']['id']; ?>
">View</a>]</td>
    <td class="td2" style="text-align: center"><input type="checkbox" name="nid[]" value="<?php echo $this->_tpl_vars['myitem']['id']; ?>
"></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
</table>
<div><img src="img/blank.gif" width="1" height="8"></div>
<div style="text-align:right">
		<div style="text-align:right">
		<img border="0" src="img/sel_all.gif" width="64" style="cursor:hand" height="22" onClick="javascript:SelectAll('nid[]');"> 
		<img border="0" src="img/sel_no.gif" width="64" style="cursor:hand" height="22" onClick="javascript:UnSelectAll('nid[]');">
        <input name="image" type="image" src="img/del.gif" width="64" height="22" border="0">
	  </div>		
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