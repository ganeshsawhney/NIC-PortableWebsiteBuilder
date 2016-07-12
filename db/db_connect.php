<?php
require_once('config.php');

$mysqli = mysqli_connect($servername, $username, $password);

// Check connection
if($mysqli->connect_error) 
{
	die('Unable to connect ('.$mysqli->connect_errno.'): '.$mysqli->connect_error);
}
else
{
	echo "Connection Success";
}


$db_exists = $mysqli->select_db($db);

if(!$db_exists) 
{
	$query = $mysqli->prepare("CREATE DATABASE ".$mysqli->real_escape_string($db));
	$success = $query->execute();

	if(!$success) 
	{
		die("Database does not exist and we were not able to create it.");
	}
	else
	{
		echo "Database was not present. So we created it for you.";
	}

	$mysqli->select_db($db);
}
?>