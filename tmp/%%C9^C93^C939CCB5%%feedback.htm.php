<?php /* Smarty version 2.6.14, created on 2008-11-04 22:34:17
         compiled from admin/feedback.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'me_fckeditor', 'admin/feedback.htm', 40, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理学课程网站后台管理系统 | POWERED BY 杭州创蓝网络科技有限公司</title>
<LINK href="css/css_table.css" type=text/css rel=stylesheet>
</head>

<body>
<form  action="feedback.php?id=<?php echo $this->_tpl_vars['id']; ?>
" <?php echo $this->_tpl_vars['form_data']['attributes']; ?>
>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="3%"><img border="0" src="img/page.gif" width="18" height="18"></td>
    <td width="97%"><span class="t_title">留言查看</span></td>
  </tr>
</table>
<div><img src="img/blank.gif" width="1" height="8"></div>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="twidth">
  <tr class="table-field">
    <td width="20%" class="t_b">Name</td>
    <td width="80%" class="t_b"><?php echo $this->_tpl_vars['name']; ?>
</td>
  </tr>
  <tr>
    <td class="td1">Content</td>
    <td class="td2"><?php echo $this->_tpl_vars['content']; ?>
</td>
  </tr>
  <tr>
    <td class="td1">Email</td>
    <td class="td2"><?php echo $this->_tpl_vars['email']; ?>
</td>
  </tr>
    <tr>
    <td class="td1">Phone</td>
    <td class="td2"><?php echo $this->_tpl_vars['tele']; ?>
</td>
  </tr>
  <tr>
    <td class="td1">Date</td>
    <td class="td2"><?php echo $this->_tpl_vars['date']; ?>
</td>
  </tr>
  <tr>
    <td class="td1">Reply：</td>
    <td class="td2" style=" height=50px; "><span class="td2"><?php echo smarty_function_me_fckeditor(array('name' => 'reply','mode' => 'Basic','forAdmin' => 'true','value' => $this->_tpl_vars['reply']), $this);?>
</span></td>
  </tr>
    <tr>
    <td colspan="2" class="td2">
	<span style="text-align: center">
	*留言提交后即审核通过，将显示在前台页面
	<input name="image" type="image" src="img/submit.gif" width="64" height="22" border="0">
      <a href="javascript:history.back(1)"><img border="0" src="img/back.gif" width="64" height="22">			      </a>	 </span></td>
  </tr>
</table>
</form>
<div><img src="img/blank.gif" width="1" height="8"></div>
<div style="text-align:right"></div>
</body>


</html>