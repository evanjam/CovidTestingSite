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
    <link href="../../css/dashboard.css" rel="stylesheet" type="text/css">
</head>
    <body>

    <h1>Reset your password</h1>
    <p>An email will be sent with a ling to reset your password</p>

        <form action='../included/pass_reset.php' method="post">
            <input type="text" name="email" placeholder="Enter your email address">
            <button type="submit" name="pass_reset_request">Recieve new password by email</button>

    </body>
</html>