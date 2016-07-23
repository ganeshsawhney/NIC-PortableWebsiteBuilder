
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

<?php 
echo "<a class='btn btn-info' role='button' href='index.php'>Home Page</a><br>";
?>
    <div class="login-block">
        <h1>Login</h1>
        <form method="post" action=<?php echo '"'.$wname.'_loginvalidate.php"'; ?> name="loginform" role="form">
            <div class="form-group">
                <label for="username">UserName:</label>
                <input type="text" class="form-control" name="username">
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

</body>
</html>