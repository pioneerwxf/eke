<?php /* Smarty version 2.6.14, created on 2008-11-06 15:16:16
         compiled from admin/book_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'admin_pagination', 'admin/book_list.htm', 85, false),)), $this); ?>
<html>
<head>
<title>channel_list</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript" src="js/common.js"></script>
<script src='js/pagination.js' type='text/javascript'></script>
<LINK href="css/css_table.css" type=text/css rel=stylesheet>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:-15px;">
  <tr>
    <td width="3%"><img border="0" src="img/page.gif" width="18" height="18"></td>
    <td width="97%"><span class="t_title"><b><a href="book.php?shopid=<?php echo $this->_tpl_vars['shopid']; ?>
"><?php if ($this->_tpl_vars['delflag'] == 1): ?>已删<?php endif;  echo $this->_tpl_vars['shopname']; ?>
 </a></b></span><b>书籍列表</b>&nbsp; 
		</td>
  </tr>
  <tr>
  	<td colspan="2">
	<form target="_self" method="post">
	<img src="img/nv_search.gif" width="16" height="16">&nbsp;书籍名称:
	<input name="title" type="text" class="input_in" id="title" style="width:80px"/> 
	&nbsp;&nbsp;作者: 
	<input name="author" type="text" class="input_in" id="author" style="width:60px"/>
	&nbsp;添加时间:
	<input name="time" type="text" class="input_in" id="time" style="width:60px"/>
&nbsp;&nbsp;
	<select name="tag">
		<option value="0" selected="selected">选择书籍状态</option>
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
<form target="_self" method="post">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" class="twidth">
		<tr class="table-field">
			<td  width="30%">书籍名称</td>
			<td  width="15%">著者</td>
			<td  width="25%">添加时间</td>
			<td  width="10%">状态</td>
			<td  width="10%">操作</td>
			<td  width="10%">选择</td>
		</tr>
		<?php $_from = $this->_tpl_vars['thepager']->itemlist; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myitem']):
?>
		<tr>
			<td class="td1"><div align="center"><?php echo $this->_tpl_vars['myitem']['title']; ?>
</div></td>
			<td class="td2"><div align="center"><?php echo $this->_tpl_vars['myitem']['author']; ?>
</div></td>
			<td class="td1"><div align="center"><?php echo $this->_tpl_vars['myitem']['date']; ?>
</div></td>
			<td class="td2"><div align="center"><?php if ($this->_tpl_vars['myitem']['tag'] == 1): ?>待售<?php elseif ($this->_tpl_vars['myitem']['tag'] == 2): ?>预定<?php elseif ($this->_tpl_vars['myitem']['tag'] == 3): ?>已售<?php elseif ($this->_tpl_vars['myitem']['tag'] == '-1'): ?>删除<?php endif; ?></div></td>
			<td class="td1"><div align="center">[
			<a href="<?php echo $this->_tpl_vars['addurl']; ?>
?con=addup&bookid=<?php echo $this->_tpl_vars['myitem']['bookid']; ?>
&tag=<?php echo $this->_tpl_vars['tag']; ?>
">修改</a>]
			</div>			</td>
			<td class="td2"><div align="center"><input type="checkbox" name="nid[]" value="<?php echo $this->_tpl_vars['myitem']['bookid']; ?>
"></div>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
	</table>
  <div style="text-align:right">
		<div><img src="img/blank.gif" width="1" height="8"></div>
		<a href="javascript:history.back(1)">
			  	<img border="0" src="img/back.gif" width="64" height="22"></a>
		<img border="0" src="img/sel_all.gif" width="64" style="cursor:hand" height="22" 
			onClick="javascript:SelectAll('nid[]');"> 
		<img border="0" src="img/sel_no.gif" width="64" style="cursor:hand" height="22" 
			onClick="javascript:UnSelectAll('nid[]');">
		<input name="image" type="image" src="img/del.gif" width="64" height="22" border="0">
	</div>
	<table border="0" cellspacing="0" cellpadding="0" width="500" id="table1">
	  <tr>
		  <td valign="middle">
		  <input type="hidden" name="shopid" value="<?php echo $this->_tpl_vars['shopid']; ?>
">
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