
<?php

function Login(){
	$usertable = "";
	$user = $_POST["email"];
	$pass = $_POST["password"];
try
	{
		
	
	$db = new PDO('mysql:host=localhost;dbname=kennevievetracker', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$select_query = $db->prepare("select id from tblusers where Username = :user and Password = :pass", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	
	$resultset = $select_query->execute(array(':user' => $user, ':pass' => $pass));
	$rows = $select_query->fetchAll();
	if(empty($rows)){

		header("Location: /kennevievetracker/login.php");
		exit();
	}
	else
	{
		session_start();
		$_SESSION['user'] = "asdasd";
		header("Location: /kennevievetracker/index.php");
	}
	}
catch(Exception $e){
	echo 'Connection failed: ' . $e->getMessage();
	}

}

function Logout(){
	session_start();
	session_destroy();
	header("Location: /kennevievetracker/login.php");
}

function getSingleTableValue($query,$param,$value,$columnname){

	try{
		$db = new PDO('mysql:host=localhost;dbname=kennevievetracker', 'root', '');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$select_query = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$result_set = $select_query->execute(array('$param' => $value));
		$result = $result_set->fetch();
		$resultVal = $result[$columnname];
	}
	catch(Exception $e){

	}
	return $resultVal;
}
?>