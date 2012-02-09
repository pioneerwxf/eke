<?php /* Smarty version 2.6.14, created on 2008-11-05 15:21:38
         compiled from admin/book.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/book.htm', 47, false),)), $this); ?>
<html>
<head>
<title>admin_list</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript" src="js/common.js"></script>
<link href="css/css_table.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center">
<table width="100%"  border="0" cellpadding="0"  height="28" style="border-collapse: collapse">
  <tr>
	<td><img border="0" src="img/page.gif" width="18" height="18"></td>
	<td width="98%"><font color="#0062AA"><b>《<?php echo $this->_tpl_vars['title']; ?>
》 属性编辑&nbsp; </b></font></td>
  </tr>
</table>
		<table border="0" cellpadding="0" cellspacing="1" class="twidth" width="100%">
         <form <?php echo $this->_tpl_vars['form_data']['attributes']; ?>
>
		  <tr class="table-field">
            <td colspan="2" nowrap><?php echo $this->_tpl_vars['form_data']['title']['html']; ?>
&nbsp;=&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;（<?php echo $this->_tpl_vars['shopname']; ?>
店）</td>
          </tr>
          <tr>
            <td class="td1" width="24%"  >著者:</td>
            <td class="td2" width="76%"  ><?php echo $this->_tpl_vars['form_data']['author']['html']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">出版社</td>
            <td  class="td2"><?php echo $this->_tpl_vars['form_data']['public']['html']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">原价</td>
            <td  class="td2"><?php echo $this->_tpl_vars['form_data']['price0']['html']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">现价</td>
            <td  class="td2"><?php echo $this->_tpl_vars['form_data']['price1']['html']; ?>
</td>
          </tr>
          <tr>
            <td  class="td1">新旧</td>
            <td  class="td2"><?php echo $this->_tpl_vars['form_data']['old_degree']['html']; ?>
</td>          
		  </tr>
		  <tr>
            <td  class="td1">图书分类</td>
            <td  class="td2"><?php echo $this->_tpl_vars['form_data']['sort']['html']; ?>
</td>          
		  </tr>
		  <tr>
            <td  class="td1">状态</td>
		    <td  class="td2"><select name="tag_now"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['tag_options'],'selected' => $this->_tpl_vars['tag_now']), $this);?>
</select></td>
	       </tr>
		  <tr>
            <td  class="td1">所属书店ID</td>
		    <td  class="td2"><?php echo $this->_tpl_vars['form_data']['shopid']['html']; ?>
</td>
	       </tr>
		  <tr>
            <td  class="td1">书籍照片</td>
            <td  class="td2">            <?php echo $this->_tpl_vars['form_data']['Myfile']['html']; ?>
</td>          
		  </tr>
		  <tr>
            <td  class="td1">补充信息</td>
		    <td  class="td2"><?php echo $this->_tpl_vars['form_data']['info']['html']; ?>
</td>
	       </tr>
		  <tr>
            <td  class="td1">添加日期</td>
            <td  class="td2"><?php echo $this->_tpl_vars['date']; ?>
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
		  <input type="hidden" name="bookid" value="<?php echo $this->_tpl_vars['bookid']; ?>
">
		  <input type="hidden" name="tag" value="<?php echo $this->_tpl_vars['tag']; ?>
">
		  <input type="hidden" name="act" value="<?php echo $this->_tpl_vars['act']; ?>
">
		  </form>
          </table>
</div>
</body>
</html>