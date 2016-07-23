
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

<?php 
echo "<br> <a class='btn btn-info' role='button' href='../index.php'>Home Page</a><br>";
require_once('../db/db_connect.php');
session_start();

if(isset($_SESSION['privilage']))
{
    if($_SESSION['privilage']!='superadmin' && $_SESSION['privilage']!='admin')
    {
        echo "<h2>Insufficient Privilages.</h2><br> <a class='btn btn-info' role='button' href='../index.php'>Home Page</a><br>";
        exit();
    }
}
else
{
    echo "<h2>Insufficient Privilages.</h2><br> <a class='btn btn-info' role='button' href='../index.php'>Home Page</a><br>";
    exit();
}

function del($dirname)
{
    array_map('unlink', glob("$dirname/*.*"));
    rmdir($dirname);
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // username and password received from loginform 
    $wname=mysqli_real_escape_string($conn,$_POST['wname']);


    $conn->query("DROP database `website_".$wname."`");
    $conn->query("Delete FROM Websites WHERE url = '".$wname."'");
    if(is_dir('../Websites/'.$wname))
    {
        if(is_dir('../Websites/'.$wname.'/'.$wname.'_uploads'))
            del('../Websites/'.$wname.'/'.$wname.'_uploads');
        del('../Websites/'.$wname);
    }

    echo "<h2>Successfully deleted website.</h2><br> <a class='btn btn-info' role='button' href='delete_website.php'>Delete Website</a><br>
</h2><br> <a class='btn btn-info' role='button' href='../index.php'>Home Page</a><br>";

        
}
?>



<body>

    <div class="select_template-block">
        <h1>Select Template</h1>
        <form method="post" action="" name="select_template_form" role="form">
            <div class="form-group">
                <label for="wname">Select one of the Templates:</label>
                
                  <?php
                  
                $query = $conn->prepare("SELECT * FROM Websites");
                $query->execute();
                $result=$query->get_result();
                
                $cnt=0;
                    echo "<ol>";
                while($row=$result->fetch_assoc())
                {
                    $cnt++;
                  echo '<li> <input type="radio" name="wname" value="'.$row['url'].'" required /> <a TARGET="_Blank" href="../Websites/'.$row['url'].'/'.$row['url'].'_index.php"> (Preview)'.$row['url'].'</a><br></li>';
                }  
                    echo "</ol>";
                  ?>       
            </div>
<?php if($cnt>0){ ?>
            <button type="submit" class="btn btn-default">Submit</button>
            <?php } ?>
        </form>
    </div>

</body>
</html>