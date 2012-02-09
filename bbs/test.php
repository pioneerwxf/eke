<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>discuz变量说明</title>
</head>
<body>
<?	  include("include/common.inc.php");
	?>
<table width="98%" border="0">
  <tr>
    <td colspan="2"><p align="center">Discuz论坛整合常用变量说明（要包括文件include/common.inc.php）</p>    </td>
  </tr>
  <tr>
    <td width="20%">当前登陆用户</td>
    <td width="80%"><?=$discuz_userss;?></td>
  </tr>
  <tr>
    <td>退出地址</td>
    <td><?=$link_logout?></td>
  </tr>
  <tr>
    <td>当前登陆用户id</td>
    <td><?=$discuz_uid?></td>
  </tr>
  <tr>
    <td>前一个地址</td>
    <td><?=$url_forward?></td>
  </tr>
  <tr>
    <td>短消息提示音乐</td>
    <td>
	
	</span>
</td>
  </tr>
  <tr>
    <td>是否有新短消息</td>
    <td></td>
  </tr>
  <tr>
    <td><?=$newpmexists."s"?></td>
    <td><? if(!empty($newpmexists) || $announcepm) { ?>有短消息
	<div style="clear: both; margin-top: 5px" id="pmprompt">
<? include template('pmprompt'); ?>
</div>
<? 	 if($pmsound) { ?><bgsound src="../bbs/images/sound/pm_<?=$pmsound?>.wav" /><? } ?><a href="pm.php" target="_blank">[查看详情]</a>
		<? if($newpm) { ?><a href="pm.php?action=noprompt" onclick="ajaxget(this.href, 'pmprompt', null, null, 'none');doane(event);">[不再提示]</a><? } 
		?>
<? } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
