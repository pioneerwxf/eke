<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<form method="post" action="pm.php?action=ignore">
	<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
	<div class="mainbox formbox">
		<h1>忽略列表</h1>
		<ul class="tabs">
			<li class="sendpm"><a href="pm.php?action=send">发送短消息</a></li>
			<li><a href="pm.php?folder=inbox">收件箱[<span id="pm_unread"><?=$pm_inbox_newpm?></span>]</a></li>
			<li><a href="pm.php?folder=outbox">草稿箱</a></li>
			<li><a href="pm.php?folder=track">已发送</a></li>
			<li><a href="pm.php?action=search">搜索短消息</a></li>
			<li><a href="pm.php?action=archive">导出短消息</a></li>
			<li class="current"><a href="pm.php?action=ignore">忽略列表</a></li>
		</ul>
		<table summary="忽略列表" cellspacing="0" cellpadding="0">
			<tr>
				<td><textarea rows="5" cols="70" id="ignorelist" name="ignorelist" style="width: 98%;"><?=$ignorepm?></textarea>
			</td>
			</tr>
			<tr>
				<td><button type="submit" class="submit" name="ignoresubmit" value="true">提交</button></td>
			</tr>
			<tr>
				<td><div class="tisp">添加到该列表中的用户给您发送短消息时将不予接收<br />添加多个忽略人员名单时用逗号 "<strong>,</strong>" 隔开(如:张三<strong>,</strong>李四<strong>,</strong>王五)<br />如需禁止所有用户发来的短消息，请设置为 "<strong>{<?=ALL?>}</strong>"</div></td>
			</tr>
		</table>
	</div>
</form>