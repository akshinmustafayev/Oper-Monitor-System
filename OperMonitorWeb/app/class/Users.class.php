<?php
	class Users
	{
		function __construct($get)
		{
			if(isset($get['users']))
			{
				$login = new Login();
				$user = new User($login->GetUser());
				$db = new Database();
				
				if($login->CheckSession())
				{
					if($get['users'] == 'getusers')
					{
						if($user->Access("access_users", "0"))
						{
							echo '-100';
							exit();
						}
						
						$rows = $db -> select('SELECT `id`,`name`,`surname`,`login`,`access`,`logindate` FROM `users`');
						for($i = 0; $i <= sizeof($rows) - 1; $i++)
						{
							echo '<tr data-id="'.$rows[$i]['id'].'" data-login="'.$rows[$i]['login'].'" class="opm-hover-light" onclick="showUserInfo(this)">';
							echo '<td>'.$rows[$i]['login'].'</td>';
							echo '<td data-info="users.left.table.hide" class="opm-grid-hide">'.$rows[$i]['name'].'</td>';
							echo '<td data-info="users.left.table.hide" class="opm-grid-hide">'.$rows[$i]['surname'].'</td>';
							$json_access = json_decode($rows[$i]['access']);
							echo '<td>'.$json_access->{'access_computers'}.", ".$json_access->{'access_computers_add'}.", ".$json_access->{'access_computers_add'}.", ".$json_access->{'access_bookmarks'}.", ".$json_access->{'access_login_events'}.", ".$json_access->{'access_monitoring'}.", ".$json_access->{'access_messages'}.", ".$json_access->{'access_users'}.", ".$json_access->{'access_users_add'}.'</td>';
							echo '<td data-info="users.left.table.hide" class="opm-grid-hide">'.$rows[$i]['logindate'].'</td>';
							echo '</tr>';
						}
					}
					else if($get['users'] == 'userinfo')
					{
						if(!isset($get['userid']) || !isset($get['userlogin']))
						{
							echo "0";
							exit();
						}
						
						if($user->Access("access_users", "0"))
						{
							echo '-100';
							exit();
						}
						
						$id = $get['userid'];
						$userlogin = $get['userlogin'];
						
						$rows = $db -> select('SELECT * FROM `users` WHERE id="'.$id.'" AND login="'.$userlogin.'"');
						if(sizeof($rows) > 0)
						{
							echo json_encode($rows[0]);
							exit();
						}
						else
						{
							echo "1";
							exit();
						}
					}
					else if($get['users'] == 'setuserpassword')
					{
						if(!isset($get['userid']) || !isset($get['userpassword']))
						{
							echo "0";
							exit();
						}
						
						if($user->Access("access_users", "0"))
						{
							echo '-100';
							exit();
						}
						
						$id = $get['userid'];
						$password = $get['userpassword'];
						
						if($password == "" || strlen($password) < 4)
						{
							echo "3";
							exit();
						}
						
						$password = sha1(md5($password).'Q34^4345_!@fTyuu');
						$rows = $db -> query('UPDATE users SET password="'.$password.'" where id="'.$id.'"');
						if($rows)
						{
							echo "1";
						}
						else
						{
							echo "2";
						}
					}
					else if($get['users'] == 'logoffuser')
					{
						if(!isset($get['userid']))
						{
							echo "0";
							exit();
						}
						
						if($user->Access("access_users", "0"))
						{
							echo '-100';
							exit();
						}
						
						$id = $get['userid'];
						$rows = $db -> query('UPDATE users SET token="" where id="'.$id.'"');
						if($rows)
						{
							echo "1";
						}
						else
						{
							echo "2";
						}
					}
					else if($get['users'] == 'changeusernamesurname')
					{
						if(!isset($get['userid']) || !isset($get['username']) || !isset($get['usersurname']))
						{
							echo "0";
							exit();
						}
						
						if($user->Access("access_users", "0"))
						{
							echo '-100';
							exit();
						}
						
						$id = $get['userid'];
						$name = $get['username'];
						$surname = $get['usersurname'];
						
						$rows = $db -> query('UPDATE users SET name="'.$name.'", surname="'.$surname.'" where id="'.$id.'"');
						if($rows)
						{
							echo "1";
						}
						else
						{
							echo "2";
						}
					}
					else if($get['users'] == 'changeuseraccess')
					{
						if(!isset($get['userid']) || !isset($get['useraccess']))
						{
							echo "0";
							exit();
						}
						
						if($user->Access("access_users", "0"))
						{
							echo '-100';
							exit();
						}
						
						$userid = $get['userid'];
						$useraccess = $get['useraccess'];
						$rows = $db -> query('UPDATE users SET access=\''.$useraccess.'\' where id="'.$userid.'"');
						if($rows)
						{
							echo "1";
						}
						else
						{
							echo "2";
						}
					}
					else if($get['users'] == 'getuseraccess')
					{
						if(!isset($get['userid']) || !isset($get['userlogin']))
						{
							echo "0";
							exit();
						}
						
						if($user->Access("access_users", "0"))
						{
							echo '-100';
							exit();
						}
						
						$userid = $get['userid'];
						$userlogin = $get['userlogin'];
						$rows = $db -> select('SELECT access FROM users where id="'.$userid.'" AND login="'.$userlogin.'"');
						if(sizeof($rows) > 0)
						{
							echo $rows[0]['access'];
							exit();
						}
						else
						{
							echo "1";
							exit();
						}
					}
					else if($get['users'] == 'deleteuser')
					{
						if(!isset($get['userid']))
						{
							echo "0";
							exit();
						}
						
						if($user->Access("access_users", "0"))
						{
							echo '-100';
							exit();
						}
						
						$id = $get['userid'];
						$rows = $db -> query('DELETE FROM users WHERE id="'.$id.'"');
						if($rows)
						{
							echo "1";
							exit();
						}
						else
						{
							echo "2";
							exit();
						}
					}
					else if($get['users'] == 'createuser')
					{
						if(!isset($get['username']) || !isset($get['usersurname']) || !isset($get['userlogin']) || !isset($get['userpassword']))
						{
							echo "0";
							exit();
						}
						
						if($user->Access("access_users_add", "0"))
						{
							echo '-100';
							exit();
						}
						
						$username = $get['username'];
						$usersurname = $get['usersurname'];
						$userlogin = $get['userlogin'];
						$userpassword = $get['userpassword'];
						
						if($userpassword == "" || strlen($userpassword) < 4)
						{
							echo '4';
							exit();
						}
						
						$userpassword = sha1(md5($userpassword).'Q34^4345_!@fTyuu');
						
						$rows = $db -> select('SELECT * FROM `users` WHERE login="'.$userlogin.'"');
						if(sizeof($rows) > 0)
						{
							echo "1";
							exit();
						}
						else
						{
							$rows2 = $db -> query('INSERT INTO `users` (name, surname, login, password, access) VALUES ("'.$username.'", "'.$usersurname.'", "'.$userlogin.'", "'.$userpassword.'", "{\"access_computers\":\"0\" ,\"access_computers_add\":\"0\" ,\"access_bookmarks\":\"0\" ,\"access_login_events\":\"0\" ,\"access_monitoring\":\"0\" ,\"access_messages\":\"0\" ,\"access_users\":\"0\" ,\"access_users_add\":\"0\"}")');
							if($rows2)
							{
								echo "2";
								exit();
							}
							else
							{
								echo "3";
								exit();
							}
						}
					}
				}
				exit();
			}
		}
	}
?>