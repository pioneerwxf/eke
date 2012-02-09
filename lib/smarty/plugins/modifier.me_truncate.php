<?php
require_once(dirname(__FILE__) . '/../../../include/utils.php');

function smarty_modifier_me_truncate($string, $length = 80, $etc = '...') {
    if ($length == 0)
        return '';
	
    return UtfSubStr($string, $length, $etc);
}
/* vim: set expandtab: */
?>