<?php
	class Opermon
	{
		function __construct($get)
		{
			if(isset($get['opermon']))
			{
				$login = new Login();
				$user = new User($login->GetUser());
				$db = new Database();
				
				if($login->CheckSession())
				{
					if($get['opermon'] == 'updatesidebartype')
					{
						$sidebartype = $get['sidebartype'];
						$user->SetSidebar($sidebartype);
						exit();
					}
					else if($get['opermon'] == 'savesettings')
					{
						$newpassword = $get['newpassword'];
						$confirmpassword = $get['confirmpassword'];
						$domain = $get['domain'];
						
						$rows = $db -> query('UPDATE users SET domain="'.$domain.'" where id="'.$user->Id().'"');
						$result = $login->UpdatePassword($newpassword, $confirmpassword, $user->Id());
						
						echo $result;
						exit();
					}
					else if($get['opermon'] == 'updateuserstatus')
					{
						$db -> query('UPDATE users SET timestamp="'.OperMonitorSystem::CurrentTime().'" where id="'.$user->Id().'"');
						exit();
					}
					else if($get['opermon'] == 'getusersstatuses')
					{
						$rows = $db -> select('SELECT name, surname, timestamp FROM `users` WHERE timestamp BETWEEN date_sub(now(),INTERVAL 1 MINUTE) and now()');
						if(sizeof($rows) > 0)
						{
							echo '<div class="opm-dashboard-user">';
							echo '<img class="opm-dashboard-user-avatar" src="app/views/img/opermonitorlogo.png">';
							echo '<p class="opm-dashboard-user-name">Oper Monitor System</p>';
							echo '</div>';
							
							for($i = 0; $i <= sizeof($rows) - 1; $i++)
							{
								echo '<div class="opm-dashboard-user">';
								echo '<img class="opm-dashboard-user-avatar" src="app/views/img/avatar.png">';
								echo '<p class="opm-dashboard-user-name">'.$rows[$i]['name'].' '.$rows[$i]['surname'].'</p>';
								echo '</div>';
							}
						}
						else
						{
							echo '<div class="opm-dashboard-user">';
							echo '<img class="opm-dashboard-user-avatar" src="app/views/img/opermonitorlogo.png">';
							echo '<p class="opm-dashboard-user-name">Oper Monitor System</p>';
							echo '</div>';
						}
						exit();
					}
					else if($get['opermon'] == 'getmessages')
					{
						$rows = $db -> select('SELECT * FROM `messages` WHERE visible="1"');
						if(sizeof($rows) > 0)
						{
							for($i = 0; $i <= sizeof($rows) - 1; $i++)
							{
								echo '<div class="opm-dashboard-news-item">';
								echo '<div class="opm-dashboard-news-item-header">';
								echo '<div class="opm-dashboard-news-item-header-left">';
								echo '<h2 class="opm-dashboard-news-item-header-text">'.$rows[$i]['header'].'</h2>';
								echo '</div>';
								echo '<div class="opm-dashboard-news-item-header-right">';
								echo '<h2 class="opm-dashboard-news-item-header-text">Time created: '.$rows[$i]['time'].'</h2>';
								echo '</div>';
								echo '</div>';
								echo '<label class="opm-dashboard-news-text">'.$rows[$i]['messagetext'].'<br><br></label>';
								echo '<div class="opm-dashboard-news-item-separator"></div>';
								echo '</div>';
							}
						}
						else
						{
							echo '<div class="opm-dashboard-item">';
							echo '<div class="opm-dashboard-item-header">';
							echo '<div class="opm-dashboard-item-header-left">';
							echo '<h2 class="opm-dashboard-item-header-text">Warning</h2>';
							echo '</div>';
							echo '<div class="opm-dashboard-item-header-right">';
							echo '<h2 class="opm-dashboard-item-header-text">Time created: 00:00:00 00:00:00</h2>';
							echo '</div>';
							echo '</div>';
							echo '<div class="opm-dashboard-item-separator"></div>';
							echo '<label class="opm-dashboard-text">No messages<br><br></label>';
							echo '</div>';
						}
						exit();
					}
					exit();
				}
			}
		}
	}
?>
