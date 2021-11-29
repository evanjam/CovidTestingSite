
<?php
    session_start();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTS Testing Services Login</title>
    <link href="css/login.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="login">
        <h1>CTS Testing</h1>
        <form method="post" action="includes/login.php" name="login">
            <input type="text" name="username" pattern="[a-zA-Z0-9]+" placeholder="login" id="username" required />
            <input type="password" name="password" placeholder="password" required>
            <input type="submit" name="login" value="login">
        </form>
        <div class="forgot">
		<a href="forms/pass_reset.php">Forgot password?</a>
        </div>
		<!-- <a href="forms/sendmailtest.php">sendmail test</a><br> -->
		<!-- <a href="forms/patient_register.php">Create New Account</a> -->
    </div>

</body>
</html>