<? if(!defined('IN_DISCUZ')) exit('Access Denied'); include template('header'); ?>
<div id="nav"><a href="<?=$indexname?>"><?=$bbname?></a> &raquo; 重置密码</div>
<form method="post" action="member.php?action=getpasswd&amp;uid=<?=$uid?>&amp;id=<?=$id?>">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<div class="mainbox">
<h1>重置密码</h1>
<table cellspacing="0" cellpadding="0" width="100%">

<tr>
<th>用户名:</th>
<td><?=$member['username']?></td>
</tr>
<tr>
<th>新密码:</th>
<td><input type="password" name="newpasswd1" size="25" /></td>
</tr>
<tr>
<th>确认新密码:</th>
<td><input type="password" name="newpasswd2" size="25" /><br />
</tr>
<tr class="btns">
<th></th>
<td>
<button type="submit" class="submit" name="getpwsubmit" value="true">提交</button>
</td>
</tr>
</table></div>
</form>
<? include template('footer'); ?>
