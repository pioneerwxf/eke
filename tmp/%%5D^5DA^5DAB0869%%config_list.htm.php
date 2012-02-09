<?php /* Smarty version 2.6.14, created on 2008-11-04 15:18:40
         compiled from admin/config_list.htm */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>System Of SERC Background | POWERED BY 杭州创蓝网络科技有限公司</title>
<LINK href="css/css_table.css" type=text/css rel=stylesheet>
<script language="javascript" src="js/common.js"></script>
<script src='js/pagination.js' type='text/javascript'></script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="3%"><img border="0" src="img/page.gif" width="18" height="18"></td>
    <td width="97%"><span class="t_title">配置列表</span></td>
  </tr>
</table>
<div><img src="img/blank.gif" width="1" height="8"></div>
<form target="_self" method="post">
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="twidth">
  <tr class="table-field">
    <td width="10%"class="td1" >配置名称</td>
    <td width="55%"class="td2" >配置取值</td>
    <td width="25%"class="td1" >配置描述</td>
    <td width="10%" class="td2">操作</td>
    </tr>
   <?php $_from = $this->_tpl_vars['thepager']->itemlist; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myitem']):
?>
  <tr>
    <td class="td2" ><div align="center"><?php echo $this->_tpl_vars['myitem']['name']; ?>
</div></td>
    <td  class="td1" ><div align="center"><?php echo $this->_tpl_vars['myitem']['value']; ?>
</div></td>
    <td class="td2" ><div align="center"><?php echo $this->_tpl_vars['myitem']['descrip']; ?>
</div></td>
    <td class="td1" ><div align="center">[<a href="<?php echo $this->_tpl_vars['addurl']; ?>
?con=addup&name=<?php echo $this->_tpl_vars['myitem']['name']; ?>
">编辑</a>]</div></td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
</table>
<div><img src="img/blank.gif" width="1" height="8"></div>
</form>
</body>


</html>