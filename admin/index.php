<?php
session_start();
header("content-type: text/html; charset=utf-8");
//include('OperLog.php');
require_once('../global.php');


if ($_POST)
{
	$loginid = SafeStr($_POST['UserName']);
	$pass =  SafeStr($_POST['Password']);
	$sql = "SELECT operid, roleid FROM t_oper where name = '" . $loginid . "' and pass = '".$pass."'";
	$tempRow = $db->getRow($sql);
 	if (!is_null($tempRow)) {
		session_register("adminname");
		session_register("adminid");
		session_register("admintype");

		$_SESSION['adminname'] = $loginid;
		$_SESSION['adminid'] = $tempRow['operid'];
		$_SESSION['admintype'] = $tempRow['roleid'];
		
		$logip=$_SERVER["REMOTE_ADDR"];
		$db->query("update t_oper set logip = '$logip',logtime = '" . date("Y-m-d H:i:s") . "' where name = '$loginid'");
		$opertype=1;$result=0; include("OperLog.php");//记录操作日志
		echo("<script language='JavaScript'>alert('成功登录，欢迎来到管理后台!');window.location='home.php';</script>");
	} 
	else {
		$opertype=1;$result=1; include("OperLog.php");//记录操作日志
		echo("<script language='JavaScript'>alert('错误的用户名密码!');window.location='index.php';</script>");
	}
	exit();
} 
else
{
	$smarty = new MySmarty();
	
	$smarty->template_dir = TEMPLATES_DIR;

	$smarty->display('admin/index.htm');
}
?>
