<?php
session_start();
require_once('admin_login_check.php');
require_once('../global.php'); 
echo("");
$smarty = new MySmarty();
$smarty->template_dir = TEMPLATES_DIR;
$smarty->display('admin/home.htm');
?>