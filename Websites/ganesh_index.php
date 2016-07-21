<?php $wname = 'ganesh'; ?>

<?php 
$db='website_'.$wname;
require_once('../db/db_connect.php');
session_start();

    $dataquery = $conn->prepare("SELECT * FROM Data");
    $dataquery->execute();
    $dataresult=$dataquery->get_result();
    $datarow=$dataresult->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<style type="text/css">
   .carousel img {
        margin: 0 auto;
        max-height: 400px;
        min-height: 300px;
    }
    .carousel{
      background-color: #9ACD32;
}
</style>
  <script src=<?php echo '"'.$wname.'_'.'ajaxscripts.js"'; ?>></script>
  <title><?php if($datarow["title"]!="None")echo $datarow["title"]; else echo $wname; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>


<?php 
if($datarow["is_header"]==true)
{

$headerquery = $conn->prepare("SELECT * FROM Header where pos='l'  order by grp");
$headerquery->execute();
$headerresult=$headerquery->get_result();
?>

<nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo $wname; ?></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo $wname.'_index.php'; ?>">Home</a></li>


            <?php 

            $grp='None';
            $alreadyinloop=0;
            while($headerrow=$headerresult->fetch_assoc())
              {
                  if($headerrow['grp']=='None')
                  {
                    if($alreadyinloop==1)
                    {
                        echo '
                            </ul>
                          </li>';
                          $grp='None';
                    }
                    echo '<li><a href="'.$headerrow['link'].'">'.$headerrow['name'].'</a></li>';
                  }
                  else
                  {
                    if($alreadyinloop==0)
                    {
                      $alreadyinloop=1;
                      $grp=$headerrow['grp'];
                      echo ' <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">'.$headerrow['grp'].'<span class="caret"></span></a>
                    <ul class="dropdown-menu">';
                    echo '<li><a href="'.$headerrow['link'].'">'.$headerrow['name'].'</a></li>';
                    }
                    else
                    {
                      if($grp==$headerrow['grp'])
                      {
                        echo '<li><a href="'.$headerrow['link'].'">'.$headerrow['name'].'</a></li>';
                      }
                      else
                      {
                        echo '
                            </ul>
                          </li>';
                      $grp=$headerrow['grp'];
                      echo ' <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">'.$headerrow['grp'].'<span class="caret"></span></a>
                    <ul class="dropdown-menu">';
                    echo '<li><a href="'.$headerrow['link'].'">'.$headerrow['name'].'</a></li>';
                      
                      }
                    }

                  }
                }
                if($alreadyinloop==1)
                  echo '</ul>';
            
            $headerquery = $conn->prepare("SELECT * FROM Header where pos='r' order by grp");
            $headerquery->execute();
            $headerresult=$headerquery->get_result();

echo '</ul><ul class="nav navbar-nav navbar-right">';

            $grp='None';
            $alreadyinloop=0;
            while($headerrow=$headerresult->fetch_assoc())
              {
                  if($headerrow['grp']=='None')
                  {
                    if($alreadyinloop==1)
                    {
                        echo '
                            </ul>
                          </li>';
                          $grp='None';
                    }
                    echo '<li><a href="'.$headerrow['link'].'">'.$headerrow['name'].'</a></li>';
                  }
                  else
                  {
                    if($alreadyinloop==0)
                    {
                      $alreadyinloop=1;
                      $grp=$headerrow['grp'];
                      echo ' <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">'.$headerrow['grp'].'<span class="caret"></span></a>
                    <ul class="dropdown-menu">';
                    echo '<li><a href="'.$headerrow['link'].'">'.$headerrow['name'].'</a></li>';
                    }
                    else
                    {
                      if($grp==$headerrow['grp'])
                      {
                        echo '<li><a href="'.$headerrow['link'].'">'.$headerrow['name'].'</a></li>';
                      }
                      else
                      {
                        echo '
                            </ul>
                          </li>';
                      $grp=$headerrow['grp'];
                      echo ' <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">'.$headerrow['grp'].'<span class="caret"></span></a>
                    <ul class="dropdown-menu">';
                    echo '<li><a href="'.$headerrow['link'].'">'.$headerrow['name'].'</a></li>';
                      
                      }
                    }

                  }
                }
                if($alreadyinloop==1)
                  echo '</ul>';

              ?>
          </ul>
        </div>
      </div>
    </nav>
  <?php
}
?>







<?php 
if($datarow["is_imageslider"]==true)
{

$imagesliderquery = $conn->prepare("SELECT * FROM Image_slider");
$imagesliderquery->execute();
$imagesliderresult=$imagesliderquery->get_result();
?>
<div id="center">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">


            <?php 
            $ac=0;
              while($imagesliderrow=$imagesliderresult->fetch_assoc())
              {
              echo '<div class="item';
              if($ac==0)
              {
                echo ' active';
                $ac=1;
              }
              echo '">
        <img class="centered-image" src="'.$imagesliderrow['link'].'" alt="'.$imagesliderrow['alt'].'">
        <div class="carousel-caption">
          <h3><font color="'.$imagesliderrow['captioncolor'].'">'.$imagesliderrow['caption'].'</font></h3>
        </div>
      </div>';
             }
?>

</div>
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
</div>

<?php
}
?>

      
<div class="container text-center">

<?php 
if($datarow["is_heading"]==true)
{
?>
  <h3>Heading</h3><br>
<?php
}
$rowquery = $conn->prepare("SELECT * FROM Body_Rows");
$rowquery->execute();
$rowresult=$rowquery->get_result();
while($rowrow=$rowresult->fetch_assoc())
{
  echo '<div class="row" id="'.$rowrow["id"].'">';
  $colquery = $conn->prepare("SELECT * FROM Body_Columns where row_id=?");
  $colquery->bind_param("d", $rowrow["id"]);
  $colquery->execute();
  $colresult=$colquery->get_result();
  while($colrow=$colresult->fetch_assoc())
  {
    echo '<div class="well col-sm-'.$colrow['length'].'">';

    $datquery = $conn->prepare("SELECT * FROM Body_Data where row_id=? and col_id=?");
    $datquery->bind_param("dd", $rowrow["id"],$colrow["id"]);
    $datquery->execute();
    $datresult=$datquery->get_result();
    while($datrow=$datresult->fetch_assoc())
    {
      echo $datrow["text"].'<br>';
    }


    echo '</div>';
  }
  echo '</div>';
}
?>


<br>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>