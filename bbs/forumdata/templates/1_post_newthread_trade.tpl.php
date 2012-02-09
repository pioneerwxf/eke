<? if(!defined('IN_DISCUZ')) exit('Access Denied'); include template('header'); ?>
<div id="nav"><a href="<?=$indexname?>"><?=$bbname?></a> <?=$navigation?> &raquo; 发布商品主题</div>

<script type="text/javascript">
var postminchars = parseInt('<?=$minpostsize?>');
var postmaxchars = parseInt('<?=$maxpostsize?>');
var disablepostctrl = parseInt('<?=$disablepostctrl?>');
var typerequired = parseInt('<?=$forum['threadtypes']['required']?>');
var bbinsert = parseInt('<?=$bbinsert?>');
var seccodecheck = parseInt('<?=$seccodecheck?>');
var secqaacheck = parseInt('<?=$secqaacheck?>');
var special = 2;
var tradepost = 1;
var isfirstpost = 1;
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
lang['post_trade_alipay_null'] = '对不起，请输入支付宝账户。';
lang['post_trade_goodsname_null'] = '对不起，请输入商品名称。';
lang['post_trade_price_null'] = '对不起，请输入商品现价。';
lang['post_trade_addr_null'] = '对不起，请输入商品所在地。';
</script>
<? include template('post_preview'); ?>
<form method="post" id="postform" action="post.php?action=newtrade&amp;fid=<?=$fid?>&amp;extra=<?=$extra?>&amp;topicsubmit=yes" <?=$enctype?>>
	<input type="hidden" name="formhash" id="formhash" value="<?=FORMHASH?>" />
	<input type="hidden" name="isblog" value="<?=$isblog?>" />
	<input type="hidden" name="frombbs" value="1" />
	<input type="hidden" name="special" value="2" />

	<div class="mainbox formbox">
		<span class="headactions"><a href="member.php?action=credits&amp;view=forum_post&amp;fid=<?=$fid?>" target="_blank">查看积分策略说明</a></span>
		<h1>发布商品主题</h1>
		<table summary="post" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th>用户名</th>
					<td>
						<? if($discuz_uid) { ?>
							<?=$discuz_userss?> [<a href="<?=$link_logout?>">退出登录</a>]
						<? } else { ?>
							游客 [<a href="<?=$link_login?>">会员登录</a>]
						<? } ?>
					</td>
				</tr>
			</thead>

		<? if($seccodecheck) { ?>
			<tr>
				<th><label for="seccodeverify">验证码</label></th>
				<td>
					<div id="seccodeimage"></div>
					<input type="text" onfocus="updateseccode();this.onfocus = null" id="seccodeverify" name="seccodeverify" size="8" maxlength="4" />
					<em class="tips"><strong>点击输入框显示验证码</strong> <? if($seccodedata['animator'] == 2) { ?>请确认您的浏览器支持 Flash 的显示，如果看不清验证码，请点<a href="###" onclick="updateseccode()">这里</a>刷新<? } elseif($seccodedata['animator'] == 1) { ?>请确认您的浏览器支持动画的显示，如果看不清验证码，请点图片刷新<? } else { ?>如果看不清验证码，请点图片刷新<? } ?></em></td>
					<script type="text/javascript">
						var seccodedata = [<?=$seccodedata['width']?>, <?=$seccodedata['height']?>, <?=$seccodedata['type']?>];
					</script>
			</tr>
		<? } ?>

		<? if($secqaacheck) { ?>
			<tr><th><label for="secanswer">验证问答</label></th>
			<td><div id="secquestion"></div><input type="text" name="secanswer" id="secanswer" size="25" maxlength="50" />
			<script type="text/javascript">
			<? if(($attackevasive & 1) && $seccodecheck) { ?>
				setTimeout("ajaxget('ajax.php?action=updatesecqaa&inajax=1', 'secquestion')", 2001);
			<? } else { ?>
				ajaxget('ajax.php?action=updatesecqaa&inajax=1', 'secquestion');
			<? } ?>
			</script></td>
			</tr>
		<? } ?>

		<tr>
			<th><label for="subject">标题</label></th>
			<td>
				<? if($iscircle && $mycircles) { ?>
					<select name='sgid'>
						<option value="0">请选择圈子</option><? if(is_array($mycircles)) { foreach($mycircles as $id => $name) { ?><option value="<?=$id?>"><?=$name?></option><? } } ?></select>
				<? } else { ?>
					<?=$typeselect?>
				<? } ?>
				<input type="text" name="subject" id="subject" size="45" value="<?=$subject?>" tabindex="3" />
			</td>
		</tr>

		<thead>
			<tr>
				<th>柜台信息</th>
				<td>&nbsp;</td>
			</tr>
		</thead>

		<tr>
		<th><label for="threaddesc">柜台商品介绍</label></th>
		<td><textarea name="counterdesc" id="counterdesc" rows="10" cols="20" style="width:99%; height:60px" tabindex="4"></textarea></td>
		</tr>

		<tr>
		<th><label for="aboutthread">柜台介绍</label></th>
		<td><textarea name="aboutcounter" id="aboutcounter" rows="10" cols="20" style="width:99%; height:60px" tabindex="5"></textarea></td>
		</tr>

		<thead>
			<tr>
				<th>商品信息</th>
				<td>&nbsp;</td>
			</tr>
		</thead>
<? include template('post_trade'); ?>
<thead>
			<tr>
				<th>&nbsp;</th>
				<td><label><input id="advshow" class="checkbox" type="checkbox" onclick="showadv()" tabindex="201" />其他信息</label></td>
			</tr>
		</thead>
		<tbody id="adv" style="display: none">

			<? if($allowsetreadperm) { ?>
				<tr>
					<th><label for="readperm">所需阅读权限</label></th>
					<td><input type="text" name="readperm" id="readperm" size="6" value="<?=$readperm?>" tabindex="202" /> <em class="tips">(0或空为不限制)</em></td>
				</tr>
			<? } ?>

			</tbody>
			<tr class="btns">
				<th>&nbsp;</th>
				<td>
					<input type="hidden" name="wysiwyg" id="<?=$editorid?>_mode" value="<?=$editormode?>" />
					<button type="submit" name="topicsubmit" id="postsubmit" value="true" tabindex="300">发布商品主题</button>
					<em>[完成后可按 Ctrl+Enter 发布]</em>&nbsp;&nbsp;
					&nbsp;<a href="###" id="restoredata" onclick="loadData()" title="恢复上次自动保存的数据">恢复数据</a>
				</td>
			</tr>
		</table>
	</div>
<br />

</form>

<script type="text/javascript">
	function showadv() {
		if($("advshow").checked == true) {
			$("adv").style.display = "";
		} else {
			$("adv").style.display = "none";
		}
	}
</script>
<? include template('post_js'); include template('footer'); ?>
