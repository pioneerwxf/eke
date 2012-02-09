<?php

/*
	[Discuz!] (C)2001-2007 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: magic.func.php 9806 2007-08-15 06:04:37Z cnteacher $
*/

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function checkmagicperm($perms, $id) {
	$id = $id ? intval($id) : '';
	if(!strexists("\t".trim($perms)."\t", "\t".trim($id)."\t") && $perms) {
		showmessage('magics_target_nopermission');
	}
}

function getmagic($magicid, $magicnum, $weight, $totalweight, $uid, $maxmagicsweight) {
	global $db, $tablepre;

	if($weight + $totalweight > $maxmagicsweight) {
		showmessage('magics_weight_range_invalid');
	} else {
		$query = $db->query("SELECT magicid FROM {$tablepre}membermagics WHERE magicid='$magicid' AND uid='$uid'");
		if($db->num_rows($query)) {
			$db->query("UPDATE {$tablepre}membermagics SET num=num+'$magicnum' WHERE magicid='$magicid' AND uid='$uid'");
		} else {
			$db->query("INSERT INTO {$tablepre}membermagics (uid, magicid, num) VALUES ('$uid', '$magicid', '$magicnum')");
		}
	}
}

function getmagicweight($uid, $magicarray) {
	global $db, $tablepre;

	$totalweight = 0;
	$query = $db->query("SELECT magicid, num FROM {$tablepre}membermagics WHERE uid='$uid'");
	while($magic = $db->fetch_array($query)) {
		$totalweight += $magicarray[$magic['magicid']]['weight'] * $magic['num'];
	}

	return $totalweight;
}

function getpostinfo($id, $type, $colsarray = '') {
	global $db, $tablepre;

	$sql = $comma = '';
	$type = in_array($type, array('tid', 'pid')) && !empty($type) ? $type : 'tid';
	$cols = '*';

	if(!empty($colsarray) && is_array($colsarray)) {
		$cols = '';
		foreach($colsarray as $val) {
			$cols .= $comma.$val;
			$comma = ', ';
		}
	}

	switch($type) {
		case 'tid': $sql = "SELECT $cols FROM {$tablepre}threads WHERE tid='$id' AND digest>='0' AND displayorder>='0'"; break;
		case 'pid': $sql = "SELECT $cols FROM {$tablepre}posts p, {$tablepre}threads t WHERE pid='$id' AND invisible='0' AND t.tid=p.tid AND digest>=0"; break;
	}

	if($sql) {
		$query = $db->query($sql);
		if(!$post = $db->fetch_array($query)) {
			showmessage('magics_target_nonexistence');
		} else {
			return daddslashes($post, 1);
		}
	}
}

function getuserinfo($username, $colsarray = '') {
	global $db, $tablepre;

	$cols = '*';
	if(!empty($colsarray) && is_array($colsarray)) {
		$cols = '';
		foreach($colsarray as $val) {
			$cols .= $comma.$val;
			$comma = ', ';
		}
	}

	$query = $db->query("SELECT $cols FROM {$tablepre}members WHERE username='$username'");
	if(!$member = $db->fetch_array($query)) {
		showmessage('magics_target_nonexistence');
	} else {
		return daddslashes($member, 1);
	}
}

function givemagic($username, $magicid, $magicnum, $totalnum, $totalprice) {
	global $db, $tablepre, $discuz_uid, $discuz_user, $creditstrans, $magicarray;

	$query = $db->query("SELECT m.uid, m.username, u.maxmagicsweight FROM {$tablepre}members m LEFT JOIN {$tablepre}usergroups u ON u.groupid=m.groupid WHERE m.username='$username'");
	if(!$member = $db->fetch_array($query)) {
		showmessage('magics_target_nonexistence');
	} elseif($member['uid'] == $discuz_uid) {
		showmessage('magics_give_myself');
	}

	$totalweight = getmagicweight($member['uid'], $magicarray);
	$magicweight = $magicarray[$magicid]['weight'] * $magicnum;

	getmagic($magicid, $magicnum, $magicweight, $totalweight, $member['uid'], $member['maxmagicsweight']);

	sendpm($member['uid'], 'magics_receive_subject', 'magics_receive_message');
	updatemagiclog($magicid, '3', $magicnum, $magicarray[$magicid]['price'], '0', '0', $member['uid']);

	if(empty($totalprice)) {
		usemagic($magicid, $totalnum, $magicnum);
		showmessage('magics_give_succeed', 'magic.php?action=user');
	}
}

function magicrand($odds) {
	$odds = $odds > 100 ? 100 : intval($odds);
	$odds = $odds < 0 ? 0 : intval($odds);
	if(rand(1, 100) > 100 - $odds) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function marketmagicnum($magicid, $marketnum, $magicnum) {
	global $db, $tablepre;

	if($magicnum == $marketnum) {
		$db->query("DELETE FROM {$tablepre}magicmarket WHERE mid='$magicid'");
	} else {
		$db->query("UPDATE {$tablepre}magicmarket SET num=num+(-'$magicnum') WHERE mid='$magicid'");
	}
}

function magicthreadmod($tid) {
	global $db, $tablepre;

	$query = $db->query("SELECT * FROM {$tablepre}threadsmod WHERE magicid='0' AND tid='$tid'");
	while($threadmod = $db->fetch_array($query)) {
		if(!$threadmod['magicid'] && in_array($threadmod['action'], array('CLS', 'ECL', 'STK', 'EST', 'HLT', 'EHL'))) {
			showmessage('magics_mod_forbidden');
		}
	}
}


function magicshowsetting($setname, $varname, $value, $type = 'radio', $width = '20%') {
	$check = array();
	$comment = $GLOBALS['lang'][$setname.'_comment'];

	$aligntop = $type == "textarea" ?  "valign=\"top\"" : NULL;
	echo "<tr><th>".(isset($GLOBALS['lang'][$setname]) ? $GLOBALS['lang'][$setname] : $setname).''.($comment ? '<br /><span class="smalltxt">'.$comment.'</span>' : NULL).'</th>'.
		'<th>';

	if($type == 'radio') {
		$value ? $check['true'] = 'checked="checked"' : $check['false'] = 'checked="checked"';
		echo "<input type=\"radio\" name=\"$varname\" value=\"1\" $check[true] /> {$GLOBALS[lang][yes]} &nbsp; &nbsp; \n".
			"<input type=\"radio\" name=\"$varname\" value=\"0\" $check[false] /> {$GLOBALS[lang][no]}\n";
	} elseif($type == 'text') {
		echo "<input type=\"$type\" size=\"30\" name=\"$varname\" value=\"".dhtmlspecialchars($value)."\" />\n";
	} else {
		echo $type;
	}
	echo '</th></tr>';
}

function magicshowtips($tips, $title) {
	echo '<div class="mainbox"><h1>'.$title.'</h1>'.
		'<table summary="" cellspacing="0" cellpadding="0"><tr><td>'.$tips.'</td></tr></table></div>';
}

function magicshowtype($name, $type = '') {
	$name = $GLOBALS['lang'][$name] ? $GLOBALS['lang'][$name] : $name;
	if($type != 'bottom') {
		if(!$type) {
			echo '</table></div><br /><br />';
		}
		if(!$type || $type == 'top') {

?>
<div class="mainbox">
<h1><?=$name?></h1><table summary="" cellspacing="0" cellpadding="0">
<?

		}
	} else {
		echo '</table></div>';
	}
}

function usemagic($magicid, $totalnum, $num = 1) {
	global $db, $tablepre, $discuz_uid;

	if($totalnum == $num) {
		$db->query("DELETE FROM {$tablepre}membermagics WHERE uid='$discuz_uid' AND magicid='$magicid'");
	} else {
		$db->query("UPDATE {$tablepre}membermagics SET num=num+(-'$num') WHERE magicid='$magicid' AND uid='$discuz_uid'");
	}
}

function updatemagicthreadlog($tid, $magicid, $action, $expiration, $extra = 0) {
	global $db, $tablepre, $timestamp, $discuz_uid, $discuz_user;
	$discuz_user = !$extra ? $discuz_user : '';
	$db->query("REPLACE INTO {$tablepre}threadsmod (tid, uid, magicid, username, dateline, expiration, action, status)
		VALUES ('$tid', '$discuz_uid', '$magicid', '$discuz_user', '$timestamp', '$expiration', '$action', '1')", 'UNBUFFERED');
}

function updatemagiclog($magicid, $action, $amount, $price, $targettid = 0, $targetpid = 0, $targetuid = 0) {
	global $db, $tablepre, $timestamp, $discuz_uid, $discuz_user;
	$db->query("INSERT INTO {$tablepre}magiclog (uid, magicid, action, dateline, amount, price, targettid, targetpid, targetuid)
		VALUES ('$discuz_uid', '$magicid', '$action', '$timestamp', '$amount', '$price','$targettid', '$targetpid', '$targetuid')", 'UNBUFFERED');
}

?>