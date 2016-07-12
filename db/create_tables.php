<?php

$query = $conn->prepare(" CREATE TABLE `Users` (
							 `user_id` int(11) NOT NULL AUTO_INCREMENT,
							 `username` varchar(50) NOT NULL,
							 `privilage` enum('superadmin','admin','i','d','u','id','du','iu','idu') NOT NULL DEFAULT 'idu',
							 `password_hash` varchar(255) NOT NULL,
							 `first_name` varchar(50) NOT NULL,
							 `last_name` varchar(50) NOT NULL,
							 `contact` bigint(20) NOT NULL,
							 PRIMARY KEY (`user_id`),
							 UNIQUE KEY `contact` (`contact`)
							) ENGINE=InnoDB DEFAULT CHARSET=latin1	");
$query->execute();



//Super Admin
$query = $conn->prepare("SELECT * FROM Users WHERE username='superadmin' ");
$query->execute();
$result=$query->get_result();
$row=$result->fetch_assoc();

if(sizeof($row)==0)
{
	$password=mysqli_real_escape_string($conn,$superadminpassword);
	$passhash=password_hash($password, PASSWORD_DEFAULT, $passhash_options);
	
	$query = $conn->prepare(" INSERT INTO `Users` (`user_id`, `username`, `privilage`, `password_hash`, `first_name`, `last_name`, `contact`) VALUES ('1', 'superadmin', 'superadmin', ?, 'Super', 'Admin', '00')	");
    
	if(!($query))
	{
		echo "SuperAdmin creation failed.<br>";
		exit();
	}
    $query->bind_param("s", $passhash);
	$query->execute();
	if(!($query))
	{
		printf("SuperAdmin creation failed: %s.\n", $conn->error);
		exit();
	}
	echo "No SuperAdmin found, so we created one. <br>";
}

?>