<? $current='h';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>

<div id="left">
  <div class="left_box">
    <h3 align="center" style="background:none;"><?
	$id=$_GET["id"];
	$sql = "select * from t_news where id = '$id'";
	$query=mysql_query($sql);
	$news = mysql_fetch_array($query);
	echo $news["title"];
	?></h3>
	<div class="notes">
	  <div align="center">
	    <?=$news["addtime"]?></div>
	</div>
</div>
<table width="100%" border="0" align="center" style="border-right:#CCCCCC 1px solid; border-left:#CCCCCC 1px solid; border-bottom:#CCCCCC 1px solid;">
  <tr>
    <td style="min-height:300px; padding:5px 10px;"><?=$news["content"];?></td>
    </tr>
  <tr>
	  <td><div align="center">
		[<a href="javascript:window.print()">Print</a>]&nbsp;&nbsp;	
		  [<a href="javascript:window.close()">Close</a>]
		  </div>
	  </td>
  </tr>
</table>
<div class="clear_height" ></div>
</div>
	<? include("right-bar.php");?>
	<? include("footer.php");?>		