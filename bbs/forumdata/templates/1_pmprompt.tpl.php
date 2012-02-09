<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>

<div class="box" id="pmprompt">
	<? if($pmsound) { ?><bgsound src="images/sound/pm_<?=$pmsound?>.wav" /><? } ?>
	<span class="headactions">
		<a href="pm.php" target="_blank">[查看详情]</a>
		<? if($newpm) { ?><a href="pm.php?action=noprompt" onclick="ajaxget(this.href, 'pmprompt', null, null, 'none');doane(event);">[不再提示]</a><? } ?>
	</span>
	<h4>您有<? if($newpmnum) { ?><span id="newpmnum"><?=$newpmnum?></span> 条新短消息&nbsp;<? } if($announcepm) { ?><?=$announcepm?> 条公共消息<? } ?></h4>
	<table summary="New PM" cellspacing="0" cellpadding="5">

	<? if($pmlist) { if(is_array($pmlist)) { foreach($pmlist as $pm) { ?>		<tbody id="pmrow_<?=$pm['pmid']?>">
			<tr>
				<td width="13%" nowrap valign="top">
					<span class="bold">来自: </span><? if(!empty($pm['announce'])) { ?>公共消息<? } elseif($pm['msgfromid']) { ?><a href="space.php?uid=<?=$pm['msgfromid']?>"><?=$pm['msgfrom']?></a><? } else { ?>系统消息<? } ?>
				</td>
				<td>
					<span class="bold" nowrap>标题:</span>
					<? if(!empty($pm['announce'])) { ?>
						<a href="pm.php?action=view&amp;folder=announce&amp;pmid=<?=$pm['pmid']?>&amp;pmprompt=yes" target="_blank" onclick="ajaxget(this.href, 'pm_<?=$pm['pmid']?>', null, null, '', 'hidelastpm(<?=$pm['pmid']?>)');doane(event);"><?=$pm['subject']?></a>
					<? } else { ?>
						<a href="pm.php?action=view&amp;pmid=<?=$pm['pmid']?>&amp;pmprompt=yes" target="_blank" onclick="ajaxget(this.href, 'pm_<?=$pm['pmid']?>', null, null, '', 'hidelastpm(<?=$pm['pmid']?>)');doane(event);"><?=$pm['subject']?></a>
					<? } ?>
					<div id="pm_<?=$pm['pmid']?>" style="display: none">
						<?=$pm['content']?>
					</div>
				</td>
			</tr>
		</tbody>
	<? } } } ?>

	</table>
</div>

<script type="text/javascript">

lastpmid = null;
function hidelastpm(pmid) {
	if(lastpmid && lastpmid != pmid) {
		changedisplay($('pm_'+lastpmid), 'none');
	}
	lastpmid = pmid;
}

</script>