<?php
	class Monitoring
	{
		function __construct($get)
		{
			if(isset($get['monitoring']))
			{
				$login = new Login();
				$user = new User($login->GetUser());
				$db = new Database();
				
				if($login->CheckSession())
				{
					if($get['monitoring'] == 'getmonitoring')
					{
						echo '{ "ramlimit":"'.OperMonitorSystem::GetServerRamLimit().'", "ramusage":"'.OperMonitorSystem::GetServerRamUsage().'", "processorusage":"'.OperMonitorSystem::GetServerCpuUsage().'", "diskusage":"'.OperMonitorSystem::GetServerDiskUsage().'", "computerscount":"'.OperMonitorSystem::GetComputersCount().'", "logineventscount":"'.OperMonitorSystem::GetLogineventsCount().'", "logineventscounttoday":"'.OperMonitorSystem::GetLogineventsCountToday().'", "logineventscountweek":"'.OperMonitorSystem::GetLogineventsCountWeek().'", "logineventscountmonth":"'.OperMonitorSystem::GetLogineventsCountMonth().'" }';
						exit();
					}
					else if($get['monitoring'] == 'getprocessorusage')
					{
						echo OperMonitorSystem::GetServerCpuPercentage();
						exit();
					}
					else if($get['monitoring'] == 'getramusage')
					{
						echo OperMonitorSystem::GetServerRamUsage();
						exit();
					}
					else if($get['monitoring'] == 'getdiskusage')
					{
						echo OperMonitorSystem::GetServerDiskUsage();
						exit();
					}
				}
				exit();
			}
		}
	}
?>
