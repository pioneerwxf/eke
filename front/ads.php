<?php
if(!isset($_GET["ads"]))
{
	$keywords=array(
						"1"=>"招聘、就业、创业",
						"2"=>"出国、交流",
						"3"=>"管理，经济",
						"4"=>"书籍、图书",
						"5"=>"计算机、软件",
						"6"=>"托福、GRE",
						"7"=>"Google、谷歌",
						"8"=>"英语，外国语，日语",
						"9"=>"浙大、大学、论文"	);
	$i=rand(1,9);
	$key=$keywords[$i];
	$ads= urlencode($keywords[$i]);
	if(isset($_SERVER['QUERY_STRING']) and $_SERVER['QUERY_STRING'])
		$url="http://".$_SERVER ['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."&ads=".$ads; 
	else
		$url="http://".$_SERVER ['HTTP_HOST'].$_SERVER['PHP_SELF']."?ads=".$ads;
	echo ("<script>window.location='$url';</script>");
}
?>

