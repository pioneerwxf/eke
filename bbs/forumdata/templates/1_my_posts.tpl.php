<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<table cellspacing="0" cellpadding="0" width="100%" summary="我的回复">
<thead>
<tr>
<td>所在主题</td>
<td>版块</td>
<td>最后发表</td>
<td>状态</td>
</tr>
</thead>
<tbody>
<? if($postlist) { if(is_array($postlist)) { foreach($postlist as $key => $post) { ?><tr>
		<td><a href="redirect.php?goto=findpost&amp;pid=<?=$post['pid']?>&amp;ptid=<?=$post['tid']?>" target="_blank"><?=$post['tsubject']?></a></td>
		<td><a href="forumdisplay.php?fid=<?=$post['fid']?>" target="_blank"><?=$post['forumname']?></a></td>
		<td><cite><a href="redirect.php?tid=<?=$post['tid']?>&amp;goto=lastpost#lastpost"><?=$post['lastpost']?></a><br />by <? if($post['lastposter']) { ?><a href="space.php?username=<?=$post['lastposterenc']?>" target="_blank"><?=$post['lastposter']?></a><? } else { ?>匿名<? } ?></cite></td>
		<td><? if($post['invisible'] == '-1') { ?>回收站<? } elseif($post['invisible'] == '2') { ?>待审核<? } else { ?>正常<? } ?></td>
		</tr><? } } } else { ?>
	<tr><td colspan="4">本版块或指定的范围内尚无主题。</td></tr>
<? } ?>
</tbody>
</table>