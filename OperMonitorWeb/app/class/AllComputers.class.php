<?php
	class AllComputers
	{
		function __construct($get)
		{
			if(isset($get['allcomputers']))
			{
				$login = new Login();
				$user = new User($login->GetUser());
				$db = new Database();
				
				if($login->CheckSession())
				{
					if($get['allcomputers'] == 'getcomputers')
					{
						if($user->Access("access_computers", "0"))
						{
							echo '-100';
							exit();
						}
						
						$piece = 0;
						if(isset($get['piece']))
							$piece = $get['piece'] * 100;
						
						
						$rows = $db -> select('SELECT `id`,`systemname`,`computername`,`serialnumber`,`os` FROM `computers` LIMIT '.$piece.', 100');
						for($i = 0; $i <= sizeof($rows) - 1; $i++)
						{
							echo '<tr data-id="'.$rows[$i]['id'].'" data-serialnumber="'.$rows[$i]['serialnumber'].'" class="opm-hover-light" onclick="showComputerInfo(this)">';
							echo '<td>'.$rows[$i]['systemname'].'</td>';
							echo '<td data-info="allcomputers.left.table.hide" class="opm-grid-hide">'.$rows[$i]['computername'].'</td>';
							echo '<td>'.$rows[$i]['serialnumber'].'</td>';
							echo '<td data-info="allcomputers.left.table.hide" class="opm-grid-hide">'.$rows[$i]['os'].'</td>';
							echo '</tr>';
						}
					}
					else if($get['allcomputers'] == 'computerinfo')
					{
						if(!isset($get['computerid']))
							exit();
						
						if($user->Access("access_computers", "0"))
						{
							echo '-100';
							exit();
						}
						
						$id = $get['computerid'];
						
						$rows = $db -> select('SELECT * FROM `computers` WHERE id="'.$id.'"');
						echo json_encode($rows[0]);
					}
					else if($get['allcomputers'] == 'computerloginevents')
					{
						if(!isset($get['serialnumber']))
							exit();
						
						if($user->Access("access_login_events", "0"))
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
					else if($get['allcomputers'] == 'searchcomputer')
					{
						if(!isset($get['searchtext']) || !isset($get['searchtype']))
							exit();
						
						if($user->Access("access_computers", "0"))
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
						
						$rows = $db -> select('SELECT `id`,`systemname`,`computername`,`serialnumber`,`os` FROM `computers` WHERE '.$searchrow.' LIKE "%'.$searchtext.'%" LIMIT '.$piece.', 100');
						for($i = 0; $i <= sizeof($rows) - 1; $i++)
						{
							echo '<tr data-id="'.$rows[$i]['id'].'" data-serialnumber="'.$rows[$i]['serialnumber'].'" class="opm-hover-light" onclick="showComputerInfo(this)">';
							echo '<td>'.$rows[$i]['systemname'].'</td>';
							echo '<td data-info="allcomputers.left.table.hide" class="opm-grid-hide">'.$rows[$i]['computername'].'</td>';
							echo '<td>'.$rows[$i]['serialnumber'].'</td>';
							echo '<td data-info="allcomputers.left.table.hide" class="opm-grid-hide">'.$rows[$i]['os'].'</td>';
							echo '</tr>';
						}
					}
				}
				exit();
			}
		}
	}
?>
