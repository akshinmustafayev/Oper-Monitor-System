<?php
	class Login 
	{
		private $db;
		
		public function __construct(){
			$this->db = new Database();
		}
		
		/**
		 * Log in function
		 *
		 * @0 - successfully logged in
		 * @1 - password incorrect
		 * @2 - login incorrect
		 * @3 - user blocked
		*/
		public function LogIn($login, $password)
		{
			$login = strtolower($login);
			$password = sha1(md5($password).'Q34^4345_!@fTyuu');
			$row = $this -> db -> select('SELECT * FROM `users` WHERE login="'.$login.'"');
			if(!empty($row))
			{
				$user = new User($row);
				if($password != $user->Password())
					return 1;
				if($user->Block() == true)
					return 3;
				
				else
				{
					$user->SetToken(sha1(md5(OperMonitorSystem::GenerateToken().OperMonitorSystem::CurrentTime())));
					$user->SetLogindate(OperMonitorSystem::CurrentTime());
					$_SESSION['operm_user_id'] = $user->Id();
					$_SESSION['operm_user_login'] = $user->Login();
					$_SESSION['operm_user_token'] = $user->Token();
					setcookie('cookie_operm_user_id', $_SESSION['operm_user_id'], time()+60*60*24*7);
					setcookie('cookie_operm_user_login', $_SESSION['operm_user_login'], time()+60*60*24*7);
					setcookie('cookie_operm_user_token', $_SESSION['operm_user_token'], time()+60*60*24*7);
					return 0;
				}
			}
			else
				return 2;
		}
		
		/**
		 * Log out
		*/
		public function LogOut()
		{
			session_destroy();
			session_unset();
			session_regenerate_id();
			setcookie('cookie_operm_user_id', "");
			setcookie('cookie_operm_user_login', "");
			setcookie('cookie_operm_user_token', "");
			unset($_COOKIE['cookie_operm_user_id']);
			unset($_COOKIE['cookie_operm_user_login']);
			unset($_COOKIE['cookie_operm_user_token']);
			header("Location: index.php");
		}
		
		/**
		 * Checks if session and cookies exist
		*/
		public function CheckSession()
		{
			if(!isset($_SESSION["operm_user_id"]) || 
				!isset($_SESSION["operm_user_login"]) || 
				!isset($_SESSION["operm_user_token"]) || 
				!isset($_COOKIE["cookie_operm_user_id"]) || 
				!isset($_COOKIE["cookie_operm_user_login"]) || 
				!isset($_COOKIE["cookie_operm_user_token"]))
			{
				return false;
			}
			else
			{
				$id = $_COOKIE["cookie_operm_user_id"];
				$login = $_COOKIE["cookie_operm_user_login"];
				$token = $_COOKIE["cookie_operm_user_token"];
				
				$row = $this -> db -> select('SELECT * FROM `users` WHERE id="'.$id.'" AND login="'.$login.'" AND token="'.$token.'"');
				if(!empty($row))
				{
					return true;
				}
				else
					return false;
			}
		}
		
		public function GetUser()
		{
			$id = $_COOKIE["cookie_operm_user_id"];
			$login = $_COOKIE["cookie_operm_user_login"];
			$token = $_COOKIE["cookie_operm_user_token"];
			
			$row = $this -> db -> select('SELECT * FROM `users` WHERE id="'.$id.'" AND login="'.$login.'" AND token="'.$token.'"');
			
			return $row;
		}
		
		public function UpdatePassword($newpassword, $confirmpassword, $userid)
		{
			if($newpassword == "" || $confirmpassword == "")
			{
				return "-2";
				exit();
			}
			
			if($newpassword != $confirmpassword)
			{
				return "-1";
				exit();
			}
			
			if($newpassword == "" || strlen($newpassword) < 4)
			{
				return "-3";
				exit();
			}
			
			if($confirmpassword == "" || strlen($confirmpassword) < 4)
			{
				return "-3";
				exit();
			}
			
			$newpassword = sha1(md5($newpassword).'Q34^4345_!@fTyuu');
			$row = $this -> db -> query('UPDATE users SET password="'.$newpassword.'" where id="'.$userid.'"');
			return "0";
		}
	}
?>