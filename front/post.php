<?	  
	include("../bbs/include/common.inc.php");
	include("../include/function.php");
?>
<?
	
	if(isset($_GET["action"]) and $_GET["action"]=='adb' )
	{
		
		$shopid=$_GET["shopid"];
		$userid=$discuz_uid;
		$tag=1;//代表正在出售，3代表已售，2代表有人预定
		$title=$_POST["title"];
		$author=$_POST["author"];
		$price0=$_POST["price0"];
		$price1=$_POST["price1"];
		$public=$_POST["public"];
		$old_degree=$_POST["old_degree"];
		$sort=$_POST["sort"];
		$info=$_POST["info"];
		$date=date("Y-m-d H:i:s");
		$level=0;//代表正常书籍
		//提取照片
		if($title=='' or $price1=='')
			echo ("<script type='text/javascript'> alert('忘了填写书名或售价了吧！');history.go(-1);</script>");
		else{
		$f=$HTTP_POST_FILES['photo'];
			if($f)
			{
			$dest_dir='../file/photo';//设定上传目录
			//取文件的后缀
			$oldname=$_FILES['photo']['name'];
			$temp=strrpos($oldname,"."); 
			$temp1=strlen($oldname); 
			$temp2=substr($oldname,$temp+1,$temp1); 
			
			$dest=$dest_dir.'/'.date("ymdhis").".".$temp2;//设置文件名为日期加上文件名避免重复
			$photo=date("ymdhis").".".$temp2;//重新组合文件名
			$r=move_uploaded_file($f['tmp_name'],$dest);
			}
			
			if($temp2=='0')
			$photo=0;
			$sql="insert into book(title,author,price0,price1,public,sort,old_degree,info,level,date,tag,shopid,userid) values ('$title','$author','$price0','$price1','$public','$sort','$old_degree','$info','$level','$date','$tag','$shopid','$userid')";
			$shopupdate="update shop set booknum=booknum+1 where shopid=$shopid";
			if(mysql_query($sql) and mysql_query($shopupdate))
			echo "<script type='text/javascript'>alert('OK,Thanks!');location.href='myshop.php#adb';</script>";
			else echo ("<script type='text/javascript'> alert('Database Failed！');history.go(-1);</script>");
		}
}
?>
