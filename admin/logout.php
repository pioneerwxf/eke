<?php
session_start();
require_once('../global.php');
$opertype=20;$result=0; include("OperLog.php");//��¼������־
session_unset();
session_destroy();

header("location:index.php");
?>