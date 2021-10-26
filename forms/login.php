<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test login/register page</title>
    <link href="../css/login.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="login">
        <h1>Login</h1>
        <form method="post" action="../includes/login.php" name="login">
            <input type="text" name="username" pattern="[a-zA-Z0-9]+" placeholder="Login" id="username" required />
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="login" value="Login">
        </form>
    </div>

    <?php
        //Just here temporarily to make users more easily
    ?>
    <div><a href="admin/admin_register.php">User Registration Form (Temporary for easy user creation)</a></div>

</body>
</html>