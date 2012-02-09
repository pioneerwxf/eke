<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<script type="text/javascript">
	var postSubmited = false;
	function ctlent(event) {
		if(postSubmited == false && (event.ctrlKey && event.keyCode == 13) || (event.altKey && event.keyCode == 83) && $('postsubmit')) {
			postSubmited = true;
			$('postsubmit').click();
			$('postsubmit').disabled = true;
		}
	}
</script>
<tr>
	<th valign="top"><label for="reason">操作原因</label>
	</th>
	<td style="height: 9em;">
		<select name="selectreason" size="6" style="height: 100px; width: 8em" onchange="this.form.reason.value=this.value">
			<option value="">自定义</option>
			<option value="">--------</option><? echo modreasonselect(); ?></select>
		<textarea id="reason" name="reason" style="height: 100px; width: 22em" onKeyDown="ctlent(event);"></textarea>
		<? if($reasonpm == 1 || $reasonpm == 3) { ?><div class="tips">您必须输入理由才能进行操作</div><? } ?>
	</td>
</tr>
<tr>
	<th>&nbsp;</th>
	<td>
		<label><input type="checkbox" name="sendreasonpm" value="1" <?=$reasonpmcheck?> /> 发短消息通知作者</label>
	</td>
</tr>