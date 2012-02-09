<? $current='h';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>
<?
	//导入eke_user里的数据到eke_memebers
	/*$query=query("eke_user","1>0");
	$member=mysql_fetch_array($query);
	while($member)
	{
		$uid=$member["id"];
		$username=$member["user_name"];
		$password=$member["user_psw"];
		$pass=md5($password);
		$email=$member["email"];
		$sql="insert into eke_members (uid,username,password,email) values ('$uid','$username','$pass','$email')";
		if(!mysql_query($sql))
			 echo ("<script type='text/javascript'> alert('数据库操作失败！');history.go(-1);</script>");
		$member=mysql_fetch_array($query);
	}
		echo "<script type='text/javascript'>alert('OK');location.href='myshop.php#adb';</script>";*/
	
	
	//导入eke_user里的数据到shop里
	/*$query=query("eke_user","id>93");
	$member=mysql_fetch_array($query);
	while($member)
	{
		$shopid=$member["id"];
		$shopname=$member["user_shop"];
		$userid=$member["id"];
		$owner=$member["user_name"];
		$phone=$member["contact"];
		$email=$member["email"];
		$adv=$member["intro"];
		$college=$member["college"];
		$booknum=$member["book_number"];
		$sql="insert into shop (shopid,shopname,userid,owner,phone,email,adv,college,booknum) values ('$shopid','$shopname','$userid','$owner','$phone','$email','$adv','$college','$booknum')";
		
		if(!mysql_query($sql))
		{	echo $sql;
			 echo ("<script type='text/javascript'> alert('failed!!!');history.go(-1);</script>");
			 exit;
		}
		$member=mysql_fetch_array($query);
	}
		echo "<script type='text/javascript'>alert('OK');location.href='myshop.php#adb';</script>";*/


	//导入eke_user里的数据到shop里   ,title,author,price0,price1,public,old_degree,sort,info,photo,tag,shopid,userid
	
	$query=query("shop,eke_book","shop.shopname=eke_book.shopname and eke_book.id >568 and eke_book.id<650");
	$book=mysql_fetch_array($query);
	while($book)
	{  if(isset($book[bookname]))
			$bookname=$book[bookname];
		else $bookname=NULL;
		if(isset($book[publisher]))
			$pub=$book[publisher];
		else $pub=NUll;
		$sql="insert into book (bookid,title,author,price0,price1,public,old_degree,sort,info,tag,shopid,userid) values ('$book[id]','$bookname','$book[author]','$book[price_before]','$book[price_now]','$pub','$book[new_degree]','$book[sort]','$book[other_info]','1','$book[shopid]','$book[userid]')";
	
	if(!mysql_query($sql))
		{	echo $sql;
			 echo ("<script type='text/javascript'> alert('failed!!!');history.go(-1);</script>");
			 exit;
		}
	$book=mysql_fetch_array($query);
	}
	
	
	
?>