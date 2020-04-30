<?php
	class OperMonitorSystem 
	{
		public static function CurrentTime()
		{
			date_default_timezone_set("Asia/Baku");
			$time = (new DateTime())->format('Y-m-d H:i:s');
			return $time;
		}
		
		public static function GenerateToken()
		{
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < 15; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		
		public static function RandomPassword()
		{
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < 15; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		
		public static function GetServerCpuUsage()
		{
			$load = 0;
			if (stristr(PHP_OS, "win"))
			{
				$cmd = "wmic cpu get loadpercentage /all";
				@exec($cmd, $output);

				if ($output)
				{
					foreach ($output as $line)
					{
						if ($line && preg_match("/^[0-9]+\$/", $line))
						{
							$load = $line;
							break;
						}
					}
				}
			}
			else
			{
				if (is_readable("/proc/stat"))
				{
					$statData1 = _getServerLoadLinuxData();
					sleep(1);
					$statData2 = _getServerLoadLinuxData();
					if
					(
						(!is_null($statData1)) &&
						(!is_null($statData2))
					)
					{
						$statData2[0] -= $statData1[0];
						$statData2[1] -= $statData1[1];
						$statData2[2] -= $statData1[2];
						$statData2[3] -= $statData1[3];
						$cpuTime = $statData2[0] + $statData2[1] + $statData2[2] + $statData2[3];
						$load = 100 - ($statData2[3] * 100 / $cpuTime);
					}
				}
			}
			return $load;
		}
		
		public static function GetServerDiskUsage()
		{
			$disktotal = disk_total_space('/');
			$diskfree = disk_free_space ('/');
			$diskuse = round(100 - (($diskfree / $disktotal) * 100))."%";
			return $diskuse;
		}
		
		public static function GetServerRamUsage()
		{
			return memory_get_usage();
		}
		
		public static function GetServerRamLimit()
		{
			$val = trim(ini_get('memory_limit'));
			$last = strtolower($val[strlen($val)-1]);
			switch($last) {
				case 'g':
					$val *= 1024;
				case 'm':
					$val *= 1024;
				case 'k':
					$val *= 1024;
			}
			return $val;
		}
		
		public static function GetComputersCount()
		{
			$db = new Database();
			$rows = $db -> select('SELECT COUNT(id) as id from computers');
			if(sizeof($rows) > 0)
			{
				return $rows[0]['id'];
			}
			else
			{
				return "0";
			}
		}
		
		public static function GetLogineventsCount()
		{
			$db = new Database();
			$rows = $db -> select('SELECT COUNT(id) as id from loginhistory');
			if(sizeof($rows) > 0)
			{
				return $rows[0]['id'];
			}
			else
			{
				return "0";
			}
		}
		
		public static function GetLogineventsCountToday()
		{
			date_default_timezone_set("Asia/Baku");
			$time = (new DateTime())->format('Y-m-d');
			$db = new Database();
			$rows = $db -> select('SELECT COUNT(id) as id from loginhistory WHERE time LIKE "%'.$time.'%"');
			if(sizeof($rows) > 0)
			{
				return $rows[0]['id'];
			}
			else
			{
				return "0";
			}
		}
		
		public static function GetLogineventsCountWeek()
		{
			date_default_timezone_set("Asia/Baku");
			$time = (new DateTime())->format('Y-m-d');
			$db = new Database();
			$rows = $db -> select('select count(id) as id from loginhistory where loginhistory.time between date_sub(now(),INTERVAL 1 WEEK) and now()');
			if(sizeof($rows) > 0)
			{
				return $rows[0]['id'];
			}
			else
			{
				return "0";
			}
		}
		
		public static function GetLogineventsCountMonth()
		{
			date_default_timezone_set("Asia/Baku");
			$time = (new DateTime())->format('Y-m-d');
			$db = new Database();
			$rows = $db -> select('select count(id) as id from loginhistory where loginhistory.time between date_sub(now(),INTERVAL 1 MONTH) and now()');
			if(sizeof($rows) > 0)
			{
				return $rows[0]['id'];
			}
			else
			{
				return "0";
			}
		}
	}
?>