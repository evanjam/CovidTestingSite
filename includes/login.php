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
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$permission = $row['permission'];
		if(password_verify($password, $row['password'])) {
				$_SESSION['username'] = $username;
				$_SESSION['permission'] = $permission;
				echo "credentials match, username and password has been successfully verified!";
				echo $_SESSION['permission'];
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
				echo "credentials do not match what is stored in the db, try again";
				header('Refresh: 1;URL=../forms/login.php');
			}
		} else {
			echo "credentials do not match what is stored in the db, try again";
			header('Refresh: 1;URL=../forms/login.php');
		}

	}
?>