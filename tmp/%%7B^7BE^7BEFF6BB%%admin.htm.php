<?php /* Smarty version 2.6.14, created on 2008-11-04 14:40:37
         compiled from admin/admin.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/admin.htm', 25, false),)), $this); ?>
<html>
<head>
<title>admin_list</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript" src="js/common.js"></script>
<link href="css/css_table.css" rel="stylesheet" type="text/css">
</head>
<body>
        <div align="center">
        <table border="0" cellpadding="0" cellspacing="1" class="twidth" width="68%">
         <form <?php echo $this->_tpl_vars['form_data']['attributes']; ?>
>
		  <tr class="table-field">
            <td colspan="2" nowrap><b><?php echo $this->_tpl_vars['title']; ?>
</b></td>
          </tr>
          <tr>
            <td class="td1" width="24%">昵称:</td>
            <td class="td2" width="76%"><?php echo $this->_tpl_vars['form_data']['name']['html']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">密码:</td>
            <td  class="td2"><?php echo $this->_tpl_vars['form_data']['pass']['html']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">权限:</td>
            <td  class="td2"><select name="role_id"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['role_options'],'selected' => $this->_tpl_vars['roleid_now']), $this);?>
</select></td>
          </tr>
          <tr>
            <td  class="td1">创建时间:</td>
            <td  class="td2"><?php echo $this->_tpl_vars['crtime']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">创建者ID:</td>
            <td  class="td2"><?php echo $this->_tpl_vars['croperid']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">最后修改时间:</td>
            <td  class="td2"><?php echo $this->_tpl_vars['modtime']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">最后修改者ID:</td>
            <td  class="td2"><?php echo $this->_tpl_vars['modoperid']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">最后登录时间:</td>
            <td  class="td2"><?php echo $this->_tpl_vars['logtime']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">最后登录IP:</td>
            <td  class="td2"><?php echo $this->_tpl_vars['logip']; ?>
</td>          
		  </tr>
          <tr>
            <td colspan="2" class="td2" style="height: 25px">
			<div><img src="img/blank.gif" width="1" height="8"></div>
			<div align="center">
			  <input type="image" border="0" src="img/submit.gif" width="64" height="22">
			  <a href="javascript:history.back(1)"><img border="0" src="img/back.gif" width="64" height="22"></a></div></td>
          </tr>
		  <input type="hidden" name="act" value="<?php echo $this->_tpl_vars['act']; ?>
">
		  <input type="hidden" name="operid" value="<?php echo $this->_tpl_vars['operid']; ?>
">
		  <input type="hidden" name="roleid" value="<?php echo $this->_tpl_vars['roleid']; ?>
">
		  <input type="hidden" name="delflag" value="<?php echo $this->_tpl_vars['delflag']; ?>
">
		  </form>
          </table>      
        </div>

</body>
</html>