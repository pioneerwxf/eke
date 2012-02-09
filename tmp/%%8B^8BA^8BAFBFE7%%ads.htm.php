<?php /* Smarty version 2.6.14, created on 2008-11-04 16:19:00
         compiled from admin/ads.htm */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> | POWERED BY </title>
<LINK href="css/css_table.css" type=text/css rel=stylesheet>
<script language="javascript" src="lib/scripts/common.js"></script>
<script language="javascript" src="lib/js/calenderJS.js"></script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="3%"><img border="0" src="img/page.gif" width="18" height="18"></td>
    <td width="97%"><span class="t_title">编辑<?php echo $this->_tpl_vars['title']; ?>
</span></td>
  </tr>
</table>
<div><img src="img/blank.gif" width="1" height="8"></div>
<form  action="ads.php?id=<?php echo $this->_tpl_vars['id']; ?>
" enctype="multipart/form-data" <?php echo $this->_tpl_vars['form_data']['attributes']; ?>
>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="twidth">
  <tr>
    <td width="24%" class="td2">显示文字</td>
    <td width="76%" class="td2"><div align="left"><?php echo $this->_tpl_vars['form_data']['title']['html']; ?>

      <br>
      （图片链接为鼠标悬浮时显示的文字）</div></td>
  </tr>
  <tr>
    <td class="td2"><span class="td2" style="text-align: center"><?php if ($this->_tpl_vars['pic'] == 0): ?>没有图片<?php else: ?><a href="file/pic/<?php echo $this->_tpl_vars['myitem']['pic']; ?>
"><img src="file/pic/<?php echo $this->_tpl_vars['pic']; ?>
" alt="" width="96" height="32" border="0"></a><?php endif; ?></span></td>
    <td class="td2"><div align="left">
      <label> 修改图片<br>
      <input name="Myfile" type="file" id="Myfile">
      </label>
      <br>
      文字链接可不上传<br>
    </div></td>
  </tr>
  <tr>
    <td class="td2">链接指向地址</td>
    <td class="td2"><div align="left"><?php echo $this->_tpl_vars['form_data']['link']['html']; ?>
</div></td>
  </tr>
  
  <tr>
    <td class="td2">权值</td>
    <td class="td2"><div align="left"><?php echo $this->_tpl_vars['form_data']['value']['html']; ?>
（权值高者优先显示在首页）</div></td>
  </tr>
  
  <tr>
    <td colspan="2" class="td2">
      <div align="center">
        <input type="hidden" name="type" value="<?php echo $this->_tpl_vars['type']; ?>
" id="hiddenField">
        <input name="image" type="image" src="img/submit.gif" width="64" height="22" border="0">
         <a href="javascript:history.back(1)"><img border="0" src="img/back.gif" width="64" height="22"> </a>	
         </div></td>
  </tr>
</table>
</form>
<div><img src="img/blank.gif" width="1" height="8"></div>
<div style="text-align:right"></div>
</body>


</html>