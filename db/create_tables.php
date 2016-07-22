<?php

$query = $conn->prepare(" CREATE TABLE IF NOT EXISTS `Users` (
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


if($db=='NIC_SiteCreator')
{
	$query = $conn->prepare(" CREATE TABLE IF NOT EXISTS `Websites` (
							 `url` varchar(20) NOT NULL,
							 `author` varchar(50) NOT NULL,
							 `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
							 PRIMARY KEY (`url`)
							)	");
	$query->execute();
}

if($db!='NIC_SiteCreator')
{
	$query = $conn->prepare(" CREATE TABLE `Data` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `title` varchar(50) NOT NULL DEFAULT 'None',
 `is_header` tinyint(1) NOT NULL DEFAULT '0',
 `is_imageslider` tinyint(1) NOT NULL DEFAULT '0',
 `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
)	");
	$query->execute();

	$query = $conn->prepare("SELECT * FROM Data");
	$query->execute();
	$result=$query->get_result();
	$row=$result->fetch_assoc();

	if(sizeof($row)==0)
	{
	$query = $conn->prepare(" INSERT INTO `Data` () VALUES()	");
	$query->execute();
	}

	
	$query = $conn->prepare(" CREATE TABLE `Body_Columns` (
								 `id` int(11) NOT NULL AUTO_INCREMENT,
								 `name` varchar(20) NOT NULL DEFAULT '',
								 `length` int(11) NOT NULL DEFAULT '1',
								 `row_id` int(11) NOT NULL,
								 `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
								 PRIMARY KEY (`id`)
								)	");
	$query->execute();
	
	$query = $conn->prepare(" CREATE TABLE `Body_Data` (
								 `id` int(11) NOT NULL AUTO_INCREMENT,
								 `text` text NOT NULL,
								 `row_id` int(11) NOT NULL,
								 `col_id` int(11) NOT NULL,
								 `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
								 PRIMARY KEY (`id`)
								)	");
	$query->execute();	
	$query = $conn->prepare(" CREATE TABLE `Body_Data` (
								 `id` int(11) NOT NULL AUTO_INCREMENT,
								 `text` text NOT NULL,
								 `row_id` int(11) NOT NULL,
								 `col_id` int(11) NOT NULL,
								 `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
								 PRIMARY KEY (`id`)
								)	");
	
	$query->execute();	
	$query = $conn->prepare(" CREATE TABLE `Body_Rows` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(20) NOT NULL DEFAULT '',
 `length` int(11) NOT NULL DEFAULT '1',
 `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
)	");
	$query->execute();	


	$query->execute();	
	$query = $conn->prepare(" CREATE TABLE `Header` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(20) NOT NULL,
 `link` varchar(20) NOT NULL DEFAULT '#',
 `grp` varchar(20) NOT NULL DEFAULT 'None',
 `pos` char(2) NOT NULL DEFAULT 'l',
 `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 KEY `grp` (`grp`)
)	");
	$query->execute();


	$query->execute();	
	$query = $conn->prepare(" CREATE TABLE `Image_slider` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `alt` varchar(20) NOT NULL,
 `link` varchar(200) NOT NULL,
 `caption` text NOT NULL,
 `captioncolor` varchar(8) NOT NULL DEFAULT 'black',
 `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
)	");
	$query->execute();

}




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
	//echo "No SuperAdmin found, so we created one. <br>";
}

?>