<?
$db = mysql_connect("localhost","root","langman");
mysql_query("set names 'utf8'");
//选择数据库
mysql_select_db("eke",$db);
function select($table,$condition)
{
	$sql = "SELECT * FROM $table WHERE $condition";

	$query = mysql_query($sql) or die(mysql_error());
	$array = mysql_fetch_array($query);
	$totalRows = mysql_num_rows($query);
	return $array;
}
function query($table,$condition)
{
	$sql = "SELECT * FROM $table WHERE $condition";
	$query = mysql_query($sql) or die(mysql_error());
	return $query;
}

function totalRows($table,$condition)
{
	$sql = "SELECT * FROM $table WHERE $condition";

	$query = mysql_query($sql) or die(mysql_error());
	//$array = mysql_fetch_array($query);
	$totalRows = mysql_num_rows($query);
	return $totalRows;
}
function cut_str($str,$len)
{
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
	return join($new_str);
}
?>