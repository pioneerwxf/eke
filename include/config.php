<?php
//define('APP_ROOT', '/opt/lampp/htdocs/');
define('APP_ROOT', '../');
define('SMARTY_DIR', APP_ROOT . 'lib/smarty/');
define('CONFIG_DIR', APP_ROOT . 'configs/');
define('TEMPLATES_DIR', APP_ROOT . 'templates/');
define('CACHE_DIR', APP_ROOT . 'tmp/');
define('AD_DIR', APP_ROOT . 'AD/');
define('NumPerPage', 10);

define('CU_DEBUG', true);

define('DIR_ATTACH', APP_ROOT . 'upload/');
define('BASE_URL', 'localhost/');
define('WEB_DIR_ATTACH', BASE_URL . 'upload/');

define('SITE_TITLE', '网站');
define('ADMIN_EMAIL', 'pioneerwxf@gmail.com');
define('ADMIN_NAME', 'ADMIN');
if (strncmp(PHP_VERSION, '5', 1) == 0) {
	define('JPGRAPH_DIR', APP_ROOT . 'lib/jpgraph/');
} else {
	define('JPGRAPH_DIR', APP_ROOT . 'lib/jpgraph12/');
}

//for table definition
require_once(APP_ROOT . 'include/tables.php');

//import pear
ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR  . APP_ROOT . PATH_SEPARATOR  . APP_ROOT . "lib/pear/" );
?>