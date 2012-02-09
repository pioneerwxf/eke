<?php
session_start();
require_once('../global.php');
require_once('admin_login_check.php');
//一些基本信息
$tblname="t_oper";//*************************
$name=explode("/",$_SERVER["PHP_SELF"]);
$nowfile=$name[count($name)-1];//取得当前页面名称
$controller=$_GET['con'];//取得控制器的值
//取出是否删除
//取出管理员的类别
$delflag=SafeStr($_REQUEST['delflag']);
$roleid=SafeStr($_REQUEST['roleid']);

//判断管理权限
if($_SESSION['admintype']!=1 and $roleid<=$_SESSION['admintype']){
	echo ("<script type='text/javascript'> alert('对不起，您没有权限管理!');history.go(-1);</script>");
	exit();
}
	
//一、显示列表页面开始---------------------------------------------------------------
if($controller==''||$controller=='list'){
	///删除语句	
	if ($_POST['act'] == 'delete') {
		$sql = "update $tblname set delflag='1' where operid in (" . GetChkBoxValue($_POST['nid']) . ")";
		$db->query($sql);
		$opertype=4;$result=0; include("OperLog.php");//记录操作日志
	}
	
	//取出数据列表语句
	if(!empty($roleid))
	$sql = "select * from $tblname where delflag='$delflag' and roleid='$roleid' order by operid ASC";//***********************;
	else $sql = "select * from $tblname where delflag='$delflag' order by operid ASC";
	
	//页码的配置语句
	$pageno = $_POST['pageno'];
	$pagesize = NumPerPage;
	$pageurl = $_SERVER["PHP_SELF"]."?delflag=".$delflag."&roleid=".$roleid;
	$thepager = Pagination($sql, $pageno, $pagesize, $pageurl);
	
	//设置新的smarty类
	$smarty = new MySmarty();
	$smarty->template_dir = TEMPLATES_DIR;
	$smarty->assign_by_ref('thepager', $thepager);
	$smarty->assign_by_ref('hiddenstr', $hiddenstr);
	$smarty->assign('roleid', $roleid);
	$smarty->assign('delflag', $delflag);

	switch ($roleid)
			{
			case '1':$title='系统管理员';break;
			case '2':$title='网站管理员';break;
			case '3':$title='内容管理员';break;
			default:$title='已删除操作员';break;
			}
	$smarty->assign('title',$title);//定义页面标题
	$smarty->assign('addurl',$nowfile);
	$smarty->display('admin/admin_list.htm');//显示列表页面
}
//显示列表页面结束---------------------------------------------------------------



//二、显示具体页面开始---------------------------------------------------------------
elseif($controller=='addup')//添加更新控制器
{
	$operid = SafeStr($_REQUEST['operid']);
	//添加表单开始------------------------------------------------
	if (!empty($operid)) $item =& GetOneRow($tblname, 'operid', $operid);//取得一行数据
	$form = new HTML_QuickForm('Form1', 'post', $nowfile."?con=addup");
	$form->addElement('text', 'name', '','size="25",style="border: 1px solid #C0C0C0"');
	$form->addElement('text', 'pass', '','size="25",style="border: 1px solid #C0C0C0"');
	if (!is_null($item)) {
	$form->setDefaults($item);
	$act='update';
	$title='编辑信息';
	}
	else
	{	$act='add';
		$title='添加新信息';
	}
	
	//新建smarty模板
	$smarty = new MySmarty();
	$smarty->template_dir = TEMPLATES_DIR;
	$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($smarty);
	$form->accept($renderer);
	
	//传递页面参数
	$smarty->assign('operid', $operid);
	$smarty->assign('roleid', $roleid);
	$smarty->assign('delflag', $delflag);
	$smarty->assign('act', $act);
	$smarty->assign('title',$title);
	
	//传递表单参数
	$smarty->assign('crtime',$item["crtime"]);
	$smarty->assign('croperid',$item["croperid"]);
	$smarty->assign('modtime',$item["modtime"]);
	$smarty->assign('modoperid',$item["modoperid"]);
	$smarty->assign('logtime',$item["logtime"]);
	$smarty->assign('logip',$item["logip"]);
	if($_SESSION['admintype']==1 and $operid!=1)
		$smarty->assign('role_options', array(
			'1' => '系统管理员',
			'2' => '网站管理员',
			'3' => '内容管理员'));
	elseif($_SESSION['admintype']==1 and $operid==1)
		$smarty->assign('role_options', array(
			'1' => '系统管理员'));
	elseif($_SESSION['admintype']==2)
		$smarty->assign('role_options', array(
			'3' => '内容管理员'));
	$smarty->assign('roleid_now', $item["roleid"]);
	$smarty->assign_by_ref('form_data', $renderer->toArray());
	$smarty->display('admin/admin.htm');	
}
//显示具体页面结束---------------------------------------------------------------



//三、更新数据开始---------------------------------------------------------------
if (($_POST['act'] == 'add'||$_POST['act'] == 'update') && $form->validate()) {
	//取得表单的数据
	$name=$_POST["name"];
	$pass=$_POST["pass"];
	$role_id=$_POST["role_id"];
	$crtime=date("Y-m-d H:i:s");
	$modtime=date("Y-m-d H:i:s");
	$croperid=$_SESSION['adminid'];
	$modoperid=$_SESSION['adminid'];
		
	//决定是更新还是插入数据
	if (!is_null($operid) && !empty($operid)) {//更新
		$tblValues = array(	"name" => $name,
				"pass" => $pass,
				"roleid" => $role_id,
				"modtime" => $modtime,
				"modoperid" => $modoperid,
				"delflag" => '0',
				);
		DBExecute($tblname, $tblValues, DB_AUTOQUERY_UPDATE, "operid = $operid");
		$opertype=5;$result=0; include("OperLog.php");//记录操作日志
	} 
	else {//插入数据
		//检查用户名是否重复
		$checkname="select * from $tblname where name='$name'";
		if(mysql_fetch_array(mysql_query($checkname))){
			echo ("<script type='text/javascript'> alert('该管理员名字已经被用，请选择其他名字!');history.go(-1);</script>");
			exit();
		}
		
		$sql="insert into $tblname (name,pass,roleid,crtime,croperid,modtime,modoperid,delflag) 
		values ('$name','$pass','$role_id','$crtime','$croperid','$modtime','$modoperid','0')";
		
		if (!mysql_query($sql)){
		$opertype=3;$result=1; include("OperLog.php");//记录操作日志
		echo ("<script type='text/javascript'> alert('数据库操作失败');history.go(-1);</script>");
		exit();
		}
		else{
			$opertype=3;$result=0; include("OperLog.php");//记录操作日志
		}
	}
	if($delflag==0)
	echo("<script>window.location='".$nowfile."?con=list&roleid=".$roleid."&delflag=".$delflag."';</script>");
	else echo("<script>window.location='".$nowfile."?con=list&delflag=1';</script>");
}
?>