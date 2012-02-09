<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div class="msgtabs"<? if($type == 'stats') { ?> style=" display: none;"<? } ?>>

<? if($type == 'question') { ?>
	<strong> 我的问题 &#8212; <? if($filter == '') { ?>全部问题<? } elseif($filter == 'solved') { ?>已解决的问题<? } elseif($filter == 'unsolved') { ?>未解决的问题<? } ?></strong>
<? } elseif($type == 'answer') { ?>
	<strong>我的回答 &#8212; <? if($filter == '') { ?>全部回答<? } elseif($filter == 'adopted') { ?>被采纳的回答<? } elseif($filter == 'unadopted') { ?>未采纳的回答<? } ?></strong>
<? } ?>
</div>


<table cellspacing="0" cellpadding="0" width="100%">
<? if($type != 'stats') { ?>
<thead>
<tr>
<td>悬赏名称</td>
<td>所属版块</td>
<td><? if($type == 'question') { ?>回答者<? } elseif($type == 'answer') { ?>提问者<? } ?></td>
<td>悬赏总额</td>
<? if($type == 'question') { ?>
	<td>实际支付</td>
<? } ?>
<td>悬赏状态</td>
<td>悬赏日期</td>
</tr>
</thead>
<tbody>
<? } if($type == 'stats') { ?>
	<tr><th>提问总数:</th><td><?=$questions['total']?> 次</td></tr>
	<tr><th>问题被解决:</th><td><?=$questions['solved']?> 次</td></tr>
	<tr><th>问题被解决率:</th><td><?=$questions['percent']?>%</td></tr>
	<tr><th>问题付出<? if(!empty($extcredits[$creditstrans]['title'])) { ?>(<?=$extcredits[$creditstrans]['title']?>)<? } ?>:</th><td><?=$questions['totalprice']?> <? if($extcredits[$creditstrans]['unit'] != '') { ?><?=$extcredits[$creditstrans]['unit']?><? } ?></td></tr>
	<tr><th>回答总数:</th><td><?=$answers['total']?> 次</td></tr>
	<tr><th>回答被采纳:</th><td><?=$answers['adopted']?> 次</td></tr>
	<tr><th>回答被采纳率:</th><td><?=$answers['percent']?>%</td></tr>
	<tr><th>回答得分<? if(!empty($extcredits[$creditstrans]['title'])) { ?>(<?=$extcredits[$creditstrans]['title']?>)<? } ?>:</th><td><?=$answers['totalprice']?> <? if($extcredits[$creditstrans]['unit'] != '') { ?><?=$extcredits[$creditstrans]['unit']?><? } ?></td></tr>
<? } elseif($type == 'question') { ?>
	<? if($rewardloglist) { if(is_array($rewardloglist)) { foreach($rewardloglist as $rewardlog) { ?>			<tr>
			<td><a href="viewthread.php?tid=<?=$rewardlog['tid']?>"><?=$rewardlog['subject']?></a></td>
			<td><a href="forumdisplay.php?fid=<?=$rewardlog['fid']?>"><?=$rewardlog['name']?></a></td>
			<td><? if($rewardlog['uid']) { ?><a href="space.php?uid=<?=$rewardlog['uid']?>"><?=$rewardlog['username']?></a><? } else { ?>&nbsp;<? } ?></td>
			<td><?=$extcredits[$creditstrans]['title']?> <?=$rewardlog['price']?><? if($extcredits[$creditstrans]['unit'] != '') { ?> <?=$extcredits[$creditstrans]['unit']?><? } ?></td>
			<td><?=$extcredits[$creditstrans]['title']?> <?=$rewardlog['netamount']?><? if($extcredits[$creditstrans]['unit'] != '') { ?> <?=$extcredits[$creditstrans]['unit']?><? } ?></td>
			<td><? if($rewardlog['answererid'] > 0) { ?>已解决<? } else { ?>未解决<? } ?></td>
			<td class="time"><?=$rewardlog['dateline']?></td>
			</tr>
		<? } } } else { ?>
		<tr><td colspan="7">目前没有悬赏记录。</td></tr>
	<? } } elseif($type == 'answer') { ?>
	<? if($rewardloglist) { if(is_array($rewardloglist)) { foreach($rewardloglist as $rewardlog) { ?>			<tr>
			<td><a href="viewthread.php?tid=<?=$rewardlog['tid']?>"><?=$rewardlog['subject']?></a></td>
			<td><a href="forumdisplay.php?fid=<?=$rewardlog['fid']?>"><?=$rewardlog['name']?></a></td>
			<td><? if($rewardlog['uid']) { ?><a href="space.php?uid=<?=$rewardlog['uid']?>"><?=$rewardlog['username']?></a><? } else { ?>&nbsp;<? } ?></td>
			<td><?=$extcredits[$creditstrans]['title']?> <?=$rewardlog['price']?><? if($extcredits[$creditstrans]['unit'] != '') { ?> <?=$extcredits[$creditstrans]['unit']?><? } ?></td>
			<td><? if($rewardlog['authorid'] > 0) { ?>已采纳<? } else { ?>未采纳<? } ?></td>
			<td class="time"><?=$rewardlog['dateline']?></td>
			</tr>
		<? } } } else { ?>
		<tr><td colspan="7">目前没有悬赏记录。</td></tr>
	<? } } else { ?>
	<td colspan="<? if($type == 'question') { ?>7<? } elseif($type == 'answer') { ?>6<? } elseif($type == 'stats') { ?>2<? } ?>">不存在悬赏记录</td></tr>
<? } ?>
</tbody>
</table>