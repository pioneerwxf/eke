<?php

/*
	[Discuz!] (C)2001-2007 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: trade.php 10573 2007-09-07 00:50:02Z monkey $
*/

define('NOROBOT', TRUE);
define('CURSCRIPT', 'trade');

require_once './include/common.inc.php';
require_once DISCUZ_ROOT.'./api/alipayapi.php';

if(!$discuz_uid) {
	showmessage('not_loggedin', NULL, 'NOPERM');
}

$page = max(1, intval($page));

if(!empty($orderid)) {

	include_once language('misc');

	$query = $db->query("SELECT * FROM {$tablepre}tradelog WHERE orderid='$orderid'");
	$tradelog = daddslashes($db->fetch_array($query), 1);
	if(empty($tradelog) || $discuz_uid != $tradelog['sellerid'] && $discuz_uid != $tradelog['buyerid']) {
		showmessage('undefined_action', NULL, 'HALTED');
	}

	$trade_message = '';
	$currentcredit = $creditstrans ? $_DSESSION['extcredits'.$creditstrans] : 0;
	$discountprice = $tradelog['baseprice'] * $tradelog['number'];

	if(!empty($pay) && !$tradelog['offline'] && $tradelog['status'] == 0 && $tradelog['buyerid'] == $discuz_uid) {
		$query = $db->query("SELECT * FROM {$tablepre}trades WHERE tid='$tradelog[tid]' AND pid='$tradelog[pid]'");
		$trade = $db->fetch_array($query);

		if($discuz_uid && $currentcredit < $discountcredit && $tradelog['discount']) {
			showmessage('trade_credits_no_enough');
		}
		$pay = array();
		$pay['commision'] = 0;
		$transport = $tradelog['transport'];
		$transportfee = 0;
		trade_setprice(array('fee' => $fee, 'trade' => $trade, 'transport' => $transport), $price, $pay, $transportfee);
		$payurl = trade_payurl($pay, $trade, $tradelog);
		showmessage('credits_addfunds_succeed', $payurl);
	}

	if(submitcheck('offlinesubmit') && in_array($offlinestatus, trade_offline($tradelog, 0))) {
		if(md5($password) != $_DSESSION['discuz_pw']) {
			showmessage('trade_password_error', 'trade.php?orderid='.$orderid);
		}
		if($offlinestatus == STATUS_SELLER_SEND) {
			$query = $db->query("SELECT amount FROM {$tablepre}trades WHERE tid='$tradelog[tid]' AND pid='$tradelog[pid]'");
			$trade = $db->fetch_array($query);
			if($tradelog['number'] > $trade['amount']) {
				showmessage('trade_lack');
			}
			$user = $tradelog['buyer'];
			$itemsubject = $tradelog['subject'];
			sendpm($tradelog['sellerid'], 'trade_seller_send_subject', 'trade_seller_send_message', '0', 'System Message');
		} elseif($offlinestatus == STATUS_WAIT_BUYER) {
			$user = $tradelog['seller'];
			$itemsubject = $tradelog['subject'];
			sendpm($tradelog['buyerid'], 'trade_buyer_confirm_subject', 'trade_buyer_confirm_message', '0', 'System Message');
		} elseif($offlinestatus == STATUS_TRADE_SUCCESS) {
			$db->query("UPDATE {$tablepre}trades SET lastbuyer='$tradelog[buyer]', lastupdate='$timestamp', totalitems=totalitems+'$tradelog[number]', tradesum=tradesum+'$tradelog[price]' WHERE tid='$tradelog[tid]' AND pid='$tradelog[pid]'", 'UNBUFFERED');
			$itemsubject = $tradelog['subject'];
			sendpm($tradelog['sellerid'], 'trade_success_subject', 'trade_success_message', '0', 'System Message');
			sendpm($tradelog['buyerid'], 'trade_success_subject', 'trade_success_message', '0', 'System Message');
		} elseif($offlinestatus == STATUS_REFUND_CLOSE) {
			$db->query("UPDATE {$tablepre}trades SET amount=amount+'$tradelog[number]' WHERE tid='$tradelog[tid]' AND pid='$tradelog[pid]'", 'UNBUFFERED');
			$itemsubject = $tradelog['subject'];
			sendpm($tradelog['sellerid'], 'trade_fefund_success_subject', 'trade_fefund_success_message', '0', 'System Message');
			sendpm($tradelog['buyerid'], 'trade_fefund_success_subject', 'trade_fefund_success_message', '0', 'System Message');
		}

		$message = trim($message);
		if($message) {
			$message = daddslashes($tradelog['message'], 1)."\t\t\t".$discuz_uid."\t".$discuz_user."\t".$timestamp."\t".nl2br(strip_tags(substr($message, 0, 200)));
		} else {
			$message = daddslashes($tradelog['message'], 1);
		}

		$db->query("UPDATE {$tablepre}tradelog SET status='$offlinestatus', lastupdate='$timestamp', message='$message' WHERE orderid='$orderid'");
		showmessage('trade_orderstatus_updated', 'trade.php?orderid='.$orderid);
	}

	if(submitcheck('tradesubmit')) {

		if($tradelog['status'] == 0) {

			$update = array();
			if($tradelog['sellerid'] == $discuz_uid) {
				$tradelog['baseprice'] = floatval($newprice);
				$tradelog['transportfee'] = intval($newfee);
				$update = array(
					"baseprice='$tradelog[baseprice]'",
					"transportfee='$tradelog[transportfee]'"
				);
			}
			if($tradelog['buyerid'] == $discuz_uid) {

				$tradelog['number'] = intval($newnumber);
				$query = $db->query("SELECT amount FROM {$tablepre}trades WHERE tid='$tradelog[tid]' AND pid='$tradelog[pid]'");
				$trade = $db->fetch_array($query);
				if($tradelog['number'] > $trade['amount']) {
					showmessage('trade_lack');
				}

				$update = array(
					"number='$tradelog[number]'",
					"discount=0",
					"buyername='".dhtmlspecialchars($newbuyername)."'",
					"buyercontact='".dhtmlspecialchars($newbuyercontact)."'",
					"buyerzip='".dhtmlspecialchars($newbuyerzip)."'",
					"buyerphone='".dhtmlspecialchars($newbuyerphone)."'",
					"buyermobile='".dhtmlspecialchars($newbuyermobile)."'"
				);

			}
			if($update) {
				if($tradelog['discount']) {
					$tradelog['baseprice'] = $tradelog['baseprice'] - $tax;
					$price = $tradelog['baseprice'] * $tradelog['number'];
				} else {
					$price = $tradelog['baseprice'] * $tradelog['number'];
				}

				$update[] = "price='".($price + ($tradelog['transport'] == 2 ? $tradelog['transportfee'] : 0))."'";
				$db->query("UPDATE {$tablepre}tradelog SET ".implode(',', $update)." WHERE orderid='$orderid'");
				$query = $db->query("SELECT * FROM {$tablepre}tradelog WHERE orderid='$orderid'");
				$tradelog = $db->fetch_array($query);

			}
		}

	}

	$tradelog['lastupdate'] = gmdate("$dateformat $timeformat", $tradelog['lastupdate'] + $timeoffset * 3600);
	$tradelog['statusview'] = trade_getstatus($tradelog['status']);

	$messagelist = array();
	if($tradelog['offline']) {
		$offlinenext = trade_offline($tradelog);
		$message = explode("\t\t\t", $tradelog['message']);
		foreach($message as $row) {
			$row = explode("\t", $row);
			$row[2] = gmdate("$dateformat $timeformat", $row[2] + $timeoffset * 3600);
			$row[0] && $messagelist[] = $row;
		}
	} else {
		$loginurl = 'https://www.alipay.com/trade/query_trade_detail.htm?trade_no='.$tradelog['tradeno'];
	}

	include template('trade_view');

} else {

	if(empty($pid)) {
		$pid = $db->result($db->query("SELECT pid FROM {$tablepre}posts WHERE tid='$tid' AND first='1' LIMIT 1"), 0);
	}
	$query = $db->query("SELECT closed FROM {$tablepre}threads WHERE tid='$tid'");
	if($db->result($query, 0)) {
		showmessage('trade_closed', 'viewthread.php?tid='.$tid.'&page='.$page);
	}
	$query = $db->query("SELECT * FROM {$tablepre}trades WHERE tid='$tid' AND pid='$pid'");
	$trade = $db->fetch_array($query);
	if(empty($trade)) {
		showmessage('undefined_action', NULL, 'HALTED');
	}
	$fromcode = false;

	if($trade['closed']) {
		showmessage('trade_closed', 'viewthread.php?tid='.$tid.'&page='.$page);
	}

	if($trade['price'] <= 0) {
		showmessage('trade_invalid', 'viewthread.php?tid='.$tid.'&page='.$page);
	}

	if($action != 'trade' && !submitcheck('tradesubmit')) {
		$query = $db->query("SELECT buyername,buyercontact,buyerzip,buyerphone,buyermobile FROM {$tablepre}tradelog WHERE buyerid='$discuz_uid' AND status!=0 AND buyername!='' ORDER BY lastupdate DESC LIMIT 1");
		$lastbuyerinfo = dhtmlspecialchars($db->fetch_array($query));
		$extra = rawurlencode($extra);
		include template('trade');
	} else {

		if($trade['sellerid'] == $discuz_uid) {
			showmessage('trade_by_myself');
		} elseif($number <= 0) {
			showmessage('trade_input_no');
		} elseif(!$fromcode && $number > $trade['amount']) {
			showmessage('trade_lack');
		}

		$pay['number'] = $number;
		$pay['price'] = $trade['price'];
		$price = $pay['price'] * $pay['number'];
		$buyercredits = 0;
		$pay['commision'] = 0;

		$orderid = $pay['orderid'] = gmdate('YmdHis', $timestamp + $_DCACHE['settings']['timeoffset'] * 3600).random(18);
		$transportfee = 0;
		trade_setprice(array('fee' => $fee, 'trade' => $trade, 'transport' => $transport), $price, $pay, $transportfee);

		$buyerid = $discuz_uid ? $discuz_uid : 0;
		$discuz_user = $discuz_user ? $discuz_user : $guestuser;
		$trade = daddslashes($trade, 1);
		$buyermsg = dhtmlspecialchars($buyermsg);
		$buyerzip = dhtmlspecialchars($buyerzip);
		$buyerphone = dhtmlspecialchars($buyerphone);
		$buyermobile = dhtmlspecialchars($buyermobile);
		$buyername = dhtmlspecialchars($buyername);
		$buyercontact = dhtmlspecialchars($buyercontact);

		$offline = !empty($offline) ? 1 : 0;
		$db->query("INSERT INTO {$tablepre}tradelog
			(tid, pid, orderid, subject, price, quality, itemtype, number, tax, locus, sellerid, seller, selleraccount, buyerid, buyer, buyercontact, buyercredits, buyermsg, lastupdate, offline, buyerzip, buyerphone, buyermobile, buyername, transport, transportfee, baseprice, discount) VALUES
			('$trade[tid]', '$trade[pid]', '$orderid', '$trade[subject]', '$price', '$trade[quality]', '$trade[itemtype]', '$number', '$tax',
			 '$trade[locus]', '$trade[sellerid]', '$trade[seller]', '$trade[account]', '$discuz_uid', '$discuz_user', '$buyercontact', 0, '$buyermsg', '$timestamp', '$offline', '$buyerzip', '$buyerphone', '$buyermobile', '$buyername', '$transport', '$transportfee', '$trade[price]', 0)");

		$db->query("UPDATE {$tablepre}trades SET amount=amount-'$number' WHERE tid='$trade[tid]' AND pid='$trade[pid]'", 'UNBUFFERED');
		showmessage('trade_order_created', 'trade.php?orderid='.$orderid);
	}

}

?>