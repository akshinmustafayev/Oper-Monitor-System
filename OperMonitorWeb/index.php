<?php
	session_start();
	spl_autoload_register(function ($class){
		include './app/class/' . $class . '.class.php';
	});
	
	$opermon = new Opermon($_GET);
	$allcomputers = new AllComputers($_GET);
	$bookmarks = new Bookmarks($_GET);
	$loginevents = new Loginevents($_GET);
	$monitoring = new Monitoring($_GET);
	$messages = new Messages($_GET);
	$users = new Users($_GET);
	$controller = new Controller($_GET, $_POST);
	/*$db = new Database();
	$rows = $db -> select("SELECT * FROM `computers` WHERE id=2");
	
	$cmp = new Computer($rows);
	echo $cmp->Hashid();
	$login = new Login();
	if(!$login->CheckSession())
	{
		echo $login->LogIn('akshin.mustafayev@unibank.az', 'admin');
	}
	else
	{
		echo 'logged in';
	}*/
?>