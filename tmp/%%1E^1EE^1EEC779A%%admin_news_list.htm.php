<?php /* Smarty version 2.6.14, created on 2008-11-04 19:01:10
         compiled from admin/admin_news_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'admin_pagination', 'admin/admin_news_list.htm', 58, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> | POWERED BY 杭州创蓝网络科技有限公司</title>
<LINK href="css/css_table.css" type=text/css rel=stylesheet>
<script language="javascript" src="js/common.js"></script>
<script src='js/pagination.js' type='text/javascript'></script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="3%"><img border="0" src="img/page.gif" width="18" height="18"></td>
    <td width="97%"><span class="t_title"><?php echo $this->_tpl_vars['page_title']; ?>
列表</span></td>
  </tr>
</table>
<div><img src="img/blank.gif" width="1" height="8"></div>
<form target="_self" method="post">
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="twidth">
  <tr class="table-field">
    <td width="38%" class="t_b">标题</td>
    <td width="25%" class="t_b">时间</td>
    <td width="20%" class="t_b">操作</td>
    <td width="17%" class="t_b">是否选择</td>
  </tr>
   <?php $_from = $this->_tpl_vars['thepager']->itemlist; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myitem']):
?>
  <tr>
    <td class="td2" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['title']; ?>
</td>
    <td class="td1" style="text-align: center"><?php echo $this->_tpl_vars['myitem']['addtime']; ?>
</td>
    <td class="td2" style="text-align: center">[<a href="<?php echo $this->_tpl_vars['addurl']; ?>
?con=addup&id=<?php echo $this->_tpl_vars['myitem']['id']; ?>
&type=<?php echo $this->_tpl_vars['type']; ?>
">查看</a>]</td>
    <td class="td1" style="text-align: center"><input type="checkbox" name="nid[]" value="<?php echo $this->_tpl_vars['myitem']['id']; ?>
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
		<img border="0" src="img/add.gif" width="64" height="22" style="cursor:hand" onClick="javascript: window.location='<?php echo $this->_tpl_vars['addurl']; ?>
?con=addup&type=<?php echo $this->_tpl_vars['type']; ?>
';">
	  </div>		
      <table border="0" cellspacing="0" cellpadding="0" width="500" id="table1">
	  <tr>
	  <td valign="middle">
	  <input type="hidden" id="type" name="type" value="<?php echo $this->_tpl_vars['type']; ?>
">
	  <input type="hidden" id="act" name="act" value="delete">
      <input type="hidden" id="con" name="con" value="list">
      <input type="hidden" id="selAll_nid[]" name="selAll_nid[]" value="">
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