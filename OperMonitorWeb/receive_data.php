<?php
	$CONF_DB = array (
		'host' 		=> 'localhost',
		'username'	=> 'root',
		'password'	=> '',
		'db_name'	=> 'opermonitorsystemnew'
	);
	date_default_timezone_set('Europe/Kiev');
	$dbConnection = new PDO(
		'mysql:host='.$CONF_DB['host'].';dbname='.$CONF_DB['db_name'],
		$CONF_DB['username'],
		$CONF_DB['password'],
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
	);
	$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$actiontype = "none"; 
	$login = "none";
    $serialnumber = "none";  
    $systemname = "none"; 
    $computername = "none"; 
    $computervendor = "none"; 
    $domain = "none"; 
    $os = "none"; 
    $ram = "none"; 
    $processor = "none"; 
    $ipaddress = "none"; 
    $harddisk = "none"; 
    $harddiskserial = "none"; 
    $graphicscard = "none"; 
	$pathvariable = 'bm9uZQ==';
	$officeversion = "none";
	
	if(isset($_POST["type"]))
		$actiontype = $_POST["type"]; 
	if(isset($_POST["login"]))
		$login = $_POST["login"]; 
	if(isset($_POST["serialnumber"]))
		$serialnumber = $_POST["serialnumber"];
	if(isset($_POST["compname"]))
		$systemname = $_POST["compname"]; 
	if(isset($_POST["computermodel"]))
		$computername = $_POST["computermodel"]; 
	if(isset($_POST["computervendor"]))
		$computervendor = $_POST["computervendor"]; 
	if(isset($_POST["domain"]))
		$domain = $_POST["domain"]; 
	if(isset($_POST["osversion"]))
		$os = $_POST["osversion"]; 
	if(isset($_POST["ram"]))
		$ram = $_POST["ram"]; 
	if(isset($_POST["processor"]))
		$processor = $_POST["processor"]; 
	if(isset($_POST["ipaddress"]))
		$ipaddress = $_POST["ipaddress"];
	if(isset($_POST["hdd"]))
		$harddisk = $_POST["hdd"]; 
	if(isset($_POST["diskserial"]))
		$harddiskserial = $_POST["diskserial"];
	if(isset($_POST["videocard"]))
		$graphicscard = $_POST["videocard"]; 
	if(isset($_POST["pathvariable"]))
		$pathvariable = $_POST["pathvariable"];
	if(isset($_POST["officeversion"]))
		$officeversion = $_POST["officeversion"];
	
	date_default_timezone_set("Asia/Baku");
	$lastactiondate = (new DateTime())->format('Y-m-d H:i:s');
	
	$stmt = $dbConnection->prepare('insert into loginhistory (systemname, serialnumber, login, time, actiontype) values (:systemname, :serialnumber, :login, :time, :actiontype)');
	$stmt->execute(array(':systemname'=> $systemname , ':serialnumber' => $serialnumber, ':login'=>$login, ':time'=>$lastactiondate, ':actiontype'=>$actiontype));
	
	$stmt = $dbConnection->prepare('SELECT id FROM computers where serialnumber=:serialnumber');
	$stmt -> execute(array(':serialnumber' => $serialnumber));
	if ($stmt -> rowCount() == 1)
	{
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt = $dbConnection->prepare('UPDATE computers SET systemname=:systemname, computername=:computername, computervendor=:computervendor, domain=:domain, os=:os, ram=:ram, processor=:processor, ipaddress=:ipaddress, harddisk=:harddisk, harddiskserial=:harddiskserial, graphicscard=:graphicscard, lastactiondate=:lastactiondate, pathvariable=:pathvariable WHERE id=:id');
		$stmt->execute(array(':systemname'=> $systemname, ':computername'=>$computername, ':computervendor'=>$computervendor, ':domain'=>$domain, ':os'=>$os, ':ram'=>$ram, ':processor'=>$processor, ':ipaddress'=>$ipaddress, ':harddisk'=>$harddisk, ':harddiskserial'=>$harddiskserial, ':graphicscard'=>$graphicscard, ':lastactiondate'=>$lastactiondate, ':pathvariable'=>$pathvariable, ':id'=>$row['id']));
	}
	else
	{
		$stmt = $dbConnection->prepare('INSERT INTO computers (serialnumber, systemname, computername, computervendor, domain, os, ram, processor, ipaddress, harddisk, harddiskserial, graphicscard, lastactiondate, pathvariable) values (:serialnumber, :systemname, :computername, :computervendor, :domain, :os, :ram, :processor, :ipaddress, :harddisk, :harddiskserial, :graphicscard, :lastactiondate, :pathvariable)');
		$stmt->execute(array(':serialnumber'=> $serialnumber , ':systemname' => $systemname, ':computername'=>$computername, ':computervendor'=>$computervendor, ':domain'=>$domain, ':os'=>$os, ':ram'=>$ram, ':processor'=>$processor, ':ipaddress'=>$ipaddress, ':harddisk'=>$harddisk, ':harddiskserial'=>$harddiskserial, ':graphicscard'=>$graphicscard, ':lastactiondate'=>$lastactiondate, ':pathvariable'=>$pathvariable));
	}

?>
