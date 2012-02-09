<?php
function smarty_function_me_show_error($params, &$smarty) {
	$errorInfo = array();
	foreach ($params as $_key => $_val) {
		switch($_key){
		case 'error':
            $errorInfo = (array)$_val;
            break;
        default:
        	break;	
		}
	}
	
	foreach ($errorInfo as $_key => $_val) {
		echo($_val . "<br/>");
	}
}
?>