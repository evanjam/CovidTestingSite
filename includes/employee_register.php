<?php

//start the session
session_start();
//register.php
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

//inserts a new patient into user_profile table
//permission automatically set to 0
try{
	if($_SESSION['permission'] == 1){   
		include('connect.php'); //allows us to use the $connect variable set in the connect.php file
		
		if (isset($_POST['register'])) { //checks if the register button was pressed on index.php
			$username = $_POST['username']; //saves variables from the user's input
			$password = $_POST['password'];
			$password_hash = password_hash($password, PASSWORD_BCRYPT); //prepares the password hash
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$dob = $_POST['date'];
			$ssn = $_POST['ssn'];
			$email = $_POST['email'];
			
			$select_user = "SELECT * FROM user_profile WHERE username = '$username'"; //prepares sql statement to check if username already exists
			$result = $connect->query($select_user); //runs $select_user as a query and stores the result in $result
			
			if($result->num_rows > 0) { //if $result->num_rows > 0 returns true, then there exists rows where the username=$username 
				
				echo'
				<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>Patient Registration Form</title>
					<link href="../css/register.css" rel="stylesheet" type="text/css">
				</head>
				<body>
            	<div class="header">
                <h1>Employee/Patient Registration Form</h1>
				<p><a href="employee_dashboard.php">Home</a></p>
            </div>
			<br><br>
            <div class="employee_register">
				<br><br>
                <p>Please fill out the following form and press Register to register a new Patient</p>
                <form method="post" action="../../classes/UserRegister-inc.php" name="register">
				    <label for="username"><b>Username</b></label>
                    <input type="text" name="username" placeholder="Enter username" pattern="[A-Za-z0-9]+"
					title="Only letters and numbers" required>
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
                    <input type="submit" name="register" value="Register"  class="registerbtn">
                </form>
                <hr>
                <div>Username already exists.</div>
            	</div>
				</body>
				</html>';
			} else { //if username doesnt already exist in database, execute remaining steps to insert the username and password
				
				//seed a new hash for $email_hash for email verification purposes
				$email_token = md5(rand(0,1000));
				
				$insert_user = "INSERT INTO user_profile (UID, username, password, fname, lname, dob, ssn, email, email_token, permission) 
				VALUES (NULL, '$username', '$password_hash', '$fname', '$lname', '$dob', '$ssn', '$email', '$email_token', '0')"; //prepare sql insertion statement
				
				if($connect->query($insert_user) == TRUE) { //evan's query function, up for discussion on which to use
					echo'
				<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>Patient Registration Form</title>
					<link href="../css/register.css" rel="stylesheet" type="text/css">
				</head>
				<body>
				<div class="header">
                <h1>Employee/Patient Registration Form</h1>
				<p><a href="employee_dashboard.php">Home</a></p>
            </div>
			<br><br>
            <div class="employee_register">
				<br><br>
                <p>Please fill out the following form and press Register to register a new Patient</p>
                <form method="post" action="../../classes/UserRegister-inc.php" name="register">
				    <label for="username"><b>Username</b></label>
                    <input type="text" name="username" placeholder="Enter username" pattern="[A-Za-z0-9]+"
					title="Only letters and numbers" required>
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
                    <input type="submit" name="register" value="Register"  class="registerbtn">
                </form>
                <hr>
                <div>New record created<br>Email Verification Link Sent</div>
            </div>
				</body>
				</html>';
				
				//prepare and send account verification email
				$subject = 'Verify your CTS Account';
				$message = '
You have been registered for weekly Covid-19 Testing Services with CTS Testing Services
========================
Username: ' . $username . '
========================
Please click the following link to activate your CTS account:
http://localhost/CovidTestingSite/includes/email_verify.php?username=' . $username . '&email_token=' . $email_token . '

Thank you.
				';
				$headers = 'From:cts.sendmail2021@gmail.com' . "\r\n";
				mail($email, $subject, $message, $headers); // Send our email
				
				
				} else 
				echo'
				<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>Patient Registration Form</title>
					<link href="../css/register.css" rel="stylesheet" type="text/css">
				</head>
				<body>
				<div class="header">
                <h1>Employee/Patient Registration Form<a href="employee_dashboard.php">Home</a></h1>
				<p><a href="employee_dashboard.php">Home</a></p>
            </div>
			<br><br>
            <div class="employee_register">
				<br><br>
                <p>Please fill out the following form and press Register to register a new Patient</p>
                <form method="post" action="../../classes/UserRegister-inc.php" name="register">
				    <label for="username"><b>Username</b></label>
                    <input type="text" name="username" placeholder="Enter username" pattern="[A-Za-z0-9]+"
					title="Only letters and numbers" required>
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
                    <input type="submit" name="register" value="Register"  class="registerbtn">
                </form>
                <hr>
                <div>Insertion Failed. Try Again</div>
            </div>
				</body>
				</html>';
				$connect->close(); //it still works if I don't include this but I feel like it's probably necessary down the line to do this
			}
		}
	}
}catch(Exception $e){
	echo'<h1>This page is unavailable.</h1>';
	header('Refresh: 1;URL=../index.php');
}
?>