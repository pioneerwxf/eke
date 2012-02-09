<?php
require_once('../global.php');
require_once('admin_login_check.php');
$tblname="t_basicdata";//*************************
$type = SafeStr($_REQUEST['type']);

if(!$_POST or isset($_POST["act"]))
{
		$sql = "select * from $tblname where type='$type'";//***********************;
		$result=mysql_query($sql);
		$array=mysql_fetch_array($result);
		
		$smarty = new MySmarty();
		$smarty->template_dir = TEMPLATES_DIR;
		
		//if (!empty($id)) $item =& GetOneRow($tblname, 'id', $id);//取得一行数据//添加表单
		$form = new HTML_QuickForm('editform', 'post');

		//添加表单结束
		
		 $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($smarty ); 
		    
		 // build the HTML for the form 生成表单的HTML代码
		 $form->accept($renderer);
		 //assign array with form data 分配表单数据到数组中
		 $smarty->assign('form_data', $renderer->toArray());
		 if($array){
		 	$smarty->assign('id', $array["id"]);
		 	$smarty->assign('content', $array["content"]);
		 	}
		  elseif(!$array){
		 	$smarty->assign('id',0);
		 	$smarty->assign('content', '');
		 	}
		 switch ($type)
			{
			case 'about':$title='About ASES';break;
			case 'contact':$title='Contact Us';break;
			default:$title='Our Infomation';break;
			}
		$smarty->assign('type', $type);
		$smarty->display('admin/profile.htm');
} elseif($_POST and !isset($_POST["act"]))
{
		$id=$_GET["id"];
		$content=$_POST["content"];
		$type=$_POST["type"];
		$addtime=date("Y-m-d");
		if($id)
		$sql="update $tblname set content='$content' where id='$id'";
		elseif($id==0)
		$sql="insert into $tblname (content,addtime,type) values('$content','$addtime','$type')";
		//echo $sql;
		if (mysql_query($sql)){
		$opertype=14;$result=0; include("OperLog.php");//记录操作日志
		echo ("<script type='text/javascript'> alert('操作成功！');location.href='profile.php?type=$type';</script>");
		}
	else{
		$opertype=14;$result=1; include("OperLog.php");//记录操作日志
		echo ("<script type='text/javascript'> alert('数据库操作失败！');history.go(-1);</script>");
	}
}
?>