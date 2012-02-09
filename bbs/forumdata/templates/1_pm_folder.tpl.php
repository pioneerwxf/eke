<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<form method="post" action="pm.php?action=delete&amp;folder=<?=$folder?>">
	<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
	<div class="mainbox">
		<h1>短消息</h1>
		<ul class="tabs headertabs">
			<li class="sendpm"><a href="pm.php?action=send">发送短消息</a></li>
			<li <? if($folder == 'inbox') { ?> class="current"<? } ?>><a href="pm.php?folder=inbox">收件箱[<span id="pm_unread"><?=$pm_inbox_newpm?></span>]</a></li>
			<li <? if($folder == 'outbox') { ?> class="current"<? } ?>><a href="pm.php?folder=outbox">草稿箱</a></li>
			<li <? if($folder == 'track') { ?> class="current"<? } ?>><a href="pm.php?folder=track">已发送</a></li>
			<li><a href="pm.php?action=search">搜索短消息</a></li>
			<li><a href="pm.php?action=archive">导出短消息</a></li>
			<li><a href="pm.php?action=ignore">忽略列表</a></li>
		</ul>
		<table summary="收件箱" cellspacing="0" cellpadding="0" id="pmlist">
			<thead>
				<tr>
					<td class="selector">&nbsp;</td>
					<th>标题</th>
					<td class="user"><? if($folder != 'outbox' && $folder != 'track') { ?>来自<? } else { ?>发送到<? } ?></td>
					<td class="time">时间</td>
				</tr>
			</thead>
			<? if($pmlist) { if(is_array($pmlist)) { foreach($pmlist as $pm) { ?>				<tr id="pmrow_<?=$pm['pmid']?>">
				<? if($folder == 'inbox' && $pm['announce']) { ?>
					<td class="selector">&nbsp;</td><td <?=$pm['class']?>><a href="pm.php?action=view&amp;folder=announce&amp;pmid=<?=$pm['pmid']?>" onclick="showpm(event, this)" id="pm_view_<?=$pm['pmid']?>"><?=$pm['subject']?></a></td>
				<? } else { ?>
					<td class="selector"><input type="checkbox" name="delete[]" value="<?=$pm['pmid']?>" /></td>
					<td  <?=$pm['class']?>>
					<? if($folder == 'outbox') { ?>
						<a href="pm.php?action=send&amp;folder=outbox&amp;pmid=<?=$pm['pmid']?>"><?=$pm['subject']?></a>
					<? } else { ?>
						<a href="pm.php?action=view&amp;folder=<?=$folder?>&amp;pmid=<?=$pm['pmid']?>" onclick="showpm(event, this)" id="pm_view_<?=$pm['pmid']?>"><?=$pm['subject']?></a>
					<? } ?>
				<? } ?>
				</td>
				<td>
				<? if($folder == 'inbox') { ?>
					<? if(!$pm['announce']) { ?>
						<? if($pm['msgfromid']) { ?><a href="space.php?uid=<?=$pm['msgfromid']?>"><?=$pm['msgfrom']?></a><? } else { ?>系统消息<? } ?>
					<? } else { ?>
						公共消息
					<? } ?>
				<? } else { ?>
					<a href="space.php?uid=<?=$pm['msgtoid']?>"><?=$pm['msgto']?></a>
				<? } ?>
				</td>
				<td><em><?=$pm['dateline']?></em></td>
				</tr>
			<? } } ?></table>
			<div class="footoperation">
				<label><input class="checkbox" type="checkbox" id="chkall" name="chkall" onclick="checkall(this.form)" /> 全选</label>
				<button type="submit" name="pmsend" value="true">删除</button>
			</div>
			<? } else { ?>
				<tr><td colspan="4">对不起，没有找到匹配结果。</td></tr>
			</table>
			<? } ?>
	</div>
</form>
<div class="notice">共有短消息: <em id="pmtotalnum"><?=$pm_total?></em> ,&nbsp; 短消息上限: <?=$maxpmnum?></div>
<? if(!empty($multipage)) { ?><div class="pages_btns"><?=$multipage?></div><? } if($folder != 'outbox') { ?>
	<script type="text/javascript">

	var prepmdiv = '';
	function showpm(event, obj) {
		var url = obj.href + '&inajax=1';
		var currpmdiv = obj.id + '_div';
		if(!$(currpmdiv)) {
			var x = new Ajax();
			x.get(url, function(s) {
				evalscript(s);
				//debug ȷ������͵�ǰ�����У������У��С�
				var table1 = obj.parentNode.parentNode.parentNode.parentNode;
				var row1 = table1.insertRow(obj.parentNode.parentNode.rowIndex + 1);
				row1.id = currpmdiv;
				row1.className = 'row';
				var cell1 = row1.insertCell(0);
				cell1.innerHTML = '&nbsp;';
				cell1.className = 'pmmessage';
				var cell2 = row1.insertCell(1);
				cell2.colSpan = '3';
				cell2.innerHTML = s;
				cell2.className = 'pmmessage';

				if(prepmdiv) {
					$(prepmdiv).style.display = 'none';
				}

				changestatus(obj);
				prepmdiv = currpmdiv;
			})
		} else {
			if($(currpmdiv).style.display == 'none') {
				$(currpmdiv).style.display = '';
				changestatus(obj);
				if(prepmdiv) {
					$(prepmdiv).style.display = 'none';
				}
				prepmdiv = currpmdiv;
			} else {
				$(currpmdiv).style.display = 'none';
				prepmdiv = '';
			}
		}
		doane(event);
	}

	</script>
<? } ?>