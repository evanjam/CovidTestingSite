<?php
//submit_test.php
//inserts new test_sample into the test_sample table

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
			VALUES (NULL, '$getUID', '$serial', '$date', 'NULL', 'NULL')";
			
			if($connect->query($insert_test) == TRUE) {
				echo "insert successful?";
			} else {
				echo "insertion error failed for some reason. try again.";
				header('Refresh: 1;URL=../forms/employee/employee_dashboard.php');
			}
			
		} else {
			echo "no patient exists with that username. please register a new patient before submitting their test.";
			header('Refresh: 3;URL=../forms/employee/employee_dashboard.php');
		}
	}
	
?>