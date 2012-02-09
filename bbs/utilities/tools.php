<?php

/*
	[Discuz!] Tools (C)2001-2007 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: tools.php 377 2007-05-31 06:33:51Z kimi $
*/

foreach(array('_COOKIE', '_POST', '_GET') as $_request) {
	foreach($$_request as $_key => $_value) {
		$_key{0} != '_' && $$_key = $_value;
	}
}

$tool_password = ''; //请您设置一个工具包的高强度密码，不能为空！
$lockfile = 'forumdata/tool.lock';

define('DISCUZ_ROOT', dirname(__FILE__).'/');
define('VERSION', '1.300');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@set_time_limit(0);


if(file_exists($lockfile)) {
	errorpage("工具箱已关闭，如需使用请通过FTP开启！");
} elseif ($tool_password == ''){
	errorpage('密码不能为空，请修改本文件中$tool_password设置密码！');
}

if($_POST['action'] == 'login') {
	setcookie('toolpassword', $_POST['toolpassword'], 0);
	echo '<meta http-equiv="refresh" content="2 url=?">';
	errorpage("请稍等，程序登录中！");
}

if(isset($_COOKIE['toolpassword'])) {
	if($_COOKIE['toolpassword'] != $tool_password) {
		errorpage("login");
	}
} else {
		errorpage("login");
}

$action = $_GET['action'];

if($action == 'repair') {
	$check = $_GET['check'];
	$nohtml = $_GET['nohtml'];
	$iterations = $_GET['iterations'];
	$simple = $_GET['simple'];

	if(@!include("./config.inc.php")) {
		if(@!include("./config.php")) {
			exit("请先上传config文件以保证您的数据库能正常链接！");
		}
	}
	mysql_connect($dbhost, $dbuser, $dbpw);
	mysql_select_db($dbname);
	$counttables = $oktables = $errortables = $rapirtables = 0;

	if($check) {

	$tables=mysql_query("SHOW TABLES");

	if(!$nohtml) {
		echo "<HTML><HEAD></HEAD><BODY><table border=1 cellspacing=0 cellpadding=4 STYLE=\"font-family: Tahoma, Verdana; font-size: 11px\">";
	}

	if($iterations) {
		$iterations --;
	}
	while($table=mysql_fetch_row($tables)) {
		if(substr($table[0], -8) != 'sessions') {
			$counttables += 1;
			$answer=checktable($table[0],$iterations);
			if(!$nohtml) {
			echo "<tr><td colspan=4>&nbsp;</td></tr>";
			} elseif (!$simple) {
			flush();
			}
		}
	}

	if(!$nohtml) {
		echo "</table></BODY></HTML>";
	}

	if($simple) {
	htmlheader();
	echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr><td>
		<p class="subtitle">Discuz! 检查修复数据库 <ul>
		<center><p class="subtitle">检查结果
		<div style="margin-top: 4px; border: 1px solid #7AC4EA; width: 80%;">
			<table width="100%" cellpadding="6" cellspacing="0" border="0">
				<tr align="center" class="header"><td width="25%">检查表(张)</td><td width="25%">正常表(张)</td><td width="25%">错误表(张)</td><td width="25%">错误数(个)</td></tr>
				<tr align="center"><td width="25%"><?=$counttables?></td><td width="25%"><?=$oktables?></td><td width="25%"><?=$rapirtables?></td><td width="25%"><?=$errortables?></td></tr>
			</table>
		</div><br>检查结果没有错误后请返回工具箱首页反之则继续修复<p><b><a href="?action=repair">继续修复</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="?">返回首页</a></b></center>

		<br><br>
		<p><font color="red">注意：
		<br><p style="text-indent: 3em; margin: 0;">对数据库操作可能会出现意外现象的发生及破坏，所以请先备份好数据库再进行上述操作！另外请您选择服务器压力比较小的时候进行一些优化操作。
		<br><p style="text-indent: 3em; margin: 0;">当您使用完毕Discuz! 系统维护工具箱后，请点击锁定工具箱以确保系统的安全！下次使用前只需要在/forumdata目录下删除tool.lock文件即可开始使用。</p></font>
		</td></tr></table>';
	}
	} else {
		htmlheader();
		echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr><td>
				<p class="subtitle">Discuz! 检查修复数据库 <ul>
				<p class="subtitle">说明：<p style="text-indent: 3em; margin: 0;">您可以通过下面的方式修复已经损坏的数据库。点击后请耐心等待修复结果！
				<p style="text-indent: 3em; margin: 0;">本程序可以修复常见的数据库错误，但无法保证可以修复所有的数据库错误。(需要 MySQL 3.23+)
				<br><br>
				<ul>
				<li> <a href="?action=repair&check=1&nohtml=1&simple=1">检查并尝试修复数据库1次</a>
				<li> <a href="?action=repair&check=1&iterations=5&nohtml=1&simple=1">检查并尝试修复数据库5次</a> (因为数据库读写关系可能有时需要多修复几次才能完全修复成功)
				</ul>
				<p><font color="red">注意：
				<br><p style="text-indent: 3em; margin: 0;">对数据库操作可能会出现意外现象的发生及破坏，所以请先备份好数据库再进行上述操作！另外请您选择服务器压力比较小的时候进行一些优化操作。
				<br><p style="text-indent: 3em; margin: 0;">当您使用完毕Discuz! 系统维护工具箱后，请点击锁定工具箱以确保系统的安全！下次使用前只需要在/forumdata目录下删除tool.lock文件即可开始使用。</p></font>
				</td></tr></table>';
	}
	htmlfooter();
} elseif ($action == 'check') {
	htmlheader();
	//6.校验环境是否支持DZ/SS，查看数据库和表的字符集，敏感信息    charset,dbcharset, php,mysql,zend,php短标记
	if(@!include("./config.inc.php")) {
		if(@!include("./config.php")) {
			exit("请先上传config文件以保证您的数据库能正常链接！");
		}
	}
	$curr_os = PHP_OS;

	if(!function_exists('mysql_connect')) {
		$curr_mysql = '不支持';
		$msg .= "<li>您的服务器不支持MySql数据库，无法安装论坛程序</li>";
		$quit = TRUE;
	} else {
		if(@mysql_connect($dbhost, $dbuser, $dbpw)) {
			$curr_mysql =  mysql_get_server_info();
		} else {
			$curr_mysql = '支持';
		}
	}

	$curr_php_version = PHP_VERSION;
	if($curr_php_version < '4.0.6') {
		$msg .= "<li>您的 PHP 版本小于 4.0.6, 无法使用 Discuz! / SuperSite。</li>";
	}
	if(!ini_get('short_open_tag')) {
		$curr_short_tag = '关闭';
		$msg .='<li>请将 php.ini 中的 short_open_tag 设置为 On，否则无法使用论坛。</li>';
	} else {
		$curr_short_tag = '开启';
	}
	if(@ini_get(file_uploads)) {
		$max_size = @ini_get(upload_max_filesize);
		$curr_upload_status = '您可以上传附件的最大尺寸: '.$max_size;
	} else {
		$msg .= "<li>附件上传或相关操作被服务器禁止。</li>";
	}

	if(OPTIMIZER_VERSION < 3.0) {
		$msg .="<li>您的ZEND版本低于3.x,将无法使用SuperSite.</li>";
	}
	

	$curr_disk_space = intval(diskfreespace('.') / (1024 * 1024)).'M';
	?>
	<div style="margin-top: 4px; border: 1px solid #7AC4EA; width: 80%;float:center;">
	<table width="100%" border="0" cellpadding="6" cellspacing="0" align="center">
	<tr class="header"><td></td><td>Discuz! / SuperSite 所需配置</td><td>当前服务器</td>
	</tr><tr class="option">
	<td class="altbg2">操作系统</td>
	<td class="altbg1">不限</td>
	<td class="altbg2"><?=$curr_os?></td>
	</tr><tr class="option">
	<td class="altbg2">PHP 版本</td>
	<td class="altbg1">4.0.6+</td>
	<td class="altbg2"><?=$curr_php_version?></td>
	</tr>
	<tr class="option">
	<td class="altbg2">短标记状态</td>
	<td class="altbg1">开启</td>
	<td class="altbg2"><?=$curr_short_tag?></td></tr>
	<tr class="option">
	<td class="altbg2">MySQL 支持</td>
	<td class="altbg1">支持</td>
	<td class="altbg2"><?=$curr_mysql?></td></tr>
	<tr class="option">
	<td class="altbg2">ZEND 支持</td>
	<td class="altbg1">支持</td>
	<td class="altbg2"><?=OPTIMIZER_VERSION?></td>
	
	</tr><tr class="option">
	<td class="altbg2">磁盘空间</td>
	<td class="altbg1">10M+</td>
	<td class="altbg2"><?=$curr_disk_space?></td>
	</tr><tr class="option">
	<td class="altbg2">附件上传</td>
	<td class="altbg1">不限</td>
	<td class="altbg2"><?=$curr_upload_status?></td>
	</tr>
	<?
	echo '<tr class="option"><td colspan="3" class="altbg2">';
	$msg == '' && $msg = '环境检查完毕,没有发现问题.';
	echo '<br>&nbsp;&nbsp;<font color="red">'.$msg.'</font></td></tr>';
	?>
	
	</table></div>
	<?
	htmlfooter();
} elseif ($action == 'filecheck') {
	require_once './include/common.inc.php';

	@set_time_limit(0);

	$do = isset($do) ? $do : 'advance';

	$lang = array(
		'filecheck_fullcheck' => '搜索未知文件',
		'filecheck_fullcheck_select' => '搜索未知文件 - 选择需要搜索的目录',
		'filecheck_fullcheck_selectall' => '[搜索全部目录]',
		'filecheck_fullcheck_start' => '开始时间:',
		'filecheck_fullcheck_current' => '当前时间:',
		'filecheck_fullcheck_end' => '结束时间:',
		'filecheck_fullcheck_file' => '当前文件:',
		'filecheck_fullcheck_foundfile' => '发现未知文件数: ',
		'filecheck_fullcheck_nofound' => '没有发现任何未知文件'
	);

	if(!$discuzfiles = @file('admin/discuzfiles.md5')) {
		cpmsg('filecheck_nofound_md5file');
	}
	htmlheader();
	if($do == 'advance') {
		$dirlist = array();
		$starttime = date('Y-m-d H:i:s');
		$cachelist = $templatelist = array();
		if(empty($checkdir)) {
			checkdirs('./');
		} elseif($checkdir == 'all') {
			echo "\n<script>var dirlist = ['./'];var runcount = 0;var foundfile = 0</script>";
		} else {
			$checkdir = str_replace('..', '', $checkdir);
			$checkdir = $checkdir{0} == '/' ? '.'.$checkdir : $checkdir;
			checkdirs($checkdir.'/');
			echo "\n<script>var dirlist = ['$checkdir/'];var runcount = 0;var foundfile = 0</script>";
		}

		echo '<table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td>
			<p class="subtitle">搜索未知文件<ul>
			<center><div style="margin-top: 4px; border: 1px solid #7AC4EA; width: 80%;float:center;">
			<table width="100%" border="0" cellpadding="6" cellspacing="0">
			<tr><th colspan="2" class="header">'.(empty($checkdir) ? '<a href="tools.php?action=filecheck&do=advance&start=yes&checkdir=all">'.$lang['filecheck_fullcheck_selectall'].'</a>' : $lang['filecheck_fullcheck'].($checkdir != 'all' ? ' - '.$checkdir : '')).'</th></tr>
			<script language="JavaScript" src="include/javascript/common.js"></script>';
		if(empty($checkdir)) {
			echo '<tr><td class="altbg1"><br><ul>';
			foreach($dirlist as $dir) {
				$subcount = count(explode('/', $dir));
				echo '<li>'.str_repeat('-', ($subcount - 2) * 4);
				echo '<a href="tools.php?action=filecheck&do=advance&start=yes&checkdir='.rawurlencode($dir).'">'.basename($dir).'</a></li>';
			}
			echo '</ul></td></tr></table>';
		} else {
			echo '<tr><td class="altbg1">'.$lang['filecheck_fullcheck_start'].' '.$starttime.'<br><span id="msg"></span></td></tr><tr><td class="altbg2"><div id="checkresult"></div></td></tr></table>
				<iframe name="checkiframe" id="checkiframe" style="display: none"></iframe>';
			echo "<script>checkiframe.location = 'tools.php?action=filecheck&do=advancenext&start=yes&dir=' + dirlist[runcount];</script>";
		}
		htmlfooter();
		exit;
	} elseif($do == 'advancenext') {
		$nopass = 0;
		foreach($discuzfiles as $line) {
			$md5files[] = trim(substr($line, 34));
		}
		$foundfile = checkfullfiles($dir);

		echo "<script>";
		if($foundfile) {
			echo "parent.foundfile += $foundfile;";
		}
		echo "parent.runcount++;
		if(parent.dirlist.length > parent.runcount) {
			parent.checkiframe.location = 'tools.php?action=filecheck&do=advancenext&start=yes&dir=' + parent.dirlist[parent.runcount];
		} else {
			var msg = '';
			msg = '$lang[filecheck_fullcheck_end] ".addslashes(date('Y-m-d H:i:s'))."';
			if(parent.foundfile) {
				msg += '<br>$lang[filecheck_fullcheck_foundfile] ' + parent.foundfile;
			} else {
				msg += '<br>$lang[filecheck_fullcheck_nofound]';
			}
			parent.$('msg').innerHTML = msg;
		}</script>";
		exit;
	}
} elseif ($action == 'logout') {
	setcookie('toolpassword', '', -86400 * 365);
	errorpage("退出成功！");
} elseif ($action == 'mysqlclear') {
	ob_implicit_flush();

	define('IN_DISCUZ', TRUE);

	require './config.inc.php';
	require './include/db_'.$database.'.class.php';

	$db = new dbstuff;
	$db->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
	$db->select_db($dbname);

	if(!get_cfg_var('register_globals')) {
		@extract($_GET, EXTR_SKIP);
	}

	$rpp			=	"1000"; //每次处理多少条数据
	$totalrows		=	isset($totalrows) ? $totalrows : 0;
	$convertedrows	=	isset($convertedrows) ? $convertedrows : 0;
	$start			=	isset($start) && $start > 0 ? $start : 0;
	$sqlstart		=	isset($start) && $start > $convertedrows ? $start - $convertedrows : 0;
	$end			=	$start + $rpp - 1;
	$stay			=	isset($stay) ? $stay : 0;
	$converted		=	0;
	$step			=	isset($step) ? $step : 0;
	$info			=	isset($info) ? $info : '';
	$action			=	array(
						'1'=>'冗余回复数据整理',
						'2'=>'冗余附件数据整理',
						'3'=>'冗余会员数据整理',
						'4'=>'冗余板块数据整理',
						'5'=>'冗余短信数据整理',
						'6'=>'主题信息整理',
						'7'=>'完成数据冗余整理'
					);
	$steps			=	count($action);
	$actionnow		=	isset($action[$step]) ? $action[$step] : '结束';
	$maxid			=	isset($maxid) ? $maxid : 0;
	$tableid		=	isset($tableid) ? $tableid : 1;

	htmlheader();
	if($step==0){
	?>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr><td>
	<p class="subtitle">数据库冗余数据整理 <ul>
	<center><div style="margin-top: 4px; border: 1px solid #7AC4EA; width: 80%;float:center;">
	<table width="100%" border="0" cellpadding="6" cellspacing="0">
	<tr class="header"><td colspan="9">数据库冗余数据整理项目详细信息</td></tr>
	<tr align="center" style="background: #FFFFD9;">
	<td>Posts表的整理</td><td>Attachments表的整理</td>
	<td>Members表的整理</td><td>Forums表的整理</td>
	<td>Pms表的整理</td><td>Threads表的整理</td><td>所有表的整理</td></tr><tr align="center">
	<td class="altbg2">[<a href="?action=mysqlclear&step=1&stay=1">单步整理</a>]</td>
	<td class="altbg1">[<a href="?action=mysqlclear&step=2&stay=1">单步整理</a>]</td>
	<td class="altbg2">[<a href="?action=mysqlclear&step=3&stay=1">单步整理</a>]</td>
	<td class="altbg1">[<a href="?action=mysqlclear&step=4&stay=1">单步整理</a>]</td>
	<td class="altbg2">[<a href="?action=mysqlclear&step=5&stay=1">单步整理</a>]</td>
	<td class="altbg2">[<a href="?action=mysqlclear&step=6&stay=1">单步整理</a>]</td>
	<td class="altbg1">[<a href="?action=mysqlclear&step=1&stay=0">全部整理</a>]</td>
	</tr>
	</center></table></div>
	<p><font color="red">注意：
	<br><p style="text-indent: 3em; margin: 0;">对数据库操作可能会出现意外现象的发生及破坏，所以请先备份好数据库再进行上述操作！另外请您选择服务器压力比较小的时候进行一些优化操作。
	<br><p style="text-indent: 3em; margin: 0;">当您使用完毕Discuz! 系统维护工具箱后，请点击锁定工具箱以确保系统的安全！下次使用前只需要在/forumdata目录下删除tool.lock文件即可开始使用。</p></font>
	</td></tr></table>
	<?php
	} elseif ($step=='1'){

		$query = "SELECT pid,tid FROM {$tablepre}posts LIMIT ".$sqlstart.", $rpp";
		$posts=$db->query($query);
			while ($post = $db->fetch_array($posts)){
				$query = $db->query("SELECT tid FROM {$tablepre}threads WHERE tid='".$post['tid']."'");
				if ($db->result($query, 0)) {
					} else {
						$convertedrows ++;
						$db->query("DELETE FROM {$tablepre}posts WHERE pid='".$post['pid']."'");
					}
				$converted = 1;
				$totalrows ++;
		}
			if($converted || $end < $maxid) {
				continue_redirect();
			} else {
				stay_redirect();
			}

	} elseif ($step=='2'){

		$query = "SELECT aid,pid,attachment FROM {$tablepre}attachments LIMIT ".$sqlstart.", $rpp";
		$posts=$db->query($query);
			while ($post = $db->fetch_array($posts)){
				$query = $db->query("SELECT pid FROM {$tablepre}posts WHERE pid='".$post['pid']."'");
				if ($db->result($query, 0)) {
					} else {
						$convertedrows ++;
						$db->query("DELETE FROM {$tablepre}attachments WHERE aid='".$post['aid']."'");
						$attachmentdir = DISCUZ_ROOT.'./attachments/';
						@unlink($attachmentdir.$post['attachment']);
					}
				$converted = 1;
				$totalrows ++;
		}
			if($converted || $end < $maxid) {
				continue_redirect();
			} else {
				stay_redirect();
			}

	} elseif ($step=='3'){

		$query = "SELECT uid FROM {$tablepre}memberfields LIMIT ".$sqlstart.", $rpp";
		$posts=$db->query($query);
			while ($post = $db->fetch_array($posts)){
				$query = $db->query("SELECT uid FROM {$tablepre}members WHERE uid='".$post['uid']."'");
				if ($db->result($query, 0)) {
					} else {
						$convertedrows ++;
						$db->query("DELETE FROM {$tablepre}memberfields WHERE uid='".$post['uid']."'");
					}
				$converted = 1;
				$totalrows ++;
		}
			if($converted || $end < $maxid) {
				continue_redirect();
			} else {
				stay_redirect();
			}

	} elseif ($step=='4'){

		$query = "SELECT fid FROM {$tablepre}forumfields LIMIT ".$sqlstart.", $rpp";
		$posts=$db->query($query);
			while ($post = $db->fetch_array($posts)){
				$query = $db->query("SELECT fid FROM {$tablepre}forums WHERE fid='".$post['fid']."'");
				if ($db->result($query, 0)) {
					} else {
						$convertedrows ++;
						$db->query("DELETE FROM {$tablepre}forumfields WHERE fid='".$post['fid']."'");
					}
				$converted = 1;
				$totalrows ++;
		}
			if($converted || $end < $maxid) {
				continue_redirect();
			} else {
				stay_redirect();
			}

	} elseif ($step=='5'){

		$query = "SELECT msgfromid,msgtoid FROM {$tablepre}pms LIMIT ".$sqlstart.", $rpp";
		$posts=$db->query($query);
			while ($post = $db->fetch_array($posts)){
				$query = $db->query("SELECT uid FROM {$tablepre}members WHERE uid='".$post['msgtoid']."'");
				if ($db->result($query, 0)) {
					} else {
						$convertedrows ++;
						$db->query("DELETE FROM {$tablepre}pms WHERE msgtoid='".$post['msgtoid']."'");
					}
				$converted = 1;
				$totalrows ++;
		}
			if($converted || $end < $maxid) {
				continue_redirect();
			} else {
				stay_redirect();
			}

	} elseif ($step=='6'){

		$query = "SELECT tid FROM {$tablepre}threads LIMIT ".$sqlstart.", $rpp";
		$posts=$db->query($query);
			while ($threads = $db->fetch_array($posts)){
				$query = $db->query("SELECT COUNT(*) FROM {$tablepre}posts WHERE tid='".$threads['tid']."' AND invisible='0'");
				$replynum = $db->result($query, 0) - 1;
				if ($replynum < 0) {
					$db->query("DELETE FROM {$tablepre}threads WHERE tid='".$threads['tid']."'");
				} else {
					$query = $db->query("SELECT a.aid FROM {$tablepre}posts p, {$tablepre}attachments a WHERE a.tid='".$threads['tid']."' AND a.pid=p.pid AND p.invisible='0' LIMIT 1");
					$attachment = $db->num_rows($query) ? 1 : 0;//修复附件
					$query  = $db->query("SELECT pid, subject, rate FROM {$tablepre}posts WHERE tid='".$threads['tid']."' AND invisible='0' ORDER BY dateline LIMIT 1");
					$firstpost = $db->fetch_array($query);
					$firstpost['subject'] = addslashes($firstpost['subject']);
					@$firstpost['rate'] = $firstpost['rate'] / abs($firstpost['rate']);//修复发帖
					$query  = $db->query("SELECT author, dateline FROM {$tablepre}posts WHERE tid='".$threads['tid']."' AND invisible='0' ORDER BY dateline DESC LIMIT 1");
					$lastpost = $db->fetch_array($query);//修复最后发帖
					$db->query("UPDATE {$tablepre}threads SET subject='".$firstpost['subject']."', replies='$replynum', lastpost='".$lastpost['dateline']."', lastposter='".addslashes($lastpost['author'])."', rate='".$firstpost['rate']."', attachment='$attachment' WHERE tid='".$threads['tid']."'", 'UNBUFFERED');
					$db->query("UPDATE {$tablepre}posts SET first='1', subject='".$firstpost['subject']."' WHERE pid='".$firstpost['pid']."'", 'UNBUFFERED');
					$db->query("UPDATE {$tablepre}posts SET first='0' WHERE tid='".$threads['tid']."' AND pid<>'".$firstpost['pid']."'", 'UNBUFFERED');
				}
				$converted = 1;
				$totalrows ++;
			}
			if($converted || $end < $maxid) {
				continue_redirect();
			} else {
				stay_redirect();
			}

	} elseif ($step=='7'){

		echo '<div style="margin-top: 4px; border: 1px solid #7AC4EA; width: 80%;float:center;">
	<table width="100%" border="0" cellpadding="6" cellspacing="0">
	<tr class="header"><td colspan="9">完成冗余数据整理</td></tr><tr align="center" class="category">
	<td>所有数据整理操作完毕.<br><br><font color="red">在您不使用本程序的时候,请注意锁定或删除本文件!</font><br></td></tr></table></div>';

	}
	htmlfooter();
} elseif ($action == 'repair_auto') {
	if(@!include("./config.inc.php")) {
		if(@!include("./config.php")) {
			exit("请先上传config文件以保证您的数据库能正常链接！");
		}
	}
	mysql_connect($dbhost, $dbuser, $dbpw);
	mysql_select_db($dbname);
	@set_time_limit(0);
	$querysql = array(
		'activityapplies' => 'applyid',
		'adminnotes' => 'id',
		'advertisements' => 'advid',
		'announcements' => 'id',
		'attachments' => 'aid',
		'attachtypes' => 'id',
		'banned' => 'id',
		'bbcodes' => 'id',
		'crons' => 'cronid',
		'faqs' => 'id',
		'forumlinks' => 'id',
		'forums' => 'fid',
		'itempool' => 'id',
		'magicmarket' => 'mid',
		'magics' => 'magicid',
		'medals' => 'medalid',
		'members' => 'uid',
		'pluginhooks' => 'pluginhookid',
		'plugins' => 'pluginid',
		'pluginvars' => 'pluginvarid',
		'pms' => 'pmid',
		'pmsearchindex' => 'searchid',
		'polloptions' => 'polloptionid',
		'posts' => 'pid',
		'profilefields' => 'fieldid',
		'projects' => 'id',
		'ranks' => 'rankid',
		'searchindex' => 'searchid',
		'smilies' => 'id',
		'styles' => 'styleid',
		'stylevars' => 'stylevarid',
		'templates' => 'templateid',
		'threads' => 'tid',
		'threadtypes' => 'typeid',
		'tradecomments' => 'id',
		'typeoptions' => 'optionid',
		'words' => 'id'
	);

	htmlheader();
	echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr><td>
		<p class="subtitle">Discuz! 自增长字段修复 <ul>
		<center><p class="subtitle">检查结果
		<div style="margin-top: 4px; border: 1px solid #7AC4EA; width: 80%;">
		<table width="100%" cellpadding="6" cellspacing="0" border="0">
		<tr align="center" class="header"><td width="25%">数据表名</td><td width="25%">字段名</td><td width="25%">是否正常</td><td width="25%">自增长状态</td></tr>';
	foreach($querysql as $key => $keyfield) {
		echo '<tr align="center"><td width="25%"  class="altbg2" align="left">'.$tablepre.$key.'</td><td width="25%" class="altbg1">'.$keyfield.'</td>';
		if($query = @mysql_query("Describe $tablepre$key $keyfield")) {
			$istableexist = '存在';
			$field = @mysql_fetch_array($query);
			if(empty($field[5]) &&  $field[0] == $keyfield) {
				mysql_query("ALTER TABLE $tablepre$key CHANGE $keyfield $keyfield $field[1] NOT NULL AUTO_INCREMENT");
				$tablestate = '<font color="red">已经修复</font>';
			} else {
				$tablestate = '正常';
			}
		} else {
			$istableexist = '不存在';
			$tablestate = '----';
		}
		echo '<td width="25%" class="altbg2">'.$istableexist.'</td><td width="25%" class="altbg1">'.$tablestate.'</td></tr>';
	}
	echo '</table>
		</div><br></center>

		<br><br>
		<p><font color="red">注意：
		<br><p style="text-indent: 3em; margin: 0;">对数据库操作可能会出现意外现象的发生及破坏，所以请先备份好数据库再进行上述操作！另外请您选择服务器压力比较小的时候进行一些优化操作。
		<br><p style="text-indent: 3em; margin: 0;">当您使用完毕Discuz! 系统维护工具箱后，请点击锁定工具箱以确保系统的安全！下次使用前只需要在/forumdata目录下删除tool.lock文件即可开始使用。</p></font>
		</td></tr></table>';
	htmlfooter();
} elseif ($action == 'restore') {
	ob_implicit_flush();

	define('IN_DISCUZ', TRUE);

	if(@(!include("./config.inc.php")) || @(!include('./include/db_'.$database.'.class.php'))) {
		if(@(!include("./config.php")) || @(!include('./include/db_'.$database.'.class.php'))) {
			exit("请先上传所有新版本的程序文件后再运行本升级程序！");
		}
	}

	$db = new dbstuff;
	$db->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
	$db->select_db($dbname);

	if(!get_cfg_var('register_globals')) {
		@extract($HTTP_GET_VARS);
	}

	$sqldump = '';
	htmlheader();
	?>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr><td>
	<p class="subtitle">数据库恢复实用工具 <ul>

	<?php
	echo "本程序用于恢复用 Discuz! 备份的数据文件,当 Discuz! 出现问题无法运行和恢复数据,<br>".
		"而 phpMyAdmin 又不能恢复大文件时,可尝试使用此工具.<br><br>".
		"注意:<ul>".
		"<li>只能恢复存放在服务器(远程或本地)上的数据文件,如果您的数据不在服务器上,请用 FTP 上传</li>".
		"<li>数据文件必须为 Discuz! 导出格式,并设置相应属性使 PHP 能够读取</li>".
		"<li>请尽量选择服务器空闲时段操作,以避免超时.如程序长久(超过 10 分钟)不反应,请刷新</b></li></ul>";

	if($file) {
		if(strtolower(substr($file, 0, 7)) == "http://") {
			echo "从远程数据库恢复数据 - 读取远程数据:<br><br>";
			echo "从远程服务器读取文件 ... ";

			$sqldump = @fread($fp, 99999999);
			@fclose($fp);
			if($sqldump) {
				echo "成功<br><br>";
			} elseif (!$multivol) {
				cexit("失败<br><br><b>无法恢复数据</b>");
			}
		} else {
			echo "从本地恢复数据 - 检查数据文件:<br><br>";
			if(file_exists($file)) {
				echo "数据文件 $file 存在检查 ... 成功<br><br>";
			} elseif (!$multivol) {
				cexit("数据文件 $file 存在检查 ... 失败<br><br><br><b>无法恢复数据</b>");
			}

			if(is_readable($file)) {
				echo "数据文件 $file 可读检查 ... 成功<br><br>";
				@$fp = fopen($file, "r");
				@flock($fp, 3);
				$sqldump = @fread($fp, filesize($file));
				@fclose($fp);
				echo "从本地读取数据 ... 成功<br><br>";
			} elseif (!$multivol) {
				cexit("数据文件 $file 可读检查 ... 失败<br><br><br><b>无法恢复数据</b>");
			}
		}

		if($multivol && !$sqldump) {
			cexit("分卷备份范围检查 ... 成功<br><br><b>恭喜您,数据已经全部成功恢复!安全起见,请务必删除本程序.</b>");
		}

		echo "数据文件 $file 格式检查 ... ";
		@list(,,,$method, $volume) = explode(',', base64_decode(preg_replace("/^# Identify:\s*(\w+).*/s", "\\1", preg_replace("/^(.+)/", "\\1", substr($sqldump, 0, 256)))));
		if($method == 'multivol' && is_numeric($volume)) {
			echo "成功<br><br>";
		} else {
			cexit("失败<br><br><b>数据非 Discuz! 分卷备份格式,无法恢复</b>");
		}

		if($onlysave == "yes") {
			echo "将数据文件保存到本地服务器 ... ";
			$filename = DISCUZ_ROOT.'./forumdata'.strrchr($file, "/");
			@$filehandle = fopen($filename, "w");
			@flock($filehandle, 3);
			if(@fwrite($filehandle, $sqldump)) {
				@fclose($filehandle);
				echo "成功<br><br>";
			} else {
				@fclose($filehandle);
				die("失败<br><br><b>无法保存数据</b>");
			}
			echo "成功<br><br><b>恭喜您,数据已经成功保存到本地服务器 <a href=\"".strstr($filename, "/")."\">$filename</a>.安全起见,请务必删除本程序.</b>";
		} else {
			$sqlquery = splitsql($sqldump);
			echo "拆分操作语句 ... 成功<br><br>";
			unset($sqldump);

			echo "正在恢复数据,请等待 ... <br><br>";
			foreach($sqlquery as $sql) {
				if(trim($sql)) {
					$db->query($sql);
					//echo "$sql<br>";
				}
			}
		if($auto == 'off'){
			$nextfile = str_replace("-$volume.sql", '-'.($volume + 1).'.sql', $file);
			cexit("数据文件 <b>$volume#</b> 恢复成功,如果有需要请继续恢复其他卷数据文件<br>请点击<b><a href=\"?action=restore&file=$nextfile&multivol=yes\">全部恢复</a></b>	或许单独恢复下一个数据文件<b><a href=\"?action=restore&file=$nextfile&multivol=yes&auto=off\">单独恢复下一数据文件</a></b>");
		} else {
			$nextfile = str_replace("-$volume.sql", '-'.($volume + 1).'.sql', $file);
			echo "数据文件 <b>$volume#</b> 恢复成功,现在将自动导入其他分卷备份数据.<br><b>请勿关闭浏览器或中断本程序运行</b>";
			redirect("?action=restore&file=$nextfile&multivol=yes");
		}
		}
	} else {
			$exportlog = array();
			if(is_dir(DISCUZ_ROOT.'./forumdata')) {
				$dir = dir(DISCUZ_ROOT.'./forumdata');
				while($entry = $dir->read()) {
					$entry = "./forumdata/$entry";
					if(is_file($entry) && preg_match("/\.sql/i", $entry)) {
						$filesize = filesize($entry);
						$fp = fopen($entry, 'rb');
						$identify = explode(',', base64_decode(preg_replace("/^# Identify:\s*(\w+).*/s", "\\1", fgets($fp, 256))));
						fclose ($fp);
							if(preg_match("/\-1.sql/i", $entry) || $identify[3] == 'shell'){
								$exportlog[$identify[0]] = array(	'version' => $identify[1],
													'type' => $identify[2],
													'method' => $identify[3],
													'volume' => $identify[4],
													'filename' => $entry,
													'size' => $filesize);
							}
					} elseif (is_dir($entry) && preg_match("/backup\_/i", $entry)) {
						$bakdir = dir($entry);
							while($bakentry = $bakdir->read()) {
								$bakentry = "$entry/$bakentry";
								if(is_file($bakentry)){
									$fp = fopen($bakentry, 'rb');
									$bakidentify = explode(',', base64_decode(preg_replace("/^# Identify:\s*(\w+).*/s", "\\1", fgets($fp, 256))));
									fclose ($fp);
									if(preg_match("/\-1\.sql/i", $bakentry) || $bakidentify[3] == 'shell') {
										$identify['bakentry'] = $bakentry;
									}
								}
							}
							if(preg_match("/backup\_/i", $entry)){
								$exportlog[filemtime($entry)] = array(	'version' => $bakidentify[1],
													'type' => $bakidentify[2],
													'method' => $bakidentify[3],
													'volume' => $bakidentify[4],
													'bakentry' => $identify['bakentry'],
													'filename' => $entry);
							}
					}
				}
				$dir->close();
			} else {
				echo 'error';
			}
			krsort($exportlog);
			reset($exportlog);

			$exportinfo = '<br><center><div style="margin-top: 4px; border-top: 1px solid #7AC4EA; border-right: 1px solid #7AC4EA; border-left: 1px solid #7AC4EA; width: 80%;float:center;"><table width="100%" border="0" cellpadding="6" cellspacing="0">
	<tr class="header"><td colspan="9">多卷数据备份记录详细信息</td></tr>
	<tr align="center" style="background: #FFFFD9;">
	<td>备份项目</td><td>版本</td>
	<td>时间</td><td>类型</td>
	<td>查看</td><td>操作</td></tr>';
			foreach($exportlog as $dateline => $info) {
				$info['dateline'] = is_int($dateline) ? gmdate("Y-m-d H:i", $dateline + 8*3600) : '未知';
					switch($info['type']) {
						case 'full':
							$info['type'] = '全部备份';
							break;
						case 'standard':
							$info['type'] = '标准备份(推荐)';
							break;
						case 'mini':
							$info['type'] = '最小备份';
							break;
						case 'custom':
							$info['type'] = '自定义备份';
							break;
					}
				//$info['size'] = sizecount($info['size']);
				$info['volume'] = $info['method'] == 'multivol' ? $info['volume'] : '';
				$info['method'] = $info['method'] == 'multivol' ? '多卷' : 'shell';
				$info['url'] = str_replace(".sql", '', str_replace("-$info[volume].sql", '', substr(strrchr($info['filename'], "/"), 1)));
				$exportinfo .= "<tr align=\"center\">\n".
					"<td class=\"altbg2\" align=\"left\">".$info['url']."</td>\n".
					"<td class=\"altbg1\">$info[version]</td>\n".
					"<td class=\"altbg2\">$info[dateline]</td>\n".
					"<td class=\"altbg1\">$info[type]</td>\n";
				if($info['bakentry']){
				$exportinfo .= "<td class=\"altbg2\"><a href=\"?action=restore&bakdirname=".$info['url']."\">查看</a></td>\n".
					"<td class=\"altbg1\"><a href=\"?action=restore&file=$info[bakentry]&importsubmit=yes\">[全部导入]</a></td>\n</tr>\n";
				} else {
				$exportinfo .= "<td class=\"altbg2\"><a href=\"?action=restore&filedirname=".$info['url']."\">查看</a></td>\n".
					"<td class=\"altbg1\"><a href=\"?action=restore&file=$info[filename]&importsubmit=yes\">[全部导入]</a></td>\n</tr>\n";
				}
			}
		$exportinfo .= '</center></table></div>';
		echo $exportinfo;
		unset($exportlog);
		unset($exportinfo);
		echo "<br>";
	//以前版本备份用到的备份情况
	if(!empty($filedirname)){
			$exportlog = array();
			if(is_dir(DISCUZ_ROOT.'./forumdata')) {
					$dir = dir(DISCUZ_ROOT.'./forumdata');
					while($entry = $dir->read()) {
						$entry = "./forumdata/$entry";
						if(is_file($entry) && preg_match("/\.sql/i", $entry) && preg_match("/$filedirname/i", $entry)) {
							$filesize = filesize($entry);
							$fp = fopen($entry, 'rb');
							$identify = explode(',', base64_decode(preg_replace("/^# Identify:\s*(\w+).*/s", "\\1", fgets($fp, 256))));
							fclose ($fp);

							$exportlog[$identify[0]] = array(	'version' => $identify[1],
												'type' => $identify[2],
												'method' => $identify[3],
												'volume' => $identify[4],
												'filename' => $entry,
												'size' => $filesize);
						}
					}
					$dir->close();
				} else {
				}
				krsort($exportlog);
				reset($exportlog);

				$exportinfo = '<br><center><div style="margin-top: 4px; border: 1px solid #7AC4EA; width: 80%;float:center;"><table	width="100%" border="0" cellpadding="6" cellspacing="0">
								<tr class="header"><td colspan="9">数据备份记录</td></tr>
								<tr align="center" class="category">
								<td>文件名</td><td>版本</td>
								<td>时间</td><td>类型</td>
								<td>大小</td><td>方式</td>
								<td>卷号</td><td>操作</td></tr>';
				foreach($exportlog as $dateline => $info) {
					$info['dateline'] = is_int($dateline) ? gmdate("Y-m-d H:i", $dateline + 8*3600) : '未知';
						switch($info['type']) {
							case 'full':
								$info['type'] = '全部备份';
								break;
							case 'standard':
								$info['type'] = '标准备份(推荐)';
								break;
							case 'mini':
								$info['type'] = '最小备份';
								break;
							case 'custom':
								$info['type'] = '自定义备份';
								break;
						}
					//$info['size'] = sizecount($info['size']);
					$info['volume'] = $info['method'] == 'multivol' ? $info['volume'] : '';
					$info['method'] = $info['method'] == 'multivol' ? '多卷' : 'shell';
					$exportinfo .= "<tr align=\"center\">\n".
						"<td class=\"altbg2\" align=\"left\"><a href=\"$info[filename]\" name=\"".substr(strrchr($info['filename'], "/"), 1)."\">".substr(strrchr($info['filename'], "/"), 1)."</a></td>\n".
						"<td class=\"altbg1\">$info[version]</td>\n".
						"<td class=\"altbg2\">$info[dateline]</td>\n".
						"<td class=\"altbg1\">$info[type]</td>\n".
						"<td class=\"altbg2\">".get_real_size($info[size])."</td>\n".
						"<td class=\"altbg1\">$info[method]</td>\n".
						"<td class=\"altbg2\">$info[volume]</td>\n".
						"<td class=\"altbg1\"><a href=\"?action=restore&file=$info[filename]&importsubmit=yes&auto=off\">[导入]</a></td>\n</tr>\n";
				}
			$exportinfo .= '</center></table></div>';
			echo $exportinfo;
		}
	// 5.5版本用到的详细备份情况
	if(!empty($bakdirname)){
			$exportlog = array();
			$filedirname = DISCUZ_ROOT.'./forumdata/'.$bakdirname;
			if(is_dir($filedirname)) {
					$dir = dir($filedirname);
					while($entry = $dir->read()) {
						$entry = $filedirname.'/'.$entry;
						if(is_file($entry) && preg_match("/\.sql/i", $entry)) {
							$filesize = filesize($entry);
							$fp = fopen($entry, 'rb');
							$identify = explode(',', base64_decode(preg_replace("/^# Identify:\s*(\w+).*/s", "\\1", fgets($fp, 256))));
							fclose ($fp);

							$exportlog[$identify[0]] = array(	'version' => $identify[1],
												'type' => $identify[2],
												'method' => $identify[3],
												'volume' => $identify[4],
												'filename' => $entry,
												'size' => $filesize);
						}
					}
					$dir->close();
			} else {
				}
			krsort($exportlog);
			reset($exportlog);

			$exportinfo = '<br><center><div style="margin-top: 4px; border-top: 1px solid #7AC4EA; border-right: 1px solid #7AC4EA; border-left: 1px solid #7AC4EA; width: 80%;float:center;"><table width="100%" border="0" cellpadding="6" cellspacing="0">
					<tr class="header"><td colspan="9">数据备份记录</td></tr>
					<tr align="center" style="background: #FFFFD9;">
					<td>文件名</td><td>版本</td>
					<td>时间</td><td>类型</td>
					<td>大小</td><td>方式</td>
					<td>卷号</td><td>操作</td></tr>';
			foreach($exportlog as $dateline => $info) {
				$info['dateline'] = is_int($dateline) ? gmdate("Y-m-d H:i", $dateline + 8*3600) : '未知';
				switch($info['type']) {
					case 'full':
						$info['type'] = '全部备份';
						break;
					case 'standard':
						$info['type'] = '标准备份(推荐)';
						break;
					case 'mini':
						$info['type'] = '最小备份';
						break;
					case 'custom':
						$info['type'] = '自定义备份';
						break;
				}
				//$info['size'] = sizecount($info['size']);
				$info['volume'] = $info['method'] == 'multivol' ? $info['volume'] : '';
				$info['method'] = $info['method'] == 'multivol' ? '多卷' : 'shell';
				$exportinfo .= "<tr align=\"center\">\n".
						"<td class=\"altbg2\" align=\"left\"><a href=\"$info[filename]\" name=\"".substr(strrchr($info['filename'], "/"), 1)."\">".substr(strrchr($info['filename'], "/"), 1)."</a></td>\n".
						"<td class=\"altbg1\">$info[version]</td>\n".
						"<td class=\"altbg2\">$info[dateline]</td>\n".
						"<td class=\"altbg1\">$info[type]</td>\n".
						"<td class=\"altbg2\">".get_real_size($info[size])."</td>\n".
						"<td class=\"altbg1\">$info[method]</td>\n".
						"<td class=\"altbg2\">$info[volume]</td>\n".
						"<td class=\"altbg1\"><a href=\"?action=restore&file=$info[filename]&importsubmit=yes&auto=off\">[导入]</a></td>\n</tr>\n";
			}
			$exportinfo .= '</center></table></div>';
			echo $exportinfo;
		}
		echo "<br>";
		cexit("");
	}
} elseif ($action == 'replace') {
	htmlheader();
	$rpp			=	"500"; //每次处理多少条数据
	$totalrows		=	isset($totalrows) ? $totalrows : 0;
	$convertedrows	=	isset($convertedrows) ? $convertedrows : 0;
	$start			=	isset($start) && $start > 0 ? $start : 0;
	$end			=	$start + $rpp - 1;
	$converted		=	0;
	$maxid			=	isset($maxid) ? $maxid : 0;
	$threads_mod	=	isset($threads_mod) ? $threads_mod : 0;
	$threads_banned =	isset($threads_banned) ? $threads_banned : 0;
	$posts_mod		=	isset($posts_mod) ? $posts_mod : 0;
	ob_implicit_flush();
	define('IN_DISCUZ', TRUE);
	if(@!include("./config.inc.php")) {
		if(@!include("./config.php")) {
			exit("请先上传config文件以保证您的数据库能正常链接！");
		}
	}
	require './include/db_'.$database.'.class.php';
	$db = new dbstuff;
	$db->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
	$db->select_db($dbname);
	if(isset($replacesubmit) || $start > 0) {
		$array_find = $array_replace = $array_findmod = $array_findbanned = array();
		$query = $db->query("SELECT find,replacement from {$tablepre}words");//获得现有规则{BANNED}放回收站 {MOD}放进审核列表
		while($row = $db->fetch_array($query)) {
			$find = $row['find'];
			$replacement = $row['replacement'];
			if($replacement == '{BANNED}') {
				$array_findbanned[] = $find;
			} elseif($replacement == '{MOD}') {
				$array_findmod[] = $find;
			} else {
				$array_find[] = $find;
				$array_replace[] = $replacement;
			}

		}
		function topattern_array($source_array) { //将数组正则化
			$source_array = preg_replace("/\{(\d+)\}/",".{0,\\1}",$source_array);
			foreach($source_array as $key => $value) {
				$source_array[$key] = '/'.$value.'/i';
			}
			return $source_array;
		}
		$array_find = topattern_array($array_find);
		$array_findmod = topattern_array($array_findmod);
		$array_findbanned = topattern_array($array_findbanned);

		//查询posts表准备替换
		$sql = "SELECT pid, tid, first, subject, message from {$tablepre}posts where pid > $start and pid < $end";
		$query = $db->query($sql);
		while($row = $db->fetch_array($query)) {
			$pid = $row['pid'];
			$tid = $row['tid'];
			$subject = $row['subject'];
			$message = $row['message'];
			$first = $row['first'];
			$displayorder = 0;//  -2审核 -1回收站
			if(count($array_findmod) > 0) {
				foreach($array_findmod as $value){
					if(preg_match($value,$subject.$message)){
						$displayorder = '-2';
						break;
					}
				}
			} 
			if(count($array_findbanned) > 0) {
				foreach($array_findbanned as $value){
					if(preg_match($value,$subject.$message)){
						$displayorder = '-1';
						break;
					}
				}
			}
			if($displayorder < 0) {
				if($displayorder == '-2' && $first == 0) {//如成立就移到审核回复
					$posts_mod ++;
					$db->query("UPDATE {$tablepre}posts SET invisible = '$displayorder' WHERE pid = $pid");
				} else {
					if($db->affected_rows($db->query("UPDATE {$tablepre}threads SET displayorder = '$displayorder' WHERE tid = $tid and displayorder >= 0")) > 0) {
						$displayorder == '-2' && $threads_mod ++;
						$displayorder == '-1' && $threads_banned ++;
					}
				}
			}

			$subject = preg_replace($array_find,$array_replace,addslashes($subject));
			$message = preg_replace($array_find,$array_replace,addslashes($message));
			if($subject != addslashes($row['subject']) || $message != addslashes($row['message'])) {
				if($db->query("UPDATE {$tablepre}posts SET subject = '$subject', message = '$message' WHERE pid = $pid")) {
					$convertedrows ++;
				}
			}
			
			$converted = 1;
		}
		if($converted) {
			continue_redirect('replace',"&replacesubmit=1&threads_banned=$threads_banned&threads_mod=$threads_mod&posts_mod=$posts_mod");
		} else {
			echo "	<table width=\"80%\" cellspacing=\"1\" bgcolor=\"#000000\" border=\"0\" align=\"center\">
						<tr class=\"header\">
							<td>批量替换完毕</td>
						</tr>";
			$threads_banned > 0 && print("<tr class=\"altbg1\"><td><br><li><font color=\"red\">".$threads_banned."</font>个主题被放入回收站.</li><center><br></td></tr>");
			$threads_mod > 0 && print("<tr class=\"altbg1\"><td><br><li><font color=\"red\">".$threads_mod."</font>个主题被放入审核列表.</li><br></td></tr>");
			$posts_mod > 0 && print("<tr class=\"altbg1\"><td><br><li><font color=\"red\">".$posts_mod."</font>个回复被放入审核列表.</li><br></td></tr>");
			echo "<tr class=\"altbg1\"><td><br><li>替换了<font color=\"red\">".$convertedrows."</font>个贴子</li><br></td></tr>";
			echo "</table>";
		}
	} else {
		$query = $db->query("select * from {$tablepre}words");
		$i = 1;
		if($db->num_rows($query) < 1) {
			echo "<center><br><br><font color=\"red\">对不起,现在还没有过滤规则,请进入论坛后台设置.</font><br><br></center>";
			htmlfooter();
			exit;
		}
	?>
		<form method="post" action="tools.php?action=replace">
				<div style="margin-top: 4px; border: 1px solid #7AC4EA; width: 60%;float:center;">
				<table width="100%" border="0" cellpadding="6" cellspacing="0" align="center">
					<tr class="header"><td colspan="3">批量替换贴子内容</td></tr>
					<tr align="center" style="background: #FFFFD9;">
						<td align="center" width="30">序号</td>
						<td align="center">不良词语</td>
						<td align="center">替换为</td></tr>
					<?
						while($row = $db->fetch_array($query)) {
					?>
					<tr>
						<td align="center" class="altbg2"><?=$i++?></td>
						<td align="center" class="altbg1"><?=$row['find']?></td>
						<td align="center" class="altbg2"><?=$row['replacement']?></td>
					</tr>
					<?}?>
				</table></div><br><br>
				<center><input type="submit" name=replacesubmit value="开始替换"></center><br>
		</form>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr><td>
	<p><font color="red">注意：
	<br><p style="text-indent: 3em; margin: 0;">本程序会按照论坛现有过滤规则操作所有贴子内容.如需修改请进论坛后台。
	<br><p style="text-indent: 3em; margin: 0;">上表列出了您论坛当前的过滤词语.</p></font>
	</td></tr></table>
	<?
	}
	htmlfooter();
} elseif ($action == 'runquery') {
	define('IN_DISCUZ',TRUE);
	if(@!include("./config.inc.php")) {
		if(@!include("./config.php")) {
			exit("请先上传config文件以保证您的数据库能正常链接！");
		}
	}
	if($admincp['runquery'] != 1) {
		errorpage('使用此功能需要将 config.inc.php 当中的 $admincp[\'runquery\'] 设置修改为 1。');
	} else {
		if(!empty($_POST['sqlsubmit']) && $_POST['queries']) {
			mysql_connect($dbhost, $dbuser, $dbpw);
			mysql_select_db($dbname);
			if(mysql_query(stripslashes($_POST[queries]))) {
				errorpage("数据库升级成功,影响列数 &nbsp;".mysql_affected_rows());
				if(strpos($_POST[queries],'settings')) {
					require_once './include/common.inc.php';
					require_once './include/cache.func.php';
					updatecache('settings');
				}
			} else {
				errorpage("数据库升级失败,mysql错误提示:.<br />".mysql_error().'<br><br><br><a href="javascript:history.go(-1);" >[ 点击这里返回上一页 ]</a>');
			}
		}
		htmlheader();
		echo "<form method=\"post\" action=\"tools.php?action=runquery\">
		<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
		<tr class=\"header\"><td colspan=2>Discuz! 数据库升级 - 请将数据库升级语句粘贴在下面</td></tr>
		<tr class=\"altbg1\">
		<td valign=\"top\">
		<div align=\"center\">
		<br /><select name=\"queryselect\" style=\"width:35%\" onChange=\"queries.value = this.value\">
			<option value = ''>可选择TOOLS内置升级语句</option>
			<option value = \"REPLACE INTO ".$tablepre."settings (variable, value) VALUES ('seccodestatus', '0')\">关闭所有验证码功能</option>
			<option value = \"REPLACE INTO ".$tablepre."settings (variable, value) VALUES ('supe_status', '1')\">关闭论坛中的supersite功能</option>
		</select>
		<br />
		<br /><textarea cols=\"85\" rows=\"10\" name=\"queries\">$queries</textarea><br />
		<br /></div>
		<br /><center><input class=\"button\" type=\"submit\" name=\"sqlsubmit\" value=\"提交\"></center><br>
		</td></tr></table>
		</form>";	
	}
	htmlfooter();
} elseif ($action == 'setadmin') {
	$info = "请输入要设置成管理员的用户名";
	htmlheader();
	?>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr><td>
	<p class="subtitle">Discuz! admin用户密码找回和重置 <ul>

	<?php

	if(!empty($_POST['loginsubmit'])){
		require './config.inc.php';
		mysql_connect($dbhost, $dbuser, $dbpw);
		mysql_select_db($dbname);
		$passwordsql = empty($_POST['password']) ? '' : ', password = \''.md5($_POST['password']).'\'';
		$passwordsql .= empty($_POST['issecques']) ? '' : ', secques = \'\'';
		$passwordinfo = empty($_POST['password']) ? '密码保持不变' : '并将密码修改为'.$_POST['password'].'';
		$query = "UPDATE {$tablepre}members SET adminid='1', groupid='1' $passwordsql WHERE $_POST[loginfield] = '$_POST[username]' limit 1";
			if(mysql_query($query)){
				$mysql_affected_rows = mysql_affected_rows();
				if($mysql_affected_rows == 0){
				$info = '<font color="red">无此用户！请检查用户名是否正确<br><br>或者重新注册，或者</font><a href="?action=setadmin">重新输入</a>';
				} elseif ($mysql_affected_rows > 0){
				$info = "将$_POST[loginfield]为$_POST[username]的用户已经设置成管理员，$passwordinfo";
				}
			} else {
			$info = '<font color="red">失败请检查Mysql设置config.inc.php</font>';
			}
	?>
	<center><p class="subtitle">
	<div style="margin-top: 4px; border: 1px solid #7AC4EA; width: 80%;">
	<form action="?action=setadmin" method="post"><input type="hidden" name="action" value="login" />
		<table width="100%" cellpadding="6" cellspacing="0" border="0">
			<tr align="left" class="header"><td><center>提示信息</center></td></tr>
			<tr align="center"><td><br><?=$info?></td></tr>
		</table>
	</form>
	<?php
	} else {?>
	<center><p class="subtitle"><?=$info?>
	<div style="margin-top: 4px; width: 80%;">
	<form action="?action=setadmin" method="post">
		<table width="100%" cellpadding="6" cellspacing="0" border="0" style="border: 1px solid #7AC4EA;">
			<tr colspan="1" class="header"><td width="30%">信息</td><td width="70%">填写</td></tr>
			<tr align="left"><td class="altbg1" width="30%"><span class="bold">	<input type="radio" name="loginfield" value="username" checked class="radio">用户名<input type="radio" name="loginfield" value="uid" class="radio">UID</span></td><td class="altbg2" width="70%"><input type="text" name="username" size="25" maxlength="40"></td></tr>
			<tr align="left"><td class="altbg1" width="30%"><div style="padding-left: 5px;">请输入密码</div></td><td class="altbg2" width="70%"><input type="text" name="password" size="25"></td></tr>
			<tr align="left"><td class="altbg1" width="30%"><div style="padding-left: 5px;">是否清除安全提问</div></td><td class="altbg2" width="70%"><span class="bold"><input type="radio" name="issecques" value="1" checked class="radio">是<input type="radio" name="issecques" value="" class="radio">否</span></td></tr>
			<th colspan="2" class="altbg1" align="center"><input type="submit" name="loginsubmit" value="提 &nbsp; 交"></th>
		</table>
	</form>
	<?php
	}?>
	</div></center>
	<br><br>
	<p><font color="red">注意：
	<br><p style="text-indent: 3em; margin: 0;">对数据库操作可能会出现意外现象的发生及破坏，所以请先备份好数据库再进行上述操作！另外请您选择服务器压力比较小的时候进行一些优化操作。
	<br><p style="text-indent: 3em; margin: 0;">当您使用完毕Discuz! 系统维护工具箱后，请点击锁定工具箱以确保系统的安全！下次使用前只需要在/forumdata目录下删除tool.lock文件即可开始使用。</p></font>
	</td></tr></table>
	<?php
	htmlfooter();
} elseif ($action == 'setlock') {
	touch($lockfile);
	if(file_exists($lockfile)) {
		echo '<meta http-equiv="refresh" content="3 url=?">';
		errorpage("成功关闭工具箱！<br>强烈建议您在不需要本程序的时候及时进行删除");
	} else {
		errorpage('注意您的目录没有写入权限，我们无法给您提供安全保障，请删除论坛根目录下的tool.php文件！');
	}
} elseif ($action == 'testmail') {
	$msg = '';

	if($_POST['action'] == 'save') {

		if(is_writeable('./mail_config.inc.php')) {

			$_POST['sendmail_silent_new'] = intval($_POST['sendmail_silent_new']);
			$_POST['mailsend_new'] = intval($_POST['mailsend_new']);
			$_POST['maildelimiter_new'] = intval($_POST['maildelimiter_new']);
			$_POST['mailusername_new'] = intval($_POST['mailusername_new']);
			$_POST['mailcfg_new']['server'] = addslashes($_POST['mailcfg_new']['server']);
			$_POST['mailcfg_new']['port'] = intval($_POST['mailcfg_new']['port']);
			$_POST['mailcfg_new']['auth'] = intval($_POST['mailcfg_new']['auth']);
			$_POST['mailcfg_new']['from'] = addslashes($_POST['mailcfg_new']['from']);
			$_POST['mailcfg_new']['auth_username'] = addslashes($_POST['mailcfg_new']['auth_username']);
			$_POST['mailcfg_new']['auth_password'] = addslashes($_POST['mailcfg_new']['auth_password']);

	$savedata = <<<EOF
	<?php

	\$sendmail_silent = $_POST[sendmail_silent_new];
	\$maildelimiter = $_POST[maildelimiter_new];
	\$mailusername = $_POST[mailusername_new];
	\$mailsend = $_POST[mailsend_new];

EOF;

			if($_POST['mailsend_new'] == 2) {

	$savedata .= <<<EOF

	\$mailcfg['server'] = '{$_POST[mailcfg_new][server]}';
	\$mailcfg['port'] = {$_POST[mailcfg_new][port]};
	\$mailcfg['auth'] = {$_POST[mailcfg_new][auth]};
	\$mailcfg['from'] = '{$_POST[mailcfg_new][from]}';
	\$mailcfg['auth_username'] = '{$_POST[mailcfg_new][auth_username]}';
	\$mailcfg['auth_password'] = '{$_POST[mailcfg_new][auth_password]}';

EOF;

			} elseif ($_POST['mailsend_new'] == 3) {

	$savedata .= <<<EOF

	\$mailcfg['server'] = '{$_POST[mailcfg_new][server]}';
	\$mailcfg['port'] = '{$_POST[mailcfg_new][port]}';

EOF;

			}

			setcookie('mail_cfg', base64_encode(serialize($_POST['mailcfg_new'])), time() + 86400);

	$savedata .= <<<EOF

	?>
EOF;

			$fp = fopen('./mail_config.inc.php', 'w');
			fwrite($fp, $savedata);
			fclose($fp);

			$msg = '设置保存完毕！';

			if($_POST['sendtest']) {

				define('IN_DISCUZ', true);

				define('DISCUZ_ROOT', './');
				define('TPLDIR', './templates/default');
				require './include/global.func.php';

				$test_tos = explode(',', $_POST['mailcfg_new']['test_to']);
				$date = date('Y-m-d H:i:s');

				switch($_POST['mailsend_new']) {
					case 1:
						$title = '标准方式发送 Email';
						$message = "通过 PHP 函数及 UNIX sendmail 发送\n\n来自 {$_POST['mailcfg_new']['test_from']}\n\n发送时间 ".$date;
						break;
					case 2:
						$title = '通过 SMTP 服务器(SOCKET)发送 Email';
						$message = "通过 SOCKET 连接 SMTP 服务器发送\n\n来自 {$_POST['mailcfg_new']['test_from']}\n\n发送时间 ".$date;
						break;
					case 3:
						$title = '通过 PHP 函数 SMTP 发送 Email';
						$message = "通过 PHP 函数 SMTP 发送 Email\n\n来自 {$_POST['mailcfg_new']['test_from']}\n\n发送时间 ".$date;
						break;
				}

				$bbname = '邮件单发测试';
				sendmail($test_tos[0], $title.' @ '.$date, "$bbname\n\n\n$message", $_POST['mailcfg_new']['test_from']);
				$bbname = '邮件群发测试';
				sendmail($_POST['mailcfg_new']['test_to'], $title.' @ '.$date, "$bbname\n\n\n$message", $_POST['mailcfg_new']['test_from']);

				$msg = '设置保存完毕！<br>标题为“'.$title.' @ '.$date.'”的测试邮件已经发出！';

			}

		} else {

			$msg = '无法写入邮件配置文件 ./mail_config.inc.php，要使用本工具请设置此文件的可写入权限。';

		}

	}

	define('IN_DISCUZ', TRUE);
	htmlheader();
	
	if(@include("./discuz_version.php")) {
		if(substr(DISCUZ_VERSION, 0, 1) >= 6) {
			echo '<br>本功能已经移动至Disuz!论坛后台管理中的邮件配置';
			htmlfooter();
			exit;
		}
	}

	@include './mail_config.inc.php';
	?>
	<script>
	function $(id) {
		return document.getElementById(id);
	}
	</script>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr><td>
	<p class="subtitle">Discuz! 邮件配置/测试工具<ul>
	<center><p class="subtitle">

	<?

	if($msg) {
		echo '<font color="#FF0000">'.$msg.'</font>';
	}

	?><div style="margin-top: 4px; border: 1px solid #7AC4EA; width: 80%;">
	<table width="100%" cellpadding="6" cellspacing="0" border="0">
	<form method="post">
	<input type="hidden" name="action" value="save"><input type="hidden" name="sendtest" value="0">
	<tr><th colspan="2" class="header">邮件配置/测试工具</th></tr>
	<?

	$saved_mailcfg = empty($_COOKIE['mail_cfg']) ? array(
		'server' => 'smtp.21cn.com',
		'port' => '25',
		'auth' => 1,
		'from' => 'Discuz <username@21cn.com>',
		'auth_username' => 'username@21cn.com',
		'auth_password' => '2678hn',
		'test_from' => 'user <my@mydomain.com>',
		'test_to' => 'user1 <test1@test1.com>, user2 <test2@test2.net>'
	) : unserialize(base64_decode($_COOKIE['mail_cfg']));

	echo '<tr><td width="30%" class="altbg1">屏蔽邮件发送中的全部错误提示</td><td class="altbg2">';
	echo ' <input class="checkbox" type="checkbox" name="sendmail_silent_new" value="1"'.($sendmail_silent ? ' checked' : '').'><br>';
	echo '</tr>';
	echo '<tr><td class="altbg1">邮件头的分隔符</td><td class="altbg2">';
	echo ' <input class="radio" type="radio" name="maildelimiter_new" value="1"'.($maildelimiter ? ' checked' : '').'> 使用 CRLF 作为分隔符<br>';
	echo ' <input class="radio" type="radio" name="maildelimiter_new" value="0"'.(!$maildelimiter ? ' checked' : '').'> 使用 LF 作为分隔符<br>';
	echo '</tr>';
	echo '<tr><td class="altbg1">收件人中包含用户名</td><td class="altbg2">';
	echo ' <input class="checkbox" type="checkbox" name="mailusername_new" value="1"'.($mailusername ? ' checked' : '').'><br>';
	echo '</tr>';

	echo '<tr><td class="altbg1">邮件发送方式</td><td class="altbg2">';
	echo ' <input class="radio" type="radio" name="mailsend_new" value="1"'.($mailsend == 1 ? ' checked' : '').' onclick="$(\'hidden1\').style.display=\'none\';$(\'hidden2\').style.display=\'none\'"> 通过 PHP 函数及 UNIX sendmail 发送(推荐此方式)<br>';
	echo ' <input class="radio" type="radio" name="mailsend_new" value="2"'.($mailsend == 2 ? ' checked' : '').' onclick="$(\'hidden1\').style.display=\'\';$(\'hidden2\').style.display=\'\'"> 通过 SOCKET 连接 SMTP 服务器发送(支持 ESMTP 验证)<br>';
	echo ' <input class="radio" type="radio" name="mailsend_new" value="3"'.($mailsend == 3 ? ' checked' : '').' onclick="$(\'hidden1\').style.display=\'\';$(\'hidden2\').style.display=\'none\'"> 通过 PHP 函数 SMTP 发送 Email(仅 win32 下有效, 不支持 ESMTP)<br>';
	echo '</tr>';

	$mailcfg['server'] = $mailcfg['server'] == '' ? $saved_mailcfg['server'] : $mailcfg['server'];
	$mailcfg['port'] = $mailcfg['port'] == '' ? $saved_mailcfg['port'] : $mailcfg['port'];
	$mailcfg['auth'] = $mailcfg['auth'] == '' ? $saved_mailcfg['auth'] : $mailcfg['auth'];
	$mailcfg['from'] = $mailcfg['from'] == '' ? $saved_mailcfg['from'] : $mailcfg['from'];
	$mailcfg['auth_username'] = $mailcfg['auth_username'] == '' ? $saved_mailcfg['auth_username'] : $mailcfg['auth_username'];
	$mailcfg['auth_password'] = $mailcfg['auth_password'] == '' ? $saved_mailcfg['auth_password'] : $mailcfg['auth_password'];

	echo '<tbody id="hidden1" style="display:'.($mailsend == 1 ? ' none' : '').'">';
	echo '<tr><td class="altbg1">SMTP 服务器</td><td class="altbg2">';
	echo ' <input class="text" type="text" name="mailcfg_new[server]" value="'.$mailcfg['server'].'"><br>';
	echo '</tr>';
	echo '<tr><td class="altbg1">SMTP 端口, 默认不需修改</td><td class="altbg2">';
	echo ' <input class="text" type="text" name="mailcfg_new[port]" value="'.$mailcfg['port'].'"><br>';
	echo '</tr>';
	echo '</tbody>';
	echo '<tbody id="hidden2" style="display:'.($mailsend != 2 ? ' none' : '').'">';
	echo '<tr><td class="altbg1">是否需要 AUTH LOGIN 验证</td><td class="altbg2">';
	echo ' <input class="checkbox" type="checkbox" name="mailcfg_new[auth]" value="1"'.($mailcfg['auth'] ? ' checked' : '').'><br>';
	echo '</tr>';
	echo '<tr><td class="altbg1">发信人地址 (如果需要验证,必须为本服务器地址)</td><td class="altbg2">';
	echo ' <input class="text" type="text" name="mailcfg_new[from]" value="'.$mailcfg['from'].'"><br>';
	echo '</tr>';
	echo '<tr><td class="altbg1">验证用户名</td><td class="altbg2">';
	echo ' <input class="text" type="text" name="mailcfg_new[auth_username]" value="'.$mailcfg['auth_username'].'"><br>';
	echo '</tr>';
	echo '<tr><td class="altbg1">验证密码</td><td class="altbg2">';
	echo ' <input class="text" type="text" name="mailcfg_new[auth_password]" value="'.$mailcfg['auth_password'].'"><br>';
	echo '</tr>';
	echo '</tbody>';

	?>
	<tr><td colspan="2" align="center" class="altbg2">
	<input class="button" type="submit" name="submit" value="保存设置">
	</td></tr>
	<?

	echo '<tr><td class="altbg1">测试发件人</td><td class="altbg2">';
	echo ' <input class="text" type="text" name="mailcfg_new[test_from]" value="'.$saved_mailcfg['test_from'].'" size="30"><br>';
	echo '</tr>';
	echo '<tr><td class="altbg1">测试收件人</td><td class="altbg2">';
	echo ' <input class="text" type="text" name="mailcfg_new[test_to]" value="'.$saved_mailcfg['test_to'].'" size="45"><br>';
	echo '</tr>';

	?>
	<tr><td colspan="2" align="center" class="altbg2">
	<input class="button" type="submit" name="submit" onclick="this.form.sendtest.value = 1" value="保存设置并测试发送">
	</td></tr>
	</form>
	</table></div>
	<?php
	htmlfooter();
} else {
	htmlheader();
	?>

	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr><td class="title">欢迎您使用 Discuz! 系统维护工具箱<?=VERSION?></td></tr>
	<tr><td><br>

	<p class="subtitle">Discuz! 系统维护工具箱功能介绍<ul>
	<p><ul>
	<li>检查或修复Discuz!数据库
	<li>优化整理Discuz!数据库磁盘碎片
	<li>导入Discuz!数据库备份文件至当前服务器
	<li>恢复论坛管理员权限
	<li>数据库冗余数据清理
	<li>测试邮件发送方式
	</ul>
	<p><font color="red">注意：
	<br><p style="text-indent: 3em; margin: 0;">对数据库操作可能会出现意外现象的发生及破坏，所以请先备份好数据库再进行上述操作！另外请您选择服务器压力比较小的时候进行一些优化操作。
	<br><p style="text-indent: 3em; margin: 0;">当您使用完毕Discuz! 系统维护工具箱后，请点击锁定工具箱以确保系统的安全！下次使用前只需要在/forumdata目录下删除tool.lock文件即可开始使用。</p></font>
	</td></tr></table>
	<?
	htmlfooter();}

function cexit($message){
	echo $message;
	echo '<br><br>
			<p><font color="red">注意：
			<br><p style="text-indent: 3em; margin: 0;">对数据库操作可能会出现意外现象的发生及破坏，所以请先备份好数据库再进行上述操作！另外请您选择服务器压力比较小的时候进行一些优化操作。
			<br><p style="text-indent: 3em; margin: 0;">当您使用完毕Discuz! 系统维护工具箱后，请点击锁定工具箱以确保系统的安全！下次使用前只需要在/forumdata目录下删除tool.lock文件即可开始使用。</p></font>
			</td></tr></table>';
	htmlfooter();
	exit();
}

function checktable($table, $loops = 0) {
	global $db, $nohtml, $simple, $counttables, $oktables, $errortables, $rapirtables;

	$result = mysql_query("CHECK TABLE $table");
	if(!$nohtml) {
		echo "<tr bgcolor='#CCCCCC'><td colspan=4 align='center'>检查数据表 Checking table $table</td></tr>";
		echo "<tr><td>Table</td><td>Operation</td><td>Type</td><td>Text</td></tr>";
	} else {
	if(!$simple) {
		echo "\n>>>>>>>>>>>>>Checking Table $table\n";
		echo "---------------------------------<br>\n";
	}
	}
	$error = 0;
	while($r = mysql_fetch_row($result)) {
	if($r[2] == 'error') {
		if($r[3] == "The handler for the table doesn't support check/repair") {
		$r[2] = 'status';
		$r[3] = 'This table does not support check/repair/optimize';
		unset($bgcolor);
		$nooptimize = 1;
		} else {
		$error = 1;
		$bgcolor = 'red';
		unset($nooptimize);
		}
		$view = '错误';
		$errortables += 1;
	} else {
		unset($bgcolor);
		unset($nooptimize);
		$view = '正常';
		if($r[3] == 'OK') {
		$oktables += 1;
		}
	}
	if(!$nohtml) {
		echo "<tr><td>$r[0]</td><td>$r[1]</td><td bgcolor='$bgcolor'>$r[2]</td><td>$r[3] / $view </td></tr>";
	} else {
		if(!$simple) {
		echo "$r[0] | $r[1] | $r[2] | $r[3]<br>\n";
		}
	}
	}

	if($error) {
	if(!$nohtml) {
		echo "<tr><td colspan=4 align='center'>正在修复中 / Repairing table $table</td></tr>";
	} else {
		if(!$simple) {
		echo ">>>>>>>>正在修复中 / Repairing Table $table<br>\n";
		}
	}
	$result2=mysql_query("REPAIR TABLE $table");
	while($r2 = mysql_fetch_row($result2)) {
	if($r2[3] == 'OK') {
		$bgcolor='blue';
		$rapirtables += 1;
	} else {
		unset($bgcolor);
	}
	if(!$nohtml) {
		echo "<tr><td>$r2[0]</td><td>$r2[1]</td><td>$r2[2]</td><td bgcolor='$bgcolor'>$r2[3]</td></tr>";
	} else {
		if(!$simple) {
			echo "$r2[0] | $r2[1] | $r2[2] | $r2[3]<br>\n";
		}
	}
	}
	}
	if(($result2[3]=='OK'||!$error)&&!$nooptimize) {
	if(!$nohtml) {
		echo "<tr><td colspan=4 align='center'>优化数据表 Optimizing table $table</td></tr>";
	} else {
		if(!$simple) {
		echo ">>>>>>>>>>>>>Optimizing Table $table<br>\n";
		}
	}
	$result3=mysql_query("OPTIMIZE TABLE $table");
	$error=0;
	while($r3=mysql_fetch_row($result3)) {
		if($r3[2]=='error') {
		$error=1;
		$bgcolor='red';
		} else {
		unset($bgcolor);
		}
		if(!$nohtml) {
		echo "<tr><td>$r3[0]</td><td>$r3[1]</td><td bgcolor='$bgcolor'>$r3[2]</td><td>$r3[3]</td></tr>";
		} else {
		if(!$simple) {
			echo "$r3[0] | $r3[1] | $r3[2] | $r3[3]<br><br>\n";
		}
		}
	}
	}
	if($error && $loops) {
		checktable($table,($loops-1));
	}
}


function checkfullfiles($currentdir) {
	global $db, $tablepre, $md5files, $cachelist, $templatelist, $lang, $nopass;
	$dir = @opendir(DISCUZ_ROOT.$currentdir);

	while($entry = @readdir($dir)) {
		$file = $currentdir.$entry;
		$file = $currentdir != './' ? preg_replace('/^\.\//', '', $file) : $file;
		$mainsubdir = substr($file, 0, strpos($file, '/'));
		if($entry != '.' && $entry != '..') {
			echo "<script>parent.$('msg').innerHTML = '$lang[filecheck_fullcheck_current] ".addslashes(date('Y-m-d H:i:s')."<br>$lang[filecheck_fullcheck_file] $file")."';</script>\r\n";
			if(is_dir($file)) {
    				checkfullfiles($file.'/');
			} elseif(is_file($file) && !in_array($file, $md5files)) {
				$pass = FALSE;
				if(in_array($file, array('./favicon.ico', './config.inc.php', './mail_config.inc.php', './robots.txt'))) {
					$pass = TRUE;
				}
				if($entry == 'index.htm' && filesize($file) < 5) {
					$pass = TRUE;
				}

				switch($mainsubdir) {
					case 'attachments' :
						if(!preg_match('/\.(php|phtml|php3|php4|jsp|exe|dll|asp|cer|asa|shtml|shtm|aspx|asax|cgi|fcgi|pl)$/i', $entry)) {
							$pass = TRUE;
						}
					break;
					case 'images' :
						if(preg_match('/\.(gif|jpg|jpeg|png|ttf|wav|css)$/i', $entry)) {
							$pass = TRUE;
						}
					case 'customavatars' :
						if(preg_match('/\.(gif|jpg|jpeg|png)$/i', $entry)) {
							$pass = TRUE;
						}
					break;
					case 'mspace' :
						if(preg_match('/\.(gif|jpg|jpeg|png|css|ini)$/i', $entry)) {
							$pass = TRUE;
						}
					break;
					case 'forumdata' :
						$forumdatasubdir = str_replace('forumdata', '', dirname($file));
						if(substr($forumdatasubdir, 0, 8) == '/backup_') {
							if(preg_match('/\.(zip|sql)$/i', $entry)) {
								$pass = TRUE;
							}
						} else {
							switch ($forumdatasubdir) {
								case '' :
									if(in_array($entry, array('dberror.log', 'install.lock'))) {
										$pass = TRUE;
									}
								break;
								case '/templates':
									if(empty($templatelist)) {
										$query = $db->query("SELECT templateid, directory FROM {$tablepre}templates");
										while($template = $db->fetch_array($query)) {
											$templatelist[$template['templateid']] = $template['directory'];
										}
									}
									$tmp = array();
									$entry = preg_replace('/(\d+)\_(\w+)\.tpl\.php/ie', '$tmp = array(\1,"\2");', $entry);
									if(!empty($tmp) && file_exists($templatelist[$tmp[0]].'/'.$tmp[1].'.htm')) {
										$pass = TRUE;
									}

								break;
								case '/logs':
									if(preg_match('/(runwizardlog|\_cplog|\_errorlog|\_banlog|\_illegallog|\_modslog|\_ratelog|\_medalslog)\.php$/i', $entry)) {
										$pass = TRUE;
									}
								break;
								case '/cache':
									if(preg_match('/\.php$/i', $entry)) {
										if(empty($cachelist)) {
											$cachelist = checkcachefiles('forumdata/cache/');
											foreach($cachelist[1] as $nopassfile => $value) {
												$nopass++;
												echo "<script>parent.$('checkresult').innerHTML += '$nopassfile<br>';</script>\r\n";
											}
										}
										$pass = TRUE;
									} elseif(preg_match('/\.(css|log)$/i', $entry)) {
										$pass = TRUE;
									}
								break;
								case '/threadcaches':
									if(preg_match('/\.htm$/i', $entry)) {
										$pass = TRUE;
									}
								break;
							}
						}

					break;
					case 'templates' :
						if(preg_match('/\.(lang\.php|htm)$/i', $entry)) {
							$pass = TRUE;
						}
					break;
					case 'include' :
						if(preg_match('/\.table$/i', $entry)) {
							$pass = TRUE;
						}
					break;
					case 'ipdata' :
						if($entry == 'wry.dat' || preg_match('/\.txt$/i', $entry)) {
							$pass = TRUE;
						}
					break;
					case 'admin' :
						if(preg_match('/\.md5$/i', $entry)) {
							$pass = TRUE;
						}
					break;
				}

				if(!$pass) {
					$nopass++;
					echo "<script>parent.$('checkresult').innerHTML += '$file<br>';</script>\r\n";
				}
			}
			ob_flush();
    			flush();
		}
	}
	return $nopass;
}

function checkdirs($currentdir) {
	global $dirlist;
	$dir = @opendir(DISCUZ_ROOT.$currentdir);

	while($entry = @readdir($dir)) {
		$file = $currentdir.$entry;
		if($entry != '.' && $entry != '..') {
			if(is_dir($file)) {
				$dirlist[] = $file;
				checkdirs($file.'/');
			}
		}
	}
}

function checkcachefiles($currentdir) {
	global $authkey;
	$dir = opendir($currentdir);
	$exts = '/\.php$/i';
	$showlist = $modifylist = $addlist = array();
	while($entry = readdir($dir)) {
		$file = $currentdir.$entry;
		if($entry != '.' && $entry != '..' && preg_match($exts, $entry)) {
			$fp = fopen($file, "rb");
			$cachedata = fread($fp, filesize($file));
			fclose($fp);

			if(preg_match("/^<\?php\n\/\/Discuz! cache file, DO NOT modify me!\n\/\/Created: [\w\s,:]+\n\/\/Identify: (\w{32})\n\n(.+?)\?>$/s", $cachedata, $match)) {
				$showlist[$file] = $md5 = $match[1];
				$cachedata = $match[2];

				if(md5($entry.$cachedata.$authkey) != $md5) {
					$modifylist[$file] = $md5;
				}
			} else {
				$showlist[$file] = $addlist[$file] = '';
			}
		}

	}

	return array($showlist, $modifylist, $addlist);
}

function continue_redirect($action = 'mysqlclear', $extra = '') {
	global $scriptname, $step, $actionnow, $start, $end, $stay, $convertedrows, $totalrows, $maxid;
	$url = "?action=$action&step=".$step."&start=".($end + 1)."&stay=$stay&totalrows=$totalrows&convertedrows=$convertedrows&maxid=$maxid".$extra;
	$timeout = $GLOBALS['debug'] ? 5000 : 2000;
	echo "<script>\r\n";
	echo "<!--\r\n";
	echo "function redirect() {\r\n";
	echo "	window.location.replace('".$url."');\r\n";
	echo "}\r\n";
	echo "setTimeout('redirect();', $timeout);\r\n";
	echo "-->\r\n";
	echo "</script>\r\n";
	echo '<div style="margin-top: 4px; border: 1px solid #7AC4EA; width: 80%;float:center;">
		<table width="100%" border="0" cellpadding="6" cellspacing="0">
		<tr class="header"><td colspan="9">正在进行'.$actionnow.'</td></tr><tr align="center" class="category"><td>';
	echo "正在检查 $start ---- $end 条 <div style=\"float: right;\">[<a href='?action=mysqlclear' style='color:red'>停止运行</a>]</div>";
	echo "<br><br><a href=\"".$url."\">如果您的浏览器长时间没有自动跳转，请点击这里！</a>";
	echo '</td></tr></table></div>';
}

function dirsize($dir) {
	$dh = @opendir($dir);
	$size = 0;
	while($file = @readdir($dh)) {
		if ($file != '.' && $file != '..') {
			$path = $dir.'/'.$file;
			if (@is_dir($path)) {
				$size += dirsize($path);
			} else {
				$size += @filesize($path);
			}
		}
	}
	@closedir($dh);
	return $size;
}

function get_real_size($size) {

	$kb = 1024;
	$mb = 1024 * $kb;
	$gb = 1024 * $mb;
	$tb = 1024 * $gb;

	if($size < $kb) {
		return $size.' Byte';
	} else if($size < $mb) {
		return round($size/$kb,2).' KB';
	} else if($size < $gb) {
		return round($size/$mb,2).' MB';
	} else if($size < $tb) {
		return round($size/$gb,2).' GB';
	} else {
		return round($size/$tb,2).' TB';
	}
}

function htmlheader(){
	echo '<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Discuz! 系统维护工具箱</title>
		<style type="text/css">
		<!--
		body {
			margin: 0px;
			scrollbar-base-color: #F5FBFF;
			scrollbar-arrow-color: #7AC4EA;
			font: 12px Tahoma, Verdana;
			background-color: #FFFFFF;
			color: #333333;
		}
		td {
			font: 12px Tahoma, Verdana;
		}
		a {
			text-decoration: none;
			color: #154BA0;
		}
		a:hover {
			text-decoration: underline;
		}
		.header {
			font: 12px Arial, Tahoma !important;
			font-weight: bold !important;
			font: 11px Arial, Tahoma;
			font-weight: bold;
			color: #154BA0;
			background: #C0E4F7;
			height: 30px;
			padding-left: 10px;
		}
		.header td {
			padding-left: 10px;
		}
		.header a {
			color: #154BA0;
		}
		.mainborder {
			clear: both;
			height: 8px;
			font-size: 0px;
			line-height: 0px;
			padding: 0px;
			background-color: #154BA0;
		}
		.headerline {
			font-size: 0px;
			line-height: 0px;
			padding: 0px;
			background: #F5FBFF;
		}
		.footerline div {
			background-color: #FFFFFF;
			position: relative;
			float: right;
			right: 40px;
		}

		.spaceborder {
			width: 100%;
			border: 1px solid #7AC4EA;
			padding: 1px;
			clear: both;
		}
		.maintable{
			width: 95%;
			font: 12px Tahoma, Verdana;
		}
		ul {
			font-size: 12px;
			color: #666666;
			margin-left: 12px;
		}
		li {
			margin-left: 22px;
		}
		pre {
			font-size: 12px;
			font-family: Courier, Courier New;
			font-weight: normal;
			color:#000000;
		}
		.code {
			background: #EFEFEF;
			border: 1px solid #CCCCCC;
		}
		.title {
			font-size: 16px;
			border-bottom: 1px dashed #999999;
			font-weight:bold; color:#333399;
		}
		.subtitle {
			font-size: 14px;
			font-weight: bold;
			color: #000000;
		}
		input, select, textarea {
		font: 12px Tahoma, Verdana;
		color: #333333;
		font-weight: normal;
		background-color: #F5FBFF;
		border: 1px solid #7AC4EA;
		}
		.checkbox, .radio {
		border: 0px;
		background: none;
		vertical-align: middle;
		height: 16px;
		}
		input {
		height: 21px;
		}
		.submitbutton {
		margin-top: 8px !important;
		margin-top: 6px;
		margin-bottom: 5px;
		text-align: left;
		}
		.bold {
		font-weight: bold;
		}
		.altbg1	{
		background: #F5FBFF;
		font: 12px Tahoma, Verdana;
		}
		td.altbg1 {
		border-bottom: 1px solid #BBE9FF;
		}
		.altbg2 {
		background: #FFFFFF;
		font: 12px Tahoma, Verdana;
		}
		td.altbg2 {
		border-bottom: 1px solid #BBE9FF;
		}
		-->
		</style>
		</head>

		<body leftmargin="0" rightmargin="0" topmargin="0">
		<div class="mainborder"></div>
		<div class="headerline" style="height: 6px"></div>
		<center><div class="maintable">
		<br><div class="spaceborder"><table cellspacing="0" cellpadding="4" width="100%" align="center">
		<tr><td class="header" colspan="2">Discuz! 系统维护工具箱</td></tr><tr><td bgcolor="#F8F8F8" align="left">
		[ <b><a href="?" target="_self">工具箱首页</a></b> ]
		[ <b><a href="?action=setlock" target="_self"><font color="red">锁定工具箱</font></a></b> ] &nbsp; &raquo; &nbsp;
		</td><td bgcolor="#F8F8F8" align="center">
		[ <b><a href="?action=repair" target="_self">检查或修复数据库</a></b> ]
		[ <b><a href="?action=restore" target="_self">导入数据库备份</a></b> ]
		[ <b><a href="?action=setadmin" target="_self">重置管理员帐号</a></b> ]
		[ <b><a href="?action=testmail" target="_self">邮件配置测试</a></b> ]
		[ <b><a href="?action=mysqlclear" target="_self">数据库冗余数据清理</a></b> ]
		<br>
		[ <b><a href="?action=filecheck" target="_self">Discuz!未知文件检索</a></b> ]
		[ <b><a href="?action=runquery" target="_self">Mysql升级数据库</a></b> ]
		[ <b><a href="?action=replace" target="_self">贴子内容批量替换</a></b> ]
		[ <b><a href="?action=check" target="_self">系统环境检查</a></b> ]
		[ <b><a href="tools.php?action=repair_auto">字段自增长修复</a></b> ]
		[ <b><a href="?action=logout" target="_self">退出</a></b> ]
		</td></tr></table></div><br><br>';
}

function htmlfooter(){
	echo '
		</div></center><br><br><br><br></td></tr><tr><td colspan="3" style="padding: 1">
		<table cellspacing="0" cellpadding="4" width="100%"><tr bgcolor="#F5FBFF">
		<td align="center" class="smalltxt"><font color="#666666">Discuz! Board 系统维护工具箱 &nbsp;
		版权所有 &copy;2001-2007 <a href="http://www.comsenz.com" style="color: #888888; text-decoration: none">
		康盛创想(北京)科技有限公司 Comsenz Inc</a>.</font></td></tr><tr style="font-size: 0px; line-height: 0px; spacing: 0px; padding: 0px; background-color: #698CC3">
		</table></td></tr></table><div class="mainborder" style="height: 6px"></div>
		</body>
		</html>';
}

function errorpage($message){
	htmlheader();
	if($message == 'login'){
		$message ='请输入Disucz!工具包的登录密码！<div style="margin-top: 4px; width: 80%;">
				<form action="?" method="post">
					<input type="password" name="toolpassword"></input>
					<input type="submit" value="submit"></input>
					<input type="hidden" name="action" value="login">
				</form>
				</div>';
	}
	echo "<br><br><br><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
		<tr><td>
		<center><p class=\"subtitle\"><font color=\"red\">$message</font></center>
		</td></tr></table>";
	htmlfooter();
	exit();
}

function redirect($url) {
	echo "<script>";
	echo "function redirect() {window.location.replace('$url');}\n";
	echo "setTimeout('redirect();', 2000);\n";
	echo "</script>";
	echo "<br><br><a href=\"$url\">如果您的浏览器没有自动跳转，请点击这里</a>";
	cexit("");
}

function splitsql($sql){
	$ret = array();
	$num = 0;
	$queriesarray = explode(";\n", trim($sql));
	unset($sql);
	foreach($queriesarray as $query) {
		$queries = explode("\n", trim($query));
		foreach($queries as $query) {
			$ret[$num] .= $query[0] == "#" ? NULL : $query;
		}
		$num++;
	}
	return($ret);
}

function stay_redirect() {
	global $action, $actionnow, $step, $stay;
	$nextstep = $step + 1;
	echo '<div style="margin-top: 4px; border: 1px solid #7AC4EA; width: 80%;float:center;">
			<table width="100%" border="0" cellpadding="6" cellspacing="0">
			<tr class="header"><td colspan="9">正在进行'.$actionnow.'</td></tr><tr align="center" class="category">
			<td>';
	if($stay) {
		$actions = isset($action[$nextstep]) ? $action[$nextstep] : '结束';
		echo "$actionnow 操作完毕.".($stay == 1 ? "&nbsp;&nbsp;&nbsp;&nbsp;" : '').'<br><br>';
		echo "<a href='?action=mysqlclear&step=".$nextstep."&stay=1'>如果继续下一步操作( $actions )，请点击这里！</a><br>";
	} else {
		if(isset($action[$nextstep])) {
			echo '即将进入：'.$action[$nextstep].'......';
		}
		$timeout = $GLOBALS['debug'] ? 5000 : 2000;
		echo "<script>\r\n";
		echo "<!--\r\n";
		echo "function redirect() {\r\n";
		echo "	window.location.replace('?action=mysqlclear&step=".$nextstep."');\r\n";
		echo "}\r\n";
		echo "setTimeout('redirect();', $timeout);\r\n";
		echo "-->\r\n";
		echo "</script>\r\n";
		echo "<div style=\"float: right;\">[<a href='?action=mysqlclear' style='color:red'>停止运行</a>]</div><br><br><a href=\"".$scriptname."?step=".$nextstep."\">如果您的浏览器长时间没有自动跳转，请点击这里！</a>";
	}

	echo '</td></tr></table></div>';
}
?>