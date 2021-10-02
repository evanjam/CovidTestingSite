<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test login/register page</title>
    <link href="../../css/login.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="register">
        <h1>register</h1>
        <form method="post" action="../../includes/register.php" name="register">
            <input type="text" name="username" placeholder="username" required>
            <input type="password" name="password" placeholder="password" required>
			<input type="text" name="fname" placeholder="first name" required>
			<input type="text" name="lname" placeholder="last name" required>
			<input type="text" name="ssn" placeholder="ssn" pattern="[0-9]+" required>
			<!-- how do I move this fucking date box down a line!!! fuck css-->
			<input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required />
            <input type="submit" name="register" value="register">
        </form>
    </div>


</body>
</html>