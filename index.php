<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login system</title>
    <link href="css/login.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="login">
        <h1>Login</h1>
        <form action="includes/authenticate.php" method="post">

            <input type="text" name="username" placeholder="Username" id="username" required>

            <input type="password" name="password" placeholder="Password" id="password" required>
            <input type="submit" value="Login">
        </form>
    </div>

	<div class="sign-up">
        <h1>sign up</h1>
        <form action="includes/authenticate.php" method="post">

            <input type="text" name="username" placeholder="Username" id="username" required>

            <input type="password" name="password" placeholder="Password" id="password" required>
            <input type="submit" value="Login">
        </form>
    </div>


    
</body>
</html>
