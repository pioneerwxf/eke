<?php
require_once(dirname(__FILE__) . '/config.php');
require_once(dirname(__FILE__) . '/connection.php');
require_once('HTML/QuickForm.php');

function ChangePwdForm(&$form) {
	$form->addElement('password', 'opassword', '','size=\'19\', style=\'border: 1px solid #C0C0C0\'');
	$form->addElement('password', 'password', '','size=\'19\', style=\'border: 1px solid #C0C0C0\'');
	$form->addElement('password', 'copassword', '','size=\'19\', style=\'border: 1px solid #C0C0C0\'');
	$form->addRule('opassword', 'please input the original password', 'required', '');
	$form->addRule('opassword', 'the original password must more than 4 characters', 'minlength', 4);
	$form->addRule('opassword', 'the original password  must less than 12 characters', 'maxlength', 12);
	$form->addRule('password', 'please input the password', 'required', '');
	$form->addRule('password', 'the password must more than 4 characters', 'minlength', 4);
	$form->addRule('password', 'the password  must less than 12 characters', 'maxlength', 12);
	$form->addRule('copassword', 'please input the confirm password', 'required', '');
	$form->addRule('copassword', 'the confirm password must more than 4 characters', 'minlength', 4);
	$form->addRule('copassword', 'the confirm password  must less than 12 characters', 'maxlength', 12);
	$form->addRule(array('password', 'copassword'), "passwords don't match", 'compare', ''); 
}

function LoginForm(&$form) {
	$form->addElement('text', 'username', '', "class='AWC-27624',size=20");
	$form->addElement('password', 'password', '' , "class='AWC-27624',size=20");
	
	$form->addRule('username', 'invalid username', 'required', null);
	$form->addRule('username', 'the username must more than 3 charactes', 'minlength', 3);
	$form->addRule('username', 'the username must less than 12 charactes', 'maxlength', 12);
	$form->addRule('password', 'please input your password', 'required', null);
	$form->addRule('password', 'the password must more than 6 charactes', 'minlength', 6);
	$form->addRule('password', 'the password must less than 12 charactes', 'maxlength', 12);
}

function UserExists($element, $value) {
	global $db;
	$sql = "select count(*) from " . TBL_PARENT . " where username = '" . $db->escapeSimple($element) . "'"; 
	$number = $db->getOne($sql);
	if(DB::isError($db)) {
	    return false;
	}
	if($number >= 1) {
	    return false;
	}
	return true; 
}

function EmailExists($element, $value) {
	global $db;
	$sql = "select count(*) from " . TBL_PARENT . " where email = '" . $db->escapeSimple($element) . "'";
	if (!is_null($value)) {
		$sql .= " and username <> '$value'";
	}
	$number = $db->getOne($sql);
	if(DB::isError($db)) {
	    return false;
	}
	if($number >= 1) {
	    return false;
	}
	return true; 
}

function MyValidPwd($element, $value) {
	if (!empty($element) && strlen($element) < 6) {
		return false;
	} else {
		return true;
	}
}

function CheckCampUpload($fields) {
	return CheckUpload('image', 1000000);
}

function CheckUpload($filedName, $maxSize) {
	require_once('HTTP/Upload.php');
	$upload = new HTTP_Upload('en');
	
	$_POST['MAX_FILE_SIZE'] = $maxSize;
	$file = $upload->getFiles($filedName);
	$allowedExt = array('jpg', 'jpeg', 'gif', 'png');
	$file->setValidExtensions($allowedExt, "accept");
	$file->setName("uniq");
	// return a file object or error
	if (PEAR::isError($file)) {
		return array("err" => ($file->getMessage()));
	}
	// Check if the file is a valid upload
	if ($file->isValid()) {    
	    $file_name = $file->moveTo(DIR_ATTACH);
	    if (PEAR::isError($file_name)) {
	    	return array("err" => ($file_name->getMessage()));
	    }
	}
	else {
		return array("err" => ($file->getMessage()));
	}
	
	$_POST['path'] = $file_name;
	return false;
}
?>