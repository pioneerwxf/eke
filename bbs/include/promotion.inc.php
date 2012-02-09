<?php

/*
	[Discuz!] (C)2001-2007 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: promotion.inc.php 9806 2007-08-15 06:04:37Z cnteacher $
*/

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!empty($fromuid)) {
	$fromuid = intval($fromuid);
	$fromuser = '';
}

if(!$discuz_uid || !($fromuid == $discuz_uid || $fromuser == $discuz_user)) {

	if($creditspolicy['promotion_visit']) {
		$db->query("REPLACE INTO {$tablepre}promotions (ip, uid, username)
			VALUES ('$onlineip', '$fromuid', '$fromuser')");
	}

	if($creditspolicy['promotion_register']) {
		if(!empty($fromuser) && empty($fromuid)) {
			if(empty($_DCOOKIE['promotion'])) {
				$query = $db->query("SELECT uid FROM {$tablepre}members WHERE username='$fromuser'");
				$fromuid = $db->result($query, 0);
			} else {
				$fromuid = intval($_DCOOKIE['promotion']);
			}
		}
		if($fromuid) {
			dsetcookie('promotion', ($_DCOOKIE['promotion'] = $fromuid), 1800);
		}
	}

}

?>