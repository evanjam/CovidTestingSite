<?php
//submit_test.php
//inserts new test_sample into the test_sample table


	//Start Session
	session_start();
	include('connect.php'); //allows us to use the $connect variable set in the connect.php file
	
	if (isset($_POST['submit_test'])) {
		$username = $_POST['username'];
		$serial = $_POST['serial'];
		$date = date("y/m/d");
		
		$select_user = "SELECT * FROM user_profile WHERE username = '$username'";
		$result = $connect->query($select_user);
		
		if($result->num_rows > 0) { //if true, rows exist where username=$username, which means the user exists in user_login table
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$getUID = $row['UID']; //gets the UID of the user 
			$insert_test = "INSERT INTO `test_sample` (`TID`, `UID`, `serial_number`, `test_date`, `result`, `is_signed`) 
			VALUES (NULL, '$getUID', '$serial', '$date', '0', '0')";
			
			if($connect->query($insert_test) == TRUE) {
				echo'
				<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>Submit New Test</title>
					<link href="../css/employee_submit.css" rel="stylesheet" type="text/css">
				</head>
				<body>
				
				<div class="header">
				<h1>Submit New Test</h1>
			
				</div>';
				if($_SESSION['permission'] == 4){
					echo'<ul>
					<li><a href="../forms/admin/admin_dashboard.php">Home</a></li>
					</ul>';
				}else if($_SESSION['permission'] == 1){
					echo'<ul>
					<li><a href="../forms/employee/employee_dashboard.php">Home</a></li>
					</ul>';
				}
				echo'

				<div class="form">
					<h1 class="Heading">Submit New Test</h1>
					<p>Please enter the patients username and the serial # on the test vial and press Submit</p>
					<img src="../img/employee/cotton_swab_resize.jpg" alt="Cotton Swab">
					<br></br>
					<form method="post" action="submit_test.php" name="submit_test">
						<input class="inputColor" type="text" name="username" placeholder="username" required>
						<input class="inputColor" type="text" name="serial" placeholder="serial #" pattern="[0-9]+" required>
						<br></br>
						<input class="inputColor" type="submit" name="submit_test" value="Submit">
					</form>
					<hr>
					<div>Test Submitted Successfully</div>
					
				</div>
				<footer>
					<div>
						<p>Covid Testing Site 2021</p>
					</div>
				</footer>
				</body>
				</html>
				';

			} else {
				echo'
				<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>Submit New Test</title>
					<link href="../css/employee_submit.css" rel="stylesheet" type="text/css">
				</head>
				<body>
				
				<div class="header">
				<h1>Submit New Test</h1>
			
				</div>';
				if($_SESSION['permission'] == 4){
					echo'<ul>
					<li><a href="../forms/admin/admin_dashboard.php">Home</a></li>
					</ul>';
				}else if($_SESSION['permission'] == 1){
					echo'<ul>
					<li><a href="../forms/employee/employee_dashboard.php">Home</a></li>
					</ul>';
				}
				echo'

				<div class="form">
					<h1 class="Heading">Submit New Test</h1>
					<p>Please enter the patients username and the serial # on the test vial and press Submit</p>
					<img src="../img/employee/cotton_swab_resize.jpg" alt="Cotton Swab">
					<br></br>
					<form method="post" action="submit_test.php" name="submit_test">
						<input class="inputColor" type="text" name="username" placeholder="username" required>
						<input class="inputColor" type="text" name="serial" placeholder="serial #" pattern="[0-9]+" required>
						<br></br>
						<input class="inputColor" type="submit" name="submit_test" value="Submit">
					</form>
					<hr>
					<div>Test Submission Failed. Try Again.</div>
					
				</div>
				<footer>
					<div>
						<p>Covid Testing Site 2021</p>
					</div>
				</footer>
				</body>
				</html>
				';
			}
			
		} else {
			echo'
				<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>Submit New Test</title>
					<link href="../css/employee_submit.css" rel="stylesheet" type="text/css">
				</head>
				<body>
				
				<div class="header">
				<h1>Submit New Test</h1>
			
				</div>';
				if($_SESSION['permission'] == 4){
					echo'<ul>
					<li><a href="../forms/admin/admin_dashboard.php">Home</a></li>
					</ul>';
				}else if($_SESSION['permission'] == 1){
					echo'<ul>
					<li><a href="../forms/employee/employee_dashboard.php">Home</a></li>
					</ul>';
				}
				echo'

				<div class="form">
					<h1 class="Heading">Submit New Test</h1>
					<p>Please enter the patients username and the serial # on the test vial and press Submit</p>
					<img src="../img/employee/cotton_swab_resize.jpg" alt="Cotton Swab">
					<br></br>
					<form method="post" action="submit_test.php" name="submit_test">
						<input class="inputColor" type="text" name="username" placeholder="username" required>
						<input class="inputColor" type="text" name="serial" placeholder="serial #" pattern="[0-9]+" required>
						<br></br>
						<input class="inputColor" type="submit" name="submit_test" value="Submit">
					</form>
					<hr>
					<div>No patient exists with that username.</div>
					
				</div>
				<footer>
					<div>
						<p>Covid Testing Site 2021</p>
					</div>
				</footer>
				</body>
				</html>
				';
		}
	}
	
?>