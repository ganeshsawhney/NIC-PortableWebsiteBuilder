<?php 
$db='website_'.$wname;
require_once('../../db/db_connect.php');
session_start();

if(mysqli_real_escape_string($conn,$_GET['q'])=='title')
{
	$title=mysqli_real_escape_string($conn,$_POST['value']);
    $query = $conn->prepare(" Update `Data` SET title=?");
    $query->bind_param("s", $title);
    $query->execute();

    if(!($query))
    {
        printf("Title Change failed: %s.\n", $conn->error);
        exit();
    }
    echo "Title successfully changed to ".$title;
}

if(mysqli_real_escape_string($conn,$_GET['q'])=='addheader')
{
	$value=mysqli_real_escape_string($conn,$_POST['value']);
    $query = $conn->prepare(" Update `Data` SET is_header=?");
    $query->bind_param("d", $value);
    $query->execute();

    if(!($query))
    {
        printf("Header Addition/Removal failed: %s.\n", $conn->error);
        exit();
    }
    echo "Header Addition/Removal successfull";
}

if(mysqli_real_escape_string($conn,$_GET['q'])=='showheader')
{
	$headerquery = $conn->prepare("SELECT * FROM Header where pos='l'  order by grp");
	$headerquery->execute();
	$headerresult=$headerquery->get_result();

	echo '<table class="table">
	<thead>
      <tr>
        <th class="danger">Left Links</th>
        <th class="info">Right Links</th>
      </tr>
  <tr> 
    <td class="danger" valign="top"><table class="table" style="display: inline-block;">
    <thead>
      <tr>
        <th> </th>
        <th>Group</th>
        <th>Name</th>
        <th>Link</th>
      </tr>
    </thead><tbody>';

	 while($headerrow=$headerresult->fetch_assoc())
	{
		echo '<tr>';
		if($headerrow['grp']=='None')
		{
			echo '<td><button class="btn btn-danger btn-xs deleteheaderrow"  id="'.$headerrow['id'].'" >DEL</button></td>';
			echo '<td></td>';
			echo '<td><input type="text" class="form-control headername" id="'.$headerrow['id'].'" value="'.$headerrow['name'].'" disabled></td>';
			echo '<td><input type="text" class="form-control headerlink"  id="'.$headerrow['id'].'" value="'.$headerrow['link'].'" disabled></td>';
		}
		else
		{
			echo '<td><button class="btn btn-danger btn-xs deleteheaderrow"  id="'.$headerrow['id'].'" >DEL</button></td>';
			echo '<td><input type="text" class="form-control headergroup" id="'.$headerrow['id'].'" value="'.$headerrow['grp'].'" disabled></td>';
			echo '<td><input type="text" class="form-control headername" id="'.$headerrow['id'].'" value="'.$headerrow['name'].'" disabled></td>';
			echo '<td><input type="text" class="form-control headerlink"  id="'.$headerrow['id'].'" value="'.$headerrow['link'].'" disabled></td>';
		}
		echo '</tr>';
	}
	echo '
    </tbody>
  </table></td>';



	$headerquery = $conn->prepare("SELECT * FROM Header where pos='r'  order by grp");
	$headerquery->execute();
	$headerresult=$headerquery->get_result();

	echo '<td class="info" valign="top"><table class="table" style="display: inline-block;">
    <thead>
      <tr>
        <th> </th>
        <th>Group</th>
        <th>Name</th>
        <th>Link</th>
      </tr>
    </thead><tbody>';

	 while($headerrow=$headerresult->fetch_assoc())
	{
		echo '<tr>';
		if($headerrow['grp']=='None')
		{
			echo '<td><button class="btn btn-danger btn-xs deleteheaderrow"  id="'.$headerrow['id'].'" >DEL</button></td>';
			echo '<td></td>';
			echo '<td><input type="text" class="form-control headername" id="'.$headerrow['id'].'" value="'.$headerrow['name'].'" disabled></td>';
			echo '<td><input type="text" class="form-control headerlink"  id="'.$headerrow['id'].'" value="'.$headerrow['link'].'" disabled></td>';
		}
		else
		{
			echo '<td><button class="btn btn-danger btn-xs deleteheaderrow"  id="'.$headerrow['id'].'" >DEL</button></td>';
			echo '<td><input type="text" class="form-control headergroup" id="'.$headerrow['id'].'" value="'.$headerrow['grp'].'" disabled></td>';
			echo '<td><input type="text" class="form-control headername" id="'.$headerrow['id'].'" value="'.$headerrow['name'].'" disabled></td>';
			echo '<td><input type="text" class="form-control headerlink"  id="'.$headerrow['id'].'" value="'.$headerrow['link'].'" disabled></td>';
		}
		echo '</tr>';
	}
	echo '
    </tbody>
  </table></td>
  </tr>
</table>';

}

if(mysqli_real_escape_string($conn,$_GET['q'])=='deleteheaderrow')
{
	$value=mysqli_real_escape_string($conn,$_POST['value']);
    $query = $conn->prepare(" Delete from `Header` where id=?");
    $query->bind_param("d", $value);
    $query->execute();

    if(!($query))
    {
        printf("Header Link Addition/Removal failed: %s.\n", $conn->error);
        exit();
    }
    echo "Header Link Addition/Removal successfull";
}

if(mysqli_real_escape_string($conn,$_GET['q'])=='addheaderrow')
{
    // username and password received from loginform 
    $pos=mysqli_real_escape_string($conn,$_POST['value1']);
    $grp=mysqli_real_escape_string($conn,$_POST['value2']);
    $name=mysqli_real_escape_string($conn,$_POST['value3']);
    $link=mysqli_real_escape_string($conn,$_POST['value4']);

    if($grp=='')
        $grp='None';

    $query = $conn->prepare(" INSERT INTO `Header` (`pos`, `grp`, `name`, `link`) VALUES ( ?,?,?,?)   ");

    $query->bind_param("ssss", $pos,$grp,$name,$link);
    $query->execute();

    if(!($query))
    {
        printf("Header Link Addition failed: %s.\n", $conn->error);
        exit();
    }
    echo "Header Link Addition successfull";
}












if(mysqli_real_escape_string($conn,$_GET['q'])=='addimageslider')
{
	$value=mysqli_real_escape_string($conn,$_POST['value']);
    $query = $conn->prepare(" Update `Data` SET is_imageslider=?");
    $query->bind_param("d", $value);
    $query->execute();

    if(!($query))
    {
        printf("Image Slider Addition/Removal failed: %s.\n", $conn->error);
        exit();
    }
    echo "Image Slider Addition/Removal successfull";
}



if(mysqli_real_escape_string($conn,$_GET['q'])=='showimageslider')
{
$imagesliderquery = $conn->prepare("SELECT * FROM Image_slider");
$imagesliderquery->execute();
$imagesliderresult=$imagesliderquery->get_result();

	echo '<table class="table" style="display: inline-block;">
    <thead>
      <tr>
        <th> </th>
        <th>Link</th>
        <th> </th>
        <th>Caption</th>
        <th>Caption Color</th>
        <th>Alternate Text</th>
      </tr>
    </thead><tbody>';

	 while($imagesliderrow=$imagesliderresult->fetch_assoc())
	{
		echo '<tr>';
		echo '<td><button class="btn btn-danger btn-xs deleteimagesliderrow"  id="'.$imagesliderrow['id'].'" >DEL</button></td>';
		echo '<td><input type="text" class="form-control "  id="'.$imagesliderrow['id'].'" value="'.$imagesliderrow['link'].'" disabled></td>';
		echo '<td><a target="_blank" href="'.$imagesliderrow['link'].'"> <span class="glyphicon glyphicon-open"></span> </a></td>';
		echo '<td><input type="text" class="form-control "  id="'.$imagesliderrow['id'].'" value="'.$imagesliderrow['caption'].'" disabled></td>';
		echo '<td><input type="text" class="form-control "  id="'.$imagesliderrow['id'].'" value="'.$imagesliderrow['captioncolor'].'" disabled></td>';
		echo '<td><input type="text" class="form-control "  id="'.$imagesliderrow['id'].'" value="'.$imagesliderrow['alt'].'" disabled></td>';
		echo '</tr>';
	}
	echo '
    </tbody>
  </table></td>';

}
if(mysqli_real_escape_string($conn,$_GET['q'])=='deleteimagesliderrow')
{
	$value=mysqli_real_escape_string($conn,$_POST['value']);
    $query = $conn->prepare(" select * from `Image_slider` where id=?");
    $query->bind_param("d", $value);
    $query->execute();
	$query=$query->get_result();
	$query=$query->fetch_assoc();
	unlink($query['link']);

    $query = $conn->prepare(" Delete from `Image_slider` where id=?");
    $query->bind_param("d", $value);
    $query->execute();

    if(!($query))
    {
        printf("Image Link Addition/Removal failed: %s.\n", $conn->error);
        exit();
    }
    echo "Image Link Addition/Removal successfull";
}


if(mysqli_real_escape_string($conn,$_GET['q'])=='addimagesliderrow')
{
    
    $caption=mysqli_real_escape_string($conn,$_POST['imageslidercaption']);
    $color=mysqli_real_escape_string($conn,$_POST['imageslidercpcolor']);
    $alt=mysqli_real_escape_string($conn,$_POST['imageslideralt']);

    if($color=='')
    	$color='Black';

		$target_dir = $wname."_uploads/";
		if (!is_dir($target_dir))
		{
			mkdir($target_dir, 0777, true);
			chmod($target_dir, 33279);
		}
		$target_file = $target_dir .'imageslider_image_'.basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.<br>";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			unlink($target_file);
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 5000000) {
		    echo "Sorry, your file is too large.<br>";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.<br>";
		    exit();
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    			chmod($target_file, 33279);
		        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
		    } else {
		        echo "Sorry, there was an error uploading your file.<br>";
		        exit();
		    }
		}





    $query = $conn->prepare(" INSERT INTO `Image_slider` (`alt`, `link`, `caption`, `captioncolor`) VALUES ( ?,?,?,?)   ");

    $query->bind_param("ssss", $alt,$target_file,$caption,$color);
    $query->execute();

    if(!($query))
    {
        printf("Image Addition failed: %s.\n", $conn->error);
        exit();
    }
    echo "Image Addition successfull";
}





if(mysqli_real_escape_string($conn,$_GET['q'])=='addrow')
{
    // username and password received from loginform 
    $name=mysqli_real_escape_string($conn,$_POST['value']);

    $query = $conn->prepare(" INSERT INTO `Body_Rows` (`name`) VALUES ( ?)   ");

    $query->bind_param("s", $name);
    $query->execute();

    if(!($query))
    {
        printf("Row Addition failed: %s.\n", $conn->error);
        exit();
    }
    echo "Row Addition successfull";
}

if(mysqli_real_escape_string($conn,$_GET['q'])=='changebody')
{
	$cnt=1;
$rowquery = $conn->prepare("SELECT * FROM Body_Rows");
$rowquery->execute();
$rowqry=$rowquery->get_result();

while($rowquery=$rowqry->fetch_assoc())
{

	echo 'Row-'.$cnt.'. &nbsp ';
	echo '<button id="'.$rowquery['id'].'" class="btn btn-danger btn-xs addcol"> Add Column</button> &nbsp'.$rowquery['name'].' <br> <div class="row">';
	$cnt++;
	$colquery = $conn->prepare("SELECT * FROM Body_Columns where row_id=?");
	$colquery->bind_param("d", $rowquery['id']);
	$colquery->execute();
	$colquery=$colquery->get_result();
	while($colrow=$colquery->fetch_assoc())
	{

		
    echo '<div class="col-sm-'.$colrow['length'].'"><button style="display: block; width: 100%;" id="'.$colrow['id'].'" class="deletecol btn btn-primary">Delete</button></div>';
	}


    echo '</div><br>';

}

echo '<br><button class="btn btn-info " id="enableaddrow">Add Row</button><br><br>';
}


if(mysqli_real_escape_string($conn,$_GET['q'])=='addcol')
{
    // username and password received from loginform 
    $rowid=mysqli_real_escape_string($conn,$_POST['value1']);
    $name=mysqli_real_escape_string($conn,$_POST['value2']);
    $length=mysqli_real_escape_string($conn,$_POST['value3']);

    $query = $conn->prepare(" INSERT INTO `Body_Columns` (`row_id`,`name`,`length`) VALUES (?,?,?)   ");

    $query->bind_param("dsd", $rowid,$name,$length);
    $query->execute();

    if(!($query))
    {
        printf("Column Addition failed: %s.\n", $conn->error);
        exit();
    }
    echo "Column Addition successfull";
}
if(mysqli_real_escape_string($conn,$_GET['q'])=='deletecol')
{
	$value=mysqli_real_escape_string($conn,$_POST['value']);
    $query = $conn->prepare(" Delete from `Body_Columns` where id=?");
    $query->bind_param("d", $value);
    $query->execute();

    if(!($query))
    {
        printf("Column Addition/Removal failed: %s.\n", $conn->error);
        exit();
    }
    $query = $conn->prepare(" Delete from `Body_Data` where col_id=?");
    $query->bind_param("d", $value);
    $query->execute();

    if(!($query))
    {
        printf("Column Addition/Removal failed: %s.\n", $conn->error);
        exit();
    }
    echo "Column Addition/Removal successfull";
}

if(mysqli_real_escape_string($conn,$_GET['q'])=='adddata')
{
    $text=mysqli_real_escape_string($conn,$_POST['value1']);
    $colid=mysqli_real_escape_string($conn,$_POST['value2']);

	$colquery = $conn->prepare("SELECT * FROM Body_Columns where id=?");
	$colquery->bind_param("d", $colid);
	$colquery->execute();
	$colquery=$colquery->get_result();
	$colrow=$colquery->fetch_assoc();

    $query = $conn->prepare(" INSERT INTO `Body_Data` (`text`, `col_id`, `row_id`) VALUES ( ?,?,?)   ");

    $query->bind_param("sdd", $text,$colid,$colrow['row_id']);
    $query->execute();

    if(!($query))
    {
        printf("Data Addition/Removal failed: %s.\n", $conn->error);
        exit();
    }
    echo "Data Addition/Removal successfull";
}

if(mysqli_real_escape_string($conn,$_GET['q'])=='deletedata')
{
	$value=mysqli_real_escape_string($conn,$_POST['value']);
    $query = $conn->prepare(" Delete from `Body_Data` where id=?");
    $query->bind_param("d", $value);
    $query->execute();

    if(!($query))
    {
        printf("Data Addition/Removal failed: %s.\n", $conn->error);
        exit();
    }
    
    echo "Data Addition/Removal successfull";
}

?>
