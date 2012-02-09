<? if(!defined('IN_DISCUZ')) exit('Access Denied'); include template('header'); ?>
<div id="nav">
<a href="<?=$indexname?>"><?=$bbname?></a> &raquo; 会员登录
</div>

<form method="post" action="logging.php?action=login">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="referer" value="<?=$referer?>" />
<input type="hidden" name="loginauth" value="<?=$loginauth?>" />
<input type="hidden" name="loginmode" value="<?=$loginmode?>" />
<input type="hidden" name="styleid" value="<?=$styleid?>" />
<input type="hidden" name="cookietime" value="<?=$cookietime?>" />
<div class="mainbox formbox">
<h1>会员登录</h1>
<? if($member['discuz_secques'] && empty($secques)) { ?>
	<ins class="logininfo">请选择您设置的安全提问，并回答正确后才能登录。</ins>
<? } ?>
<table summary="会员登录" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<th>用户名</th>
<td><input type="text" size="25" value="<?=$username?>" disabled /></td>
</tr>
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
<? } if($member['discuz_secques'] && empty($secques)) { ?>
	<tr>
	<th>安全提问</th>
	<td><select name="questionid" tabindex="3">
	<option value="0">无安全提问</option>
	<option value="1">母亲的名字</option>
	<option value="2">爷爷的名字</option>
	<option value="3">父亲出生的城市</option>
	<option value="4">您其中一位老师的名字</option>
	<option value="5">您个人计算机的型号</option>
	<option value="6">您最喜欢的餐馆名称</option>
	<option value="7">驾驶执照的最后四位数字</option>
	</select></td>
	</tr>
	<tr>
	<th>回答</th>
	<td><input type="text" name="answer" size="25" tabindex="4" /></td>
	</tr>
<? } ?>
<tr>
<th>&nbsp;</th>
<td>
<button type="submit" class="submit" name="loginsubmit" value="true">会员登录</button>
</td>
</tr>
</tbody>
</table></div>
</form>
<? include template('footer'); ?>
