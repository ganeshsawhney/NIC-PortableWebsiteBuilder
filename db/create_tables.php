<?php
require_once('db_connect.php');

	$query = $mysqli->prepare(" CREATE TABLE `Users` (
							 `user_id` int(11) NOT NULL AUTO_INCREMENT,
							 `username` varchar(50) NOT NULL,
							 `privilage` enum('superadmin','admin','i','d','u','id','du','iu','idu') NOT NULL DEFAULT 'idu',
							 `password_hash` varchar(255) NOT NULL,
							 `first_name` varchar(50) NOT NULL,
							 `last_name` int(50) NOT NULL,
							 `contact` bigint(20) NOT NULL,
							 PRIMARY KEY (`user_id`),
							 UNIQUE KEY `contact` (`contact`)
							) ENGINE=InnoDB DEFAULT CHARSET=latin1	");
	$query->execute();
?>