<?php
//login.php
//https://stackoverflow.com/questions/46819734/how-to-check-username-and-password-matches-the-database-values
//https://stackoverflow.com/questions/26536293/php-password-hash-password-verify

    include('connect.php'); 
	
    if (isset($_POST['login'])) {
        $username = $_POST['username']; 
        $password = $_POST['password'];
		// $getId = $_POST['ULID'];
		$dt2=date("Y-m-d");
		$success = 0;
//		$password_hash = password_hash($password, PASSWORD_BCRYPT); 
		$get_user = "SELECT * FROM user_login WHERE username = '$username'"; 
		$result = $connect->query($get_user); 
		
		if($result->num_rows > 0) { 
			$get_password = "SELECT password FROM user_login WHERE username = '$username'"; 
			$row = $result->fetch_array(MYSQLI_ASSOC);
		if(password_verify($password, $row['password'])) {
				echo "credentials match, username and password has been successfully verified!";
				//made this code to try and track user log is and success in the login_logs table but dont know why it wont work 
				++$success;
				$insert_log = "INSERT INTO login_log (ULID ,login_date, is_successful) VALUES ( NULL , $dt2 , $success )"; //attempting to add into login_logs table with user date and success
						echo "login log created";
						if($connect->query($insert_log) == TRUE) { //so it outputs that the query connect worked but no table values show up??????????
							echo "new log created";
						}
			} else {
				echo "credentials do not match what is stored in the db, try again";
				header('Refresh: 1;URL=../index.php');
			}
		} else {
			echo "user doesnt exist, redirecting to home..";
			header('Refresh: 1;URL=../index.php');
		}
		
	}
?>