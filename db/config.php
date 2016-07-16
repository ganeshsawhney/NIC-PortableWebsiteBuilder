<?php
$servername = "localhost";
$username = "root";
$password = "";

if(!isset($db))
	$db = "NIC_SiteCreator";

$superadminpassword="nicpassword";


$passhash_options = [
    'salt' => "Ganesh_Sports_programmer",
    'cost' => 10
];

?>