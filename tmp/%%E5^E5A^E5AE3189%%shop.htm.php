<?php /* Smarty version 2.6.14, created on 2008-11-06 00:29:20
         compiled from admin/shop.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/shop.htm', 37, false),)), $this); ?>
<html>
<head>
<title>admin_list</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript" src="js/common.js"></script>
<link href="css/css_table.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center">
		<table border="0" cellpadding="0" cellspacing="1" class="twidth" width="100%">
         <form enctype="multipart/form-data" <?php echo $this->_tpl_vars['form_data']['attributes']; ?>
>
		  <tr class="table-field">
            <td colspan="2" nowrap><b><?php echo $this->_tpl_vars['title']; ?>
</b></td>
          </tr>
          <tr>
            <td class="td1" width="24%"  >书店名称:</td>
            <td class="td2" width="76%"  ><?php echo $this->_tpl_vars['form_data']['shopname']['html']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">店主</td>
            <td  class="td2"><?php echo $this->_tpl_vars['form_data']['owner']['html']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">店主电话</td>
            <td  class="td2"><?php echo $this->_tpl_vars['form_data']['phone']['html']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">店主email</td>
            <td  class="td2"><?php echo $this->_tpl_vars['form_data']['email']['html']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">广告词</td>
            <td  class="td2"><?php echo $this->_tpl_vars['form_data']['adv']['html']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">书店级别</td>
            <td  class="td2"><select name="level_now"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['level_options'],'selected' => $this->_tpl_vars['level_now']), $this);?>
</select></td>          
		  </tr>
		  <tr>
            <td  class="td1">所属学院</td>
            <td  class="td2"><select name="college"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['college_options'],'selected' => $this->_tpl_vars['college']), $this);?>
</select></td>          
		  </tr>
		  <tr>
            <td  class="td1">海报图片</td>
            <td  class="td2"><?php echo $this->_tpl_vars['form_data']['poster']['html']; ?>
<br>
				<input name="Posterfile" type="file" id="Posterfile">(优先选择)</td>          
		  </tr>
		  <tr>
            <td  class="td1">创建时间</td>
            <td  class="td2"><?php echo $this->_tpl_vars['date']; ?>
</td>          
		  </tr>
		  <tr>
            <td  class="td1">现有藏书</td>
            <td  class="td2"><?php echo $this->_tpl_vars['booknum']; ?>
</td>          
		  </tr>
		  <tr>
            <td  class="td1">已售藏书</td>
            <td  class="td2"><?php echo $this->_tpl_vars['soldnum']; ?>
</td>          
		  </tr>
		  <tr>
            <td colspan="2" class="td2" style="height: 25px">
				<div align="center">
				  <p><img src="img/blank.gif" width="1" height="8">
			        <input type="image" border="0" src="img/submit.gif" width="64" height="22">
				        <a href="javascript:history.back(1)">
		                <img border="0" src="img/back.gif" width="64" height="22"></a> </p>
				</div>			</td>
          </tr>
		  <input type="hidden" name="shopid" value="<?php echo $this->_tpl_vars['shopid']; ?>
">
		  <input type="hidden" name="level" value="<?php echo $this->_tpl_vars['level']; ?>
">
		  <input type="hidden" name="act" value="<?php echo $this->_tpl_vars['act']; ?>
">
		  </form>
  </table>
</div>
</body>
</html>