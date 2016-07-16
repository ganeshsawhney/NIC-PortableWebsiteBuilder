<?php 
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
    $wname=mysqli_real_escape_string($conn,$_POST['websitename']);
    $tname=mysqli_real_escape_string($conn,$_POST['templatename']);

    if(!is_dir('../templates/'.$tname) || !(ctype_alnum($wname)))
    {
      echo "Wrong Template / Not ALPHANUMERIC website name.<br>";
      exit();
    }

    $query = $conn->prepare("SELECT * FROM Websites WHERE url=?");
    $query->bind_param("s", $wname);
    $query->execute();
    $result=$query->get_result();
    $row=$result->fetch_assoc();

    if(sizeof($row)>0)
    {
        echo "Website already exists.<br>";
        exit();
    }
    else
    {
        $username=$_SESSION['username'];        

        $query = $conn->prepare(" INSERT INTO `Websites` (`url`, `author`) VALUES ( ?,?)   ");
    
        if(!($query))
        {
            echo "Website creation failed.<br>";
            exit();
        }
        $query->bind_param("ss", $wname,$username);
        $query->execute();

        if(!($query))
        {
            printf("Website creation failed: %s.\n", $conn->error);
            exit();
        }
        echo "Successfully created website.<br>";

        $srcfile='../templates/'.$tname.'/home.php';
        $destfile='../Websites/'.$wname.'_index.php';

        copy($srcfile,$destfile);
        chmod($destfile, fileperms($srcfile));

        $var_str = var_export($wname, true);
        $var = "<?php \$wname = $var_str; ?>\n\n";
        $var.=file_get_contents($destfile);
        file_put_contents($destfile, $var);

        $db='website_'.$wname;

        $query = $conn->prepare("CREATE DATABASE IF NOT EXISTS ".$conn->real_escape_string($db));
        $success = $query->execute();

        if(!$success) 
        {
          die("Database for this website could not be created.<br>");
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="select_template.css">
</head>

<body>

    <div class="select_template-block">
        <h1>Select Template</h1>
        <form method="post" action="" name="select_template_form" role="form">
            <div class="form-group">
                <label for="username">Name of your website (<u>ALPHANUMERIC ONLY</u>) :</label>
                <input type="text" class="form-control" name="websitename" pattern="^[a-zA-Z0-9]+$" required>
            </div>
            <div class="form-group">
                <label for="username">Select one of the Templates:</label>
                
                  <?php
                  function listFolderFiles($dir)
                  {
                    echo "<ol>";
                    $scan = scandir($dir);
                    foreach($scan as $file)
                    {
                      if (!is_dir($dir+$file) && $file!='.' && $file!='..')
                      {
                      echo '<li> &nbsp &nbsp <input type="radio" name="templatename" value="'.$file.'" /> <a TARGET="_Blank" href="'.$dir.$file.'/preview.php">'.$file.'</a><br></li>';
                      }
                    }
                    echo '</ol>';
                  }

                  listFolderFiles('../templates/');

                  ?>       
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

</body>
</html>