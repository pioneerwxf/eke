<?php
session_start();
require_once('../global.php');
require_once('admin_login_check.php');

//判断管理权限
	if($_SESSION['admintype']!=1){
		echo ("<script type='text/javascript'> alert('对不起，您没有权限管理!');history.go(-1);</script>");
		exit();
	}
if(!$_POST["name"])
{
  $tblname="t_sys_config";//*************************
  $name=explode("/",$_SERVER["PHP_SELF"]);
  $nowfile=$name[count($name)-1];//取得当前页面名称
  $controller=$_GET['con'];//取得控制器的值
   
if($controller==''||$controller=='list'){//如果控制器为列表
	$sql = "select * from $tblname order by name ASC";//***********************;
	$pageno = $_POST['pageno'];
	$pagesize = NumPerPage;
	$pageurl = $_SERVER["PHP_SELF"];
	$thepager = Pagination($sql, $pageno, $pagesize, $pageurl);
	$smarty = new MySmarty();
	$smarty->template_dir = TEMPLATES_DIR;
	$smarty->assign_by_ref('thepager', $thepager);
	$smarty->assign_by_ref('hiddenstr', $hiddenstr);
	$smarty->assign('addurl',$nowfile);
	//$smarty->assign('title', $title);
	$smarty->display('admin/config_list.htm');//********************************************
}
elseif($controller=='addup')//添加更新控制器
{
		$name = SafeStr($_REQUEST['name']);
		$sql = "select * from $tblname  where name='$name'";//***********************;
		$result=mysql_query($sql);
		$array=mysql_fetch_array($result);
		
		$smarty = new MySmarty();
		$smarty->template_dir = TEMPLATES_DIR;
		
		if (!empty($name)) $item =& GetOneRow($tblname, 'name', $name);//取得一行数据//添加表单
		$form = new HTML_QuickForm('editform', 'post');
		$form->addElement('textarea', 'value', '','cols="45" rows="3",size="53",style="border: 1px solid #C0C0C0"');
		$form->addElement('textarea', 'descrip', '','cols="45" rows="3" size="53",style="border: 1px solid #C0C0C0"');
		if (!is_null($array)) 
		$form->setDefaults($array);

		//添加表单结束
		
		 $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($smarty ); 
		    
		 $form->accept($renderer);
		 $smarty->assign('form_data', $renderer->toArray());
		 if(!empty($name))		 $smarty->assign('name', $array["name"]);
		 elseif(empty($name)) $smarty->assign('name', 0);
		$smarty->display('admin/config.htm');
	}
} else if($_POST["name"])
{
		$name=$_POST["name"];
		$value=$_POST["value"];
		$descrip=$_POST["descrip"];
		
		$sql="update t_sys_config set name='$name',value='$value',descrip='$descrip' where name='$name'";
	if (mysql_query($sql)){
	$opertype=2;$result=0; include("OperLog.php");//记录操作日志
	echo ("<script type='text/javascript'> alert('操作成功!');location.href='config.php';</script>");
	}	
	else{
	$opertype=2;$result=1; include("OperLog.php");//记录操作日志
	echo ("<script type='text/javascript'> alert('数据库操作失败!');history.go(-1);</script>");
	}
}
?>