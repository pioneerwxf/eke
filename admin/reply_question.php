<?php
require_once('../global.php');
$id=$_GET["id"];
$reply=$_POST["reply"];
$title=$_POST["title"];
$content=$_POST["content"];
$reply_date=date("Y-m-d");

$sql="update qalist set title='$title',content='$content',reply='$reply',reply_date='$reply_date' where id='$id'";

if (mysql_query($sql))
echo ("<script type='text/javascript'> alert('成功回复！');location.href='answer.php';</script>");

else{
echo ("<script type='text/javascript'> alert('数据库操作失败！');history.go(-1);</script>");
}

?>