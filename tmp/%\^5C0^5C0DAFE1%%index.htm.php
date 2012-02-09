<?php /* Smarty version 2.6.14, created on 2008-11-06 09:37:52
         compiled from admin/index.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎来到--eKe--后台管理系统 </title>
<LINK href="css/css.css" type=text/css rel=stylesheet>
<script language="javascript" src="js/common.js"></script>
<script language=javascript>
<?php echo '
function SetFocus() {
	if (document.Login.UserName.value=="")
		document.Login.UserName.focus();
	else
		document.Login.UserName.select();
}
function CheckForm() {
	if(document.Login.UserName.value=="")
	{
		alert("Please Input your username");
		document.Login.UserName.focus();
		return false;
	}
	if(document.Login.Password.value == "")
	{
		alert("Please Input your password");
		document.Login.Password.focus();
		return false;
	}
}
'; ?>

</script>
</head>

<body scroll=no bgcolor="#1A60A8" onLoad="initialize();">
<form name="Login" method="post" target="_parent" onSubmit="return CheckForm();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="139">&nbsp;</td>
  </tr>
  <tr>
    <td height="261">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" height="261">>
		<tr>
			<td height="1">
			<img border="0" src="img/blank.gif" width="154" height="1"></td>
			<td height="1">
			<img border="0" src="img/blank.gif" width="684" height="1"></td>
			<td height="1">
			<img border="0" src="img/blank.gif" width="186" height="1"></td>
		</tr>
		  <tr>
			<td class="index_bg_left">&nbsp;</td>
			<td class="index_bg_mid" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="25"><embed width="1" height="1" src="flash/index_sound.swf" hidden></td>
				  </tr>
				  <tr>
					<td height="148" align="center"><embed src="flash/index_logo.swf" quality=High type="application/x-shockwave-flash" width="595" height="154" wmode="transparent" swliveconnect="true"></embed>
					</td>
				  </tr>
				  <tr>
					<td height="39" class="loginindex"><table width="413" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5%" class="fontw">ID</td>
                        <td width="22%"><input type="text" name="UserName" class="logininput"/></td>
                        <td width="6%" class="fontw">PW</td>
                        <td width="23%"><input type="Password" name="Password" class="logininput"/>
                        <td width="17%"><a href="javascript:document.Login.submit();" onMouseOver="MM_swapImage('bt_login','','img/bt_login_o.gif',1)" onMouseOut="MM_swapImgRestore()"><img border="0" src="img/bt_login.gif" width="64" height="22" name="bt_login" ></a></td>
                        <td width="15%"><a href="javascript:document.Login.reset();" onMouseOver="MM_swapImage('bt_rest','','img/bt_login_reset_o.gif',1)" onMouseOut="MM_swapImgRestore()"><img border="0" src="img/bt_login_reset.gif" width="64" height="22" name="bt_rest"></a></td>
                        <td width="12%">&nbsp;</td>
                      </tr>
                    </table></td>
				  </tr>
				  <tr>
					<td height="39" align="right" class="fontw">&nbsp;&nbsp;&nbsp;&nbsp;COPYRIGHT © 2008 ALL RIGHTS RESERVED</td>
				  </tr>
				</table>
			</td>
			<td class="index_bg_right" align="right">&nbsp;</td>
		  </tr>
		</table>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>


</html>