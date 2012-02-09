<?php

/*
	[Discuz!] (C)2001-2007 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: redirect.php 10496 2007-09-03 08:57:02Z monkey $
*/

define('CURSCRIPT', 'viewthread');

require_once './include/common.inc.php';

if($goto == 'findpost') {

	$pid = intval($pid);
	$ptid = intval($ptid);

	$query = $db->query("SELECT p.tid, p.dateline, t.special FROM {$tablepre}posts p LEFT JOIN {$tablepre}threads t USING(tid) WHERE p.pid='$pid'");
	if($post = $db->fetch_array($query)) {
		$sqladd = $post['special'] ? "AND first=0" : '';
		$query = $db->query("SELECT count(*) FROM {$tablepre}posts WHERE tid='$post[tid]' AND dateline<='$post[dateline]' $sqladd");
		$page = ceil($db->result($query, 0) / $ppp);
		if(empty($special)) {
			dheader("Location: viewthread.php?tid=$post[tid]&page=$page#pid$pid");
		} elseif($special == 'trade') {
			dheader("Location: viewthread.php?do=tradeinfo&tid=$post[tid]&pid=$pid");
		}
	} else {
	        $ptid = !empty($ptid) ? intval($ptid) : 0;
		showmessage('post_check', NULL, 'HALTED');
	}
}

$tid = $forum['closed'] < 2 ? $tid : $forum['closed'];

if(isset($fid) && empty($forum)) {
	showmessage('forum_nonexistence', NULL, 'HALTED');
}

@include DISCUZ_ROOT.'./forumdata/cache/cache_viewthread.php';

if($goto == 'lastpost') {

	if($tid) {
		$query = $db->query("SELECT tid, replies, special FROM {$tablepre}threads WHERE tid='$tid' AND displayorder>='0'");
	} else {
		$query = $db->query("SELECT tid, replies, special FROM {$tablepre}threads WHERE fid='$fid' AND displayorder>='0' ORDER BY lastpost DESC LIMIT 1");
	}
	if(!$thread = $db->fetch_array($query)) {
		showmessage('thread_nonexistence');
	}
	$page = ceil(($thread['special'] ? $thread['replies'] : $thread['replies'] + 1) / $ppp);
	$tid = $thread['tid'];

	require_once DISCUZ_ROOT.'./viewthread.php';
	exit();

} elseif($goto == 'newpost') {

	$query = $db->query("SELECT COUNT(*) FROM {$tablepre}posts WHERE tid='$tid' AND dateline<='$lastvisit'");
	$page = max(ceil($db->result($query, 0) / $ppp), 1);

	require_once DISCUZ_ROOT.'./viewthread.php';
	exit();

} elseif($goto == 'nextnewset') {

	if($fid && $tid) {
		$query = $db->query("SELECT lastpost FROM {$tablepre}threads WHERE tid='$tid' AND displayorder>='0'");
		$this_lastpost = $db->result($query, 0);
		$query = $db->query("SELECT tid FROM {$tablepre}threads WHERE fid='$fid' AND displayorder>='0' AND lastpost>'$this_lastpost' ORDER BY lastpost ASC LIMIT 1");
		if($next = $db->fetch_array($query)) {
			$tid = $next['tid'];
			require_once DISCUZ_ROOT.'./viewthread.php';
			exit();
		} else {
			showmessage('redirect_nextnewset_nonexistence');
		}
	} else {
		showmessage('undefined_action', NULL, 'HALTED');
	}

} elseif($goto == 'nextoldset') {

	if($fid && $tid) {
		$query = $db->query("SELECT lastpost FROM {$tablepre}threads WHERE tid='$tid' AND displayorder>='0'");
		$this_lastpost = $db->result($query, 0);
		$query = $db->query("SELECT tid FROM {$tablepre}threads WHERE fid='$fid' AND displayorder>='0' AND lastpost<'$this_lastpost' ORDER BY lastpost DESC LIMIT 1");
		if($last = $db->fetch_array($query)) {
			$tid = $last['tid'];
			require_once DISCUZ_ROOT.'./viewthread.php';
			exit();
		} else {
			showmessage('redirect_nextoldset_nonexistence');
		}
	} else {
		showmessage('undefined_action', NULL, 'HALTED');
	}

} else {
	showmessage('undefined_action', NULL, 'HALTED');
}

?>