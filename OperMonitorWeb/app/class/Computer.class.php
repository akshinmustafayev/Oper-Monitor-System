<?php
	class Computer 
	{
		private $db;
		public $id;
		public $serialnumber;
		public $computername;
		public $computervendor;
		public $domain;
		public $os;
		public $ram;
		public $processor;
		public $ipaddress;
		public $harddisk;
		public $harddiskserial;
		public $graphicscard;
		public $lastactiondate;
		public $pathvariable;
		
		public function __construct($computer = array()){
			$this->db = new Database();
			$this->id = $computer[0]['id'];
			$this->serialnumber = $computer[0]['serialnumber'];
			$this->computername = $computer[0]['computername'];
			$this->computervendor = $computer[0]['computervendor'];
			$this->domain = $computer[0]['domain'];
			$this->os = $computer[0]['os'];
			$this->ram = $computer[0]['ram'];
			$this->processor = $computer[0]['processor'];
			$this->ipaddress = $computer[0]['ipaddress'];
			$this->harddisk = $computer[0]['harddisk'];
			$this->harddiskserial = $computer[0]['harddiskserial'];
			$this->graphicscard = $computer[0]['graphicscard'];
			$this->lastactiondate = $computer[0]['lastactiondate'];
			$this->pathvariable = $computer[0]['pathvariable'];
		}
		
		public function Id()
		{
			return $this->id;
		}
		
		public function Serialnumber()
		{
			return $this->serialnumber;
		}
		
		public function SetSerialnumber($new_serialnumber)
		{
			$this->db->query('UPDATE computers SET serialnumber = "'.$new_serialnumber.'" WHERE id = "'.self::id().'"');
			$this->serialnumber = $new_serialnumber;
		}
		
		public function Computername()
		{
			return $this->computername;
		}
		
		public function SetComputername($new_computername)
		{
			$this->db->query('UPDATE computers SET computername = "'.$new_computername.'" WHERE id = "'.self::id().'"');
			$this->computername = $new_computername;
		}
		
		public function Computervendor()
		{
			return $this->computervendor;
		}
		
		public function SetComputervendor($new_computervendor)
		{
			$this->db->query('UPDATE computers SET computervendor = "'.$new_computervendor.'" WHERE id = "'.self::id().'"');
			$this->computervendor = $new_computervendor;
		}
		
		public function Domain()
		{
			return $this->domain;
		}
		
		public function SetDomain($new_domain)
		{
			$this->db->query('UPDATE computers SET domain = "'.$new_domain.'" WHERE id = "'.self::id().'"');
			$this->domain = $new_domain;
		}
		
		public function Os()
		{
			return $this->os;
		}
		
		public function SetOs($new_os)
		{
			$this->db->query('UPDATE computers SET os = "'.$new_os.'" WHERE id = "'.self::id().'"');
			$this->os = $new_os;
		}
		
		public function Ram()
		{
			return $this->ram;
		}
		
		public function SetRam($new_ram)
		{
			$this->db->query('UPDATE computers SET ram = "'.$new_ram.'" WHERE id = "'.self::id().'"');
			$this->ram = $new_ram;
		}
		
		public function Processor()
		{
			return $this->processor;
		}
		
		public function SetProcessor($new_processor)
		{
			$this->db->query('UPDATE computers SET processor = "'.$new_processor.'" WHERE id = "'.self::id().'"');
			$this->processor = $new_processor;
		}
		
		public function Ipaddress()
		{
			return $this->ipaddress;
		}
		
		public function SetIpaddress($new_ipaddress)
		{
			$this->db->query('UPDATE computers SET ipaddress = "'.$new_ipaddress.'" WHERE id = "'.self::id().'"');
			$this->ipaddress = $new_ipaddress;
		}
		
		public function Harddisk()
		{
			return $this->harddisk;
		}
		
		public function SetHarddisk($new_harddisk)
		{
			$this->db->query('UPDATE computers SET harddisk = "'.$new_harddisk.'" WHERE id = "'.self::id().'"');
			$this->harddisk = $new_harddisk;
		}
		
		public function Harddiskserial()
		{
			return $this->harddiskserial;
		}
		
		public function SetHarddiskserial($new_harddiskserial)
		{
			$this->db->query('UPDATE computers SET harddiskserial = "'.$new_harddiskserial.'" WHERE id = "'.self::id().'"');
			$this->harddiskserial = $new_harddiskserial;
		}
		
		public function Graphicscard()
		{
			return $this->graphicscard;
		}
		
		public function SetGraphicscard($new_graphicscard)
		{
			$this->db->query('UPDATE computers SET graphicscard = "'.$new_graphicscard.'" WHERE id = "'.self::id().'"');
			$this->graphicscard = $new_graphicscard;
		}
		
		public function Lastactiondate()
		{
			return $this->lastactiondate;
		}
		
		public function SetLastactiondate($new_lastactiondate)
		{
			$this->db->query('UPDATE computers SET lastactiondate = "'.$new_lastactiondate.'" WHERE id = "'.self::id().'"');
			$this->lastactiondate = $new_lastactiondate;
		}
		
		public function Pathvariable()
		{
			return $this->pathvariable;
		}
		
		public function SetPathvariable($new_pathvariable)
		{
			$this->db->query('UPDATE computers SET pathvariable = "'.$new_pathvariable.'" WHERE id = "'.self::id().'"');
			$this->pathvariable = $new_pathvariable;
		}
	}
?>