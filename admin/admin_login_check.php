<?php
error_reporting(E_ERROR);
session_start();

if (empty($_SESSION['adminname']) || !isset($_SESSION['adminname']) ) {

	header("location:index.php");
} else {
	
	//var_dump($sql);
	//$roleid=$_SESSION['admintype'];
	//$url=$_SERVER['PHP_SELF'];
	//$sql="select id from cu_node where url='$url' and id in (select nodeid from cu_limit where roleid=$roleid)";
	//$nodeid= $db->getOne($sql);
	//var_dump($nodeid);
//	if(empty($nodeid))
//	header("location:nolimits.htm");
}
?>