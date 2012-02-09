<?php

/*
	[Discuz!] (C)2001-2007 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: supe_daily.inc.php 10115 2007-08-24 00:58:08Z cnteacher $
*/

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if($supe['status'] && $supe['maxupdateusers']) {
	require_once DISCUZ_ROOT.'./include/cache.func.php';
	updatecache(array('supe_updateusers', 'supe_updateitems'));
}

?>