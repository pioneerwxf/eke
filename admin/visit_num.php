<?php
require_once('../global.php');
require_once('admin_login_check.php');
  
  $tblname="visit_number";//*************************
  $name=explode("/",$_SERVER["PHP_SELF"]);
  $nowfile=$name[count($name)-1];//取得当前页面名称
  $controller=$_GET['con'];//取得控制器的值
  

		$sql = "select * from $tblname  order by id desc";//***********************;
	
	$pageno = $_POST['pageno'];
	$pagesize = NumPerPage;
	$pageurl = $_SERVER["PHP_SELF"];
	$thepager = Pagination($sql, $pageno, $pagesize, $pageurl);
	$smarty = new MySmarty();
	$smarty->template_dir = TEMPLATES_DIR;
	$smarty->assign_by_ref('thepager', $thepager);
	$smarty->assign_by_ref('hiddenstr', $hiddenstr);
	$smarty->assign('addurl',$nowfile);
	$smarty->display('admin/visit_num_list.htm');//********************************************
?>