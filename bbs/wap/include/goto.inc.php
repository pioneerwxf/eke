<?php

/*
	[Discuz!] (C)2001-2007 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: goto.inc.php 9806 2007-08-15 06:04:37Z cnteacher $
*/

if(!defined('IN_DISCUZ')) {
        exit('Access Denied');
}

$discuz_action = 194;

$do = !empty($do) && in_array($do, array('last', 'next')) ? $do : '';

if($do == 'last') {

	if($fid && $tid) {
		$query = $db->query("SELECT lastpost FROM {$tablepre}threads WHERE tid='$tid' AND displayorder>='0'");
		$this_lastpost = $db->result($query, 0);
		$query = $db->query("SELECT tid FROM {$tablepre}threads WHERE fid='$fid' AND displayorder>='0' AND lastpost>'$this_lastpost' ORDER BY lastpost ASC LIMIT 1");
		if($next = $db->fetch_array($query)) {
			$tid = $next['tid'];
			header("Location: index.php?action=thread&tid=$tid");
			exit();
		} else {
			wapmsg('goto_last_nonexistence');
		}
	} else {
		wapmsg('undefined_action', NULL, 'HALTED');
	}

} elseif($do == 'next') {

	if($fid && $tid) {
		$query = $db->query("SELECT lastpost FROM {$tablepre}threads WHERE tid='$tid' AND displayorder>='0'");
		$this_lastpost = $db->result($query, 0);
		$query = $db->query("SELECT tid FROM {$tablepre}threads WHERE fid='$fid' AND displayorder>='0' AND lastpost<'$this_lastpost' ORDER BY lastpost DESC LIMIT 1");
		if($last = $db->fetch_array($query)) {
			$tid = $last['tid'];
			header("Location: index.php?action=thread&tid=$tid");
			exit();
		} else {
			wapmsg('goto_next_nonexistence');
		}
	} else {
		wapmsg('undefined_action', NULL, 'HALTED');
	}

} else {

	echo "<p>$lang[goto]:<br />\n".
		"<input title=\"url\" name=\"url\" type=\"text\" value=\"http://\" /><br />\n".
		"<anchor title=\"$lang[submit]\">$lang[submit]<go href=\"index.php?action=goto&amp;url=$(url:escape)\" /></anchor></p>\n";

}

?>