<?php
require_once('../global.php');
require_once('admin_login_check.php');
  
//一些基本信息
$tblname="order";//*************************
$name=explode("/",$_SERVER["PHP_SELF"]);
$nowfile=$name[count($name)-1];//取得当前页面名称
$controller=$_GET['con'];//取得控制器的值

//提取搜索表单传来的参数
$date=$_REQUEST["date"];
$user=$_REQUEST["user"];
$tag=$_REQUEST["tag"];

//搜索语句开始，为了便于分页，讲页码参数存储为session格式-------------------
if(!isset($_POST['pageno'])){
	if(!empty($tag))
		$sql = "select * from eke.order,book where bid=bookid and eke.order.date like '%$date%' and user like '%$user%' and eke.order.tag='$tag' order by eke.order.orderid desc";
	elseif(empty($tag))
		$sql = "select * from eke.order,book where bid=bookid and eke.order.date like '%$date%' and user like '%$user%' order by eke.order.orderid desc";
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
$smarty->display('admin/history_sell_list.htm');//********************************************
?>