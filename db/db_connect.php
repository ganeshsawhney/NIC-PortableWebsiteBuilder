<?php
require_once('config.php');

$conn = mysqli_connect($servername, $username, $password);

// Check connection
if($conn->connect_error) 
{
	die('Unable to connect ('.$conn->connect_errno.'): '.$conn->connect_error);
}
else
{
	//echo "Connection Success<br>";
}


$db_exists = $conn->select_db($db);

if(!$db_exists) 
{
	$query = $conn->prepare("CREATE DATABASE ".$conn->real_escape_string($db));
	$success = $query->execute();

	if(!$success) 
	{
		die("Database does not exist and we were not able to create it.<br>");
	}
	else
	{
		echo "Database was not present. So we created it for you.<br>";
	}

	$conn->select_db($db);
}


require_once('create_tables.php');
?>