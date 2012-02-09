<?php
//连接数据库 参数分别是 服务器 用户名 密码
$db = mysql_connect("localhost","root","langman");
//以下这一句是为了支持UTF8
mysql_query("set names 'utf8'");
//选择数据库
mysql_select_db("eke",$db);
function query($table,$condition)
{
	$sql = "SELECT * FROM $table WHERE $condition";
	$query = mysql_query($sql) or die(mysql_error());
	return $query;
}
function select($table,$condition)
{
	$sql = "SELECT * FROM $table WHERE $condition";

	$query = mysql_query($sql) or die(mysql_error());
	$array = mysql_fetch_array($query);
	$totalRows = mysql_num_rows($query);
	return $array;
}
function totalRows($table,$condition)
{
	$sql = "SELECT * FROM $table WHERE $condition";

	$query = mysql_query($sql) or die(mysql_error());
	//$array = mysql_fetch_array($query);
	$totalRows = mysql_num_rows($query);
	return $totalRows;
}

//字符串截取函数
function cut_str($str,$len)
{
	$str_orig=$str;
	for($i=0;$i<$len;$i++)
	{
		$temp_str=substr($str,0,1);
		if(ord($temp_str) > 127)
		{
			$i++;
			if($i<$len)
			{
				$new_str[]=substr($str,0,3);$str=substr($str,3);
			}
		}
		else
		{
			$new_str[]=substr($str,0,1);$str=substr($str,1);
		}
	}
	if(strlen($str_orig)<=$len)
	return join($new_str);
	elseif(strlen($str_orig)>$len)
	return join($new_str);
//	return join($new_str)."...";
}

?>
