<?php /* Smarty version 2.6.14, created on 2008-11-04 15:18:57
         compiled from admin/config.htm */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>System Of Background | POWERED BY Wangxianfeng</title>
<LINK href="css/css_table.css" type=text/css rel=stylesheet>
</head>

<body>
<form action="config.php" <?php echo $this->_tpl_vars['form_data']['attributes']; ?>
>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="3%"><img border="0" src="img/page.gif" width="18" height="18"></td>
    <td width="97%">配置编辑<?php echo $this->_tpl_vars['name']; ?>
</td>
  </tr>
</table>
<div><img src="img/blank.gif" width="1" height="8"></div>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="twidth">
  <tr class="table-field">
    <td width="24%" class="t_b">配置名称</td>
    <td width="76%" class="t_b"><?php echo $this->_tpl_vars['name']; ?>
</td>
  </tr>
  
  <tr>
    <td class="td1">配置取值</td>
    <td class="td2"><?php echo $this->_tpl_vars['form_data']['value']['html']; ?>
</td>
  </tr>
  <tr>
    <td class="td1">配置描述</td>
    <td class="td2"><?php echo $this->_tpl_vars['form_data']['descrip']['html']; ?>
</td>
  </tr>
  
    <tr>
    <td colspan="2" class="td2">
	  <div align="center">
	    <input name="image" type="image" src="img/submit.gif" width="64" height="22" border="0">
        <a href="javascript:history.back(1)"><img border="0" src="img/back.gif" width="64" height="22">			      </a></div></td>
  </tr>
</table>
<input name="name" type="hidden" value="<?php echo $this->_tpl_vars['name']; ?>
">
</form>
<div><img src="img/blank.gif" width="1" height="8"></div>
</body>


</html>