<?php
function smarty_function_me_row_site_info_list($params, &$smarty) {
	foreach ($params as $_key => $_val) {
		switch($_key){
		case 'template':
		case 'bid':
		case 'cid':
			$$_key = $_val;
			break;
        default:
        	break;	
		}
	}
	
	global $db;
	$sql = "select * from " . TBL_BUSINESS_SERVICE . " where bid = $bid and `type` = $cid";
	$serviceList = $db->getAll($sql);
	//var_dump($serviceList);
	//echo("$sql<br />");
	$smarty->assign_by_ref("serviceList", $serviceList);
	$smarty->display($template);
}
?>