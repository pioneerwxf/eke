<?
	$path=$_SERVER["PHP_SELF"]; 
	if(isset($_GET["page"]))
		$page=$_GET["page"];
	else $page=1;
	$pagecount=ceil($rsnum/$pagesize);
	if($page>$pagecount) $page=$pagecount;
	mysql_data_seek($query,($page-1)*$pagesize);
	return $page;
?>