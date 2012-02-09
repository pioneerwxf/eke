<? if(!defined('IN_DISCUZ')) exit('Access Denied'); include template('header'); ?>
<div id="nav"><a href="<?=$indexname?>"><?=$bbname?></a> <?=$navigation?> &raquo;
<? if($operation == 'delete') { ?>
	删除主题
<? } elseif($operation == 'move') { ?>
	移动主题
<? } elseif($operation == 'highlight') { ?>
	高亮显示
<? } elseif($operation == 'type') { ?>
	主题分类
<? } elseif($operation == 'close') { ?>
	关闭/打开主题
<? } elseif($operation == 'stick') { ?>
	置顶/解除置顶
<? } elseif($operation == 'digest') { ?>
	加入/解除精华
<? } elseif($operation == 'supe_push') { ?>
	推送/解除推送
<? } elseif($operation == 'removereward') { ?>
	推送/解除推送
<? } elseif($operation == 'bump') { ?>
	提升/下沉主题
<? } elseif($operation == 'recommend') { ?>
	推荐主题
<? } ?>
</div>

<form method="post" action="topicadmin.php?action=moderate&amp;operation=<?=$operation?>" id="postform">
	<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
	<input type="hidden" name="fid" value="<?=$fid?>" />
	<input type="hidden" name="referer" value="<?=$referer?>" />

	<div class="mainbox formbox">
		<h1>
		<? if($operation == 'delete') { ?>
			删除主题
		<? } elseif($operation == 'move') { ?>
			移动主题
		<? } elseif($operation == 'highlight') { ?>
			高亮显示
		<? } elseif($operation == 'type') { ?>
			主题分类
		<? } elseif($operation == 'close') { ?>
			关闭/打开主题
		<? } elseif($operation == 'stick') { ?>
			置顶/解除置顶
		<? } elseif($operation == 'digest') { ?>
			<a href="member.php?action=credits&amp;view=digest" target="_blank">查看积分策略说明</a>加入/解除精华
		<? } elseif($operation == 'supe_push') { ?>
			推送/解除
		<? } elseif($operation == 'bump') { ?>
			提升/下沉主题
		<? } elseif($operation == 'recommend') { ?>
			推荐主题
		<? } ?>
		</h1>
	<table summary="Operating" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th>用户名</th>
				<td><?=$discuz_userss?> [<a href="<?=$link_logout?>">退出登录</a>]</td>
			</tr>
		</thead>

		<? if($operation == 'move') { ?>
			<tr>
				<th><label for="moveto">目标版块/分区</label></th>
				<td>
					<select id="moveto" name="moveto">
						<?=$forumselect?>
					</select>
				</td>
			</tr>

			<tr>
				<th>移动方式</th>
				<td>
					<label><input class="radio" type="radio" name="type" value="normal" checked="checked" /> 移动主题</label>
					<label><input class="radio" type="radio" name="type" value="redirect" /> 移动主题并在原来的版块中保留转向</label>
				</td>
			</tr>
		<? } elseif($operation == 'highlight') { ?>
			<tr>
				<th>字体样式</td>
				<td>
					<label><input class="checkbox" type="checkbox" name="highlight_style[1]" value="1" <?=$stylecheck['1']?> /> <strong style="font-weight: bold; color: #000;">粗体</strong></label>&nbsp;
					<label><input class="checkbox" type="checkbox" name="highlight_style[2]" value="1" <?=$stylecheck['2']?> /> <em style="font-style: italic;">斜体</em></label>&nbsp;
					<label><input class="checkbox" type="checkbox" name="highlight_style[3]" value="1" <?=$stylecheck['3']?> /> <span style="text-decoration: underline;">下划线</span></label>
				</td>
			</tr>

			<tr>
				<th>字体颜色</th>
				<td>
					<label class="highlight"><input class="radio" type="radio" name="highlight_color" value="0" <?=$colorcheck['0']?> /><em style="background: <?=LINK?>;"></em></label>
					<label class="highlight"><input class="radio" type="radio" name="highlight_color" value="1" <?=$colorcheck['1']?> /><em style="background: red;"></em></label>
					<label class="highlight"><input class="radio" type="radio" name="highlight_color" value="2" <?=$colorcheck['2']?> /><em style="background: orange;"></em></label>
					<label class="highlight"><input class="radio" type="radio" name="highlight_color" value="3" <?=$colorcheck['3']?> /><em style="background: yellow;"></em></label>
					<label class="highlight"><input class="radio" type="radio" name="highlight_color" value="4" <?=$colorcheck['4']?> /><em style="background: green;"></em></label>
					<label class="highlight"><input class="radio" type="radio" name="highlight_color" value="5" <?=$colorcheck['5']?> /><em style="background: cyan;"></em></label>
					<label class="highlight"><input class="radio" type="radio" name="highlight_color" value="6" <?=$colorcheck['6']?> /><em style="background: blue;"></em></label>
					<label class="highlight"><input class="radio" type="radio" name="highlight_color" value="7" <?=$colorcheck['7']?> /><em style="background: purple;"></em></label>
					<label class="highlight"><input class="radio" type="radio" name="highlight_color" value="8" <?=$colorcheck['8']?> /><em style="background: gray;"></em></label>
				</td>
			</tr>
		<? } elseif($operation == 'type') { ?>
			<tr>
				<th>目标版块/分区</td>
				<td><?=$typeselect?></td>
			</tr>
		<? } elseif($operation == 'close') { ?>
			<tr>
				<th>操作</th>
				<td>
					<label><input class="radio" type="radio" name="close" value="0" <?=$closecheck['0']?> /> 打开主题 </label>&nbsp;
					<label><input class="radio" type="radio" name="close" value="1" <?=$closecheck['1']?> /> 关闭主题</label>
				</td>
			</tr>
		<? } elseif($operation == 'stick') { ?>
			<tr>
				<th>级别</th>
				<td>
					<? if(!$single || $threadlist[$tid]['displayorder'] > 0) { ?>
						<label><input class="radio" type="radio" name="level" value="0" onclick="$('expirationarea').disabled=1" /> 解除置顶 </label>&nbsp;
					<? } ?>
						<label><input class="radio" type="radio" name="level" value="1" <?=$stickcheck['1']?> onclick="$('expirationarea').disabled=0" /> <img src="<?=IMGDIR?>/pin_1.gif" alt="<?=$threadsticky['2']?>" /> <?=$threadsticky['2']?></label>
					<? if($allowstickthread >= 2) { ?>
						<label><input class="radio" type="radio" name="level" value="2" <?=$stickcheck['2']?> onclick="$('expirationarea').disabled=0" /> <img src="<?=IMGDIR?>/pin_2.gif" alt="<?=$threadsticky['1']?>" /> <?=$threadsticky['1']?></label>
						<? if($allowstickthread == 3) { ?>
							<label><input class="radio" type="radio" name="level" value="3" <?=$stickcheck['3']?> onclick="$('expirationarea').disabled=0" /> <img src="<?=IMGDIR?>/pin_3.gif" alt="<?=$threadsticky['0']?>" /> <?=$threadsticky['0']?></label>
						<? } ?>
					<? } ?>
				</td>
			</tr>
		<? } elseif($operation == 'digest') { ?>
			<tr>
				<th>级别</th>
				<td>
					<? if(!$single || ($single && $threadlist[$tid]['digest'])) { ?>
						<label><input class="radio" type="radio" name="level" value="0" <?=$digestcheck['0']?> onclick="$('expiration').disabled=1" /> 解除精华 </label>&nbsp;
				<? } ?>
					<label><input class="radio" type="radio" name="level" value="1" <?=$digestcheck['1']?> onclick="$('expiration').disabled=0" /> <img src="<?=IMGDIR?>/digest_1.gif" alt="" /></label>
					<label><input class="radio" type="radio" name="level" value="2" <?=$digestcheck['2']?> onclick="$('expiration').disabled=0" /> <img src="<?=IMGDIR?>/digest_2.gif" alt="" /></label>
					<label><input class="radio" type="radio" name="level" value="3" <?=$digestcheck['3']?> onclick="$('expiration').disabled=0" /> <img src="<?=IMGDIR?>/digest_3.gif" alt="" /></label>
				</td>
			</tr>

		<? } elseif($operation == 'supe_push') { ?>
			<tr>
			<td class="altbg1"><span class="bold">推送到 SupeSite</span></td>
			<td class="altbg2">
			<input class="radio" type="radio" name="supe_pushstatus" value="2" <?=$supe_pushstatus['2']?>> 推送 &nbsp; &nbsp;
			<input class="radio" type="radio" name="supe_pushstatus" value="-2" <?=$supe_pushstatus['-2']?>> 解除推送 &nbsp; &nbsp;</td>
			</tr>

		<? } elseif($operation == 'bump') { ?>
			<tr>
				<th>操作</th>
				<td>
					<label><input class="radio" type="radio" name="isbump" value="1" checked="checked" /> 提升主题 </label>&nbsp;
					<label><input class="radio" type="radio" name="isbump" value="0" /> 下沉主题</label>
				</td>
			</tr>
		<? } elseif($operation == 'recommend') { ?>
			<tr>
				<th>操作</th>
				<td>
					<label><input class="radio" type="radio" name="isrecommend" value="1" checked="checked" /> 推荐主题</label>
					<label><input class="radio" type="radio" name="isrecommend" value="0" /> 解除推荐</label>
				</td>
			</tr>
			<tr>
				<th><label for="recommendexpire">有效期</label></th>
				<td>
					<select id="recommendexpire" name="recommendexpire">
						<option value="86400">一天</option>
						<option value="259200">三天</option>
						<option value="432000">五天</option>
						<option value="604800">一周</option>
						<option value="2592000">一月</option>
						<option value="7776000">三月</option>
						<option value="15552000">六月</option>
						<option value="31536000">一年</option>
					</select>
				</td>
			</tr>
		<? } ?>

		<? if(in_array($operation, array('stick', 'digest', 'highlight', 'close'))) { ?>
			<tr id="expirationarea">
				<th><label for="expiration">有效期</label></th>
				<td><input onclick="showcalendar(event, this, true)" type="text" name="expiration" id="expiration" size="15" value="<?=$expirationdefault?>" /> 本操作的有效期限，格式为 yyyy-mm-dd，范围 <u><?=$expirationmin?></u> 至 <u><?=$expirationmax?></u>，留空为不限制</td>
			</tr>
		<? } include template('topicadmin_reason'); if(in_array($operation, array('stick', 'digest', 'highlight'))) { ?>
			<tr>
				<th>后续操作</th>
				<td>
					<label><input class="radio" type="radio" name="next" value="" checked="checked" /> 无 </label>&nbsp;
					<? if($operation != 'highlight') { ?><label><input class="radio" type="radio" name="next" value="highlight" /> 高亮显示 </label>&nbsp; <? } ?>
					<? if($operation != 'stick') { ?><label><input class="radio" type="radio" name="next" value="stick" /> 置顶/解除置顶 </label>&nbsp; <? } ?>
					<? if($operation != 'digest') { ?><label><input class="radio" type="radio" name="next" value="digest"> 加入/解除精华 </label>&nbsp; <? } ?>
				</td>
			</tr>
		<? } ?>

		<tr class="btns">
			<th>&nbsp;</th>
			<td><button type="submit" name="modsubmit" id="postsubmit" value="true">提交</button> [完成后可按 Ctrl+Enter 发布]
		</tr>

	</table>

	</div>

	<? if($single) { ?>
		<input type="hidden" name="moderate[]" value="<?=$moderate['0']?>" />
		<? if($loglist) { ?>
			<div class="mainbox">
				<h3>主题操作记录</h3>
				<table summary="Log List" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
							<td>操作者</td>
							<td>时间</td>
							<td>操作</td>
							<td>有效期</td>
						</tr>
					</thead><? if(is_array($loglist)) { foreach($loglist as $log) { ?>						<tr>
							<td><? if($log['uid']) { ?><a href="space.php?uid=<?=$log['uid']?>" target="_blank"><?=$log['username']?></a><? } else { ?>任务系统<? } ?></td>
							<td><?=$log['dateline']?></td>
							<td <?=$log['status']?>><strong><?=$modactioncode[$log['action']]?></strong></td>
							<td <?=$log['status']?>><? if($log['expiration']) { ?><?=$log['expiration']?><? } elseif(in_array($log['action'], array('STK', 'HLT', 'DIG', 'CLS', 'OPN'))) { ?>永久有效<? } ?></td>
						</tr>
					<? } } ?></table>
			</div>
		<? } ?>
	<? } else { ?>
		<div class="mainbox threadlist">
			<table summary="Threads" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th>标题</th>
						<td class="author">作者</td>
						<td class="nums">回复</td>
						<td class="lastpost">最后发表</td>
					</tr>
				</thead><? if(is_array($threadlist)) { foreach($threadlist as $thread) { ?>				<tbody>
					<tr>
						<th>
							<input type="checkbox" name="moderate[]" value="<?=$thread['tid']?>" checked="checked" />
							<a href="viewthread.php?tid=<?=$thread['tid']?>&amp;extra=<?=$extra?>"><?=$thread['subject']?></a>
						</th>
						<td class="author"><? if($thread['author']) { ?><a href="space.php?uid=<?=$thread['authorid']?>"><?=$thread['author']?></a><? } else { ?>匿名<? } ?></td>
						<td class="nums"><?=$thread['replies']?></td>
						<td class="lastpost"><?=$thread['lastpost']?> <cite>by <? if($thread['lastposter']) { ?><a href="space.php?username=<?=$thread['lastposterenc']?>"><?=$thread['lastposter']?></a><? } else { ?>匿名<? } ?></cite></td>
					</tr>
				</tbody>
				<? } } ?></table>
		</div>
	<? } ?>

</form>
<? if(in_array($operation, array('stick', 'digest', 'highlight', 'close'))) { ?>
	<script src="include/javascript/calendar.js" type="text/javascript"></script>
<? } include template('footer'); ?>
