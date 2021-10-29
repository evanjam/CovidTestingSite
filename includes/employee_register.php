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
					<link href="../css/dashboard.css" rel="stylesheet" type="text/css">
				</head>
				<body>
				<div class="header">
				<h1>Employee/Patient Registration Form</h1>
			
				</div>

				<div><a href="../forms/employee/employee_dashboard.php">Home</a></div>
				<br>

				<div class="employee_register">
					<h1>Patient Registration Form</h1>
					Please fill out the following form and press Register to register a new Patient
					<img src="../img/employee/nurse_resize.jpg" alt="Nurse">
					<form method="post" action="employee_register.php" name="register">
						<input type="text" name="username" placeholder="username" required>
						<input type="password" name="password" placeholder="password" required>
						<input type="text" name="fname" placeholder="first name" required>
						<input type="text" name="lname" placeholder="last name" required>
						<input type="text" name="ssn" placeholder="ssn" pattern="[0-9]+" required>
						<input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required />
						<input type="submit" name="register" value="Register">
					</form>
					<hr>
					<div>Username already exists.</div>
				</div>
				</body>
				</html>';
			} else { //if username doesnt already exist in database, execute remaining steps to insert the username and password
				$insert_user = "INSERT INTO user_profile (UID, username, password, fname, lname, dob, ssn, permission) 
				VALUES (NULL, '$username', '$password_hash', '$fname', '$lname', '$dob', '$ssn', '0')"; //prepare sql insertion statement
				
				if($connect->query($insert_user) == TRUE) { //evan's query function, up for discussion on which to use
					echo'
				<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>Patient Registration Form</title>
					<link href="../css/dashboard.css" rel="stylesheet" type="text/css">
				</head>
				<body>
				<div class="header">
				<h1>Employee/Patient Registration Form</h1>
			
				</div>

				<div><a href="../forms/employee/employee_dashboard.php">Home</a></div>
				<br>

				<div class="employee_register">
					<h1>Patient Registration Form</h1>
					Please fill out the following form and press Register to register a new Patient
					<img src="../img/employee/nurse_resize.jpg" alt="Nurse">
					<form method="post" action="employee_register.php" name="register">
						<input type="text" name="username" placeholder="username" required>
						<input type="password" name="password" placeholder="password" required>
						<input type="text" name="fname" placeholder="first name" required>
						<input type="text" name="lname" placeholder="last name" required>
						<input type="text" name="ssn" placeholder="ssn" pattern="[0-9]+" required>
						<input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required />
						<input type="submit" name="register" value="Register">
					</form>
					<hr>
					<div>New record created</div>
				</div>
				</body>
				</html>';
				} else 
				echo'
				<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>Patient Registration Form</title>
					<link href="../css/dashboard.css" rel="stylesheet" type="text/css">
				</head>
				<body>
				<div class="header">
				<h1>Employee/Patient Registration Form</h1>
			
				</div>

				<div><a href="../forms/employee/employee_dashboard.php">Home</a></div>
				<br>

				<div class="employee_register">
					<h1>Patient Registration Form</h1>
					Please fill out the following form and press Register to register a new Patient
					<img src="../img/employee/nurse_resize.jpg" alt="Nurse">
					<form method="post" action="employee_register.php" name="register">
						<input type="text" name="username" placeholder="username" required>
						<input type="password" name="password" placeholder="password" required>
						<input type="text" name="fname" placeholder="first name" required>
						<input type="text" name="lname" placeholder="last name" required>
						<input type="text" name="ssn" placeholder="ssn" pattern="[0-9]+" required>
						<input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required />
						<input type="submit" name="register" value="Register">
					</form>
					<hr>
					<div>Insertion failed. Try again.</div>
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