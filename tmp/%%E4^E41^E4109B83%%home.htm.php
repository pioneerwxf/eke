<?php /* Smarty version 2.6.14, created on 2008-11-04 14:35:20
         compiled from admin/home.htm */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎来到--eKe--后台管理系统 </title>
<LINK href="css/css.css" type=text/css rel=stylesheet>
<script language="javascript" src="js/common.js"></script>
</head>

<body scroll=no onLoad="initialize();">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" class="twidth">
  <tr>
    <td colspan="2" class="head"><table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="88"><img src="img/logo.jpg" width="340" height="88" /></td>
        <td>&nbsp;</td>
        <td class="head-right linktop">&nbsp;<a href="../index.php">前台主页</a>&nbsp;|&nbsp;<a href="logout.php">退出</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" class="panel"><table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td rowspan="2" id="Panel" name="Panel"><table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td class="panel-head"><span class="fontw">WELCOME ADMIN</span></td>
              </tr>
            <tr>
              <td><img src="img/panel_sep.jpg" width="172" height="2"></td>
            </tr>
            <tr>
              <td height="24"><table width="100%"  border="0" cellspacing="2" cellpadding="0">
                  <tr>
                    <td width="100%" class="fontw" align="center"><script language="Javascript">Today();</script></td>
                    <td><a href="javascript:void(dtree.a.openAll())"><img src="img/bt_openall.jpg" alt="展开树" width="18" height="18" border="0"></a></td>
                    <td><a href="javascript:void(dtree.a.closeAll())"><img src="img/bt_closeall.jpg" alt="关闭树" width="18" height="18" border="0"></a></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="100%"><table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="10">&nbsp;</td>
                    <td width="182" valign="top" class="tree">
					<iframe id="dtree" name="dtree" src="menulist.htm" marginheight="0" marginwidth="0" frameborder="0" scrolling="auto" allowtransparency="100%" width="100%" height="100%"></iframe>
					</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td valign="bottom" class="tab-center">&nbsp;</td>
            </tr>
            <tr>
              <td valign="bottom" class="panel-foot"></td>
              </tr>
          </table></td>
          <td class="switch"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td id="hidePanel" name="hidePanel"><img src="img/bt_hide.jpg" alt="隐藏功能面板" name="bt_hide" width="8" height="64" border="0" id="bt_hide" style="cursor:pointer; " onClick="switchPanel('hide')" onMouseOver="MM_swapImage('bt_hide','','img/bt_hide_o.jpg',1)" onMouseOut="MM_swapImgRestore()"></td>
            </tr>
            <tr>
              <td id="showPanel" name="showPanel"><img src="img/bt_show.jpg" alt="显示功能面板" name="bt_show" width="8" height="64" border="0" id="bt_show" style="cursor:pointer; " onClick="switchPanel('show')" onMouseOver="MM_swapImage('bt_show','','img/bt_show_o.jpg',1)" onMouseOut="MM_swapImgRestore()"></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td class="panel-foot-r"></td>
        </tr>
      </table></td>
    <td width="100%" valign="top" class="mainboard"><iframe id="MainBoard" name="MainBoard" src="welcome.htm" marginheight="0" marginwidth="0" frameborder="0" scrolling="auto" allowtransparency="100%" width="100%" height="100%"></iframe></td>
  </tr>
  <tr>
    <td colspan="2" class="fontw foot">COPYRIGHT © 2008 ALL RIGHTS RESERVED</td>
  </tr>
</table>
</body>

</html>