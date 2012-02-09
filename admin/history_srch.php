<?php
require_once('../global.php');
require_once('admin_login_check.php');
  
//一些基本信息
$tblname="t_search_history";//*************************
$name=explode("/",$_SERVER["PHP_SELF"]);
$nowfile=$name[count($name)-1];//取得当前页面名称
$controller=$_GET['con'];//取得控制器的值

//提取搜索表单传来的参数
$srtime=$_REQUEST["time"];
$keyword=$_REQUEST["keyword"];
$srip=$_REQUEST["ip"];
$type=$_REQUEST["type"];

//搜索语句开始，为了便于分页，讲页码参数存储为session格式-------------------
if(!isset($_POST['pageno'])){
	$sql = "select * from $tblname where type like '%$type%' and srtime like '%$srtime%' and srip like '%$srip%' and keyword like '%$keyword%' order by srtime desc";
	session_register("sql");	//为了分页具有连续性，将sql存储成session格式
	$_SESSION['sql'] = $sql;
}

$sql=$_SESSION['sql'];
//搜索语句结束，为了便于分页，讲页码参数存储为session格式-------------------
	
$pageno = $_POST['pageno'];
$pagesize = NumPerPage;
$pageurl = $_SERVER["PHP_SELF"];
$thepager = Pagination($sql, $pageno, $pagesize, $pageurl);
$smarty = new MySmarty();
$smarty->template_dir = TEMPLATES_DIR;
$smarty->assign_by_ref('thepager', $thepager);
$smarty->assign_by_ref('hiddenstr', $hiddenstr);
$smarty->assign('addurl',$nowfile);
$smarty->display('admin/history_srch_list.htm');//********************************************
?>