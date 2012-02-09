<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<table cellspacing="0" cellpadding="0" width="100%">
<thead>
<tr>
<td>所在主题</td>
<td>版块</td>
<td><? if($type == 'poll') { ?>最后发表<? } else { ?>投票日期<? } ?></td>
<td>状态</td>
</tr>
</thead>
<tbody>
<? if($polllist) { if(is_array($polllist)) { foreach($polllist as $key => $poll) { ?><tr>
		<td><a href="viewthread.php?tid=<?=$poll['tid']?>" target="_blank"><?=$poll['subject']?></a></td>
		<td><a href="forumdisplay.php?fid=<?=$poll['fid']?>" target="_blank"><?=$poll['forumname']?></a></td>
		<td>
			<? if($type == 'poll') { ?>
				<cite>
					<a href="redirect.php?tid=<?=$poll['tid']?>&amp;goto=lastpost#lastpost" target="_blank"><?=$poll['lastpost']?></a><br />by 
					<? if($poll['lastposter']) { ?>
						<a href="space.php?username=<?=$poll['lastposterenc']?>" target="_blank"><?=$poll['lastposter']?></a>
					<? } else { ?>
						匿名
					<? } ?>
				<cite>
			<? } else { ?>
				<cite><?=$poll['dateline']?></cite>
			<? } ?>
		</td>
		<td><? if($poll['displayorder'] == '-1') { ?>回收站<? } elseif($poll['displayorder'] == '-2') { ?>待审核<? } elseif($poll['closed'] == '1') { ?>关闭<? } else { ?>正常<? } ?></td>
		</tr><? } } } else { ?>
	<tr><td colspan="4">本版块或指定的范围内尚无主题。</td></tr>
<? } ?>
</tbody>
</table>