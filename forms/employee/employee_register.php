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
    <link href="../../css/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
    //This allows the error to be caught. It gets missed without line 19-28
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
    if($_SESSION['permission'] == 1){ 
	echo'<div class="header">
        <h1>Employee/Patient Registration Form</h1>
    
    </div>

	<div><a href="employee_dashboard.php">Home</a></div>
    <br>

    <div class="employee_register">
        <h1>Patient Registration Form</h1>
		Please fill out the following form and press Register to register a new Patient
		<img src="../../img/employee/nurse_resize.jpg" alt="Nurse">
        <form method="post" action="../../classes/UserRegister-inc.php" name="register">
            <input type="text" name="username" placeholder="username" pattern="[A-Za-z0-9]+"
            title="Only letters and numbers" required>
            <input type="password" id="password" name="password" placeholder="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[#?!@$%^&*-]).{8,}" 
			title="Password must contain at least one number, one uppercase, lowercase letter and 1 special character, and at least 8 or more characters" required/>
            <input type="text" name="fname" placeholder="first name" pattern="[A-Za-z]+" 
			title="Only letters" required>
            <input type="text" name="lname" placeholder="last name" pattern="[A-Za-z]+"
			title="Only letters" required>
            <input type="text" name="ssn" maxlength="9" placeholder="ssn" pattern="[0-9]+"
			title="SSN must be 9 digits" required>
			<input type="email" placeholder="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
            <input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required>
            <input type="submit" name="register" value="Register">
        </form>
    </div>';

    }else{
        //Return message if access level is incorrect.
        echo '<h1>This page is not reachable with your level of access.</h1>';
    }
}catch(Exception $e){
    echo'<h1>This page is unavailable.</h1>';
    header('Refresh: 1;URL=../../index.php');
}

?>
</body>
</html>