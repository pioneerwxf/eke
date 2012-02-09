<? $current='h';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>
<?php
$name=$_POST["name"];
//$school=$_POST["school"];
$tele=$_POST["tele"];
$email=$_POST["email"];
$content=$_POST["content"];
$date=date("Y-m-d");
$tag=0;
$sql="insert into t_qalist (name,email,tele,content,date,tag) values ('$name','$email','$tele','$content','$date','$tag')";
//echo $sql;
if (mysql_query($sql))
echo ("<script type='text/javascript'> alert('非常感谢您的留言，我们会尽快回复您');location.href='contact.php';</script>");

else{
echo ("<script type='text/javascript'> alert('Database Failed');history.go(-1);</script>");
}

?>