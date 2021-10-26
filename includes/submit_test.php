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
				echo "Insert successful. Redirecting to home";
				//dustin can you please make it go to the right dashboard here buddy :)
				if($_SESSION['permission'] == 4){
					header('Refresh: 2;URL=../forms/admin/admin_dashboard.php');
				}else if($_SESSION['permission'] == 1){
					header('Refresh: 2;URL=../forms/employee/employee_dashboard.php');
				}
			} else {
				echo "Insertion error. Failed for some reason. Try again.";
				if($_SESSION['permission'] == 4){
					header('Refresh: 2;URL=../forms/admin/admin_submit_test.php');
				}else if($_SESSION['permission'] == 1){
					header('Refresh: 2;URL=../forms/employee/employee_submit_test.php');
				}
			}
			
		} else {
			echo "No patient exists with that username. Please register a new patient before submitting their test.";
			if($_SESSION['permission'] == 4){
				header('Refresh: 3;URL=../forms/admin/admin_submit_test.php');
			}else if($_SESSION['permission'] == 1){
				header('Refresh: 3;URL=../forms/employee/employee_submit_test.php');
			}
		}
	}
	
?>