<?php $wname = 'ganesh'; ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="login_form.css">
</head>

<body>

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