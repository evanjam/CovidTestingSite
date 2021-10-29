<?php
//register.php
//creates new user in the user_login table and gives admin the ability to set the permission level

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
			echo'<!DOCTYPE html>
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
					<h1>Register a new user profile</h1>
				
				</div>
			
				<div><a href="../index.php">Home</a></div>
				<br>
			
				<div class="employee_register">
					<h1>User Registration Form</h1>
					Please fill out the following form and press Register to register a new Patient
					<img src="../img/employee/nurse_resize.jpg" alt="Nurse">
					<form method="post" action="../includes/register.php" name="register">
						<input type="text" name="username" placeholder="username" required>
						<input type="password" name="password" placeholder="password" required>
						<input type="text" name="fname" placeholder="first name" required>
						<input type="text" name="lname" placeholder="last name" required>
						<input type="text" name="ssn" placeholder="ssn" pattern="[0-9]+" required>
						<input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required />
						<input type="submit" name="register" value="Register">
					</form>
					<hr>
					<div>Username already exists. Try again.</div>
				</div>
				
			</body>
			</html>';
			header('Refresh: 2;URL=../forms/patient_register.php'); //wait 1 second and refresh index.php homepage
		} else { //if username doesnt already exist in database, execute remaining steps to insert the username and password
			$insert_user = "INSERT INTO user_profile (UID, username, password, fname, lname, dob, ssn) 
			VALUES (NULL, '$username', '$password_hash', '$fname', '$lname', '$dob', '$ssn')"; //prepare sql insertion statement
			
			if($connect->query($insert_user) == TRUE) { //evan's query function, up for discussion on which to use
				//If new user profile was created
				echo'<!DOCTYPE html>
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
						<h1>Register a new user profile</h1>
					
					</div>
				
					<div><a href="../index.php">Home</a></div>
					<br>
				
					<div class="employee_register">
						<h1>User Registration Form</h1>
						Please fill out the following form and press Register to register a new Patient
						<img src="../img/employee/nurse_resize.jpg" alt="Nurse">
						<form method="post" action="../includes/register.php" name="register">
							<input type="text" name="username" placeholder="username" required>
							<input type="password" name="password" placeholder="password" required>
							<input type="text" name="fname" placeholder="first name" required>
							<input type="text" name="lname" placeholder="last name" required>
							<input type="text" name="ssn" placeholder="ssn" pattern="[0-9]+" required>
							<input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required />
							<input type="submit" name="register" value="Register">
						</form>
						<hr>
						<div>New user profile created.</div>
					</div>
					
				</body>
				</html>';
				header('Refresh: 2;URL=../index.php');
			} else 
			//If insertion failed
			echo'<!DOCTYPE html>
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
					<h1>Register a new user profile</h1>
				
				</div>
			
				<div><a href="../index.php">Home</a></div>
				<br>
			
				<div class="employee_register">
					<h1>User Registration Form</h1>
					Please fill out the following form and press Register to register a new Patient
					<img src="../img/employee/nurse_resize.jpg" alt="Nurse">
					<form method="post" action="../includes/register.php" name="register">
						<input type="text" name="username" placeholder="username" required>
						<input type="password" name="password" placeholder="password" required>
						<input type="text" name="fname" placeholder="first name" required>
						<input type="text" name="lname" placeholder="last name" required>
						<input type="text" name="ssn" placeholder="ssn" pattern="[0-9]+" required>
						<input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required />
						<input type="submit" name="register" value="Register">
					</form>
					<hr>
					<div>Insertion Failed. Try again.</div>
				</div>				
			</body>
			</html>';
			header('Refresh: 2;URL=../forms/patient_register.php');
			$connect->close(); //it still works if I don't include this but I feel like it's probably necessary down the line to do this
		}
	}
?>