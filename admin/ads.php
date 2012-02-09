<?php
require_once('../global.php');
require_once('admin_login_check.php');
$tblname="t_ads";//*************************

if(!$_POST["type"] or isset($_POST["act"]))
{
  $type=$_GET["type"];//获得新闻页面的类型
  $name=explode("/",$_SERVER["PHP_SELF"]);
  $nowfile=$name[count($name)-1];//取得当前页面名称
  $controller=$_GET['con'];//取得控制器的值
  
 		switch ($type)
			{
			case 'top_pic':$title='首页滚动图片';break;
			case 'foot_pic':$title='页脚图片链接';break;
			case 'foot_text':$title='首页文字链接';break;
			case 'frd_link':$title='友情链接';break;
			default:$title='链接';break;
			}
 
if($controller==''||$controller=='list'){//如果控制器为列表
	
	if ($_POST['act'] == 'delete') {
		$sql = "delete from $tblname where id in (" . GetChkBoxValue($_POST['nid']) . ")";//*************************************************
		$db->query($sql);
	}
		$sql = "select * from $tblname where value>=0 and type='$type' order by value desc, id desc";//***********************;
	
	$pageno = $_POST['pageno'];
	$pagesize = NumPerPage;
	$pageurl = $_SERVER["PHP_SELF"]."?type=".$type;
	$thepager = Pagination($sql, $pageno, $pagesize, $pageurl);
	$smarty = new MySmarty();
	$smarty->template_dir = TEMPLATES_DIR;
	$smarty->assign_by_ref('thepager', $thepager);
	$smarty->assign_by_ref('hiddenstr', $hiddenstr);
	$smarty->assign('addurl',$nowfile);
	$smarty->assign('title', $title);
	$smarty->assign('type', $type);
	$smarty->display('admin/admin_ads_list.htm');//********************************************

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
		$form->addElement('text', 'title', '','size="53",style="border: 1px solid #C0C0C0"');
		$form->addElement('file', 'Myfile', '','size="53",style="border: 1px solid #C0C0C0"');
		$form->addElement('text', 'link', 'http://','size="53",style="border: 1px solid #C0C0C0"');
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
		 $smarty->assign('title', $title);
		 $smarty->assign('type', $type);
		 if($array["pic"])
		 	$smarty->assign('pic', $array["pic"]);
		 elseif(!$array["pic"])
		     	$smarty->assign('pic', '0');
		 if(!empty($id))		 $smarty->assign('id', $array["id"]);
		 elseif(empty($id)) $smarty->assign('id', 0);
		$smarty->display('admin/ads.htm');
	}
} else if($_POST["type"] and !isset($_POST["act"]))
{
		$id=$_GET["id"];
		$title=$_POST["title"];
		$link=$_POST["link"];
		$value=$_POST["value"];
		$type=$_POST["type"];
		
		//图片上传
		$f=$_FILES['Myfile'];
		if($f)
		{
		$dest_dir='file/pic/';//设定上传目录
		//取文件的后缀
		$oldname=$_FILES['Myfile']['name'];
		$temp=strrpos($oldname,"."); 
		$temp1=strlen($oldname); 
		$temp2=substr($oldname,$temp+1,$temp1); 
		
		
		$dest=$dest_dir.'/'.date("ymdhis").".".$temp2;//设置文件名为日期加上文件名避免重复
		$filename=date("ymdhis").".".$temp2;//重新组合文件名
		$r=move_uploaded_file($f['tmp_name'],$dest);
		if(!$temp2)
		$filename=0;
		}
		//图片上传完毕
		$addtime=date("Y-m-d");
		if(!empty($id) and $filename==0){
		$sql="update $tblname set title='$title',value='$value',link='$link' where id='$id'";
		}
		elseif(!empty($id) and $filename!=0){
		$sql="update $tblname set title='$title',value='$value',pic='$filename',link='$link' where id='$id'";
		}
		elseif(empty($id))
		$sql="insert into $tblname (title,pic,link,value,addtime,type) values('$title','$filename','$link','$value','$addtime','$type')";
		//echo $sql;
		if (mysql_query($sql))
	echo ("<script type='text/javascript'> alert('操作成功！');location.href='ads.php?type=$type';</script>");
	
	else{
	echo ("<script type='text/javascript'> alert('数据库操作失败！');history.go(-1);</script>");
	}
}
?>