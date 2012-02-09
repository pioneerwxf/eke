<?php

/*
	[Discuz!] (C)2001-2007 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: threadpay.inc.php 9806 2007-08-15 06:04:37Z cnteacher $
*/

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!isset($extcredits[$creditstrans])) {
	showmessage('credits_transaction_disabled');
}

$query = $db->query("SELECT COUNT(*) AS payers, SUM(netamount) AS income FROM {$tablepre}paymentlog WHERE tid='$tid'");
$payment = $db->fetch_array($query);

$thread['payers'] = $payment['payers'];
$thread['netprice'] = !$maxincperthread || ($maxincperthread && $payment['income'] < $maxincperthread) ? floor($thread['price'] * (1 - $creditstax)) : 0;
$thread['creditstax'] = sprintf('%1.2f', $creditstax * 100).'%';
$thread['endtime'] = $maxchargespan ? gmdate("$dateformat $timeformat", $timestamp + $maxchargespan * 3600 + $timeoffset * 3600) : 0;

$query = $db->query("SELECT * FROM {$tablepre}posts WHERE tid='$tid' AND first='1' LIMIT 1");
$firstpost = $db->fetch_array($query);
$pid = $firstpost['pid'];
$thread['freemessage'] = '';
if(preg_match_all("/\[free\](.+?)\[\/free\]/is", $firstpost['message'], $matches)) {
	foreach($matches[1] AS $match) {
		$thread['freemessage'] .= discuzcode($match, $firstpost['smileyoff'], $firstpost['bbcodeoff'], sprintf('%00b', $firstpost['htmlon']), $forum['allowsmilies'], $forum['allowbbcode'], $forum['allowimgcode'], $forum['allowhtml'], 0).'<br />';
	}
}

?>