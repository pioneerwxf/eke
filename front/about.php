<? $current='h';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>
<div id="left">
  <div class="left_articles">
    <h3>关于我们</h3>
	<div class="notes">
	    了解eKe，了解我们
	</div>
<div class="clear_height" ></div>
	<?
		$query=query("t_basicdata","type='about'");
		$data = mysql_fetch_array($query);
		if($data) echo $data["content"];
		?>
  </div>
<div class="clear_height" ></div>
</div>
	<? include("right-bar.php");?>
	<? include("footer.php");?>		
