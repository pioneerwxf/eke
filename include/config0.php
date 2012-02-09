<?
include_once("../lib/smarty/Smarty.class.php"); //包含smarty类文件
$smarty = new Smarty();//建立smarty实例对象$smarty
$smarty->left_delimiter = "{"; 
$smarty->right_delimiter = "}";
$smarty->template_dir = "../templates";//设置模板目录
$smarty->compile_dir = "../tmp"; //设置编译目录
?>