<?php
	class Messages
	{
		function __construct($get)
		{
			if(isset($get['messages']))
			{
				$login = new Login();
				$user = new User($login->GetUser());
				$db = new Database();
				
				if($login->CheckSession())
				{
					if($get['messages'] == 'getmessages')
					{
						if($user->Access("access_messages", "0"))
						{
							echo '-100';
							exit();
						}
						
						$rows = $db -> select('SELECT * FROM `messages`');
						for($i = 0; $i <= sizeof($rows) - 1; $i++)
						{
							echo '<tr data-id="'.$rows[$i]['id'].'" class="opm-hover-light" onclick="showMessageInfo(this)">';
							$rows[$i]['header'] = str_replace("<br>", "", $rows[$i]['header']);
							echo '<td>'.$rows[$i]['header'].'</td>';
							$rows[$i]['messagetext'] = str_replace("<br>", "", $rows[$i]['messagetext']);
							echo '<td data-info="users.left.table.hide" class="opm-grid-hide">'.$rows[$i]['messagetext'].'</td>';
							echo '<td data-info="users.left.table.hide" class="opm-grid-hide">'.$rows[$i]['time'].'</td>';
							echo '</tr>';
						}
					}
					else if($get['messages'] == 'messageinfo')
					{
						if(!isset($get['messageid']))
						{
							echo "0";
							exit();
						}
						
						if($user->Access("access_messages", "0"))
						{
							echo '-100';
							exit();
						}
						
						$id = $get['messageid'];
						
						$rows = $db -> select('SELECT * FROM `messages` WHERE id="'.$id.'"');
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
					else if($get['messages'] == 'changemessage')
					{
						if(!isset($get['messageid']) || !isset($get['messageheader']) || !isset($get['messagetext']) || !isset($get['messagevisible']))
						{
							echo "0";
							exit();
						}
						
						if($user->Access("access_messages", "0"))
						{
							echo '-100';
							exit();
						}
						
						$messageid = $get['messageid'];
						$messageheader = $get['messageheader'];
						$messagetext = $get['messagetext'];
						$messagevisible = $get['messagevisible'];
						$time = OperMonitorSystem::CurrentTime();
						$rows = $db -> query('UPDATE messages SET header=\''.$messageheader.'\', messagetext=\''.$messagetext.'\', visible=\''.$messagevisible.'\', time=\''.$time.'\'  where id="'.$messageid.'"');
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
					else if($get['messages'] == 'deletemessage')
					{
						if(!isset($get['messageid']))
						{
							echo "0";
							exit();
						}
						
						if($user->Access("access_messages", "0"))
						{
							echo '-100';
							exit();
						}
						
						$messageid = $get['messageid'];
						$rows = $db -> query('DELETE FROM messages WHERE id="'.$messageid.'"');
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
					else if($get['messages'] == 'createmessage')
					{
						if(!isset($get['header']) || !isset($get['messagetext']) || !isset($get['visibility']))
						{
							echo "0";
							exit();
						}
						
						if($user->Access("access_messages", "0"))
						{
							echo '-100';
							exit();
						}
						
						$header = $get['header'];
						$text = $get['messagetext'];
						$visibility = $get['visibility'];
						$time = OperMonitorSystem::CurrentTime();
						
						$rows = $db -> query('INSERT INTO `messages` (header, messagetext, visible, time) VALUES ("'.$header.'", "'.$text.'", "'.$visibility.'", "'.$time.'")');
						if($rows)
						{
							echo "1";
							exit();
						}
						else
						{
							echo "2";
							print_r($rows);
							exit();
						}
					}
				}
				exit();
			}
		}
	}
?>
