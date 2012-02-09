<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div class="msgtabs">

<? if($type == 'orig') { ?>
	<strong> 发起的活动 &#8212; <? if($ended == '') { ?>全部活动<? } elseif($ended == 'no') { ?>未结束的活动<? } elseif($ended == 'yes') { ?>已结束的活动<? } ?></strong>
<? } elseif($type == 'apply') { ?>
	<strong>申请的活动 &#8212; <? if($ended == '') { ?>全部活动<? } elseif($ended == 'no') { ?>未结束的活动<? } elseif($ended == 'yes') { ?>已结束的活动<? } ?></strong>
<? } ?>
</div>






<table cellspacing="0" cellpadding="0" width="100%" align="center">
<? if($type == 'orig') { ?>
		<thead>
		<tr>
		<td>活动名称</td>
		<td>开始时间</td>
		<td>活动地点</td>
		<td>每人花销</td>
		<td>征集截止</td>
		</tr>
		</thead>
		
		<tbody>
		<? if($activity) { if(is_array($activity)) { foreach($activity as $value) { ?>				<tr>
				<td><? if($thread['displayorder'] >= 0) { ?><a href="viewthread.php?tid=<?=$value['tid']?>" target="_black"><?=$value['subject']?></a><? } else { ?><?=$value['subject']?><? } ?></td>
				<td><?=$value['starttimefrom']?></td>
				<td><?=$value['place']?></td>
				<td><?=$value['cost']?></td>
				<td><? if($value['expiration']) { ?>已截止<? } else { ?>未截止<? } ?></td>
				</tr>
			<? } } } else { ?>
			<tr><td>目前没有活动记录。</td></tr>
		<? } ?>
		</tbody>
<? } else { ?>
	<thead>
	<tr>
	<td>活动名称</td>
	<td>开始时间</td>
	<td>活动地点</td>
	<td>每人花销</td>
	<td>批准状态</td>
	</tr>
	</thead>
	
	<tbody>
	<? if($activity) { if(is_array($activity)) { foreach($activity as $value) { ?>			<tr>
			<td><? if($thread['displayorder'] >= 0) { ?><a href="viewthread.php?tid=<?=$value['tid']?>" target="_black"><?=$value['subject']?></a><? } else { ?><?=$value['subject']?><? } ?></td>
			<td><?=$value['starttimefrom']?></td>
			<td><?=$value['place']?></td>
			<td><?=$value['cost']?></td>
			<td><? if($value['verified']) { ?>已批准<? } else { ?>未批准<? } ?></td>
			</tr>
		<? } } } else { ?>
		<tr><td colspan="5">目前没有活动记录。</td></tr>
	<? } ?>
	</tbody>
<? } ?>
</table>