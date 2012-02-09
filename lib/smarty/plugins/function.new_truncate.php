<?php
function smarty_function_new_truncate($string, $length = 80, $etc = '...',
                                  $break_words = false, $middle = false)
{
    if ($length == 0)
        return '';
 
    if (strlen($string) > $length) {
        $length -= strlen($etc);
        return $string = mb_substr($string,0,$length,"gbk");
        /*if (!$break_words && !$middle) {
            $string = preg_replace('/\s+?(\S+)?$/', '', mb_substr($string, 0, $length+1));
        }
        if(!$middle) {
            return mb_substr($string, 0, $length).$etc;
        } else {
            return mb_substr($string, 0, $length/2) . $etc . mb_substr($string, -$length/2);
        }*/
    } else {
        return $string;
    }
}
?>
