<? if(!defined('IN_DISCUZ')) exit('Access Denied'); include template('header'); if(!$inajax) { ?>
<div id="nav"><a href="<?=$indexname?>"><?=$bbname?></a> &raquo; 提示信息</div>

<div class="box message">
<h1><?=$bbname?> 提示信息</h1>
<p>您无权进行当前操作，这可能因以下原因之一造成</p>

<? if($show_message) { ?><p><b><?=$show_message?></b></p><? } ?>
<p><? if($discuz_uid) { ?>您已经登录，但您的帐号或其所在的用户组无权访问当前页面。<? } else { ?>您还没有登录，请填写下面的登录表单后再尝试访问。</p><? } if(!$discuz_uid) { ?>
	<form name="login" method="post" action="logging.php?action=login">
	<input type="hidden" name="formhash" value="<?=FORMHASH?>">
	<input type="hidden" name="referer" value="<?=$referer?>">
	<input type="hidden" name="cookietime" value="2592000">
	<div class="box" style="width: 60%; margin: 10px auto;">
	<table cellspacing="0" cellpadding="4" width="100%">
	<thead>
	<tr>
	<td colspan="2">会员登录</td>
	</tr>
	</thead>
	<tbody>
	<? if($seccodecheck) { ?>
		<tr>
			<th><label for="seccodeverify">验证码</label></th>
			<td>
				<div id="seccodeimage"></div>
				<input type="text" onfocus="updateseccode();this.onfocus = null" id="seccodeverify" name="seccodeverify" size="8" maxlength="4" tabindex="1" />
				<em class="tips"><strong>点击输入框显示验证码</strong> <? if($seccodedata['animator'] == 2) { ?>请确认您的浏览器支持 Flash 的显示，如果看不清验证码，请点<a href="###" onclick="updateseccode()">这里</a>刷新<? } elseif($seccodedata['animator'] == 1) { ?>请确认您的浏览器支持动画的显示，如果看不清验证码，请点图片刷新<? } else { ?>如果看不清验证码，请点图片刷新<? } ?></em></td>
				<script type="text/javascript">
					var seccodedata = [<?=$seccodedata['width']?>, <?=$seccodedata['height']?>, <?=$seccodedata['type']?>];
				</script>
		</tr>
	<? } ?>
	<tr>
	<td onclick="document.login.username.focus();">
	<label><input type="radio" name="loginfield" value="username" checked="checked" />用户名</label>
	<label><input type="radio" name="loginfield" value="uid" />UID</td></label>
	<td><input type="text" name="username" size="25" maxlength="40" tabindex="2" /> &nbsp;<em class="tips"><a href="<?=$regname?>"><?=$reglinkname?></a></em></td>
	</tr>
	<tr>
	<td>密码</td>
	<td><input type="password" name="password" size="25" tabindex="3" /> &nbsp;<em class="tips"><a href="member.php?action=lostpasswd">忘记密码</a></em></td>
	</tr>
	<tr>
	<td>安全提问</td>
	<td><select name="questionid" tabindex="4">
	<option value="0">&nbsp;</option>
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
	<td>回答</td>
	<td><input type="text" name="answer" size="25" tabindex="5" /></td>
	</tr>
	<tr><td></td><td>
	<button class="submit" type="submit" name="loginsubmit" id="loginsubmit" value="true" tabindex="6">会员登录</button>
	</td></tr>
	</table>
	</div>
	</form>
<? } ?>
</div>

<? } else { ?>

<script type="text/javascript">

function ajaxerror() {
	<? if(!$discuz_uid) { ?>
		alert('<?=$show_message?>');
	<? } else { ?>
		alert('您已经登录，但您的帐号或其所在的用户组无权访问当前页面。');
	<? } ?>
}

ajaxerror();

</script>

<? } include template('footer'); ?>
