<?php
require_once(dirname(__FILE__) . '/../../../lib/fckeditor/fckeditor.php');

function smarty_function_me_fckeditor($params, &$smarty) {
	$name = "";  $mode = ""; $data = ""; 
	foreach ($params as $_key => $_val) {
		switch($_key){
		case 'mode':
		case 'name':
		case 'data':
		case 'forAdmin':
        case 'value':
            $$_key = (string)$_val;
            break;
        default:
        	break;	
		}
	}
	
	$oFCKeditor = new FCKeditor('FCKeditor1');
	$oFCKeditor->BasePath = ($forAdmin == 'true' ? '../lib/fckeditor/' : 'lib/fckeditor/');
	//$oFCKeditor->Config['SkinPath'] = '../fckeditor/editor/skins/office2003/';
	//var_dump($name);
	$oFCKeditor->Value = $data;
	$oFCKeditor->ToolbarSet = (empty($mode)) ? 'Default' : $mode;
	$oFCKeditor->InstanceName = (empty($name)) ? 'EditorDefault' : $name;
	$oFCKeditor->Width = '100%';
	$oFCKeditor->Height = '300';
	$oFCKeditor->Value = $value;
	$oFCKeditor->Create();
}
?>