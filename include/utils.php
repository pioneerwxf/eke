<?php
require_once(dirname(__FILE__) . '/connection.php');
require_once(dirname(__FILE__) . '/mpager.php');

function Alert($info,$url=''){ 
	if(empty($url)) $url = $_SERVER['HTTP_REFERER'];
	echo "<script language = \"JavaScript\">";
	echo "	 alert(\"$info.\");";
	echo "	 location.href = \"$url\";";
	echo "</script>";
	exit();
}

function Pagination($query, $pageno, $pagesize, $pageurl) {
	global $db;
	$res = $db->query($query);
	if (DB::isError($res)) {
		die($res->getMessage());
	}
	$count0 = $res->numRows();
	$pagecount = 0;
	$pagecount = ceil($count0 / $pagesize);
	$pageno = intval($pageno);
	$pagecount = intval($pagecount);
	if (!is_int($pageno)) {
		$pageno = 1;
	} else {
		if ($pageno < 1) {
			$pageno = 1;
		} elseif ($pageno > $pagecount && $pagecount > 0) {
			$pageno = $pagecount;
		}
	}
	$start = ($pageno - 1) * $pagesize;
	$query .= " limit $start, $pagesize";
	$itemlist = $db->getAll($query);
	$count = count($itemlist);
	
	$thepager = new mpager;
	$thepager->pagesize = $pagesize;
	$thepager->pagecount = $pagecount;
	$thepager->start = $start;
	$thepager->last = $count;
	$thepager->pageurl = $pageurl;
	$thepager->pageno = $pageno;
	$thepager->count = $count0;
	$thepager->itemlist = $itemlist;
	return $thepager;
}

function CheckEmail($email) {
	$emailarray = split("@",$email);
	if (count($emailarray) != 2)
	  return "false";
	else {
		$emailleft = $emailarray[0];
		$emailright = $emailarray[1];
		if (count($emailleft) == 0)
		  return "false";
		else {
			$rightarray = explode(".",$emailright);
			if (count($rightarray) != 2)
	            return "false";
	        else {
	           $right = $rightarray[1]; 
	           if (strlen($right) < 2 || strlen($right) >3)
	            return "false";
	        }
		}
	}
	return "true";
}

function SafeStr($str, $sqlFilter = true, $htmlFilter = true) {
	$str = str_replace("'", "\'", $str);
	if ($sqlFilter && !get_magic_quotes_gpc()) {
		$str = AddSlashes($str);
	}
	if ($htmlFilter) {
		$str = htmlspecialchars($str, ENT_QUOTES); 
		$str = str_replace("<", "&lt;", $str); 
		$str = str_replace(">", "&gt;", $str); 
		$str = str_replace("\\", '&#92;', $str); 
	}
	return $str;
}

function Mailer($from, $fromName, $address, $subject, $body) {
	define('SMTP_HOST', 'smtp.163.com');
	define('SMTP_AUTH', true);
	define('SMTP_USER', 'danny_wan');
	define('SMTP_PASS', 'cuicuiiuiu');

	require_once(dirname(__FILE__) . "/../lib/mail/class.phpmailer.php");
	
	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host = SMTP_HOST;	//"localhost"; // SMTP server
	$mail->IsHTML(true);
	$mail->From = $from;
	$mail->AddAddress($address);
	$mail->Subject = $subject;
	$mail->FromName = $fromName;
	$mail->Body = $body;
	$mail->SMTPAuth = SMTP_AUTH;	//"false";
	$mail->Username = SMTP_USER;	//"";
	$mail->Password = SMTP_PASS;	//"";
		
	if (!$mail->Send()) {
//		echo($mail->ErrorInfo);
//		$mheaders = "From: $from\r\n";
//		$mheaders = $mheaders . "Reply-To: $from\r\n";
//		$mheaders = $mheaders . "X-Mailer: PHP/Floorball.net\r\n";
//		$mheaders = $mheaders . "Content-Type: text/html; charset=utf-8\r\n";// Mime type
//		
//		return @mail($address, $subject, $body, $mheaders);
	}
	else return true;
}

function RandomStr($len) {
	$arrChars = array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	$str = "";
	for ($i = 0; $i < $len; ++$i) {
		$str .= $arrChars[mt_rand(0, 35)];
	}
	
	return $str;
}

function RandomSymbol($len) {
	$arrChars = array('`','~','!','@','#','$','%','^','&','*','(',')');
	$str = "";
	for ($i = 0; $i < $len; ++$i) {
		$str .= $arrChars[mt_rand(0, 12)];
	}
	
	return $str;
}

function add_Str($str, $strpiece)
{
	$temp = explode('>', $str);
	foreach($temp as $key => $value)
	{
		$pos = strrpos($value, '<');
		if($pos > 0)
		{
			$tem = str_split($value, $pos);
			$re[$key] = implode($strpiece, $tem);
		}
		else
		{
			$re[$key] = $value;
		}
	}
	$re = implode('>', $re);
	return $re;
}
function addMess($str)
{
	$mess = '<span class="luanma">' . RandomSymbol(10) . '</span>';
	return add_str($str, $mess);
}

function RandomNum($len) {
	$arrChars = array('0','1','2','3','4','5','6','7','8','9');
	$str = "";
	for ($i = 0; $i < $len; ++$i) {
		$str .= $arrChars[mt_rand(0, 9)];
	}
	
	return $str;
}

function DateChange($sdate) {
	$arrTemp = explode("-", $sdate);
	return $arrTemp[2] . "-" . $arrTemp[0] . "-" . $arrTemp[1];
}

function StrDateToIntDate($strDate) {
	$arrDate = explode("-", $strDate);
	$intDate = mktime(0, 0, 0, intval($arrDate[1]), intval($arrDate[2]), intval($arrDate[0]));
	return $intDate;
}

function IsSafeStr( $str ) {
	$arrInValid = array("<",">","{","}");
	$isValid = true;
	foreach ( $arrInValid as $invalidStr) {
		if ( strpos($str, $invalidStr) !== false ) {
			$isValid = false;
			break;
		}
	}
	return $isValid;
}

function GetMemLevel( $level ) {
	switch ($level) {
		case 0:
		$level_title = "普通会员";
		break;
		case 1:
		$level_title = "白银会员";
		break;
		case 2:
		$level_title = "金卡会员";
		break;
		case 3:
		$level_title = "钻石会员";
		break;
		default:
		break;
	}
	return $level_title;
}

function GetProCityJs($arrProvince) {
	global $db;
	$resultArr = array();
	$proCount = count($arrProvince);
	$js_str = "<script language=JavaScript>";
	$js_str .= "var arrCity = new Array(" . ($proCount - 1) . ");";
	
	for ($i=0;$i < $proCount; $i++) {
		 $arrTemp = $db->getAll("select id, title from ".TBL_CITY." where provinceid = '".$arrProvince[$i]['id']."'");
	     if (count($arrTemp) > 0) {
	     	$js_str .=  "arrCity[".$i."] = new Array(".(count($arrTemp)-1).");";
	     } else {
	     	$js_str .=  "arrCity[".$i."] = new Array(0);";
	     }
	     
	     for ($j=0;$j < count($arrTemp); $j++) {
	     	 $js_str .=  "arrCity[".$i."][".$j."] = new Array(1);";
	         $js_str .=  "arrCity[".$i."][".$j."][0] = '".$arrTemp[$j]['id']."';";
	         $js_str .=  "arrCity[".$i."][".$j."][1] = '".$arrTemp[$j]['title']."';";
	     }
	}
	$js_str .=  "</script>";
    return $js_str;
}

function GetCityChannelJs($arrProvince) {
	global $db;
	$resultArr = array();
	$proCount = count($arrProvince);
	$js_str = "<script language=JavaScript>";
	$js_str .= "var arrCityChannel = new Array(" . ($proCount - 1) . ");";
	
	for ($i=0;$i < $proCount; $i++) {
		 $arrTemp = $db->getAll("select id, title from ".TBL_CITY." where provinceid = '".$arrProvince[$i]['id']."' and isChannel = 1");
	     if (count($arrTemp) > 0) {
	     	$js_str .=  "arrCityChannel[".$i."] = new Array(".(count($arrTemp)-1).");";
	     } else {
	     	$js_str .=  "arrCityChannel[".$i."] = new Array(0);";
	     }
	     
	     for ($j=0;$j < count($arrTemp); $j++) {
	     	 $js_str .=  "arrCityChannel[".$i."][".$j."] = new Array(1);";
	         $js_str .=  "arrCityChannel[".$i."][".$j."][0] = '".$arrTemp[$j]['id']."';";
	         $js_str .=  "arrCityChannel[".$i."][".$j."][1] = '".$arrTemp[$j]['title']."';";
	     }
	}
	$js_str .=  "</script>";
    return $js_str;
}

function GetCarTypeJs($arrCarBrand) {
	global $db;
	$resultArr = array();
	$brandCount = count($arrCarBrand);
	$js_str = "<script language=JavaScript>";
	$js_str .= "var arrType = new Array(".($brandCount-1).");";
	for ($i=0;$i < $brandCount; $i++) {
		 $arrTemp = $db->getAll("select id, title from ".TBL_CAR_TYPE." where parent = '".$arrCarBrand[$i]['id']."'");
	     if(count($arrTemp)>0){
		 $js_str .=  "arrType[".$i."] = new Array(".(count($arrTemp)-1).");";
	     for ($j=0;$j < count($arrTemp); $j++) {
	     	 $js_str .=  "arrType[".$i."][".$j."] = new Array(1);";
	         $js_str .=  "arrType[".$i."][".$j."][0] = '".$arrTemp[$j]['id']."';";
	         $js_str .=  "arrType[".$i."][".$j."][1] = '".$arrTemp[$j]['title']."';";
	     }
	     }
	}
	$js_str .=  "</script>";
    return $js_str;
}



function UpdateCaptcha($elementID) {
	$objresponse = new xajaxResponse();
	$objresponse->addAssign($elementID, "src", "include/captcha.php?id=" . RandomStr(2));
	
	return $objresponse->getXML();
}

function GetChkBoxValue(&$arrChk) {
	if (!is_array($arrChk)) {
		return $arrChk;
	}
	
	$arrTemp = array_filter($arrChk, "NotEmptyStr");
	$len = count($arrTemp); $str = ""; $i = 0;
	foreach ($arrTemp as $key => $value) {
		if ($value != "") {
			$str .= (($i == $len - 1) ? $value : ($value . ","));
		}
		++$i;
	}
	
	return $str;
}

function NotEmptyStr($str) {
	return $str != "";
}
function UploadFile($fieldName,$uploaddir='',$filename=''){
  $str=$_FILES[$fieldName]['name'];
  $name=explode(".",$str);
  $extend=$name[count($name)-1];
    if($extend!="")
  {
  $randval=date("Ymd").rand();
  if($uploaddir=='')
  $uploaddir="../upload/";
  if($filename=='')
  $uploadfile=$uploaddir.$randval.".".$extend;
  else
  $uploadfile=$uploaddir.$filename.".".$extend;
  	if($_FILES[$fieldName]['error']==0){
  		move_uploaded_file($_FILES[$fieldName]['tmp_name'],$uploadfile);
		return $uploadfile;
  	}
	else
	return false;
  }
}
function CheckUpload($fieldName, $maxSize, $allowEmpty = false, &$allowedExt = null) {
	require_once('HTTP/Upload.php');
	$upload = new HTTP_Upload('cn');
	
	$_POST['MAX_FILE_SIZE'] = $maxSize;
	$file = $upload->getFiles($fieldName);
	//$allowedExt = array('jpg', 'jpeg', 'gif', 'png');
	if (!is_null($allowedExt) && is_array($allowedExt)) $file->setValidExtensions($allowedExt, "accept");
	$file->setName("uniq");
	// return a file object or error
	if (PEAR::isError($file)) {
		return array("uploaderr" => ($file->getMessage()));
	}
	// Check if the file is a valid upload
	if ($file->isValid()) {    
	    $file_name = $file->moveTo(DIR_ATTACH);
	    if (PEAR::isError($file_name)) {
	    	return array("uploaderr" => ($file->getMessage()));
	    }
	} else {
		//var_dump($file->getMessage());
		if ($file->getMessage() == "Upload error: NO_USER_FILE" && $allowEmpty) { //可以不上传文件
			return false;
		} else {
			return array("uploaderr" => ($file->getMessage()));
		}
	}
	
	$_POST['path_' . $fieldName] = $file_name;
	return false;
}

function SelectCity(&$form, $selValue = null) {
	global $db;
	$sel =& $form->addElement('hierselect', 'province', '', null, '&nbsp;');
	$arrProvince = $db->getAssoc('select id, title from ' . TBL_PROVINCE);
	$arrProvince = array('' => '选择省份') + $arrProvince;
	foreach ($arrProvince as $id => $title) {
		$arrCity = $db->getAssoc('select id, title from ' . TBL_CITY . " where provinceid = $id");
		foreach ($arrCity as $cid => $ctitle) {
			$secOptions[$id][$cid] = $ctitle;
		} 
	}
	$secOptions1[''][''] = '选择城市';
	$secOptions = $secOptions1 + $secOptions;
	$sel->setMainOptions($arrProvince);
	$sel->setSecOptions($secOptions);
	//$selValue = array("3", "4");
	if (!is_null($selValue) && is_array($selValue)) {//$form->setDefaults(array('province' => array('', '')));
		$form->setDefaults(array('province' => $selValue));
	}
}

function UtfSubStr($str, $len, $etc = '...') {
	$strLen = strlen($str);
	for($i = 0; $i < $len; ++$i) {
		$temp_str = substr($str, 0, 1);
		if (ord($temp_str) > 127) {
			++$i;
			--$strLen;
			if ($i < $len) {
				$new_str[] = substr($str, 0, 3);
				$str = substr($str, 3);
			}
		} else {
			$new_str[] = substr($str, 0, 1);
			$str = substr($str, 1);
		}
	}
	
	$str = join($new_str);
	//var_dump($strLen); var_dump($len);
	if ($strLen > $len) $str .= $etc;
	
	return $str;
}

function isNew($t){
	if((date("U")-strtotime($t))/86400<=3)
		return "<span class=new>New</span>";
	else
    	return '';
}
//$str = preg_replace($reg,'***',$str);
//$strReg 为过滤字符串，许过滤的字符用;隔开，如 '你妈比;操你妈'
//$rep_word 为过滤后替换的字符串，如 '***'
//$strFiltered 为被过滤的字符串
function strFilter($strReg, $rep_word, $strFiltered)
{
	if($strReg == '')return $strFiltered;
	$temp = str_replace(';','|',$strReg);
	$reg = implode('', array('/',$temp,'/'));
	return preg_replace($reg, $rep_word, $strFiltered);
}
function addTerm($str)
{   
	if(empty($str))return $str;
	global $db;
	$terms=$db->getAll('select id,title from cn_courseware where type=1');
 	foreach($terms as $v){
		$str=str_replace($v['title'],'<span class=linkshuyu><a href=classroom_info.php?id='.$v['id'].' target=_blank>'.$v['title'].'</a></span>',$str);
	}
	return $str;
}
$nopowerhtm = "nolimits.htm";
$arrRoll_id = array("1" => "幻灯片1", "2" => "幻灯片2", "3" => "幻灯片3", "4" => "幻灯片4");
$arrRegular = array("1" => "网站介绍", "2" => "联系我们", "3" => "注册协议", "4" => "使用说明", "5" => "网站地图", "6" => "商务合作", "7" => "垃圾字符过滤", "8" => "关键字");
$arrAds = array("1" => "首页顶部大图", "2" => "首页幻灯片", "3" => "首页左一", "4" => "首页左二", "5" => "首页右一", "6" => "首页右二", "7" => "内页顶部大图", "8" => "内页左一", "9" => "内页左二", "10" => "创新网络图片", "11"=> "创新大讲堂图片");
$arrSex = array("1" => "男", "0" => "女");
$arrYesNo = array("0" => "否", "1" => "是");
$arrLevel = array("1" => "硕士", "2" => "博士");
$arrData = array("1" => "创新数据", "2" => "创新评价");
$arrField = array("1" => "技术创新", "2" => "制度创新", "3" => "服务创新", "4" => "市场创新",
				"5" => "组织创新", "6" => "战略创新");
				
$arrNews = array("1" => "（中文）公司新闻", "2" => "（中文）培训专栏", "3" => "（中文）行业动态", "4" => "（英文）公司新闻", "5" => "（英文）培训专栏", "6" => "（英文）行业动态");

$arrBook = array("1" => "精品书库", "2" => "经典文献","3"=>"书刊动态","4"=>"读书品文");	

$arrProduct = array("1" => "（中文）产品与服务", "2" => "（英文）产品与服务");		

$arrNet = array("1" => "基地网络", "2" => "科研机构网络", "3" => "政府网络", "4" => "企业网络",
				"5" => "媒体网络");	
$arrResearch = array("1" => "企业咨询", "2" => "政府咨询", "3" => "基金项目");
$arrlink = array("1" => "科研院校链接", "2" => "企业链接", "3" => "国家机构链接","4"=>"合作链接");	
$arrCourse = array("1" => "创新术语", "2" => "讲座实录", "3" => "讲座预告","4"=>"资源下载");
$arrObject = array("1" => "国家/区域", "2" => "产业/行业", "3" => "企业/组织","4"=>"项目/产品");
$arrLanguage = array("1" => "英文", "2" => "中文", "3" => "其他");
$arrEstimate = array("1" => "创新数据", "2" => "创新评价");
$arrQz = array();
for($i=0; $i<51; $i++)$arrQz[$i] = "$i";
					
define('VISIBLE_NONE', 0);
define('VISIBLE_FRIENDS', 1);
define('VISIBLE_ALL', 2);

define('FR_TYPE_PERSON', 0);
define('FR_TYPE_CLIENT', 1);

define('EM_TYPE_PERSON', 0);
define('EM_TYPE_CLIENT', 1);

define('BUSINESS_TYPE_TY', 0);
define('BUSINESS_TYPE_RZ', 1);
define('BUSINESS_TYPE_VIP', 2);
?>