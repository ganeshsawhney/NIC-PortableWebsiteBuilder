<?php 
require_once('../db/db_connect.php');
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	// username and password received from loginform 
	$username=mysqli_real_escape_string($conn,$_POST['username']);
	$password=mysqli_real_escape_string($conn,$_POST['password']);
	$passhash=password_hash($password, PASSWORD_DEFAULT, $passhash_options);

	$query = $conn->prepare("SELECT * FROM Users WHERE username=? and password_hash=?");
	$query->bind_param("ss", $username, $passhash);
	$query->execute();
    $result=$query->get_result();
    $row=$result->fetch_assoc();

    if(sizeof($row)==0)
    {
		echo "Username or Password is invalid";
	}
	else
	{
		$_SESSION['username']=$row['username'];
		$_SESSION['privilage']=$row['privilage'];
	}
}
?>