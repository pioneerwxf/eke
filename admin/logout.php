<?php
session_start();
require_once('../global.php');
$opertype=20;$result=0; include("OperLog.php");//记录操作日志
session_unset();
session_destroy();

header("location:index.php");
?>