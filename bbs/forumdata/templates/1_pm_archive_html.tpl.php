<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$charset?>" />
<title><?=$bbname?></title>
<style type="text/css">
body		{ background-color: #FFFFFF; color: #000000; font-family: Verdana, Tahoma; font-size: 12px; margin: 20px; padding: 0px; }
#largetext	{ font-size: 18px; font-weight: bold; margin-bottom: 10px; padding-top: 3px; width: auto; }
#userinfo	{ font-size: 12px; color: #888888; text-align: right; width: auto; }
#copyright	{ margin-top: 30px; font-size: 11px; text-align: center; }
.wrapper	{ }
.subject	{ font-size: 14px; font-weight: bold; padding: 3px; margin-bottom: 10px; border: 1px solid #A8A8A8; }
.pm		{ color: #000000; padding: 10px; margin-top:10px; border: 1px solid #888888; }
.content	{ color: #888888; }
.msgborder	{ margin: 2em; margin-top: 3px;	padding: 10px; border: 1px solid #888888; word-break: break-all; }
</style>
</head>
<body>
<div id="wrapper">
  <div id="largetext">导出短消息</div>
  <div id="userinfo"><a href="<?=$boardurl?>space.php?uid=<?=$discuz_uid?>" target="_blank"><?=$discuz_userss?> @ <?=$timenow['time']?></a></div>
  <br /><? if(is_array($pmlist)) { foreach($pmlist as $pm) { ?>  <div class="pm">
    <div class="subject"><?=$pm['subject']?></div>
    <strong>时间:</strong> <?=$pm['dateline']?><br />
    <strong>文件夹:</strong> <? if($pm['folder'] == 'outbox') { ?>草稿箱<? } else { ?>收件箱<? } ?><br />
    <strong>来自:</strong> <? if(!$announcepm) { if($pm['msgfromid']) { ?><a href="space.php?uid=<?=$pm['msgfromid']?>"><?=$pm['msgfrom']?></a><? } else { ?><?=$pm['msgfrom']?><? } } else { ?>公共消息<? } ?><br />
    <strong>发送到:</strong> <a href="<?=$boardurl?>space.php?uid=<?=$pm['msgtoid']?>" target="_blank"><?=$pm['msgto']?></a><br />
    <br />
    <div class="content"><?=$pm['message']?></div>
  </div><? } } ?></div>
<div id='copyright'>
  Powered by <strong><a href="http://www.discuz.net" target="_blank">Discuz!</a> <?=$version?></strong></a>&nbsp;
  &copy; 2001-2006 <a href="http://www.comsenz.com" target="_blank">Comsenz Inc.</a>
</div>
</body>
</html>