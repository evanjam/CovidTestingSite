<?php
//login.php
//https://stackoverflow.com/questions/46819734/how-to-check-username-and-password-matches-the-database-values
//https://stackoverflow.com/questions/26536293/php-password-hash-password-verify

	//Start session
	session_start();

    include('connect.php'); 
	
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
		$get_user = "SELECT * FROM user_profile WHERE username = '$username'";
		$result = $connect->query($get_user);
		
		if($result->num_rows > 0) {
			//Get data from the user and create variables
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$permission = $row['permission'];
			$UID = $row['UID'];
		if(password_verify($password, $row['password'])) {
				//Create session variables
				$_SESSION['username'] = $username;
				$_SESSION['UID'] = $UID;
				$_SESSION['permission'] = $permission;
				echo '
				<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>test login/register page</title>
					<link href="../css/login.css" rel="stylesheet" type="text/css">
				</head>
				<body>

					<div class="login">
						<h1>login</h1>
						<form method="post" action="includes/login.php" name="login">
							<input type="text" name="username" pattern="[a-zA-Z0-9]+" placeholder="login" id="username" required />
							<input type="password" name="password" placeholder="password" required>
							<input type="submit" name="login" value="login">
						</form>
						<a href="forms/pass_reset.php">Forgot password?</a><br>
						<a href="forms/patient_register.php">Create New Account</a>
						<hr>
						<div>Credentials match, Logging in...</div>
						<hr>
					</div>

				</body>
				</html>';


				//Check the user permission to determine which dashboard to link to
				if($_SESSION['permission'] == 0){
					header('Refresh: 1;URL=../forms/patient/patient_dashboard.php');
				}
				else if($_SESSION['permission'] == 1){
					header('Refresh: 1;URL=../forms/employee/employee_dashboard.php');
				}
				else if($_SESSION['permission'] == 2){
					header('Refresh: 1;URL=../forms/lab/lab_dashboard.php');
				}
				else if($_SESSION['permission'] == 3){
					header('Refresh: 1;URL=../forms/doctor/doctor_dashboard.php');
				}
				else if($_SESSION['permission'] == 4){
					header('Refresh: 1;URL=../forms/admin/admin_dashboard.php');
				}

			} else {
				echo '
				<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>test login/register page</title>
					<link href="../css/login.css" rel="stylesheet" type="text/css">
				</head>
				<body>

					<div class="login">
						<h1>login</h1>
						<form method="post" action="includes/login.php" name="login">
							<input type="text" name="username" pattern="[a-zA-Z0-9]+" placeholder="login" id="username" required />
							<input type="password" name="password" placeholder="password" required>
							<input type="submit" name="login" value="login">
						</form>
						<a href="forms/pass_reset.php">Forgot password?</a><br>
						<a href="forms/register.php">Create New Account</a>
						<hr>
						<div>Credentials do not match you dum idiot, Try again</div>
						<hr>
					</div>

				</body>
				</html>';
				header('Refresh: 2;URL=../index.php');
			}
		} else {
			echo '
				<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>test login/register page</title>
					<link href="../css/login.css" rel="stylesheet" type="text/css">
				</head>
				<body>

					<div class="login">
						<h1>login</h1>
						<form method="post" action="includes/login.php" name="login">
							<input type="text" name="username" pattern="[a-zA-Z0-9]+" placeholder="login" id="username" required />
							<input type="password" name="password" placeholder="password" required>
							<input type="submit" name="login" value="login">
						</form>
						<a href="forms/pass_reset.php">Forgot password?</a><br>
						<a href="forms/register.php">Create New Account</a>
						<hr>
						<div>Credentials do not match, Try again</div>
						<hr>
					</div>

				</body>
				</html>';
			header('Refresh: 2;URL=../index.php');
		}

	}
?>