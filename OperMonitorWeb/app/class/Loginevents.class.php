<?php
	class Loginevents
	{
		function __construct($get)
		{
			if(isset($get['loginevents']))
			{
				$login = new Login();
				$user = new User($login->GetUser());
				$db = new Database();
				
				if($login->CheckSession())
				{
					if($get['loginevents'] == 'getloginevents')
					{
						if(!isset($get['serialnumber']) || !isset($get['action']) || !isset($get['systemname']) || !isset($get['systemnamevalue']) || !isset($get['login']) || !isset($get['loginvalue']))
							exit();
						
						if($user->Access("access_login_events", "0"))
						{
							echo '-100';
							exit();
						}
						
						$query = 'SELECT * FROM loginhistory WHERE ';
						
						$serialnumber = $get['serialnumber'];
						$action = $get['action'];
						$systemname = $get['systemname'];
						$systemnamevalue = $get['systemnamevalue'];
						$userlogin = $get['login'];
						$loginvalue = $get['loginvalue'];
						
						if($serialnumber == '' && $systemname == '' && $userlogin == '')
						{
							echo '-1';
							exit();
						}
						
						if($serialnumber != '')
							$query = $query.'serialnumber LIKE "%'.$serialnumber.'%" ';
						
						if($systemname != '')
						{
							$val = '';
							if($systemnamevalue == "0")
								$val = '"%'.$systemname.'%"';
							else if($systemnamevalue == "1")
								$val = '"'.$systemname.'%"';
							else if($systemnamevalue == "2")
								$val = '"%'.$systemname.'"';
							else if($systemnamevalue == "3")
								$val = '"'.$systemname.'"';
							
							if($serialnumber != '')
								$query = $query.' AND systemname LIKE '.$val;
							else
							{
								if($systemnamevalue == "3")
									$query = $query.' systemname = '.$val;
								else
									$query = $query.' systemname LIKE '.$val;
							}
						}
						
						if($userlogin != '')
						{
							$val = '';
							if($loginvalue == "0")
								$val = '"%'.$userlogin.'%"';
							else if($loginvalue == "1")
								$val = '"'.$userlogin.'%"';
							else if($loginvalue == "2")
								$val = '"%'.$userlogin.'"';
							else if($loginvalue == "3")
								$val = '"'.$userlogin.'"';
							
							if($serialnumber != '' || $systemname != '')
								$query = $query.' AND login LIKE '.$val;
							else
							{
								if($loginvalue == "3")
									$query = $query.' login = '.$val;
								else
									$query = $query.' login LIKE '.$val;
							}
						}
						
						if($action != '' && ($serialnumber != '' || $systemname != '' || $userlogin != ''))
						{
							if($action == "1")
								$query = $query.' AND actiontype = "1"';
							else if($action == "2")
								$query = $query.' AND actiontype = "2"';
						}
						
						$rows = $db -> select($query);
						if(sizeof($rows) > 0)
						{
							for($i = 0; $i <= sizeof($rows) - 1; $i++)
							{
								echo '<tr>';
								echo '<td>'.$rows[$i]['systemname'].'</td>';
								echo '<td>'.$rows[$i]['serialnumber'].'</td>';
								echo '<td>'.$rows[$i]['login'].'</td>';
								if($rows[$i]['actiontype'] == "1")
									echo "<td>Log in</td>";
								else if($rows[$i]['actiontype'] == "2")
									echo "<td>Log off</td>";
								else
									echo "<td>Unknown</td>";
								echo '<td>'.$rows[$i]['time'].'</td>';
								echo '</tr>';
							}
						}
						else
						{
							echo "0";
							exit();
						}
					}
					exit();
				}
			}
		}
	}
?>