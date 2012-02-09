<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div class="mainbox viewthread">
	<h1><?=$pm['subject']?></h1>
	<table summary="Read PM" cellspacing="0" cellpadding="0">
		<tr>
			<td class="postcontent">
				<p class="postinfo">
					时间:<?=$pm['dateline']?>,&nbsp;
					来自:<? if(!$announcepm) { if($pm['msgfromid']) { ?><a href="space.php?uid=<?=$pm['msgfromid']?>"><?=$pm['msgfrom']?></a><? } else { ?>系统消息<? } } else { ?>公共消息<? } ?>,&nbsp;
					发送到:<a href="space.php?uid=<?=$pm['msgtoid']?>"><?=$pm['msgto']?></a>
				</p>
				<div class="postmessage"><?=$pm['message']?></div>
				<p class="postactions">
					<a href="###" onclick="history.go(-1);">返回</a>
					<? if(!$announcepm) { ?>
						<? if($folder == 'inbox' && $pm['msgfromid']) { ?>
							 - <a href="pm.php?action=send&amp;pmid=<?=$pmid?>&amp;do=reply">回复</a>
						<? } ?>
						 - <a href="pm.php?action=send&amp;pmid=<?=$pmid?>&amp;do=forward">转发</a>
						<? if($folder == 'inbox') { ?> - <a href="pm.php?action=markunread&amp;pmid=<?=$pmid?>" id="ajax_markunread_<?=$pmid?>" onclick="ajaxmenu(event, this.id)">标记未读</a><? } ?>
						 - <a href="pm.php?action=archive&amp;pmid=<?=$pmid?>">下载</a>
						 - <a href="pm.php?action=delete&amp;folder=<?=$folder?>&amp;pmid=<?=$pmid?>">删除</a>
					<? } else { ?>
						- <a href="pm.php?action=announcearchive&amp;pmid=<?=$pmid?>">下载</a>
					<? } ?>
				</p>
			</td>
		</tr>
	</table>
</div>