<?php /* Smarty version 2.6.14, created on 2008-11-04 14:24:00
         compiled from admin/admin_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'admin_pagination', 'admin/admin_list.htm', 57, false),)), $this); ?>
<html>
<head>
<title>admin_list</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript" src="js/common.js"></script>
<script src='js/pagination.js' type='text/javascript'></script>
<LINK href="css/css_table.css" type=text/css rel=stylesheet></head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:-15px;">
  <tr>
    <td width="3%"><img border="0" src="img/page.gif" width="18" height="18"></td>
    <td width="97%"><span class="t_title"><b><?php echo $this->_tpl_vars['title']; ?>
 列表
		</b></span></td>
  </tr>
</table>
<br>
<form target="_self" method="post">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" class="twidth">
 		 <tr class="table-field">
            <td  width="20%">管理员ID</td>
			<td  width="30%">昵称</td>
            <td  width="25%">操作</td>
            <td  width="25%">选择（是/否）</td>
          </tr>
          <?php $_from = $this->_tpl_vars['thepager']->itemlist; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myitem']):
?>
          <tr>
            <td class="td1"><div align="center"><?php echo $this->_tpl_vars['myitem']['operid']; ?>
</div></td>
            <td class="td2"><div align="center"><?php echo $this->_tpl_vars['myitem']['name']; ?>
</div></td>
            <td class="td1"><div align="center">[<a href="<?php echo $this->_tpl_vars['addurl']; ?>
?con=addup&operid=<?php echo $this->_tpl_vars['myitem']['operid']; ?>
&roleid=<?php echo $this->_tpl_vars['myitem']['roleid']; ?>
&delflag=<?php echo $this->_tpl_vars['myitem']['delflag']; ?>
">查看</a>] </div></td>
            <td class="td2">
			  <div align="center"><?php if ($this->_tpl_vars['myitem']['operid'] != 1): ?>
			    <input type="checkbox" name="nid[]" value="<?php echo $this->_tpl_vars['myitem']['operid']; ?>
">
		    <?php endif; ?></div></td>
          </tr>
          <?php endforeach; endif; unset($_from); ?>
  </table>
		<div style="text-align:right">
		<div><img src="img/blank.gif" width="1" height="8"></div>
		<img border="0" src="img/sel_all.gif" width="64" style="cursor:hand" height="22" onClick="javascript:SelectAll('nid[]');"> 
		<img border="0" src="img/sel_no.gif" width="64" style="cursor:hand" height="22" onClick="javascript:UnSelectAll('nid[]');">
        <input name="image" type="image" src="img/del.gif" width="64" height="22" border="0">
		<?php if ($this->_tpl_vars['delflag'] == 0): ?><img border="0" src="img/add.gif" width="64" height="22" style="cursor:hand" onClick="javascript: window.location='<?php echo $this->_tpl_vars['addurl']; ?>
?con=addup&delflag=<?php echo $this->_tpl_vars['delflag']; ?>
&roleid=<?php echo $this->_tpl_vars['roleid']; ?>
';"><?php endif; ?>
	  </div>		
      <table border="0" cellspacing="0" cellpadding="0" width="500" id="table1">
	  <tr>
	  <td valign="middle">
	  <input type="hidden" id="act" name="act" value="delete">
      <input type="hidden" id="con" name="con" value="list">
      <input type="hidden" id="selAll_nid[]" name="selAll_nid[]" value="">
	 </td>
	 </tr>
	 </table>
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