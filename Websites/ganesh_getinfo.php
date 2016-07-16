<?php $wname = 'ganesh'; ?>

<?php 
$db='website_'.$wname;
require_once('../db/db_connect.php');
session_start();

?>

<?php
    $q = mysqli_real_escape_string($conn,$_GET['q']);
    if($q=='title')
    {
        $query = $conn->prepare("SELECT title FROM Data");
        $query->execute();
        $result=$query->get_result();
        $row=$result->fetch_assoc();

        if($row['title']=='None')
        {
            echo " ";
            exit();
        }
        else
        {
            echo $row['title'];
        }
    }
?>