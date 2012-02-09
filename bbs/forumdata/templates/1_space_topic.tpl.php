<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<script src="include/javascript/viewthread.js" type="text/javascript"></script>
<script type="text/javascript">zoomstatus = parseInt(<?=$zoomstatus?>);</script>

<td id="main_layout1">

<div id="module_topic">
<table class="module" cellpadding="0" cellspacing="0" border="0"><tr><td class="header">
<div class="title">
	<? if($blogtopic['special'] == 1) { ?>
		<a target="_blank" href="viewthread.php?tid=<?=$tid?>"><img src="<?=IMGDIR?>/pollsmall.gif" alt="投票" border="0" /></a>
	<? } ?>
	<? if($blogtopic['special'] == 2) { ?>
		<a target="_blank" href="viewthread.php?tid=<?=$tid?>"><img src="<?=IMGDIR?>/tradesmall.gif" alt="商品" border="0" /></a>
	<? } ?>
	<? if($blogtopic['special'] == 3) { ?>
		<? if($blogtopic['price'] > 0) { ?>
		 	<a target="_blank" href="viewthread.php?tid=<?=$tid?>"><img src="<?=IMGDIR?>/rewardsmall.gif" alt="悬赏" border="0" /></a>
		<? } elseif($blogtopic['price'] < 0) { ?>
			<a target="_blank" href="viewthread.php?tid=<?=$tid?>"><img src="<?=IMGDIR?>/rewardsmallend.gif" alt="悬赏已解决" border="0" /></a>
		<? } ?>
	<? } ?>
	<? if($blogtopic['special'] == 4) { ?>
		<a target="_blank" href="viewthread.php?tid=<?=$tid?>"><img src="<?=IMGDIR?>/activitysmall.gif" alt="活动" border="0" /></a>
	<? } ?>
	<?=$blogtopic['subject']?>
</div>
<div class="more">
<a href="viewthread.php?action=printable&amp;tid=<?=$tid?>" target="_blank">打印</a> |
<a href="misc.php?action=emailfriend&amp;tid=<?=$tid?>" target="_blank">推荐</a>
<? if($uid == $discuz_uid || $forum['ismoderator']) { ?>
	| <a href="misc.php?action=blog&amp;tid=<?=$tid?>">从文集移除</a>
	| <a href="post.php?action=edit&amp;fid=<?=$blogtopic['fid']?>&amp;tid=<?=$tid?>&amp;pid=<?=$blogtopic['pid']?>" target="_blank">编辑帖子</a>
<? } else { ?>
	| <a href="misc.php?action=rate&amp;tid=<?=$tid?>&amp;pid=<?=$blogtopic['pid']?>&amp;isblog=yes" target="_blank">评分</a>
<? } ?>
</div>
</td></tr>
<tr><td class="message">
<div class="dateline"><?=$blogtopic['dateline']?></div>
<br />
<div style="float: right"><?=$blogtopic['karma']?></div>
<?=$blogtopic['message']?>
<? if($blogtopic['attachment']) { ?>
	<br /><br /><img src="images/attachicons/common.gif" alt="" />&nbsp;附件: <i>您所在的用户组无法下载或查看附件</i>
<? } elseif($blogtopic['attachlist']) { ?>
	<br /><br /><div class="attach msgbody">
	<div class="msgheader">
	附件</div><div class="msgborder" style="padding: 0px; border-bottom: 0px;">
	<?=$blogtopic['attachlist']?>
	</div>
	</div>
<? } if($blogtopic['tags']) { ?>
	<br /><br /><strong>标签: <?=$blogtopic['tags']?></strong>
<? } ?>
</td></tr></table>
</div>

<div id="module_topiccomment">
<? if($commentlist) { ?>
	<table class="module" cellpadding="0" cellspacing="0" border="0"><tr><td class="header">
	<div class="title">
	评论(<?=$blogtopic['replies']?>)
	</div>
	</td></tr>
	<tr><td>
	<? if($multipage) { ?><?=$multipage?><br /><br /><? } if(is_array($commentlist)) { foreach($commentlist as $comment) { ?>		<br /><div class="message">
		<? if($comment['subject']) { ?><div class="comment_subject"><?=$comment['subject']?></div><? } ?>

		<? if($adminid != 1 && $bannedmessages && (($comment['authorid'] && !$comment['username']) || ($comment['groupid'] == 4 || $comment['groupid'] == 5))) { ?>
			提示: <em>作者被禁止或删除 内容自动屏蔽</em>
		<? } elseif($comment['status'] == 1) { ?>
			提示: <em>该帖被管理员或版主屏蔽</em>
		<? } else { ?>
			<?=$comment['message']?>
			<? if($comment['attachment']) { ?>
				<br /><br /><img src="images/attachicons/common.gif" alt="" />&nbsp;附件: <i>您所在的用户组无法下载或查看附件</i>
			<? } elseif($comment['attachlist']) { ?>
				<br /><br /><div class="attach msgbody">
				<div class="msgheader">
				附件</div><div class="msgborder" style="padding: 0px; border-bottom: 0px;">
				<?=$comment['attachlist']?>
				</div>
				</div>
			<? } ?>
		<? } ?>
		<br style="clear: both"><br />
		<div class="author">
		<? if($comment['authorid'] && $comment['username'] && !$comment['anonymous']) { ?>
			<a href="space.php?uid=<?=$comment['authorid']?>" class="bold" title="<?=$comment['authortitle']?><?="\n"?><?="\n"?>积分: <?=$comment['credits']?><?="\n"?>帖子: <?=$comment['posts']?><?="\n"?>注册: <?=$comment['regdate']?>"><?=$comment['author']?></a> <? showstars($comment['stars']); } else { ?>
			<? if(!$comment['authorid']) { ?>
				<span class="bold">游客</span> <span class="smalltxt"><?=$comment['useip']?></span>
			<? } elseif($comment['authorid'] && $comment['username'] && $comment['anonymous']) { ?>
				<span class="bold">匿名</span>
			<? } else { ?>
				<span class="bold"><?=$comment['author']?></span> <span class="smalltxt">该用户已被删除</span>
			<? } ?>
		<? } ?>
		</div>
		<div class="dateline"><?=$comment['dateline']?></div>
		</div><br />
	<? } } if($multipage) { ?><?=$multipage?><br /><br /><? } ?>
	</td></tr></table>
<? } ?>
</div>

<? if($allowpostreply) { ?>
	<script type="text/javascript">
	var postminchars = <?=$minpostsize?>;
	var postmaxchars = <?=$maxpostsize?>;
	var disablepostctrl = <?=$disablepostctrl?>;
	function validate(theform) {
		if (theform.message.value == "" && theform.subject.value == "") {
			alert("请完成标题或内容栏。");
			return false;
		} else if (theform.subject.value.length > 80) {
			alert("您的标题超过 80 个字符的限制。");
			return false;
		}
		if (!disablepostctrl && ((postminchars != 0 && theform.message.value.length < postminchars) || (postmaxchars != 0 && theform.message.value.length > postmaxchars))) {
			alert("您的帖子长度不符合要求。\n\n当前长度: "+theform.message.value.length+" 字节\n系统限制: "+postminchars+" 到 "+postmaxchars+" 字节");
			return false;
		}
		theform.replysubmit.disabled = true;
		return true;
	}
	var postSubmited = false;
	function ctlent(event) {
		if(postSubmited == false && (event.ctrlKey && event.keyCode == 13) || (event.altKey && event.keyCode == 83) && $('postsubmit')) {
			postSubmited = true;
			$('postsubmit').disabled = true;
			$('postform').submit();
		}
	}
	</script>

	<form id="postform" method="post" name="input" action="post.php?action=reply&amp;fid=<?=$fid?>&amp;tid=<?=$tid?>&amp;replysubmit=yes" onSubmit="return validate(this)">
	<input type="hidden" name="formhash" value="<?=FORMHASH?>">
	<input type="hidden" name="isblog" value="yes">
	<input type="hidden" name="page" value="<?=$page?>">
	<input type="hidden" name="starttime" value="<?=$starttime?>">
	<input type="hidden" name="endtime" value="<?=$endtime?>">

	<table id="module_postcomment" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr><td colspan="2" class="header"><div class="reply"><a target="_blank" href="post.php?action=reply&amp;fid=<?=$blogtopic['fid']?>&amp;tid=<?=$tid?>">高级</a></div>发表评论</td></tr>
	<tr>
	<th>标题 (可选)</th>
	<td><input class="input" type="text" name="subject" value="" tabindex="1"></td>
	</tr>
	<tr>
	<th>选项<br />
	<input class="checkbox" type="checkbox" name="parseurloff" value="1"> 禁用 URL 识别<br />
	<input class="checkbox" type="checkbox" name="smileyoff" value="1"> 禁用 <a href="faq.php?action=message&amp;id=32" target="_blank">表情</a><br />
	<input class="checkbox" type="checkbox" name="bbcodeoff" value="1"> 禁用 <a href="faq.php?action=message&amp;id=18" target="_blank">Discuz!代码</a><br />
	<input class="checkbox" type="checkbox" name="usesig" value="1" <?=$usesigcheck?>> 使用个人签名<br />
	<input class="checkbox" type="checkbox" name="emailnotify" value="1"> 接收新回复邮件通知
	</th>
	<td><textarea rows="7" name="message" onKeyDown="ctlent(event);" tabindex="2"></textarea><br />
	<input class="button" type="submit" name="replysubmit" id="postsubmit" value="发表评论" tabindex="3">&nbsp;&nbsp;&nbsp;
	<input class="button" type="reset" name="topicsreset" value="清空内容" tabindex="4">&nbsp; &nbsp;[完成后可按 Ctrl+Enter 发布]</td>
	</tr></table></form>
<? } else { ?>
	<table id="module_postcomment" align="center">
	<tr><td colspan="2" class="header">发表评论</td></tr>
	<tr><td>本文章已关闭或您没有权限发表评论。</td></tr>
	</table>
<? } ?>
<div align="right"><a target="_blank" href="viewthread.php?tid=<?=$tid?>">查看完整版本</a></div>

</td>