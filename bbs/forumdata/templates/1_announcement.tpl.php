<? if(!defined('IN_DISCUZ')) exit('Access Denied'); include template('header'); ?>
<div id="nav"><a href="<?=$indexname?>"><?=$bbname?></a> &raquo; 论坛公告</div>

<script src="include/javascript/viewthread.js" type="text/javascript"></script>
<script type="text/javascript">zoomstatus = parseInt(<?=$zoomstatus?>);</script>

<? if(!empty($multipage)) { ?><div class="pages_btns"><?=$multipage?></div><? } if(is_array($announcelist)) { foreach($announcelist as $announce) { ?>	<div class="box">
	<div class="specialpost" id="<?=$announce['id']?>">
		<div class="postinfo">
			<span style="float: left"><?=$announce['subject']?></span>
			作者: <a href="space.php?username=<?=$announce['authorenc']?>"><?=$announce['author']?></a> &nbsp;
			起始时间: <?=$announce['starttime']?> &nbsp;
			结束时间: <? if($announce['endtime']) { ?><?=$announce['endtime']?><? } else { ?>不限<? } ?>
		</div>
		<div class="postmessage">
			<?=$announce['message']?>
		</div>
	</div>
	</div><? } } if(!empty($multipage)) { ?><div class="pages_btns"><?=$multipage?></div><? } include template('footer'); ?>
