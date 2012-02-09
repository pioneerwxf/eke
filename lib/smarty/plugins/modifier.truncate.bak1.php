<?php
function smarty_modifier_truncate($string,$length=80,$etc='...',$start=0)   
{
  $str="";
  $str_len=$start+$length;
  for($i=$start;$i< $str_len;$i++)
  {
	    if(ord(substr($string,$i,1))>0xa0)
	  	{   
	      $str.=substr($string,$i,2);   
	      $i++;   
	    }   
	    else    
	      $str.=substr($string,$i,1);
   }         
   if(strlen($string) > $length)         
       return $str.$etc;
   else
    return $str;
}
?>