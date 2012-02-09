<?php
	//更新已售书籍数目的大小
	$sold_number_sql="select count(*) as number from book where shopid=$shopid and tag=3";
	$sold_number_result=mysql_query($sold_number_sql);
	$sold_number_array=mysql_fetch_array($sold_number_result);
	
	//更新待售书籍数目的大小
	$book_number_sql="select count(*) as number from book where shopid=$shopid and tag>0 and tag<3";
	$book_number_result=mysql_query($book_number_sql);
	$book_number_array=mysql_fetch_array($book_number_result);
	if($sold_number_array)
		$sold_number=$sold_number_array["number"];
	elseif(!$sold_number_array)
		$sold_number=0;
	
	if($book_number_array)
		$book_number=$book_number_array["number"];
	elseif(!$book_number_array)
		$book_number=0;
	$sql_size="update shop set soldnum='$sold_number',booknum='$book_number' where shopid='$shopid'";
	//echo $sql_size;
	if (!mysql_query($sql_size)){
	echo("<script type='text/javascript'>alert('数据库后期操作失败，请删除刚才添加的记录!');history.go(-1);</script>");
	exit();
	}
?>