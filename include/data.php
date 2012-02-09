<?php
require_once(dirname(__FILE__) . '/config.php');
require_once(dirname(__FILE__) . '/connection.php');

function GetOneRow($tblName, $indexField, $index, $way = DB_FETCHMODE_ASSOC) {
	global $db;
	
	$sql = "select * from `$tblName` where `$indexField` = $index";
	//echo("$sql<br>");
	$row = $db->getRow($sql, $way);
	if (DB::isError($row)) {
		return false;
	}
	
	return $row;
}
function GetOne($sql) {
	global $db;
	
	
	$row = $db->getRow($sql, DB_FETCHMODE_ASSOC);
	if (DB::isError($row)) {
		return false;
	}
	
	return $row;
}

function GetAssoArray($tblName, $key, $value, $limitation = null, $orderby = null) {
	global $db;
	$sql = "select `$key`, `$value` from `$tblName` where 1 = 1";
	if (!is_null($limitation)) {
		$sql .= " and $limitation";
	}
	if (!is_null($orderby)) {
		$sql .= " $orderby";
	}
	$res = $db->query($sql);
	$arrTemp = array();
	while ($row = $res->fetchRow())
	{
		$arrUsertype[$row[0]] = $row[1];
	}
	
	return $arrUsertype;
}

function GetList($tblName, $arrField, $arrWhere, $arrOrderBy, $manualSQL = null) {
	global $db;
	
	if (!is_null($manualSQL)) {
		$sql = $manualSQL;
	} else {
		if (is_null($arrField) || empty($arrField)) {
			$sql = "select *";
		} else {
			$sql = "select ";
			$len = count($arrField);
			for ($i = 0; $i < $len; ++ $i) {
				$sql .= (($i == $len - 1) ? ($arrField[$i]) : ($arrField[$i] . ", "));
				
			}
		}
		$sql .= " from `$tblName`";
		
		if (!is_null($arrWhere) && !empty($arrWhere)) {
			$sql .= " where ";
			$len = count($arrWhere);
			$i = 0;
			foreach ($arrWhere as $field => $value) {
				switch (gettype($value)) {
				case 'integer':
				case 'double':
					$sql .= (($i == $len - 1) ? ("{$field} = {$value}") : ("{$field} = {$value}  and "));
					break;
				default:
					$sql .= (($i == $len - 1) ? ("{$field} = '{$value}'") : ("{$field} = '{$value}' and "));
					break;
				}
				
				++$i;
			}
		}
		
		
		if (!is_null($arrOrderBy) && !empty($arrOrderBy)) {
			$sql .= " order by ";
			$len = count($arrOrderBy);
			$i = 0;
			foreach ($arrOrderBy as $orderField => $orderWay) {
				$sql .= (($i == $len - 1) ? ("{$orderField} {$orderWay}" . "") : ("{$orderField} {$orderWay}, "));
				++$i;
			}
		}
	}
	var_dump($sql);
	$arrTemp = $db->getAll($sql);
	
	return true;
}

function DBExecute($tblName, &$tblFieldsValues, $mode = DB_AUTOQUERY_INSERT, $where = null) {
	global $db;
	
	if ($mode != DB_AUTOQUERY_INSERT && $mode != DB_AUTOQUERY_UPDATE) {
		if (CU_DEBUG) {
			die("Wrong Mode");
		} else {
			return "Wrong Mode";
		}
	}
	
	if ($mode == DB_AUTOQUERY_INSERT) {
		$sth = $db->autoExecute($tblName, $tblFieldsValues, DB_AUTOQUERY_INSERT);
	} else {
		$sth = $db->autoExecute($tblName, $tblFieldsValues, DB_AUTOQUERY_UPDATE, $where);
	}
	
	if (DB::isError($sth)) {
		if (CU_DEBUG) {
			die($sth->getMessage());
		} else {
			return $sth->getMessage();
		} 
	} 
	
	return true;
}

function GetUserName($uid) {
	global $db;
	$username = $db->getOne("select username from " . TBL_DSC_MEMBER . " where uid = $uid");
	if (DB::isError($username)) {
		return "未知用户";
	} else {
		return $username;
	}
}

function GetFriendType($bid) {
	global $db;
	$btype = $db->getOne("select title from " . TBL_FRIEND_TYPE . " where id = $bid");
	if (DB::isError($btype)) {
		return "未知类别";
	} else {
		return $btype;
	}
}

function GetProvince($pid) {
	global $db;
	return $db->getOne("select title from " . TBL_PROVINCE . " where id = $pid");
}

function GetCity($cid) {
	global $db;
	return $db->getOne("select title from " . TBL_CITY . " where id = $cid");
}

function GetProCity($bid, $uid = 0) {
	global $db;
	if ($bid > 0) {
		$row = $db->getRow("select provinceid, cityid from " . TBL_BUSINESS . " where id = $bid");
	} else {
		$row = $db->getRow("select provinceid, cityid from " . TBL_DSC_MEMBER . " where uid = $uid");
	}
	if (DB::isError($row) || is_null($row)) return;
	echo(GetProvince($row['provinceid']) . GetCity($row['cityid']));
}

function GetNewsType($id) {
	global $db;
	return $db->getOne("select title from " . TBL_NEWS_TYPE . " where id = $id");
}

function GetLinkType($id) {
	global $db;
	return $db->getOne("select typename from cu_link_type where id = $id");
}

function GetChannelList() {
	global $arrChannel;
	return $arrChannel;
}
function GetYwList() {
	global $arrYw;
	return $arrYw;
}



//获得学堂类型列表
function GetstudyType(){
	//var_dump($id);
	//exit();
	global $db;
	$arr1= $db->getAll("select id,title from cu_study_type  order by id asc");
	//$arr2= $db->getAll("select typename from cu_link_type where parentid = $id order by id asc");
  //var_dump($arr1);
  $arr3=arrs2arr($arr1,"title");
  $arr4=arrs2arr($arr1,"id");
  //var_dump($arr4);
	return array_combine($arr4,$arr3);
	
	}



//获得城市列表
function GetCityList(){
	//var_dump($id);
	//exit();
	global $db;
	$arr1= $db->getAll("select id,title from cu_city where isChannel=1  order by id asc");
	//$arr2= $db->getAll("select typename from cu_link_type where parentid = $id order by id asc");
  //var_dump($arr1);
  $arr3=arrs2arr($arr1,"title");
  $arr4=arrs2arr($arr1,"id");
  //var_dump($arr4);
  //var_dump($arr3);
	return array_combine($arr4,$arr3);
	
	}	
	
	
	//获得商家列表
function GetBusiness(){
	//var_dump($id);
	//exit();
	global $db;
	$arr1= $db->getAll("select id,name from cu_business  order by id asc");
	//$arr2= $db->getAll("select typename from cu_link_type where parentid = $id order by id asc");
  //var_dump($arr1);
  $arr3=arrs2arr($arr1,"name");
  $arr4=arrs2arr($arr1,"id");
  //var_dump($arr4);
  //var_dump($arr3);
	return array_combine($arr4,$arr3);
	
	}
	
	
//获得角色列表		
function GetRoleType($bz){
	//var_dump($id);
	//exit();
	global $db;
	$arr1= $db->getAll("select id,rolename from cu_role where bz='$bz' order by id asc");
	//$arr2= $db->getAll("select typename from cu_link_type where parentid = $id order by id asc");
  //var_dump($arr1);
  $arr3=arrs2arr($arr1,"rolename");
  $arr4=arrs2arr($arr1,"id");
  //var_dump($arr4);
	return array_combine($arr4,$arr3);
	
	}
	
	//获取知道类型列表
function GetZDType(){
	//var_dump($id);
	//exit();
	global $db;
	$arr1= $db->getAll("select id,title from cu_ask_type where parent>0 order by id asc");
	//$arr2= $db->getAll("select typename from cu_link_type where parentid = $id order by id asc");
  //var_dump($arr1);
  $arr3=arrs2arr($arr1,"title");
  $arr4=arrs2arr($arr1,"id");
  //var_dump($arr4);
	return array_combine($arr4,$arr3);
	
	}
	
	
	//获取链接类型列表
function GetadType($id){
	//var_dump($id);
	//exit();
	global $db;
	$arr1= $db->getAll("select id,typename from cu_link_type where parentid = $id order by id asc");
	//$arr2= $db->getAll("select typename from cu_link_type where parentid = $id order by id asc");
  //var_dump($arr1);
  $arr3=arrs2arr($arr1,"typename");
  $arr4=arrs2arr($arr1,"id");
  //var_dump($arr4);
	return array_combine($arr4,$arr3);
	
	}
	
function arrs2arr($arrs,$key){
 $array = array();
 foreach($arrs as $val){
  foreach ($val as $k => $v) {
   if($k===$key)$array[]=$v;
  }
 }
 $array = resetkey(array_unique($array)); 
 return $array;
}

function resetkey($arr){
 $array = array();
 foreach($arr as $v){
  $array[]=$v;
 }
 return $array;
}


//function GetCarTypeList($parent = null) {
////	global $arrDomBrand;
////	return $arrDomBrand;
//	if (!is_null($parent)) {
//		$sql = "select id, title from " . TBL_CAR_TYPE . " where parent = $parent";
//	} else {
//		$sql = "select id, title from " . TBL_CAR_TYPE . " where parent = $parent";
//	}
//}

function GetFrLink($cid) {
	global $db;
	return $db->getOne("select content from " . TBL_FR_LINK . " where id = $cid");
}


function roleHasLimit($opcode,$roleid,$nodecode){
	global $db;
	$nodeid=$db->getOne("select id from limit_node where nodecode='$nodecode'");
    if($nodeid==''){
		echo("不存在的节点编码");
		exit;
	}
	$limitcode=$db->getOne("select limitcode from limit_rolelimit where nodeid=$nodeid and roleid=$roleid");
	if(strstr($limitcode,$opcode))
		return true;
	else
		return false;
}
function hasOpview($nodecode){
    global $db;
	session_start();
	if($_SESSION['username']=='admin')return;
	if(empty($_SESSION['usertype'])||is_null($_SESSION['usertype']))
		$roleid=1;
	else
	    $roleid=$_SESSION['usertype'];
	if(!roleHasLimit("opview",$roleid,$nodecode))echo("<script>window.location='nolimits.htm'</script>");
	
}
function addScore($nodecode){
    global $db;
	session_start();
	if($_SESSION['username']=='admin')return;
	if(empty($_SESSION['username'])||is_null($_SESSION['username']))
		return;
	$username=$_SESSION['username'];
	if(empty($_SESSION['usertype'])||is_null($_SESSION['usertype']))
		$roleid=1;
	else
	    $roleid=$_SESSION['usertype'];
	$nodeid=$db->getOne("select id from limit_node where nodecode='$nodecode'");
    if($nodeid==''){
		echo("不存在的节点编码");
		exit;
	}
	$s=$db->getOne("select addscore from limit_rolelimit where nodeid=$nodeid and roleid=$roleid");
	$db->query("update cn_user set score=score+$s where username='$username'");
}
function subScore($nodecode){
    global $db;
	session_start();
	if($_SESSION['username']=='admin')return;
	if(empty($_SESSION['username'])||is_null($_SESSION['username']))
		return;
	$username=$_SESSION['username'];
	if(empty($_SESSION['usertype'])||is_null($_SESSION['usertype']))
		$roleid=1;
	else
	    $roleid=$_SESSION['usertype'];
	$nodeid=$db->getOne("select id from limit_node where nodecode='$nodecode'");
    if($nodeid==''){
		echo("不存在的节点编码");
		exit;
	}
	$s=$db->getOne("select subscore from limit_rolelimit where nodeid=$nodeid and roleid=$roleid");
	$ts=$db->getOne("select score from cn_user where username='$username'");
	if($ts-$s<0){
		echo("您的积分不够，无法查看内容，请多发文章增加积分！");
		exit;
	}
	$db->query("update cn_user set score=score-$s where username='$username'");
}
?>