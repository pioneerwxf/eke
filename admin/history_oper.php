<?php
session_start();
require_once('../global.php');
require_once('admin_login_check.php');
  
//一些基本信息
$tblname="t_operlog";//*************************
$name=explode("/",$_SERVER["PHP_SELF"]);
$nowfile=$name[count($name)-1];//取得当前页面名称
$controller=$_GET['con'];//取得控制器的值

//按倒叙取出操作日志的列表
$name=$_REQUEST["name"];
$optime=$_REQUEST["time"];
$ip=$_REQUEST["ip"];
$opertype=$_REQUEST["opertype"];

if(!isset($_POST['pageno'])){
	if(empty($opertype))
		$sql = "select * from $tblname,t_oper where $tblname.operid=t_oper.operid and name like '%$name%' and optime like '%$optime%' and ip like '%$ip%' order by optime desc";
	else
		$sql = "select * from $tblname,t_oper where $tblname.operid=t_oper.operid and name like '%$name%' and optime like '%$optime%' and ip like '%$ip%' and opertype='$opertype' order by optime desc";

	session_register("sql");	//为了分页具有连续性，将sql存储成session格式
	$_SESSION['sql'] = $sql;
}

$sql=$_SESSION['sql'];
$pageno = $_POST['pageno'];
$pagesize = NumPerPage;
$pageurl = $_SERVER["PHP_SELF"];
$thepager = Pagination($sql, $pageno, $pagesize, $pageurl);
$smarty = new MySmarty();
$smarty->template_dir = TEMPLATES_DIR;
$smarty->assign_by_ref('thepager', $thepager);
$smarty->assign_by_ref('hiddenstr', $hiddenstr);
$smarty->assign('addurl',$nowfile);
$smarty->display('admin/history_oper_list.htm');//********************************************
?>