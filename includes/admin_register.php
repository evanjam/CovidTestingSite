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


//creates new user in the user_login table and gives admin the ability to set the permission level
try{
	if($_SESSION['permission'] == 4){ 
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
			$permission = $_POST['permission'];
			
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
				<h1>Admin/User Registration Form</h1>
			
				</div>

				<div><a href="../forms/admin/admin_dashboard.php">Home</a></div>
				<br>

				<div class="employee_register">
					<h1>User Registration Form</h1>
					Please fill out the following form and press Register to register a new User. Enter permission level as number 0-4.
					<img src="../img/employee/nurse_resize.jpg" alt="Nurse">
					<form method="post" action="admin_register.php" name="register">
						<input type="text" name="username" placeholder="username" required>
						<input type="password" name="password" placeholder="password" required>
						<input type="text" name="fname" placeholder="first name" required>
						<input type="text" name="lname" placeholder="last name" required>
						<input type="text" name="ssn" placeholder="ssn" pattern="[0-9]+" required>
						<input type="text" name="email" placeholder="email" required>
						<input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required />
						<input type="number" name="permission" placeholder="permission" id="permission" pattern="[0-4]" required />
						<input type="submit" name="register" value="Register">
					</form>
					<hr>
					<div>Username already exists.</div>
				</div>
				</body>
				</html>';
		
				//header('Refresh: 2;URL=../forms/admin/admin_register.php'); //wait 1 second and refresh index.php homepage
			} else { //if username doesnt already exist in database, execute remaining steps to insert the username and password
			
				//seed a new hash for $email_hash for email verification purposes
				$email_token = md5(rand(0,1000));
				
				$insert_user = "INSERT INTO user_profile (UID, username, password, fname, lname, dob, ssn, email, email_token, permission) 
				VALUES (NULL, '$username', '$password_hash', '$fname', '$lname', '$dob', '$ssn', '$email', '$email_token', '$permission')"; //prepare sql insertion statement
				
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
				<h1>Admin/User Registration Form</h1>
			
				</div>

				<div><a href="../forms/admin/admin_dashboard.php">Home</a></div>
				<br>

				<div class="employee_register">
					<h1>User Registration Form</h1>
					Please fill out the following form and press Register to register a new User. Enter permission level as number 0-4.
					<img src="../img/employee/nurse_resize.jpg" alt="Nurse">
					<form method="post" action="admin_register.php" name="register">
						<input type="text" name="username" placeholder="username" required>
						<input type="password" name="password" placeholder="password" required>
						<input type="text" name="fname" placeholder="first name" required>
						<input type="text" name="lname" placeholder="last name" required>
						<input type="text" name="ssn" placeholder="ssn" pattern="[0-9]+" required>
						<input type="text" name="email" placeholder="email" required>
						<input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required />
						<input type="number" name="permission" placeholder="permission" id="permission" pattern="[0-4]" required />
						<input type="submit" name="register" value="Register">
					</form>
					<hr>
					<div>New record created.</div>
				</div>
				</body>
				</html>';
					//header('Refresh: 2;URL=../forms/admin/admin_register.php');
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
				<h1>Admin/User Registration Form</h1>
			
				</div>

				<div><a href="../forms/admin/admin_dashboard.php">Home</a></div>
				<br>

				<div class="employee_register">
					<h1>User Registration Form</h1>
					Please fill out the following form and press Register to register a new User. Enter permission level as number 0-4.
					<img src="../img/employee/nurse_resize.jpg" alt="Nurse">
					<form method="post" action="admin_register.php" name="register">
						<input type="text" name="username" placeholder="username" required>
						<input type="password" name="password" placeholder="password" required>
						<input type="text" name="fname" placeholder="first name" required>
						<input type="text" name="lname" placeholder="last name" required>
						<input type="text" name="ssn" placeholder="ssn" pattern="[0-9]+" required>
						<input type="text" name="email" placeholder="email" required>
						<input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required />
						<input type="number" name="permission" placeholder="permission" id="permission" pattern="[0-4]" required />
						<input type="submit" name="register" value="Register">
					</form>
					<hr>
					<div>Insertion failed. Try again.</div>
				</div>
				</body>
				</html>';
				//header('Refresh: 2;URL=../forms/admin/admin_register.php');
				$connect->close(); //it still works if I don't include this but I feel like it's probably necessary down the line to do this
			}
		}
	}else{
		echo '<h1>This page is not reachable with your level of access.</h1>';
		header('Refresh: 1;URL=../index.php');
	}
}catch(Exception $e){
	echo'<h1>This page is unavailable.</h1>';
	header('Refresh: 1;URL=../index.php');
}

?>