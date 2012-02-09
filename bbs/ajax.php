<?php

/*
	[Discuz!] (C)2001-2007 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: ajax.php 9804 2007-08-15 05:56:19Z cnteacher $
*/

define('NOROBOT', TRUE);
require_once './include/common.inc.php';

if($action == 'updatesecqaa') {

	require_once DISCUZ_ROOT.'./forumdata/cache/cache_secqaa.php';
	$seccode = random(1, 1) * 1000000 + substr($seccode, -6);
	updatesession();
	showmessage($_DCACHE['secqaa'][substr($seccode, 0, 1)]['question']);

} elseif($action == 'checkseccode') {
	$tmp = $seccode;
	seccodeconvert($tmp);
	if(strtoupper($seccodeverify) != $tmp) {
		showmessage('submit_seccode_invalid');
	}

} elseif($action == 'checksecanswer') {

	require_once DISCUZ_ROOT.'./forumdata/cache/cache_secqaa.php';
	if(!$headercharset) {
		@dheader('Content-Type: text/html; charset='.$charset);
	}
	if(md5($secanswer) != $_DCACHE['secqaa'][$seccode{0}]['answer']) {
		showmessage('submit_secqaa_invalid');
	}

} elseif($action == 'checkusername') {

	$username = trim($username);

	$guestexp = '\xA1\xA1|^Guest|^\xD3\xCE\xBF\xCD|\xB9\x43\xAB\xC8';
	$censorexp = '/^('.str_replace(array('\\*', "\r\n", ' '), array('.*', '|', ''), preg_quote(($censoruser = trim($censoruser)), '/')).')$/i';
	if(preg_match("/^\s*$|^c:\\con\\con$|[%,\*\"\s\t\<\>\&]|$guestexp/is", $username) || ($censoruser && @preg_match($censorexp, $username))) {
		showmessage('profile_username_illegal');
	}

	$query = $db->query("SELECT uid FROM {$tablepre}members WHERE username='$username'");
	$username = dhtmlspecialchars(stripslashes($username));

	if($db->num_rows($query)) {
		showmessage('register_check_found');
	}

} elseif($action == 'checkemail' && !$doublee) {

	$email = trim($email);

	$query = $db->query("SELECT uid FROM {$tablepre}members WHERE email='$email' LIMIT 1");
	if($db->num_rows($query)) {
		showmessage('profile_email_duplicate');
	}

} elseif($action == 'checkuserexists') {

	$username = trim($username);
	$query = $db->query("SELECT uid FROM {$tablepre}members WHERE username='$username'");
	$username = dhtmlspecialchars(stripslashes($username));

	if($db->num_rows($query)) {
		showmessage('<img src="'.IMGDIR.'/check_right.gif" width="13" height="13">');
	} else {
		showmessage('username_nonexistence');
	}

} elseif($action == 'checkinvitecode') {

	$invitecode = trim($invitecode);
	$query = $db->query("SELECT invitecode FROM {$tablepre}invites WHERE invitecode='$invitecode' AND status IN ('1', '3')");

	if(!$db->num_rows($query)) {
		showmessage('invite_invalid');
	}

}

showmessage('succeed');

?>