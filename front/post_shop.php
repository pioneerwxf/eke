<? $current='m';?>
<? include("../include/dbconnect.php");?>
<?
	if(isset($_GET["shopid"]) and $_GET["shopid"] )
	{
		 $shopid=$_GET["shopid"];
		$shopname=$_POST["shopname"];
		$owner=$_POST["owner"];
		$phone=$_POST["phone"];
		$email=$_POST["email"];
		$adv=$_POST["adv"];
		$college=$_POST["college"];
		$poster=$_POST["poster"];
		
		//图片上传
		$f=$_FILES['Posterfile'];
		if($f)
		{
		$dest_dir='./banner';//设定上传目录
		//取文件的后缀
		$oldname=$_FILES['Posterfile']['name'];
		$temp=strrpos($oldname,"."); 
		$temp1=strlen($oldname); 
		$temp2=substr($oldname,$temp+1,$temp1); 
		$dest=$dest_dir.'/'.date("ymdhis").".".$temp2;//设置文件名为日期加上文件名避免重复
		$filename=date("ymdhis").".".$temp2;//重新组合文件名
		$r=move_uploaded_file($f['tmp_name'],$dest);
		if(!$temp2)
		$filename=0;
		}
		//图片上传完毕
		if($filename){	//如果上传了文件就将海报路径写成服务器下的地址
			$poster=$filename;
		}
		$sql="update shop set shopname='$shopname',owner='$owner',phone='$phone',email='$email',poster='$poster',adv='$adv',college='$college' where shopid=$shopid ";
		if(mysql_query($sql))
		echo "<script type='text/javascript'>alert('书店设置完毕！');location.href='myshop.php';</script>";
		else echo ("<script type='text/javascript'> alert('数据库操作失败！');history.go(-1);</script>");
	}
?>