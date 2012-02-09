<?php

/*
	[Discuz!] (C)2001-2007 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: attachment.php 10506 2007-09-03 09:56:32Z liuqiang $
*/

define('NOROBOT', TRUE);
require_once './include/common.inc.php';

$discuz_action = 14;

// read local file's function: 1=fread 2=readfile 3=fpassthru 4=fpassthru+multiple
$readmod = 2;

$refererhost = parse_url($_SERVER['HTTP_REFERER']);
$supe_host = $supe['status'] ? parse_url($supe['siteurl']) : '';
if($attachrefcheck && $_SERVER['HTTP_REFERER'] && !($refererhost['host'] == $_SERVER['HTTP_HOST'] || ($supe['status'] && $refererhost['host'] == $supe_host['host']))) {
	//dheader("Location: {$boardurl}images/common/invalidreferer.gif");
	showmessage('attachment_referer_invalid', NULL, 'HALTED');
}

periodscheck('attachbanperiods');
$attachexists = $ispaid = FALSE;
if(!empty($aid)) {
	$query = $db->query("SELECT * FROM {$tablepre}attachments WHERE aid='$aid'");
	if($attach = $db->fetch_array($query)) {
		$query = $db->query("SELECT tid, fid, price, special FROM {$tablepre}threads WHERE tid='$attach[tid]' AND displayorder>='0'");
		$thread = $db->fetch_array($query);
		if($thread['fid']) {
			$query = $db->query("SELECT COUNT(*) FROM {$tablepre}posts WHERE pid='$attach[pid]' AND invisible='0'");
			if($db->result($query, 0)) {
				$attachexists = TRUE;
			}
		}
	}
}

if(!$attachexists) {
	showmessage('attachment_nonexistence');

}

if($allowgetattach && ($attach['readperm'] && $attach['readperm'] > $readaccess) && $adminid <= 0 && !($discuz_uid && $discuz_uid == $attach['uid'])) {
	showmessage('attachment_forum_nopermission', NULL, 'NOPERM');
}

if(!$thread['special'] && $thread['price'] > 0 && (!$discuz_uid || ($discuz_uid && $discuz_uid != $attach['uid'] && $adminid <=0))) {
	$query = $db->query("SELECT uid FROM {$tablepre}paymentlog WHERE uid='$discuz_uid' AND tid='$attach[tid]'");
	if($db->result($query, 0)) {
		$ispaid = TRUE;
	} else {
		showmessage('attachment_payto', 'viewthread.php?tid='.$attach['tid']);
	}
}

if($attach['price'] && (!$discuz_uid || ($discuz_uid != $attach['uid'] && !in_array($adminid, array(1, 2))))) {
	if($adminid != 3 || !$db->result($db->query("SELECT uid FROM {$tablepre}moderators m INNER JOIN {$tablepre}threads t ON t.tid='$attach[tid]' AND t.fid=m.fid WHERE m.uid='$discuz_uid'"), 0)) {
		$payrequired = 0;
		if(!$discuz_uid) {
			$payrequired = 1;
		} else {
			$payrequired = !$db->result($db->query("SELECT uid FROM {$tablepre}attachpaymentlog WHERE uid='$discuz_uid' AND aid='$attach[aid]'"), 0);
		}
		if($payrequired) {
			showmessage('attachement_payto_attach', 'misc.php?action=attachpay&aid='.$attach['aid']);
		}
	}
}

if($attach['isimage'] && empty($nothumb) && $attach['thumb']) {
	if($attach['remote'] && !$ftp['hideurl']) {
		dheader('location:'.$ftp['attachurl'].'/'.$attach['attachment'].'.thumb.jpg');
	}
	dheader('Content-Disposition: inline; filename='.$attach['filename'].'.thumb.jpg');
	dheader('Content-Type: image/pjpeg');
	if(!$attach['remote']) {
		$thumbfilename = $attachdir.'/'.$attach['attachment'].'.thumb.jpg';
		if(is_readable($thumbfilename)) {
			$filesize = filesize($thumbfilename);
			$fp = fopen($thumbfilename, 'rb');
			@flock($fp, 2);
			$attachment = @fread($fp, $filesize);
			@fclose($fp);
			echo $attachment;
			exit;
		}
	} else {
		if(getremotefile($attach['attachment'].'.thumb.jpg')) {
			exit;
		}
	}
}

$filename = $attachdir.'/'.$attach['attachment'];

if(!$attach['remote'] && !(is_readable($filename) && $attachexists)) {
	showmessage('attachment_nonexistence');

}

$query = $db->query("SELECT f.viewperm, f.getattachperm, f.getattachcredits, a.allowgetattach FROM {$tablepre}forumfields f
		LEFT JOIN {$tablepre}access a ON a.uid='$discuz_uid' AND a.fid=f.fid
		WHERE f.fid='$thread[fid]'");
$forum = $db->fetch_array($query);

if(!$ispaid) {
	if(!$forum['allowgetattach']) {
		if(!$forum['getattachperm'] && !$allowgetattach) {
			showmessage('group_nopermission', NULL, 'NOPERM');
		} elseif(($forum['getattachperm'] && !forumperm($forum['getattachperm'])) || ($forum['viewperm'] && !forumperm($forum['viewperm']))) {
			showmessage('attachment_forum_nopermission', NULL, 'NOPERM');
		}
	}
}

if(!($isimage = preg_match("/^image\/.+/", $attach['filetype']))) {
	$getattachcredits = $forum['getattachcredits'] ? unserialize($forum['getattachcredits']) : $creditspolicy['getattach'];
	checklowerlimit($getattachcredits, -1);
}

if(empty($noupdate)) {
	if($delayviewcount == 2 || $delayviewcount == 3) {
		$logfile = './forumdata/cache/cache_attachviews.log';
		if(substr($timestamp, -1) == '0') {
			require_once DISCUZ_ROOT.'./include/misc.func.php';
			updateviews('attachments', 'aid', 'downloads', $logfile);
		}

		if(@$fp = fopen(DISCUZ_ROOT.$logfile, 'a')) {
			fwrite($fp, "$aid\n");
			fclose($fp);
		} elseif($adminid == 1) {
			showmessage('view_log_invalid');
		}
	} else {
		$db->query("UPDATE {$tablepre}attachments SET downloads=downloads+'1' WHERE aid='$aid'", 'UNBUFFERED');
	}
}

if(!$isimage) {
	updatecredits($discuz_uid, $getattachcredits, -1);
}

ob_end_clean();
//dheader('Cache-control: max-age=31536000');
//dheader('Expires: '.gmdate('D, d M Y H:i:s', $timestamp + 31536000).' GMT');

if($attach['remote'] && !$ftp['hideurl']) {
	dheader('location:'.$ftp['attachurl'].'/'.$attach['attachment']);
}
$filesize = filesize($filename);
$attach['filename'] = '"'.(strtolower($charset) == 'utf-8' && strexists($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? urlencode($attach['filename']) : $attach['filename']).'"';

dheader('Date: '.gmdate('D, d M Y H:i:s', $attach['dateline']).' GMT');
dheader('Last-Modified: '.gmdate('D, d M Y H:i:s', $attach['dateline']).' GMT');
dheader('Content-Encoding: none');

if($isimage && !empty($noupdate)) {
	dheader('Content-Disposition: inline; filename='.$attach['filename']);
} else {
	dheader('Content-Disposition: attachment; filename='.$attach['filename']);
}

dheader('Content-Type: '.$attach['filetype']);
dheader('Content-Length: '.$filesize);

$range = 0;
if($readmod == 4) {
	dheader('Accept-Ranges: bytes');
	if(!empty($_SERVER['HTTP_RANGE'])) {
		list($range) = explode('-',(str_replace('bytes=', '', $_SERVER['HTTP_RANGE'])));
		$rangesize = ($filesize - $range) > 0 ?  ($filesize - $range) : 0;
		dheader('Content-Length: '.$rangesize);
		dheader('HTTP/1.1 206 Partial Content');
		dheader('Content-Range: bytes='.$range.'-'.($filesize-1).'/'.($filesize));
	}
}

if(!$attach['remote']) {
	error_reporting(0);
	getlocalfile($filename, $readmod, $range);
} else {
	if(!getremotefile($attach['attachment'])) {
		showmessage('attachment_nonexistence');
	}
}

function getremotefile($file) {
	global $authkey, $ftp, $attachdir;
	@set_time_limit(0);
	if(!@readfile($ftp['attachurl'].'/'.$file)) {
		require_once DISCUZ_ROOT.'./include/ftp.func.php';
		if(!($ftp['connid'] = dftp_connect($ftp['host'], $ftp['username'], authcode($ftp['password'], 'DECODE', md5($authkey)), $ftp['attachdir'], $ftp['port'], $ftp['ssl']))) {
			return FALSE;
		}
		$tmpfile = @tempnam($attachdir, '');
		if(dftp_get($ftp['connid'], $tmpfile, $file, FTP_BINARY)) {
			@readfile($tmpfile);
			@unlink($tmpfile);
		} else {
			@unlink($tmpfile);
			return FALSE;
		}
	}
	return TRUE;
}

function getlocalfile($filename, $readmod = 1, $range = 0) {
	if($readmod == 1 || $readmod == 3 || $readmod == 4) {
		if($fp = @fopen($filename, 'rb')) {
			@fseek($fp, $range);
			if(function_exists('fpassthru') && ($readmod == 3 || $readmod == 4)) {
				@fpassthru($fp);
			} else {
				echo @fread($fp, filesize($filename));
			}
		}
		@fclose($fp);
	} else {
		@readfile($filename);
	}
	@flush(); @ob_flush();
}

?>