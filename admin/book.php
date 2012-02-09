<?php
require_once('../global.php');  		//包含全局变量
require_once('admin_login_check.php');	//检查用户是否登录
  
$tblname="book";						//本页面设计的主要数据表
$name=explode("/",$_SERVER["PHP_SELF"]);
$nowfile=$name[count($name)-1];			//取得当前页面名称
$controller=$_GET['con'];				//取得控制器的值，用于控制显示列表还是具体页面
$shopid= SafeStr($_REQUEST['shopid']);//取得上一链接或页面的传进来参数
$tag= SafeStr($_REQUEST['tag']);

//显示列表页面开始----------------------------------------------------------------------------------
if($controller==''||$controller=='list'){	//如果控制器为列表
	//删除一个电影属性信息，直接删
	if ($_POST['act'] == 'delete') { 		
		$sql = "update $tblname set tag='-1' where bookid in (" . GetChkBoxValue($_POST['nid']) . ")";	
		$db->query($sql);
		$opertype=10;$result=0; include("OperLog.php");//记录删除影片成功操作日志
		//更新藏书量的大小
		include("UpdateSize.php");
	}
	
	//提取搜索表单传来的参数
	$title=$_REQUEST["title"];
	$author=$_REQUEST["author"];
	$date=$_REQUEST["time"];
	
	//搜索语句开始，为了便于分页，讲页码参数存储为session格式-------------------
if(!isset($_POST['pageno'])){
	if(!empty($shopid)){
		if(!empty($tag))//否者就显示数据列表	
			$sql = "select * from $tblname where tag ='$tag' and shopid='$shopid' and title like '%$title%' and author like '%$author%' and date like '%$date%' order by bookid DESC, title asc";	//否者就显示数据列表	
		elseif(empty($tag))
			$sql = "select * from $tblname where tag>0 and shopid='$shopid' and title like '%$title%' and author like '%$author%' and date like '%$date%' order by bookid DESC, title asc";	//否者就显示数据列表
	}elseif(empty($shopid)){
		if(!empty($tag))//否者就显示数据列表	
			$sql = "select * from $tblname where tag ='$tag' and title like '%$title%' and author like '%$author%' and date like '%$date%' order by bookid DESC, title asc";	//否者就显示数据列表	
		elseif(empty($tag))
			$sql = "select * from $tblname where tag>0 and title like '%$title%' and author like '%$author%' and date like '%$date%' order by bookid DESC, title asc";	
	}
session_register("sql");	//为了分页具有连续性，将sql存储成session格式
$_SESSION['sql'] = $sql;
}
	$sql=$_SESSION['sql'];
	//搜索语句结束，为了便于分页，讲页码参数存储为session格式-------------------
	
	//翻页参数控制start----
	$pageno = $_POST['pageno'];
	$pagesize = NumPerPage;
	$pageurl = $_SERVER["PHP_SELF"]."?shopid=".$shopid;	//返回时的地址
	$thepager = Pagination($sql, $pageno, $pagesize, $pageurl);
	//翻页参数控制end------
	
	//新建smarty模板 start--------------------------------------
	$smarty = new MySmarty();
	$smarty->template_dir = TEMPLATES_DIR;
	$smarty->assign_by_ref('thepager', $thepager);
	
	$shoparray=mysql_fetch_array(mysql_query("select shopname from shop where shopid='$shopid'"));
	if($shoparray)
		$smarty->assign('shopname',$shoparray["shopname"]."书店");
	else	 $smarty->assign('shopname',"全部书店");
	$smarty->assign('shopid',$shopid);	
	$smarty->assign('tag',$tag);		//传递页面间参数
	$smarty->assign('addurl',$nowfile);
	$smarty->display('admin/book_list.htm');//**************
	//新建smarty模板 end------------------------------------------
}
//显示列表页面结束---------------------------------------------------------------------------------

//显示具体页面开始---------------------------------------------------------------------------------
elseif($controller=='addup')//添加更新控制器
{
	$bookid = SafeStr($_REQUEST['bookid']);
	//添加表单**************************************************************************
	if (!empty($bookid)) $item =& GetOneRow($tblname, 'bookid', $bookid);//取得一行数据
		$form = new HTML_QuickForm('Form1', 'post', $nowfile."?con=addup");
		$form->addElement('text', 'title', '','size="20",style="border: 1px solid #C0C0C0"');
		$form->addElement('text', 'shopid', '','size="15",style="border: 1px solid #C0C0C0"');
		$form->addElement('text', 'author', '','size="45",style="border: 1px solid #C0C0C0"');
		$form->addElement('text', 'public', '','size="45",style="border: 1px solid #C0C0C0"');	
		$form->addElement('text', 'price0', '','size="15",style="border: 1px solid #C0C0C0"');	
		$form->addElement('text', 'price1', '','size="15",style="border: 1px solid #C0C0C0"');	
		$form->addElement('text', 'old_degree', '','size="15",style="border: 1px solid #C0C0C0"');	
		$form->addElement('text', 'sort', '','size="15",style="border: 1px solid #C0C0C0"');	
		$form->addElement('text', 'info', '','size="45",style="border: 1px solid #C0C0C0"');	
		$form->addElement('file', 'Myfile', '','size="45",style="border: 1px solid #C0C0C0"');
		if (!is_null($item)) {
		$form->setDefaults($item);
		$act='update';
		$title='编辑信息';
		}
		else
		{	$act='add';
		    $title='添加新信息';
		}
			
	$smarty = new MySmarty();
	$smarty->template_dir = TEMPLATES_DIR;
	$renderer =& new HTML_QuickForm_Renderer_ArraySmarty($smarty);
	$form->accept($renderer);

	//构造tag选项
	$smarty->assign('tag_options', array(
		'-1' => '已删除',
		'1' => '待售',
		'2' => '预定',
		'3' => '已售'));
		$smarty->assign('tag_now', $item["tag"]);
	
	//根据shopid读取所属书店的标题
	$shopid=$item["shopid"];
	$title_sql = "select * from shop where shopid='$shopid'";
	$title_result=mysql_query($title_sql);
	$array_title=mysql_fetch_array($title_result);
	if($array_title)
		$smarty->assign('shopname',$array_title["shopname"]);		//定义页面以及影片的名称
	else $smarty->assign('shopname',"未知书店");	
	
	$smarty->assign('date',$item["date"]);
	$smarty->assign('tag', $tag);
	$smarty->assign('act', $act);
	$smarty->assign('bookid', $bookid);
	$smarty->assign('title', $item["title"]);
	
	$smarty->assign_by_ref('form_data', $renderer->toArray());
	$smarty->display('admin/book.htm');//**************************************
	//添加表单结束**************************************************************************
}
//显示具体页面结束---------------------------------------------------------------------------------

//更新数据开始---------------------------------------------------------------------
	if (($_POST['act'] == 'add'||$_POST['act'] == 'update') && $form->validate()) {
			$bookid=$_POST['bookid'];
			$title=$_POST['title'];
			$author=$_POST['author'];
			$public=$_POST['public'];
			$price0=$_POST['price0'];
			$price1=$_POST['price1'];
			$old_degree=$_POST['old_degree'];
			$sort=$_POST['sort'];
			$shopid=$_POST['shopid'];
			$tag_now=$_POST['tag_now'];
			$info=$_POST['info'];
			
			//读取文件BT文件路径
			$f=$_FILES['Myfile'];
			if($f)
			{
			$dest_dir='../file/banner/';//设定上传目录
			//取文件的后缀
			$oldname=$_FILES['Myfile']['name'];
			$temp=strrpos($oldname,"."); 
			$temp1=strlen($oldname); 
			$temp2=substr($oldname,$temp+1,$temp1); 
			
			$dest=$dest_dir.'/'."bt".date("ymdhis").".".$temp2;//设置文件名为日期加上文件名避免重复
			$filename="bt".date("ymdhis").".".$temp2;//重新组合文件名
			$r=move_uploaded_file($f['tmp_name'],$dest);
			if(!$temp2)
			$filename=0;
			}

		if (!is_null($bookid) && !empty($bookid)) { //如果是更新数据
			$sql="update $tblname set title='$title',author='$author',public='$public',
			price0='$price0',price1='$price1',old_degree='$old_degree',sort='$sort',
			info='$info',photo='$filename',shopid='$shopid',tag='$tag_now' where bookid='$bookid'";
		} 

		if(mysql_query($sql)){
			$opertype=11;$result=0; include("OperLog.php");//记录操作日志
			//更新藏书量的大小
			include("UpdateSize.php");
			echo("<script> alert('操作成功!');window.location='".$nowfile."?tag=".$tag."&shopid=".$shopid."';</script>"); //返回列表页面
		}  
		else{
			$opertype=11;$result=1; include("OperLog.php");//记录操作日志
			echo("<script type='text/javascript'>alert('数据库操作失败,请将信息补充完整!');history.go(-1);</script>");
			exit();
		} 
	}
	//更新数据结束---------------------------------------------------------------------

//显示具体页面结束---------------------------------------------------------------------------------

?>