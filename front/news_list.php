<? $current='h';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>

<div id="left">
  <div class="left_box">
    <h3 align="center">eKe新闻列表</h3>
</div>
  <table width="100%" border="0" align="center" style="border-right:#CCCCCC 1px solid; border-left:#CCCCCC 1px solid; border-bottom:#CCCCCC 1px solid;">
    <?
	$query=query("t_news","type='news' order by value DESC,addtime DESC");
	$news = mysql_fetch_array($query);
	$order=1;
	$rsnum=mysql_num_rows($query);
	if ($rsnum==0){
	echo "暂时没有新闻";
	exit;
	}
	//分页设置
	$i=0;
	$pagesize=10; //每页显示的条数
	include("../include/page_num.php");
	while (($news = mysql_fetch_array($query))&&$i<$pagesize) {
	?>	
	<tr>
      <td width="72%" height="25" style="padding:0px 10px;"><img src="../images/news.gif" alt="" /> <a href="news.php?id=<?=$news["id"]?>" target="_blank"><?=$order?>、<?=cut_str($news["title"],80)?></a></td>
      <td width="28%" style="padding:0px 10px;"><?=$news["addtime"]?></td>
    </tr>
	<?
		$order++;
		$i++;
		}
	?>
  <tr>
	<td style="padding:0px 10px;"><? include("../include/page.php");?></td>
  </tr>
  </table>
  <div class="clear_height" ></div>
</div>
	<? include("right-bar.php");?>
	<? include("footer.php");?>		