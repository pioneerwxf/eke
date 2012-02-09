<div class="left_articles">
<p>
<img src="../images/notice.gif" alt="" />公告：<MARQUEE id=cl onmouseover=cl.stop() onmouseout=cl.start() 
            scrollAmount=2 scrollDelay=100 direction=left width=550 style=" margin-left:10px; color:#F63;">
			<? 			
			$query=query("eke_announcements","1>0 order by starttime DESC limit 1");
			$array = mysql_fetch_array($query);
			for($i=1;$array and $i<=5;$i++){
			?>
			<a style="color:#F63;" href="forum.php?url=announcement.php?id=<?=$array["id"]?>"><?=$array["subject"]?></a><br />
			<? $array = mysql_fetch_array($query);}?>  
</MARQUEE>
			  </p>
</div>