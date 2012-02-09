<? if(!defined('IN_DISCUZ')) exit('Access Denied'); if($type == 'forum') { ?>
	<form method="post" action="my.php?item=favorites&amp;type=forum">
	<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
	
	<table cellspacing="0" cellpadding="0" width="100%" summary="收藏的版块">
	<thead class="separation">
	<tr>
	<td align="center" width="48"><input class="checkbox" type="checkbox" name="chkall" onclick="checkall(this.form)" />删?</td>
	<td>版块</td>
	<td>主题</td>
	<td>帖数</td>
	<td>今日</td>
	</tr>
	</thead>
	
	<tbody>
	<? if($favlist) { if(is_array($favlist)) { foreach($favlist as $fav) { ?>			<tr>
			<td><input class="checkbox" type="checkbox" name="delete[]" value="<?=$fav['fid']?>" /></td>
			<td><a href="forumdisplay.php?fid=<?=$fav['fid']?>" target="_blank"><?=$fav['name']?></a></td>
			<td><?=$fav['threads']?></td>
			<td><?=$fav['posts']?></td>
			<td><?=$fav['todayposts']?></td>
			</tr>
		<? } } } else { ?>
		<tr><td colspan="5">目前没有被收藏的主题或版块。</td></tr>
	<? } ?>
	
	</tbody>
	</table>
<? } elseif($type == 'thread') { ?>
	<form method="post" action="my.php?item=favorites&amp;type=thread">
	<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
	<table cellspacing="0" cellpadding="0" width="100%" align="center" summary="收藏的主题">
	<thead class="separation">
	<tr>
	<td align="center" width="48"><input class="checkbox" type="checkbox" name="chkall" onclick="checkall(this.form)">删?</td>
	<td>标题</td>
	<td>版块</td>
	<td>回复</td>
	<td>最后发表</td>
	</tr>
	</thead>

	<tbody>
	<? if($favlist) { if(is_array($favlist)) { foreach($favlist as $fav) { ?>			<tr>
			<td><input class="checkbox" type="checkbox" name="delete[]" value="<?=$fav['tid']?>"></td>
			<td><a href="viewthread.php?tid=<?=$fav['tid']?>" target="_blank"><?=$fav['subject']?></a></td>
			<td><a href="forumdisplay.php?fid=<?=$fav['fid']?>" target="_blank"><?=$fav['name']?></a></td>
			<td><?=$fav['replies']?></td>
			<td><cite><a href="redirect.php?tid=<?=$fav['tid']?>&amp;goto=lastpost#lastpost"><?=$fav['lastpost']?></a> by <? if($fav['lastposter']) { ?><a href="space.php?username=<?=$fav['lastposterenc']?>" target="_blank"><?=$fav['lastposter']?></a><? } else { ?>匿名<? } ?></cite></td>
			</tr>
		<? } } } else { ?>
		<tr><td colspan="5">目前没有被收藏的主题或版块。</td></tr>
	<? } ?>

	</tbody>
	</table>
<? } ?>
<p class="btns"><button type="submit" class="submit" name="favsubmit" value="true">提交</button></p>

</form>