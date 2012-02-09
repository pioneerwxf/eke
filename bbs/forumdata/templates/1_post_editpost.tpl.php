<? if(!defined('IN_DISCUZ')) exit('Access Denied'); if(!$iscircle || !$sgid) { include template('header'); } else { include template('supesite_header'); } ?>

<div id="nav"><a href="<?=$indexname?>"><?=$bbname?></a> <?=$navigation?> &raquo; <? if($isfirstpost) { if($thread['special'] == 1) { ?>编辑投票主题<? } elseif($thread['special'] == 3) { ?>编辑悬赏主题<? } elseif($thread['special'] == 5) { ?>编辑辩论主题<? } else { ?>编辑帖子<? } } else { ?>编辑帖子<? } ?></div>

<? if($thread['special'] == 4 || $thread['special'] == 5) { ?>
	<script src="include/javascript/calendar.js" type="text/javascript"></script>
<? } ?>
<script type="text/javascript">
var postminchars = parseInt('<?=$minpostsize?>');
var postmaxchars = parseInt('<?=$maxpostsize?>');
var disablepostctrl = parseInt('<?=$disablepostctrl?>');
var typerequired = parseInt('<?=$forum['threadtypes']['required']?>');
var attachments = new Array();
var bbinsert = parseInt('<?=$bbinsert?>');
var attachimgurl = new Array();
var isfirstpost = parseInt('<?=$isfirstpost?>');
var special = parseInt('<?=$special?>');
var allowposttrade = parseInt('<?=$allowposttrade?>');
var allowpostreward = parseInt('<?=$allowpostreward?>');
var allowpostactivity = parseInt('<?=$allowpostactivity?>');
lang['board_allowed'] = '系统限制';
lang['lento'] = '到';
lang['bytes'] = '字节';
lang['post_curlength'] = '当前长度';
lang['post_subject_and_message_isnull'] = '请完成标题或内容栏。';
lang['post_subject_toolong'] = '您的标题超过 80 个字符的限制。';
lang['post_message_length_invalid'] = '您的帖子长度不符合要求。';
lang['post_type_isnull'] = '请选择主题对应的分类。';
lang['post_reward_credits_null'] = '对不起，您输入悬赏积分。';
</script>
<? include template('post_preview'); ?>
<form method="post" id="postform" action="post.php?action=edit&amp;extra=<?=$extra?>&amp;editsubmit=yes&amp;mod=<?=$mod?>" <?=$enctype?>>
<input type="hidden" name="formhash" id="formhash" value="<?=FORMHASH?>">
<input type="hidden" name="page" value="<?=$page?>">

<div class="mainbox formbox">
	<h1><? if($isfirstpost) { if($thread['special'] == 1) { ?>编辑投票主题<? } elseif($thread['special'] == 3) { ?>编辑悬赏主题<? } elseif($thread['special'] == 5) { ?>编辑辩论主题<? } else { ?>编辑帖子<? } } else { ?>编辑帖子<? } ?></h1>
	<table summary="Edit Post" cellspacing="0" cellpadding="0" id="editpost">

		<? if($discuz_uid) { ?>
		<thead>
			<tr>
				<th>用户名</th>
				<td><?=$discuz_userss?> <em class="tips">[<a href="<?=$link_logout?>">退出登录</a>]</em></td>
			</tr>
		</thead>
		<? } if($thread['special'] == 3 && $isfirstpost) { ?>
	<tr>
	<th>悬赏价格<? if(!empty($extcredits[$creditstrans]['title'])) { ?>(<?=$extcredits[$creditstrans]['title']?>)<? } ?></th>
	<td>
	<? if($thread['price'] > 0) { ?>
        <input onkeyup="getrealprice(this.value)" type="text" name="rewardprice" size="6" value="<?=$rewardprice?>" tabindex="2" />
        税后追加: <span id="realprice">0</span> <?=$extcredits[$creditstrans]['unit']?> (最低 <?=$minrewardprice?> <?=$extcredits[$creditstrans]['unit']?><? if($maxrewardprice > 0) { ?> - <?=$maxrewardprice?> <?=$extcredits[$creditstrans]['unit']?><? } ?></span>)
	<? } elseif($thread['price'] < 0 && $forum['ismoderator']) { ?>
	<input type="text" name="rewardprice" size="6" value="<?=$rewardprice?>" tabindex="2" />
	<? } else { ?>
	<input onkeyup="getrealprice(this.value)" type="hidden" name="rewardprice" size="6" value="<?=$rewardprice?>" tabindex="2" /><?=$rewardprice?> <?=$extcredits[$creditstrans]['unit']?>
	<? } ?>
	</td></tr>
	<? if($thread['price'] > 0) { ?>
	<script type="text/javascript">
		$('realprice').innerHTML = 0;
		function getrealprice(price){
			if(!price.search(/^\d+$/) ) {
				n = parseInt(price) + Math.ceil(parseInt(price * <?=$creditstax?>)) - (parseInt(<?=$thread['price']?>) + Math.ceil(parseInt(<?=$thread['price']?> * <?=$creditstax?>)));
				if(price > 32767) {
					$('realprice').innerHTML = '<b>售价不能高于 32767</b>';
				} else if (price < <?=$rewardprice?>) {
					$('realprice').innerHTML = '<b>不能降低悬赏积分</b>';
				}else if (price < <?=$minrewardprice?> || (<?=$maxrewardprice?> > 0 && price > <?=$maxrewardprice?>)) {
					$('realprice').innerHTML = '<b>售价超出范围</b>';
				} else {
					$('realprice').innerHTML = n;
				}
			}else{
				$('realprice').innerHTML = '<b>填写无效</b>';
			}
		}
	</script>
	<? } } ?>

<tr>
<th style="border-bottom: 0;">标题</th>
<td style="border-bottom: 0;">
<? if($isfirstpost) { ?>
	<?=$typeselect?>
<? } if($thread['special'] == 3 && !$forum['ismoderator'] && $isfirstpost && $thread['replies'] > 0) { ?>
	<input type="hidden" name="subject" id="subject" size="45" value="<?=$postinfo['subject']?>" tabindex="3" /><?=$postinfo['subject']?>
<? } else { ?>
	<input type="text" name="subject" id="subject" size="45" value="<?=$postinfo['subject']?>" tabindex="3" />
<? } ?>

<input type="hidden" name="origsubject" value="<?=$postinfo['subject']?>" />
<? if($special == 6) { ?>
	<input type="hidden" name="subjectu8" value="" />
	<input type="hidden" name="tagsu8" value="" />
	<input type="hidden" name="vid" value="1" />
<? } ?>
</td></tr>

<? if($thread['special'] == 1 && $isfirstpost && ($alloweditpoll || $thread['authorid'] == $discuz_uid)) { ?>
	<input type="hidden" name="polls" value="yes" />
	<tr><th>有效记票天数</th><td><input type="text" name="expiration" value="<? if(!$poll['expiration']) { ?>0<? } elseif($poll['expiration'] < 0) { ?>关闭投票<? } elseif($poll['expiration'] < $timestamp) { ?>已结束<? } else { print_r(round(($poll['expiration'] - $timestamp) / 86400)) ?> <? } ?>" size="6" tabindex="4" /> <em class="tips">(0或空为不限制)</em></td></tr>
	<tr>
	<th valign="top">投票选项<br />
	每行填写 1 个选项<br />最多可填写 <?=$maxpolloptions?> 个选项 <?=$maxpolloptions?><br /><br />
	<input type="checkbox" name="visibilitypoll" value="1" tabindex="4" <? if(!$poll['visible']) { ?>checked<? } ?> /> 提交投票后结果才可见<br />
	<input type="checkbox" name="multiplepoll" value="1" tabindex="5" <? if($poll['multiple']) { ?>checked<? } ?>  onclick="this.checked?$('maxchoicescontrol').style.display='':$('maxchoicescontrol').style.display='none';" /> 多选投票<br />
	<? if(!$poll['expiration'] || $poll['expiration'] > $timestamp) { ?><input type="checkbox" name="close" value="1" /> 关闭投票<br /><? } ?>
	<span id="maxchoicescontrol" <? if(!$poll['multiple']) { ?>style="display: none"<? } ?>>最多可选项数: <input type="text" name="maxchoices" value="<?=$poll['maxchoices']?>" size="5" /><br />
	</span></td><td>
	显示顺序&nbsp;<a id="addpolloptlink" href="#" onclick="addpollopt()">[增加投票项]</a><br /><? if(is_array($poll['polloption'])) { foreach($poll['polloption'] as $key => $option) { ?><input type="hidden" name="polloptionid[<?=$poll['polloptionid'][$key]?>]" value="<?=$poll['polloptionid'][$key]?>">
		<input type="text" name="displayorder[<?=$poll['polloptionid'][$key]?>]" value="<?=$poll['displayorder'][$key]?>" size="5" tabindex="6" style="text-align:right">&nbsp;<input type="text" name="polloption[<?=$poll['polloptionid'][$key]?>]" value="<?=$option?>" tabindex="7" size="55"<? if(!$alloweditpoll) { ?> readonly<? } ?> /><br /><? } } ?><span id="addpolloptindex"></span>
	</td></tr>
<script type="text/javascript">
var max = <?=$key?> + 1;
var polloptionid = <?=$poll['polloptionid'][$key]?> + 1;
function addpollopt() {
	if(max < <?=$maxpolloptions?>) {
		max++;
		var optrow='<input type="hidden" name="polloptionid['+ polloptionid +']" value='+ polloptionid +'><input type="text" name="displayorder[]" value="" size="5" style="text-align:right">&nbsp;<input type="text" name="polloption[]" value="" size="55"><br />';
		$('addpolloptindex').innerHTML = $('addpolloptindex').innerHTML + optrow;
		polloptionid++;
		if(max == <?=$maxpolloptions?>) {
			$('addpolloptlink').disabled=true;
		}
	}
}
</script>
<? } ?>
<tbody id="threadtypes"></tbody>
<tr>
<? include template('post_editor'); ?>
</tr>

<? if($isfirstpost) { ?>

	<? if($tagstatus) { ?>
		<tr>
			<th><label for="tags">标签(TAG)</label></th>
			<td>
				<input size="45" type="input" id="tags" name="tags" value="<?=$threadtags?>" tabindex="200" />&nbsp;
				<button onclick="relatekw();return false">可用标签</button><span id="tagselect"></span>
				<em class="tips">(用空格隔开多个标签，最多可填写 <strong>5</strong> 个)</em>
			</td>
		</tr>
	<? } ?>

	<? if($thread['special'] == 5) { ?>
		<tr>
		<th>正方观点</th>
		<td><textarea name="affirmpoint" rows="10" cols="20" style="width:99%; height:60px" tabindex="201" onkeydown="ctlent(event)"><?=$debate['affirmpoint']?></textarea></td>
		</tr>
		<tr>
		<th>反方观点</th>
		<td><textarea name="negapoint" rows="10" cols="20" style="width:99%; height:60px" tabindex="202" onkeydown="ctlent(event)"><?=$debate['negapoint']?></textarea></td>
		</tr>
		<tr>
		<th>结束时间</th>
		<td><input onclick="showcalendar(event, this, true)" type="text" name="endtime" size="45" value="<?=$debate['endtime']?>" tabindex="203" /></td>
		</tr>
		<tr>
		<th>裁判</th>
		<td><input type="text" name="umpire" size="45" tabindex="204" onblur="checkuserexists(this.value, 'checkuserinfo')" value="<?=$debate['umpire']?>" /><span id="checkuserinfo"></span></td>
		</tr>
	<? } ?>

		<thead>
			<tr>
				<th>其他信息</th>
				<td>&nbsp;</td>
			</tr>
		</thead>

	<? if($allowsetreadperm) { ?>
		<tr>
		<th>所需阅读权限</th>
		<td><input type="text" name="readperm" size="6" value="<?=$thread['readperm']?>" tabindex="205" /> <em class="tips">(0或空为不限制)</em></td>
		</tr>
	<? } ?>

	<? if($maxprice && !$thread['special']) { ?>
		<tr>
		<th>售价(<?=$extcredits[$creditstrans]['title']?>)</th>
		<td>
		<? if($thread['price'] == -1 || $thread['freecharge']) { ?>
			<input type="text" name="price" size="6" value="<?=$thread['pricedisplay']?>" tabindex="206" disabled /> <em class="tips"><?=$extcredits[$creditstrans]['unit']?> <? if($thread['price'] == -1) { ?>(本主题被强制退款)<? } else { ?>(本主题自发表起已超过最长出售时限)<? } ?></em>
		<? } else { ?>
			<input type="text" name="price" size="6" value="<?=$thread['pricedisplay']?>" tabindex="206" /> <em class="tips"><?=$extcredits[$creditstrans]['unit']?> (最高 <?=$maxprice?> <?=$extcredits[$creditstrans]['unit']?><? if($maxincperthread) { ?>，单一主题作者最高收入 <?=$maxincperthread?> <?=$extcredits[$creditstrans]['unit']?><? } if($maxchargespan) { ?>，最高出售时限 <?=$maxchargespan?> 小时<? } ?>)</em>
			您可以使用 <code><strong>[free]</strong>message<strong>[/free]</strong></code> 代码发表无需付费也能查看的免费信息
		<? } ?>	</td></tr>
	<? } ?>

	<? if(!$thread['special']) { ?>
		<tr>
		<th>图标</th><td><input type="radio" name="iconid" value="0" tabindex="207" checked /> 无 <?=$icons?></td>
		</tr>
	<? } } ?>

	<tr class="btns">
		<th>&nbsp;</th>
		<td>
			<input type="hidden" name="wysiwyg" id="<?=$editorid?>_mode" value="<?=$editormode?>" />
			<input type="hidden" name="fid" id="fid" value="<?=$fid?>" />
			<input type="hidden" name="tid" value="<?=$tid?>" />
			<input type="hidden" name="pid" value="<?=$pid?>" />
			<input type="hidden" name="postsubject" value="<?=$postinfo['subject']?>" />
			<button type="submit" name="editsubmit" id="postsubmit" value="true" tabindex="300"><? if($isfirstpost) { if($thread['special'] == 1) { ?>编辑投票主题<? } elseif($thread['special'] == 3) { ?>编辑悬赏主题<? } elseif($thread['special'] == 5) { ?>编辑辩论主题<? } else { ?>编辑帖子<? } } else { ?>编辑帖子<? } ?></button>
			<em>[完成后可按 Ctrl+Enter 发布]</em>&nbsp;&nbsp;
			&nbsp;<a href="###" id="restoredata" onclick="loadData()" title="恢复上次自动保存的数据">恢复数据</a>
		</td>
	</tr>
</table>
</div>

<? if($postinfo['attachment'] && $attachments) { include template('post_editpost_attachlist'); } ?>

</form>
<? include template('post_js'); ?>
<script type="text/javascript">
	function checkuserexists(username, objname) {
		var x = new Ajax();
		username = is_ie && document.charset == 'utf-8' ? encodeURIComponent(username) : username;
		x.get('ajax.php?inajax=1&action=checkuserexists&username=' + username, function(s){
			var obj = $(objname);
			obj.innerHTML = s;
		});
	}
	<? if($thread['typeid'] && $isfirstpost) { ?>ajaxget('post.php?action=threadtypes&tid=<?=$tid?>&typeid=<?=$thread['typeid']?>&themeid=1', 'threadtypes', 'threadtypeswait');<? } ?>
</script>

<? if(!$iscircle || !$sgid) { include template('footer'); } else { include template('supesite_footer'); } ?>