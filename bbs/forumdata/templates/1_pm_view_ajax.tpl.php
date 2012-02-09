<? if(!defined('IN_DISCUZ')) exit('Access Denied'); include template('header'); ?>
<br />
<?=$pm['message']?>
<div class="postactions" style="margin-top: 12px;">
<? if(!$announcepm) { ?>
	<? if($folder == 'inbox' && $pm['msgfromid']) { ?><a href="pm.php?action=send&amp;pmid=<?=$pmid?>&amp;do=reply" target="_blank">回复</a> -<? } ?>
	 <a href="pm.php?action=send&amp;pmid=<?=$pmid?>&amp;do=forward" target="_blank">转发</a>
	<? if($folder == 'inbox') { ?> - <a href="pm.php?action=markunread&amp;pmid=<?=$pmid?>" id="ajax_markunread_<?=$pmid?>" onclick="ajaxmenu(event, this.id, 1000, 'markunread', 0)">标记未读</a><? } ?>
	 - <a href="pm.php?action=archive&amp;pmid=<?=$pmid?>">下载</a>
	- <a href="pm.php?action=delete&amp;folder=<?=$folder?>&amp;pmid=<?=$pmid?>" id="ajax_delete_<?=$pmid?>" onclick="ajaxmenu(event, this.id, 1000, 'deletepm', 0)">删除</a> -
<? } else { ?>
	<a href="pm.php?action=announcearchive&amp;pmid=<?=$pmid?>">下载</a> -
<? } ?>
<a href="###" onclick="closepm(<?=$pmid?>)">关闭</a></div>

<script type="text/javascript">

folder = '<?=$folder?>';

<? if(empty($pmprompt)) { ?>

function deletepm(obj) {
	var pmid = obj.substr(obj.lastIndexOf('_') + 1);
	$('pmrow_' + pmid).style.display = 'none';
	$('pm_view_' + pmid + '_div').style.display = 'none';
	if(folder == 'inbox') $('pmtotalnum').innerHTML = parseInt($('pmtotalnum').innerHTML) - 1;
}

function markunread(obj) {
	var pmid = obj.substr(obj.lastIndexOf('_') + 1);
	$('pm_view_' + pmid).parentNode.style.fontWeight = 800;//'<b>' + $('pm_view' + pmid).innerHTML + '</b>';
	$('pm_view_' + pmid + '_div').style.display = 'none';
	prepmdiv = '';
	if(folder == 'inbox') $('pm_unread').innerHTML = parseInt($('pm_unread').innerHTML) + 1;
}

function changestatus(obj) {
	if(obj.parentNode.style.fontWeight == 800) {
		obj.parentNode.style.fontWeight = 200;
		if(folder == 'inbox' && obj.href.indexOf('folder=announce') == -1) $('pm_unread').innerHTML = parseInt($('pm_unread').innerHTML) - 1;
	}
}

function closepm(pmid) {
	changedisplay($('pm_view_' + pmid + '_div'), 'none');
	prepmdiv = '';
}

<? } else { ?>

function deletepm(obj) {
	obj = $(obj);
	var pmid = obj.id.substr(obj.id.lastIndexOf('_') + 1);
	changedisplay($('pmrow_' + pmid), 'none');
	$('newpmnum').innerHTML = parseInt($('newpmnum').innerHTML) - 1;
	if(parseInt($('newpmnum').innerHTML) == 0) {
		changedisplay($('pmprompt'), 'none');
	}
}

function markunread(obj) {
	return false;
}

function changestatus(obj) {
	return false;
}

function closepm(pmid) {
	changedisplay($('pm_' + pmid), 'none');
	prepmdiv = '';
}

<? } ?>

</script>
<? include template('footer'); ?>
