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
		$login_date = date("Y-m-d"); //getting the date to input into login_logs 
		$get_user = "SELECT * FROM user_profile WHERE username = '$username'"; //prepare sql query to select row from table where username=$username
		$result = $connect->query($get_user); //execute sql statement, store row in $result
		
		//if rows are greater than 0, then rows exist where username=$username, therefore user exists
		if($result->num_rows > 0) {
			//$row is an array of the fields of $result
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$permission = $row['permission']; //grabs the permission value from the selected $row
			$UID = $row['UID']; //grabs UID from selected $row
		if(password_verify($password, $row['password'])) { //reverse hash function to check entered password against the hash stored in database
				//if password_verify succeeds, set up some session variables
				$_SESSION['username'] = $username;
				$_SESSION['UID'] = $UID;
				$_SESSION['permission'] = $permission;

				//next, insert a record of the login event into login_log table with timestamp
				$insert_log = "INSERT INTO login_log (UID, login_date, is_successful) VALUES ('$UID', '$login_date', '1')"; //preparing sql statement 
				$connect->query($insert_log); //executing sql statement to insert into login_log table
				
				//re-printing the login page front end but with an added div at the bottom indicating login status
				include('../classes/login.classes.php');
				$obj = new Login();
				$obj->success_Login();

				//Check the user permission and redirect to appropriate dashboard based on permission level
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
				//if password verification fails (ie username is correct and pw is not) then insert a log entry and print message denying access, refresh page.
				$insert_log = "INSERT INTO login_log (UID, login_date, is_successful) VALUES ('$UID', '$login_date', '0')"; //preparing sql statement 
				$connect->query($insert_log); //executing sql statement to insert into login_log table
				//re-printing the login page front end but with an added div at the bottom indicating login status
				include('../classes/login.classes.php');
				$obj = new Login();
				$obj->wrong_Credentials();

				header('Refresh: 2;URL=../index.php');
			}
		} else {
			//if the username does not exist in the database then do not insert a log entry and print message denying access, refresh page
			
			//re-printing the login page front end but with an added div at the bottom indicating login status
			include('../classes/login.classes.php');
			$obj = new Login();
			$obj->user_Not_Exist();
			header('Refresh: 2;URL=../index.php');
		}

	}
?>