<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
	<? if(!empty($jsmenu) && (empty($bbclosed) || $adminid == 1)) { include template('jsmenu'); } ?>
	<div id="ad_footerbanner1"></div><div id="ad_footerbanner2"></div><div id="ad_footerbanner3"></div>
</div>
<div id="footer">
	<div class="wrap">
		<div id="footlinks">
			<p>当前时区 GMT<?=$timenow['offset']?>, 现在时间是 <?=$timenow['time']?><? if($icp) { ?> <a href="http://www.miibeian.gov.cn/" target="_blank"><?=$icp?></a><? } ?></p>
			<p>
				<a href="member.php?action=clearcookies&amp;formhash=<?=FORMHASH?>">清除 Cookies</a>
				- <a href="mailto:<?=$adminemail?>">联系我们</a> - <a href="<?=$siteurl?>" target="_blank"><?=$sitename?></a>
				<? if($archiverstatus) { ?> - <a href="archiver/" target="_blank">Archiver</a><? } ?>
				<? if($wapstatus) { ?> - <a href="wap/" target="_blank">WAP</a><? } ?>
				- <span class="scrolltop" onclick="window.scrollTo(0,0);">TOP</span>
				<? if(!empty($stylejumpstatus)) { ?>
					- <span id="styleswitcher" class="dropmenu" onmouseover="showMenu(this.id)">界面风格</span>
					<script type="text/javascript">
					function setstyle(styleid) {
					<? if(CURSCRIPT == 'forumdisplay') { ?>
						location.href = 'forumdisplay.php?fid=<?=$fid?>&page=<?=$page?>&styleid=' + styleid;
					<? } elseif(CURSCRIPT == 'viewthread') { ?>
						location.href = 'viewthread.php?tid=<?=$tid?>&page=<?=$page?>&styleid=' + styleid;
					<? } else { ?>
						location.href = '<?=$indexname?>?styleid=' + styleid;
					<? } ?>
					}
					</script>
					<ul id="styleswitcher_menu" class="popupmenu_popup" style="display: none;"><? if(is_array($stylejump)) { foreach($stylejump as $id => $name) { ?><li<? if($id == $styleid) { ?> class="current"<? } ?>><a href="###" onclick="setstyle(<?=$id?>)"><?=$name?></a></li><? } } ?></ul>
				<? } ?>
			</p>
		</div>

		<a href="http://www.discuz.net" target="_blank" title="Powered by Discuz!"><img src="<?=IMGDIR?>/discuz_icon.gif" border="0" alt="Discuz!" /></a>
		<p id="copyright">
			Powered by <strong><a href="http://www.discuz.net" target="_blank">Discuz!</a></strong> <em><?=$version?></em><? if(!empty($boardlicensed)) { ?> <a href="http://www.discuz.com/index.php?action=certificate&amp;host=<?=$_SERVER['HTTP_HOST']?>" target="_blank">Licensed</a><? } ?>
			&copy; 2001-2007 <a href="http://www.comsenz.com" target="_blank">Comsenz Inc.</a>
		</p><? updatesession(); if(debuginfo()) { ?>
			<p id="debuginfo">Processed in <?=$debuginfo['time']?> second(s), <?=$debuginfo['queries']?> queries<? if($gzipcompress) { ?>, Gzip enabled<? } ?>.</p>
		<? } ?>
	</div>
</div>
<? if($_DCACHE['settings']['frameon'] && in_array(CURSCRIPT, array('index', 'forumdisplay', 'viewthread')) && $_DCOOKIE['frameon'] == 'yes') { ?>
	<script src="include/javascript/iframe.js" type="text/javascript"></script>
<? } output(); ?></body>
</html>