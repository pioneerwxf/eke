<?php

/*
	[Discuz!] (C)2001-2007 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: index.php 9806 2007-08-15 06:04:37Z cnteacher $
*/

define('CURSCRIPT', 'wap');
require_once '../include/common.inc.php';

if(preg_match('/(mozilla|m3gate|winwap|openwave)/i', $_SERVER['HTTP_USER_AGENT'])) {
	dheader("Location: {$boardurl}index.php");
}

require_once './include/global.func.php';
require_once DISCUZ_ROOT.'./include/forum.func.php';
@include_once(DISCUZ_ROOT.'./forumdata/cache/cache_forums.php');

$discuz_action = 191;

if($charset != 'utf-8') {
	require_once '../include/chinese.class.php';
}

$action = isset($action) ? $action : 'home';
if($action == 'goto' && !empty($url)) {
	header("Location: $url");
	exit();
} else {
	wapheader($bbname);
}

include language('wap');

if(!$wapstatus) {
	wapmsg('wap_disabled');
} elseif($bbclosed) {
	wapmsg('board_closed');
}

$chs = '';
if($_POST && $charset != 'utf-8') {
	$chs = new Chinese('UTF-8', $charset);
	foreach($_POST as $key => $value) {
		$$key = $chs->Convert($$key);
	}
	unset($chs);
}

if(in_array($action, array('home', 'login', 'register', 'search', 'stats', 'my', 'myphone', 'goto', 'forum', 'thread', 'post', 'pm'))) {
	require_once './include/'.$action.'.inc.php';
} else {
	wapmsg('undefined_action');
}

wapfooter();

?>
