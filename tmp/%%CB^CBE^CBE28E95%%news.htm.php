<?php /* Smarty version 2.6.14, created on 2008-11-04 19:01:13
         compiled from admin/news.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'me_fckeditor', 'admin/news.htm', 28, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理学课程网站后台管理系统 | POWERED BY 杭州创蓝网络科技有限公司</title>
<LINK href="css/css_table.css" type=text/css rel=stylesheet>
<script language="javascript" src="js/common.js"></script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="3%"><img border="0" src="img/page.gif" width="18" height="18"></td>
    <td width="97%"><span class="t_title">新闻编辑</span></td>
  </tr>
</table>
<div><img src="img/blank.gif" width="1" height="8"></div>
<form  action="news.php?id=<?php echo $this->_tpl_vars['id']; ?>
" <?php echo $this->_tpl_vars['form_data']['attributes']; ?>
>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="twidth">
  <tr>
    <td width="24%" class="td2">新闻标题</td>
    <td width="76%" class="td2"><div align="left"><?php echo $this->_tpl_vars['form_data']['title']['html']; ?>
</div></td>
  </tr>
  <tr>
    <td class="td2">权值</td>
    <td class="td2"><div align="left"><?php echo $this->_tpl_vars['form_data']['value']['html']; ?>
</div></td>
  </tr>
  <tr>
    <td colspan="2" class="td2"><?php echo smarty_function_me_fckeditor(array('name' => 'content','mode' => 'Basic','forAdmin' => 'true','value' => $this->_tpl_vars['content']), $this);?>
</td>
  </tr>
  <tr>
    <td colspan="2" class="td2">
	  <div align="center">
	    <input name="image" type="image" src="img/submit.gif" width="64" height="22" border="0">
	    <a href="javascript:history.back(1)"><img border="0" src="img/back.gif" width="64" height="22"></a>	 
	    <input name="type" type="hidden" value="<?php echo $this->_tpl_vars['type']; ?>
">
	    </div></td>
  </tr>
</table>
</form>
<div><img src="img/blank.gif" width="1" height="8"></div>
<div style="text-align:right"></div>
</body>


</html>