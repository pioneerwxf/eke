<?php
require_once('../global.php');
require_once('admin_login_check.php');
$tblname="t_qalist";//*************************

if(!$_POST["reply"] or isset($_POST["act"]))
{
  $name=explode("/",$_SERVER["PHP_SELF"]);
  $nowfile=$name[count($name)-1];//取得当前页面名称
  $controller=$_GET['con'];//取得控制器的值
  

if($controller==''||$controller=='list'){//如果控制器为列表
	
	if ($_POST['act'] == 'delete') {
		$sql = "delete from $tblname where id in (" . GetChkBoxValue($_POST['nid']) . ")";//*************************************************
		$db->query($sql);
	}
		$sql = "select * from $tblname order by id desc";//***********************;
	
	$pageno = $_POST['pageno'];
	$pagesize = NumPerPage;
	$pageurl = $_SERVER["PHP_SELF"];
	$thepager = Pagination($sql, $pageno, $pagesize, $pageurl);
	$smarty = new MySmarty();
	$smarty->template_dir = TEMPLATES_DIR;
	$smarty->assign_by_ref('thepager', $thepager);
	$smarty->assign_by_ref('hiddenstr', $hiddenstr);
	$smarty->assign('addurl',$nowfile);
	$smarty->display('admin/feedback_list.htm');//********************************************

}
elseif($controller=='addup')//添加更新控制器
{
		$id = SafeStr($_REQUEST['id']);
		$sql = "select * from $tblname  where id='$id'";//***********************;
		$result=mysql_query($sql);
		$array=mysql_fetch_array($result);
		
		$smarty = new MySmarty();
		$smarty->template_dir = TEMPLATES_DIR;
		
		if (!empty($id)) $item =& GetOneRow($tblname, 'id', $id);//取得一行数据//添加表单
		$form = new HTML_QuickForm('editform', 'post');
		if (!is_null($item)) 
		$form->setDefaults($item);

		//添加表单结束
		
		 $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($smarty ); 
		    
		 // build the HTML for the form 生成表单的HTML代码
		 $form->accept($renderer);
		 //assign array with form data 分配表单数据到数组中
		 $smarty->assign('form_data', $renderer->toArray());
		 $smarty->assign('school',$array["school"]);
		 $smarty->assign('content',$array["content"]);
		 $smarty->assign('date',$array["date"]);
		 $smarty->assign('email',$array["email"]);
		 $smarty->assign('tele',$array["tele"]);
		 $smarty->assign('name',$array["name"]);
		 $smarty->assign('reply', $array["reply"]);
		 $smarty->assign('id', $array["id"]);
		$smarty->display('admin/feedback.htm');
	}
} else if($_POST["reply"] and !isset($_POST["act"]))
{
		$id=$_GET["id"];
		$reply=$_POST["reply"];
		$reply_date=date("Y-m-d");
		if(!empty($id))
		$sql="update $tblname set reply='$reply',tag='1',reply_date='$reply_date' where id='$id'";
		//echo $sql;
		if (mysql_query($sql))
	echo ("<script type='text/javascript'> alert('回复成功！');location.href='feedback.php';</script>");
	
	else{
	echo ("<script type='text/javascript'> alert('数据库操作失败！');history.go(-1);</script>");
	}
}
?>