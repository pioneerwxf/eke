<?php
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
$test = "ccc<br>thank you<p>qq";
echo(addMess($test));
?>