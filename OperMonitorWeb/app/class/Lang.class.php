<?php
	class Lang 
	{
		private $user_lang;
		public $lang = array();
		
		public function __construct(){
			$userLang = '';
			if(!isset($_COOKIE["cookie_operm_user_lang"]))
			{
				setcookie('cookie_operm_user_lang', 'en', time()+60*60*24*365);
				$userLang = 'en';
			}
			else
				$userLang = $_COOKIE["cookie_operm_user_lang"];
			$this->user_lang = $userLang;
		}
		
		public function GetLangArray()
		{
			$loadFile = 'app/locale/'.$this->user_lang.'.ini';
			if(!file_exists($loadFile)){
				setcookie('cookie_operm_user_lang', 'en', time()+60*60*24*365);
				$loadFile = 'app/locale/en.ini';
			}
			$this->lang = parse_ini_file($loadFile);
			return $this->lang;
		}
	}
?>