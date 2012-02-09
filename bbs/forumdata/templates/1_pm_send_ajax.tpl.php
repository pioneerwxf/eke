<? if(!defined('IN_DISCUZ')) exit('Access Denied'); include template('header'); ?>
<div class="ajaxform" style="width: 500px;">
<form method="post" id="postpmform" name="postpmform" action="pm.php?action=send&amp;inajax=1">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="pmsubmit" value="<?=FORMHASH?>" />
<table cellspacing="0" cellpadding="0" width="100%">
	<thead>
		<tr>
		<th>发送短消息</th>
		<td align="right"><a href="javascript:hideMenu();"><img src="<?=IMGDIR?>/close.gif" alt="关闭" title="关闭" /></a></td>
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
	<? } if($secqaacheck) { ?>
	<tr>
	<th>验证问答</th>
	<td><div id="secquestion"></div><input type="text" name="secanswer" size="25" maxlength="50" /></td>
	</tr>
	<script type="text/javascript">ajaxget('ajax.php?action=updatesecqaa', 'secquestion');</script>
<? } ?>

<tr><th>发送到</th>
<td><input type="text" name="msgto" size="65" value="<?=$touser?>" /></td></tr>
<tr>
<th>标题</th>
<td><input type="text" name="subject" size="65" value="<?=$subject?>" /></td>
</tr>

<tr>
<th>内容<br /><br />
</th>
<td><textarea id="pm_textarea" rows="6" cols="10" name="message" style="width: 100%; height:100px; word-break: break-all" onKeyDown="ctlent(event);"></textarea><br /></td>
</tr>
</tbody>
<tr>
<th></th>
<td><button name="pmsubmit" type="button" class="submit" value="true" onclick="ajaxpost('postpmform', '<?=$ajaxmenuid?>');return false">提交</button></td>
</table>

</form>
</div>
<? include template('footer'); ?>
