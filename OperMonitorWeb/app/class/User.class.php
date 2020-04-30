<?php
	class User 
	{
		private $db;
		public $id;
		public $name;
		public $surname;
		public $login;
		public $password;
		public $access;
		public $lang;
		public $sidebar;
		public $logindate;
		public $block;
		public $token;
		public $maxcomputers;
		public $domain;
		
		public function __construct($user = array()){
			$this->db = new Database();
			$this->id = $user[0]['id'];
			$this->name = $user[0]['name'];
			$this->surname = $user[0]['surname'];
			$this->login = $user[0]['login'];
			$this->password = $user[0]['password'];
			$this->access = $user[0]['access'];
			$this->lang = $user[0]['lang'];
			$this->sidebar = $user[0]['sidebar'];
			$this->logindate = $user[0]['logindate'];
			$this->block = $user[0]['block'];
			$this->token = $user[0]['token'];
			$this->maxcomputers = $user[0]['maxcomputers'];
			$this->domain = $user[0]['domain'];
		}
		
		public function Id()
		{
			return $this->id;
		}
		
		public function Name()
		{
			return $this->name;
		}
		
		public function SetName($new_name)
		{
			$this->db->query('UPDATE users SET name = "'.$new_name.'" WHERE id = "'.self::id().'"');
			$this->name = $new_name;
		}
		
		public function Surname()
		{
			return $this->surname;
		}
		
		public function SetSurname($new_surname)
		{
			$this->db->query('UPDATE users SET surname = "'.$new_surname.'" WHERE id = "'.self::id().'"');
			$this->surname = $new_surname;
		}
		
		public function Login()
		{
			return $this->login;
		}
		
		public function SetLogin($new_login)
		{
			$this->db->query('UPDATE users SET login = "'.$new_login.'" WHERE id = "'.self::id().'"');
			$this->login = $new_login;
		}
		
		public function Password()
		{
			return $this->password;
		}
		
		public function SetPassword($new_password)
		{
			$new_password = sha1(md5($new_password).'456Y345_!!234aa');
			$this->db->query('UPDATE users SET password = "'.$new_password.'" WHERE id = "'.self::id().'"');
			$this->password = $new_password;
		}
		
		public function Access($access_name, $value)
		{
			$json_object = json_decode($this->access);
			if($json_object->{$access_name} == $value)
				return true;
			else
				return false;
		}
		
		public function SetAccess($new_access)
		{
			$this->db->query('UPDATE users SET access = "'.$new_access.'" WHERE id = "'.self::id().'"');
			$this->access = $new_access;
		}
		
		public function Lang()
		{
			return $this->lang;
		}
		
		public function SetLang($new_lang)
		{
			$this->db->query('UPDATE users SET lang = "'.$new_lang.'" WHERE id = "'.self::id().'"');
			$this->lang = $new_lang;
		}
		
		public function Sidebar()
		{
			return $this->sidebar;
		}
		
		public function SetSidebar($new_sidebar)
		{
			$this->db->query('UPDATE users SET sidebar = "'.$new_sidebar.'" WHERE id = "'.self::id().'"');
			$this->sidebar = $new_sidebar;
		}
		
		public function Logindate()
		{
			return $this->logindate;
		}
		
		public function SetLogindate($new_logindate)
		{
			$this->db->query('UPDATE users SET logindate = "'.$new_logindate.'" WHERE id = "'.self::id().'"');
			$this->logindate = $new_logindate;
		}
		
		public function Block()
		{
			return $this->block;
		}
		
		public function SetBlock($new_block)
		{
			$this->db->query('UPDATE users SET block = "'.$new_block.'" WHERE id = "'.self::id().'"');
			$this->block = $new_block;
		}
		
		public function Token()
		{
			return $this->token;
		}
		
		public function SetToken($new_token)
		{
			$this->db->query('UPDATE users SET token = "'.$new_token.'" WHERE id = "'.self::id().'"');
			$this->token = $new_token;
		}
		
		public function Maxcomputers()
		{
			return $this->maxcomputers;
		}
		
		public function SetMaxcomputers($new_maxcomputer)
		{
			$this->db->query('UPDATE users SET maxcomputers = "'.$new_maxcomputer.'" WHERE id = "'.self::id().'"');
			$this->maxcomputers = $new_maxcomputer;
		}
		
		public function Domain()
		{
			return $this->domain;
		}
		
		public function SetDomain($new_domain)
		{
			$this->db->query('UPDATE users SET domain = "'.$new_domain.'" WHERE id = "'.self::id().'"');
			$this->domain = $new_domain;
		}
	}
?>
