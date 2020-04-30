<?php
	class Controller 
	{
		function __construct($get, $post)
		{
			$login = new Login();
			$views = new Views();
			$db = new Database();
			
			if($login->CheckSession())
			{
				if(isset($get['logout']))
					$login->LogOut();
				
				$views->AddView('portal.php', $login->GetUser());
				exit();
			}
			else
			{
				if(isset($post['login']) && isset($post['password']))
				{
					$event = $login->LogIn($post['login'], $post['password']);
					if($event == "0")
					{
						header("Location: index.php");
					}
					else if($event != "0")
					{
						$arr = array($event);
						$views->AddView('login.php', $arr);
						exit();
					}
				}
				else if (isset($get['login']))
				{
					$views->AddView('login.php');
					exit();
				}
				else
				{
					$views->AddView('login.php');
				}
			}
		}
	}
?>