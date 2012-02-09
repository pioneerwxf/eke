<?php
function smarty_function_me_callphpfunc($params, &$smarty) {
	$arrParam = array();
	foreach ($params as $_key => $_val) {
		switch($_key){
		case 'func':
			$func = $_val;
			break;
        default:
        	$arrParam[$_key] = $_val;
        	break;	
		}
	}
	
	return call_user_func_array($func, $arrParam);
}
?>