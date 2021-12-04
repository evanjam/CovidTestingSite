<?php
    //Start the session to access the user and permission level
    session_start();
	
	$t=time();
	if (isset($_SESSION['logged']) && ($t - $_SESSION['logged'] > 900)) 
	{
    session_destroy();
	header('Refresh: 0.01;URL=../../sessioninactivitytimeout.php');
	}
	else
	{
		$_SESSION['logged'] = time();
	}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration Form</title>
    <link href="../../css/register.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
    //This allows the error to be caught
    set_error_handler('exceptions_error_handler');

    function exceptions_error_handler($severity, $message, $filename, $lineno) {
    if (error_reporting() == 0) {
        return;
    }
    if (error_reporting() & $severity) {
        throw new ErrorException($message, 0, $severity, $filename, $lineno);
    }
    }


    //Check to see if the users permission level is correct for this page
    try{
        if($_SESSION['permission'] == 4){
            echo'<div class="header">
                <h1>Admin/User Registration Form</h1>
            </div>
			<br><br>
            <div class="employee_register">
				<br><br>
                <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                </ul>
                <p>Please fill out the following form and press Register to register a new User. Enter permission level as number 0-4.</p>
                <form method="post" action="../../includes/admin_register.php" name="register">
				    <label for="username"><b>Username</b></label>
                    <input type="text" name="username" placeholder="Enter username" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
					title="Username cannot contain those special characters" required>
					<label for="password"><b>Password</b></label>
                    <input type="password" id="password" name="password" placeholder="Enter password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[#?!@$%^&*-]).{8,}" 
					title="Password must contain at least one number, one uppercase, lowercase letter and 1 special character, and at least 8 or more characters" required/>
                     <label for="fname"><b>First name</b></label>
					<input type="text" name="fname" placeholder="Enter first name" pattern="[A-Za-z]+" 
					title="Only letters" required>
                     <label for="lname"><b>Last name</b></label>
					<input type="text" name="lname" placeholder="Enter last name" pattern="[A-Za-z]+"
					title="Only letters" required>
                     <label for="ssn"><b>SSN</b></label>
					<input type="text" name="ssn" maxlength="9" placeholder="Enter SSN" pattern="[0-9]+"
					title="SSN must be 9 digits" required>
					 <label for="email"><b>Email</b></label>
					<input type="email" placeholder="Enter email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                     <label for="date"><b>Date</b></label>
					<input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required>
                     <label for="permission"><b>Permission</b></label>
					<input type="number" name="permission" placeholder="Enter permission level" id="permission" min="0" max="4" required>
                    <input type="submit" name="register" value="Register"  class="registerbtn">
                </form>
            </div>';
        }
        else{
            //Return message if access level is incorrect.
            echo '<h1>This page is not reachable with your level of access.</h1>';
        }
    }catch(Exception $e){
        echo'<h1>This page is unavailable.</h1>';
        header('Refresh: 1;URL=../../index.php');
    }
?>
    <footer>
        <div>
            <p>Covid Testing Site 2021</p>
        </div>
    </footer>

</body>
</html>