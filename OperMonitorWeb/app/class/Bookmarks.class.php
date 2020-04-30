<?php
	class Bookmarks
	{
		function __construct($get)
		{
			if(isset($get['bookmarks']))
			{
				$login = new Login();
				$user = new User($login->GetUser());
				$db = new Database();
				
				if($login->CheckSession())
				{
					if($get['bookmarks'] == 'addcomputertobookmarks')
					{
						if(!isset($get['computerid']))
							exit();
						
						if($user->Access("access_bookmarks", "0"))
						{
							echo '-100';
							exit();
						}
						
						$id = $get['computerid'];
						
						$rows = $db -> select('SELECT * FROM `bookmarks` WHERE computer_id="'.$id.'" AND user_id="'.$user->Id().'"');
						if(sizeof($rows) > 0)
						{
							$rows = $db -> query('DELETE FROM `bookmarks` WHERE computer_id="'.$id.'" AND user_id="'.$user->Id().'"');
							echo "1";
							exit();
						}
						else
						{
							$rows = $db -> query('INSERT INTO `bookmarks` (computer_id, user_id) values ("'.$id.'", "'.$user->Id().'")');
							echo "2";
							exit();
						}
					}
					if($get['bookmarks'] == 'getcomputerbookmarkinfo')
					{
						if(!isset($get['computerid']))
							exit();
						
						if($user->Access("access_bookmarks", "0"))
						{
							echo '-100';
							exit();
						}
						
						$id = $get['computerid'];
						
						$rows = $db -> select('SELECT * FROM `bookmarks` WHERE computer_id="'.$id.'" AND user_id="'.$user->Id().'"');
						if(sizeof($rows) > 0)
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
					if($get['bookmarks'] == 'getbookmarkcomputers')
					{
						if($user->Access("access_bookmarks", "0"))
						{
							echo '-100';
							exit();
						}
						
						$piece = 0;
						if(isset($get['piece']))
							$piece = $get['piece'] * 100;
						
						$rows = $db -> select('SELECT `id`,`systemname`,`computername`,`serialnumber`,`os` FROM `computers` WHERE `id` IN (SELECT computer_id FROM `bookmarks` WHERE user_id="'.$user->Id().'") LIMIT '.$piece.', 100');
						for($i = 0; $i <= sizeof($rows) - 1; $i++)
						{
							echo '<tr data-id="'.$rows[$i]['id'].'" data-serialnumber="'.$rows[$i]['serialnumber'].'" class="opm-hover-light" onclick="showBookmarkInfo(this)">';
							echo '<td>'.$rows[$i]['systemname'].'</td>';
							echo '<td data-info="allcomputers.left.table.hide" class="opm-grid-hide">'.$rows[$i]['computername'].'</td>';
							echo '<td>'.$rows[$i]['serialnumber'].'</td>';
							echo '<td data-info="allcomputers.left.table.hide" class="opm-grid-hide">'.$rows[$i]['os'].'</td>';
							echo '</tr>';
						}
					}
					else if($get['bookmarks'] == 'searchcomputer')
					{
						if(!isset($get['searchtext']) || !isset($get['searchtype']))
							exit();
						
						if($user->Access("access_bookmarks", "0"))
						{
							echo '-100';
							exit();
						}
						
						$searchtext = $get['searchtext'];
						$searchtype = $get['searchtype'];
						$searchrow = 'systemname';
						
						if($searchtype == "1")
							$searchrow = 'systemname';
						else if($searchtype == "2")
							$searchrow = 'computername';
						else if($searchtype == "3")
							$searchrow = 'serialnumber';
						else if($searchtype == "4")
							$searchrow = 'computervendor';
						else if($searchtype == "5")
							$searchrow = 'domain';
						else if($searchtype == "6")
							$searchrow = 'os';
						else if($searchtype == "7")
							$searchrow = 'ram';
						else if($searchtype == "8")
							$searchrow = 'processor';
						else if($searchtype == "9")
							$searchrow = 'ipaddress';
						else if($searchtype == "10")
							$searchrow = 'harddisk';
						else if($searchtype == "11")
							$searchrow = 'harddiskserial';
						else if($searchtype == "12")
							$searchrow = 'graphicscard';
						else if($searchtype == "13")
							$searchrow = 'lastactiondate';
						
						$piece = 0;
						if(isset($get['piece']))
							$piece = $get['piece'] * 100;
						
						$rows = $db -> select('SELECT `id`,`systemname`,`computername`,`serialnumber`,`os` FROM `computers` WHERE `id` IN (SELECT computer_id FROM `bookmarks` WHERE user_id="'.$user->Id().'") AND '.$searchrow.' LIKE "%'.$searchtext.'%" LIMIT '.$piece.', 100');
						for($i = 0; $i <= sizeof($rows) - 1; $i++)
						{
							echo '<tr data-id="'.$rows[$i]['id'].'" data-serialnumber="'.$rows[$i]['serialnumber'].'" class="opm-hover-light" onclick="showBookmarkInfo(this)">';
							echo '<td>'.$rows[$i]['systemname'].'</td>';
							echo '<td data-info="allcomputers.left.table.hide" class="opm-grid-hide">'.$rows[$i]['computername'].'</td>';
							echo '<td>'.$rows[$i]['serialnumber'].'</td>';
							echo '<td data-info="allcomputers.left.table.hide" class="opm-grid-hide">'.$rows[$i]['os'].'</td>';
							echo '</tr>';
						}
					}
					else if($get['bookmarks'] == 'computerinfo')
					{
						if(!isset($get['computerid']))
							exit();
						
						if($user->Access("access_bookmarks", "0"))
						{
							echo '-100';
							exit();
						}
						
						$id = $get['computerid'];
						
						$rows = $db -> select('SELECT * FROM `computers` WHERE `id` = (SELECT computer_id FROM `bookmarks` WHERE user_id="'.$user->Id().'" AND computer_id = "'.$id.'")');
						echo json_encode($rows[0]);
					}
					else if($get['bookmarks'] == 'computerloginevents')
					{
						if(!isset($get['serialnumber']))
							exit();
						
						if($user->Access("access_bookmarks", "0"))
						{
							echo '-100';
							exit();
						}
						
						$serialnumber = $get['serialnumber'];
						$piece = 0;
						if(isset($get['piece']))
							$piece = $get['piece'] * 100;
						
						$rows = $db -> select('SELECT * FROM `loginhistory` WHERE serialnumber="'.$serialnumber.'" ORDER BY id DESC LIMIT '.$piece.', 100');
						echo json_encode($rows);
					}
					exit();
				}
			}
		}
	}
?>
