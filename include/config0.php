<?
include_once("../lib/smarty/Smarty.class.php"); //����smarty���ļ�
$smarty = new Smarty();//����smartyʵ������$smarty
$smarty->left_delimiter = "{"; 
$smarty->right_delimiter = "}";
$smarty->template_dir = "../templates";//����ģ��Ŀ¼
$smarty->compile_dir = "../tmp"; //���ñ���Ŀ¼
?>