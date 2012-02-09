<?php
require_once('../global.php');  		//包含全局变量
require_once('admin_login_check.php');	//检查用户是否登录
  
$tblname="shop";				//本页面设计的主要数据表
$name=explode("/",$_SERVER["PHP_SELF"]);
$nowfile=$name[count($name)-1];			//取得当前页面名称
$controller=$_GET['con'];				//取得控制器的值，用于控制显示列表还是具体页面
$level= SafeStr($_REQUEST['level']);//取得上一链接或页面的传进来参数

//一、显示列表页面开始-----------------------------------------------------------------------------
if($controller==''||$controller=='list'){	//如果控制器为列表
	if ($_POST['act'] == 'delete') {
		$modtime=date("Y-m-d H:i:s");		//删除者的ID
		$modoperid=$_SESSION['adminid'];	//删除的时间
		$sql = "update $tblname set level='-1' where shopid in (" . GetChkBoxValue($_POST['nid']) . ")";				
				//删除一个书店，做出level=0的标记而已
		$db->query($sql);
		$opertype=7;$result=0; include("OperLog.php");//记录操作日志
	}
	
	//提取搜索表单传来的参数
	$shopname=$_REQUEST["shopname"];
	$owner=$_REQUEST["owner"];
	$college=$_REQUEST["college"];
	$date=$_REQUEST["time"];
	//搜索语句开始，为了便于分页，讲页码参数存储为session格式-------------------
	if(!isset($_POST['pageno'])){
		if(empty($level))//否者就显示数据列表	
			$sql = "select * from $tblname where level>0  and shopname like '%$shopname%' and owner like '%$owner%' and college like '%$college%' and date like '%$date%' order by date DESC, shopname ASC";	
		else 
			$sql = "select * from $tblname where level='$level' and shopname like '%$shopname%' and owner like '%$owner%' and college like '%$college%' and date like '%$date%' order by date DESC, shopname ASC";

		session_register("sql");	//为了分页具有连续性，将sql存储成session格式
		$_SESSION['sql'] = $sql;
	}
	
	$sql=$_SESSION['sql'];
	//搜索语句结束，为了便于分页，讲页码参数存储为session格式-------------------
	
	//翻页参数控制start----
	$pageno = $_POST['pageno'];
	$pagesize = NumPerPage;
	$pageurl = $_SERVER["PHP_SELF"]."?level=".$level;	//返回时的地址
	$thepager = Pagination($sql, $pageno, $pagesize, $pageurl);
	//翻页参数控制end------
	
	//新建smarty模板 start--------------------------------------
	$smarty = new MySmarty();
	$smarty->template_dir = TEMPLATES_DIR;
	$smarty->assign_by_ref('thepager', $thepager);
	
	$smarty->assign('title',"书店列表");	
	$smarty->assign('level',$level);		//传递页面间参数
	$smarty->assign('addurl',$nowfile);
	$smarty->display('admin/shop_list.htm');//**************
	//新建smarty模板 end------------------------------------------
}
//显示列表页面结束---------------------------------------------------------------------------------

//二、显示具体页面开始-----------------------------------------------------------------------------
elseif($controller=='addup')//添加更新控制器
{
	$shopid = SafeStr($_REQUEST['shopid']);
	//添加表单开始**************************************************************************
	if (!empty($shopid)) $item =& GetOneRow($tblname, 'shopid', $shopid);//取得一行数据
		$form = new HTML_QuickForm('Form1', 'post', $nowfile."?con=addup");
		$form->addElement('text', 'shopname', '','size="37",style="border: 1px solid #C0C0C0"');
		$form->addElement('text', 'owner', '','size="37",style="border: 1px solid #C0C0C0"');
		$form->addElement('text', 'adv', '','size="37",style="border: 1px solid #C0C0C0"');
		$form->addElement('text', 'phone', '','size="37",style="border: 1px solid #C0C0C0"');	
		$form->addElement('text', 'email', '','size="37",style="border: 1px solid #C0C0C0"');	
		$form->addElement('file', 'Posterfile', '','style="border: 1px solid #C0C0C0"');
		$form->addElement('text', 'poster', '','size="37",style="border: 1px solid #C0C0C0"');	
		
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

	//传递表单参数
	//include("../bbs/include/common.inc.php");
	//$date=gmdate("$dateformat", $item['date'] + $timeoffset * 3600);
	$smarty->assign('date',$item["date"]);
	$smarty->assign('booknum',$item["booknum"]);
	$smarty->assign('soldnum',$item["soldnum"]);
	
	//构造level选项
	$smarty->assign('level_options', array(
		'-1' => '已删除',
		'1' => '小屋级',
		'2' => '别墅级',
		'3' => '殿堂级'));
		$smarty->assign('level_now', $item["level"]);

	//构造学院选项
	$smarty->assign('college_options', array(
		'竺可桢学院' => '竺可桢学院',
		'机械与能源工程学' => '机械与能源工程学',
		'计算机科学与技术学院(软件学院)' => '计算机科学与技术学院(软件学院)',
		'动物科学学院' => '动物科学学院',
		'人文学院' => '人文学院',
		'理学院' => '理学院',
		'信息工程与科学学院' => '信息工程与科学学院',
		'生物医学工程与仪器科学学院' => '生物医学工程与仪器科学学院',
		'法学院' => '法学院',
		'教育学院' => '教育学院',
		'医学院' => '医学院',
		'药学院' => '药学院',
		'公共管理学院' => '公共管理学院',
		'农业与生物技术学院' => '农业与生物技术学院',
		'环境与资源学院' => '环境与资源学院',
		'生命科学学院' => '生命科学学院',
		'外国语学院' => '外国语学院',
		'管理学院' => '管理学院',
		'经济学院' => '经济学院',
		'生物系统工程与食品科学学院' => '生物系统工程与食品科学学院',
		'建筑工程学院' => '建筑工程学院',
		'电气工程学院' => '电气工程学院',
		'环境与资源学院' => '环境与资源学院'));
		$smarty->assign('college', $item["college"]);
	
	$smarty->assign('shopid', $shopid);
	$smarty->assign('level', $level);
	$smarty->assign('act', $act);
	$smarty->assign('title',$title);
	
	$smarty->assign_by_ref('form_data', $renderer->toArray());
	$smarty->display('admin/shop.htm');//**************************************
	//构造表单结束
}
//显示具体页面结束---------------------------------------------------------------------------------



//更新数据开始---------------------------------------------------------------------
if (($_POST['act'] == 'add'||$_POST['act'] == 'update') && $form->validate()) {
		//读取表单参数
		$college=$_POST['college'];
		$shopname=$_POST['shopname'];
		$owner=$_POST['owner'];
		$adv=$_POST['adv'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$level_now=$_POST['level_now'];
		$poster=$_POST['poster'];
		
		//图片上传
		$f=$_FILES['Posterfile'];
		if($f)
		{
		$dest_dir='file/banner/';//设定上传目录
		//取文件的后缀
		$oldname=$_FILES['Posterfile']['name'];
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
		if($filename){	//如果上传了文件就将海报路径写成服务器下的地址
			$poster=$filename;
		}
		//读取文件posterpath结束
	if (!is_null($shopid) && !empty($shopid)) { //如果是更新数据
		$sql="update $tblname set adv='$adv',shopname='$shopname',owner='$owner',level='$level_now',
		college='$college',poster='$poster',phone='$phone',email='$email' where shopid = $shopid"; 
		//echo $sql;
		if (mysql_query($sql)){
		$opertype=8;$result=0; include("OperLog.php");//记录操作日志
		}
		else{
			$opertype=8;$result=1; include("OperLog.php");//记录操作日志
			echo("<script type='text/javascript'> alert('数据库操作失败,请将信息补充完整!');history.go(-1);</script>");
			exit();
		}
	} 
	else {//否者是插入数据
		$sql="insert into $tblname (adv,shopname,owner,level,college,poster,phone,email)
		 values ('$adv','$shopname','$owner','$level_now','$college','$poster','$phone','$email')";
		
		if (!mysql_query($sql)){
		$opertype=6;$result=0; include("OperLog.php");//记录操作日志
		echo("<script type='text/javascript'>alert('数据库操作失败，请检查信息是否完整!');history.go(-1);</script>");
		exit();
		}
		else{
			$opertype=6;$result=1; include("OperLog.php");//记录操作日志
		}
		
	}		
	//更新size的大小
	include("UpdateSize.php");
	echo("<script>alert('操作成功!');window.location='".$nowfile."?con=list&level=".$level."';</script>");   //返回列表页面
}
//更新数据结束---------------------------------------------------------------------
?>