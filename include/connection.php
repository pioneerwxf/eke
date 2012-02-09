<?php
require_once('DB.php');
$user = 'root';
$pass = 'langman';
$host = 'localhost';
$db_name = 'eke'; 

//$user = 'carsunion';
//$pass = 'carsunion_user';
//$host = 'localhost';
//$db_name = 'carunion';
$dsn = "mysql://$user:$pass@$host/$db_name";
//$db = DB::connect($dsn, true);
$options = array('debug' => true);
$db = DB::connect($dsn, $options);
//$db = DB::connect($dsn);
if (DB::isError($db)) {
	die($db->getMessage());
}
$db->setFetchMode(DB_FETCHMODE_ASSOC);
$db->query("set names 'utf8'");
?>