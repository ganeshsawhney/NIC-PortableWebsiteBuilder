<?php $wname = 'ganesh'; ?>

<?php 
$db='website_'.$wname;
require_once('../db/db_connect.php');
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
			echo '<td><input type="text" class="headername" id="'.$headerrow['id'].'" value="'.$headerrow['name'].'"></td>';
			echo '<td><input type="text" class="headerlink"  id="'.$headerrow['id'].'" value="'.$headerrow['link'].'"></td>';
		}
		else
		{
			echo '<td><button class="btn btn-danger btn-xs deleteheaderrow"  id="'.$headerrow['id'].'" >DEL</button></td>';
			echo '<td><input type="text" class="headergroup" id="'.$headerrow['id'].'" value="'.$headerrow['grp'].'"></td>';
			echo '<td><input type="text" class="headername" id="'.$headerrow['id'].'" value="'.$headerrow['name'].'"></td>';
			echo '<td><input type="text" class="headerlink"  id="'.$headerrow['id'].'" value="'.$headerrow['link'].'"></td>';
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
			echo '<td><input type="text" class="headername" id="'.$headerrow['id'].'" value="'.$headerrow['name'].'"></td>';
			echo '<td><input type="text" class="headerlink"  id="'.$headerrow['id'].'" value="'.$headerrow['link'].'"></td>';
		}
		else
		{
			echo '<td><button class="btn btn-danger btn-xs deleteheaderrow"  id="'.$headerrow['id'].'" >DEL</button></td>';
			echo '<td><input type="text" class="headergroup" id="'.$headerrow['id'].'" value="'.$headerrow['grp'].'"></td>';
			echo '<td><input type="text" class="headername" id="'.$headerrow['id'].'" value="'.$headerrow['name'].'"></td>';
			echo '<td><input type="text" class="headerlink"  id="'.$headerrow['id'].'" value="'.$headerrow['link'].'"></td>';
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
?>
