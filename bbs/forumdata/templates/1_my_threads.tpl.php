<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<table cellspacing="0" cellpadding="0" width="100%" summary="我的主题">
<thead>
<tr>
<td style="width: 40%">标题</td>
<td>版块</td>
<td>最后发表</td>
<td>状态</td>
</tr>
</thead>
<tbody>
<? if($threadlist) { if(is_array($threadlist)) { foreach($threadlist as $thread) { ?>		<tr>
		<td><? if($thread['displayorder'] >= 0) { ?><a href="viewthread.php?tid=<?=$thread['tid']?>" target="_blank"><?=$thread['subject']?></a><? } else { ?><?=$thread['subject']?><? } ?></td>
		<td><a href="forumdisplay.php?fid=<?=$thread['fid']?>" target="_blank"><?=$thread['forumname']?></a></td>
		<td>
			<cite>
				<a href="redirect.php?tid=<?=$thread['tid']?>&amp;goto=lastpost#lastpost"><?=$thread['lastpost']?></a>
				<br />by 
				<? if($thread['lastposter']) { ?>
					<a href="space.php?username=<?=$thread['lastposterenc']?>" target="_blank"><?=$thread['lastposter']?></a>
				<? } else { ?>
					匿名
				<? } ?>
			</cite>
		</td>
		<td><? if($thread['displayorder'] == '-1') { ?>回收站<? } elseif($thread['displayorder'] == '-2') { ?>待审核<? } elseif($thread['closed'] == '1') { ?>关闭<? } else { ?>正常<? } ?></td>
		</tr>
	<? } } } else { ?>
	<tr><td colspan="4">本版块或指定的范围内尚无主题。</td></tr>
<? } ?>
</tbody>
</table>