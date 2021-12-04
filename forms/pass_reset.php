<?php
        //form page for the user to start and enter an email to connect to includes file for password reset
        session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Need New Password</title>
    <link href="../css/login.css" rel="stylesheet" type="text/css">
</head>
    <body>

    <div class="login">
        <h1>Reset Password</h1>
        <form method="post" action="../includes/password_reset.php" name="login">
            <input type="text" name="username" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="login" id="username" required />
            <input type="text" name="ssn" placeholder="ssn" pattern="[0-9]+" required>
            <input type="password" name="Newpassword" placeholder=" New password" required>
            <input type="password" name="Confirmpassword" placeholder=" Confirm password" required>
            <input type="submit" name="reset" value="Reset">
        </form>
    </div>


    </body>
</html>