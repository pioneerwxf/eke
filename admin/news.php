<?php
require_once('../global.php');
require_once('admin_login_check.php');
$tblname="t_news";//*************************
$name=explode("/",$_SERVER["PHP_SELF"]);
$nowfile=$name[count($name)-1];//取得当前页面名称
$controller=$_GET['con'];//取得控制器的值
$type = SafeStr($_REQUEST['type']);

if ($type=='news')
	$page_title='新闻';
elseif($type=='index')
	$page_title='首页简介显示';
if(!$_POST["title"] or isset($_POST["act"]))
{
if($controller==''||$controller=='list'){//如果控制器为列表
	
	if ($_POST['act'] == 'delete') {
		$sql = "delete from $tblname where id in (" . GetChkBoxValue($_POST['nid']) . ")";
		$db->query($sql);
		$opertype=13;$result=0; include("OperLog.php");//记录操作日志
	}
	$sql = "select * from $tblname where value>=0 and type='$type' order by id desc";
	
	$pageno = $_POST['pageno'];
	$pagesize = NumPerPage;
	$pageurl = $_SERVER["PHP_SELF"]."?type=".$type;
	$thepager = Pagination($sql, $pageno, $pagesize, $pageurl);
	$smarty = new MySmarty();
	$smarty->template_dir = TEMPLATES_DIR;
	$smarty->assign_by_ref('thepager', $thepager);
	$smarty->assign_by_ref('hiddenstr', $hiddenstr);
	$smarty->assign('addurl',$nowfile);
	$smarty->assign('page_title',$page_title);
	$smarty->assign('type',$type);
	$smarty->display('admin/admin_news_list.htm');//********************************************

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
		$form->addElement('text', 'title', '1111111','size="53",style="border: 1px solid #C0C0C0"');
		$selectElement = $form->createElement('select', 'value', '22');
		$selectElement->loadArray($arrQz);
		$form->addElement($selectElement);
		if (!is_null($item)) 
		$form->setDefaults($item);

		//添加表单结束
		
		 $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($smarty ); 
		    
		 // build the HTML for the form 生成表单的HTML代码
		 $form->accept($renderer);
		 //assign array with form data 分配表单数据到数组中
		 $smarty->assign('form_data', $renderer->toArray());
		 $smarty->assign('type',$type);
		 $smarty->assign('content', $array["content"]);
		 if(!empty($id))		 $smarty->assign('id', $array["id"]);
		 elseif(empty($id)) $smarty->assign('id', 0);
		$smarty->display('admin/news.htm');
	}
} else if($_POST["title"] and !isset($_POST["act"]))
{
		$id=$_GET["id"];
		$content=$_POST["content"];
		$title=$_POST["title"];
		$value=$_POST["value"];
		$type=$_POST["type"];
		$addtime=date("Y-m-d");
		if(!empty($id))
		$sql="update t_news set title='$title',value='$value',content='$content' where id='$id'";
		elseif(empty($id))
		$sql="insert into t_news (title,content,value,addtime,type) values ('$title','$content','$value','$addtime','$type')";
		//echo $sql;
	if (mysql_query($sql)){
		$opertype=12;$result=0; include("OperLog.php");//记录操作日志
		echo ("<script type='text/javascript'> alert('操作成功！');location.href='news.php?type=$type';</script>");
		}
	else{
		$opertype=12;$result=1; include("OperLog.php");//记录操作日志
		echo ("<script type='text/javascript'> alert('数据库操作失败！');history.go(-1);</script>");
	}
}
?>