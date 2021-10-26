<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test login/register page</title>
    <link href="css/login.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="login">
        <h1>login</h1>
        <form method="post" action="includes/login.php" name="login">
            <input type="text" name="username" pattern="[a-zA-Z0-9]+" placeholder="login" id="username" required />
            <input type="password" name="password" placeholder="password" required>
            <input type="submit" name="login" value="login">
        </form>
		<a href="../includes/password_reset.php">Forgot password?</a>
    </div>

     <!--   //Just here temporarily to make users more easily -->
    <div><a href="forms/admin/admin_register.php">User Registration Form (Temporary for easy user creation)</a></div>


</body>
</html>