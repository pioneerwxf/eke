<?php
require_once(dirname(__FILE__) . '/../include/config.php');
require_once('smarty/Smarty.class.php');

class MySmarty extends Smarty {
	var $lang_dir = "";
	
	function MySmarty() {
		
		$this->Smarty();
		$this->template_dir = TEMPLATES_DIR . 'front/';
		$this->config_dir = CONFIG_DIR;
		$this->compile_dir = CACHE_DIR;
		$this->plugins_dir = SMARTY_DIR . 'plugins/';
		
		$this->php_handling = SMARTY_PHP_ALLOW;
		
		$lang = $_COOKIE["user_lan"];
		if ($lang == "" || $lang == "en"
			|| (!file_exists(TEMPLATES_DIR . "/" . $lang))) 
		{
			$this->template_dir = TEMPLATES_DIR . "/front/";
		}
		else
		{ 
		    $this->template_dir = TEMPLATES_DIR . "/" . $lang ."/";
		}
		
		if ($lang == "" || $lang == "en"
			|| (!file_exists(CONFIG_DIR . "/" . $lang))) 
		{
			$this->lang_dir = CONFIG_DIR . "/language/default/";
		}
		else
		{ 
		    $this->lang_dir = CONFIG_DIR . "/language/" . $lang ."/";
		}
		
		$this->caching = false;
		$this->debugging = false;
	}
	
	function SetLangFile ($filename) {
		$this->assign("langfile", $this->lang_dir . $filename);
	}
}
?>