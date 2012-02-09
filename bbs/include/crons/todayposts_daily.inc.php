<?php

/*
	[Discuz!] (C)2001-2007 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: todayposts_daily.inc.php 9806 2007-08-15 06:04:37Z cnteacher $
*/

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$query = $db->query("SELECT sum(todayposts) FROM {$tablepre}forums");
$yesterdayposts = intval($db->result($query, 0));

$query = $db->query("SELECT value FROM {$tablepre}settings WHERE variable='historyposts'");
$historypost = $db->result($query, 0);

$hpostarray = explode("\t", $historypost);
$historyposts = $hpostarray[1] < $yesterdayposts ? "$yesterdayposts\t$yesterdayposts" : "$yesterdayposts\t$hpostarray[1]";

$db->query("REPLACE INTO {$tablepre}settings (variable, value) VALUES ('historyposts', '$historyposts')");
$db->query("UPDATE {$tablepre}forums SET todayposts='0'");

require_once DISCUZ_ROOT.'./include/cache.func.php';
$_DCACHE['settings']['historyposts'] = $historyposts;
updatesettings();

?>