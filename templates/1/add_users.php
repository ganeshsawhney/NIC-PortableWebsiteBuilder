<?php 
$db='website_'.$wname;
require_once('../db/db_connect.php');
session_start();
if(isset($_SESSION['privilage']))
{
    if($_SESSION['privilage']!='superadmin' && $_SESSION['privilage']!='admin')
    {
        echo "Insufficient Privilages.<br>";
        exit();
    }
}
else
{
    echo "Insufficient Privilages.<br>";
    exit();
}




if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // username and password received from loginform 
    $username=mysqli_real_escape_string($conn,$_POST['username']);

    $query = $conn->prepare("SELECT * FROM Users WHERE username=?");
    $query->bind_param("s", $username);
    $query->execute();
    $result=$query->get_result();
    $row=$result->fetch_assoc();

    if(sizeof($row)>0)
    {
        echo "Username already exists.<br>";
    }
    else
    {
        $firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
        $lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
        $contact=mysqli_real_escape_string($conn,$_POST['contact']);
        $privilage=mysqli_real_escape_string($conn,$_POST['privilage']);
        $password=mysqli_real_escape_string($conn,$_POST['password']);
        $passhash=password_hash($password, PASSWORD_DEFAULT, $passhash_options);
        

        $query = $conn->prepare(" INSERT INTO `Users` (`username`, `privilage`, `password_hash`, `first_name`, `last_name`, `contact`) VALUES ( ?,?,?,?,?,?)   ");
    
        if(!($query))
        {
            echo "User creation failed.<br>";
            exit();
        }
        $query->bind_param("sssssd", $username,$privilage,$passhash,$firstname,$lastname,$contact);
        $query->execute();

        if(!($query))
        {
            printf("User creation failed: %s.\n", $conn->error);
            exit();
        }
        echo "Successfully added user.<br>";
    }

}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="add_users.css">
</head>

<body>

    <div class="addusers-block">
        <h1>Add-User</h1>
        <form method="post" action="" name="adduser_form" role="form">
            <div class="form-group">
                <label for="username">UserName:</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="username">First-Name:</label>
                <input type="text" class="form-control" name="firstname" required>
            </div>
            <div class="form-group">
                <label for="username">Last-Name:</label>
                <input type="text" class="form-control" name="lastname" required>
            </div>
            <div class="form-group">
                <label for="username">Contact:</label>
                <input type="number" class="form-control" name="contact" min="1111111111" max="9999999999" required>
            </div>
            <div class="form-group">
                <label for="sel1">Privilages:</label>
                <select class="form-control" name="privilage">
                    <option value="admin">Admin</option>
                    <option value="i">Add</option>
                    <option value="d">Delete</option>
                    <option value="u">Update</option>
                    <option value="id">Add,Delete</option>
                    <option value="du">Delete,Update</option>
                    <option value="iu">Add,Update</option>
                    <option value="idu">Add,Delete,Update</option>
                </select>
            </div> 
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

</body>
</html>