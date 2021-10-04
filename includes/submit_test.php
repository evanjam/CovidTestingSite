<?php
//submit_test.php
//inserts new test_sample into the test_sample table

	include('connect.php'); //allows us to use the $connect variable set in the connect.php file
	
	if (isset($_POST['submit_test'])) {
		$ssn = $_POST['ssn'];
		$serial = $_POST['serial'];
		$date = date("y/m/d");
		
		$select_user = "SELECT * FROM user_profile WHERE ssn = '$ssn'";
		$result = $connect->query($select_user);
		
		if($result->num_rows > 0) { //if true, rows exist where serial=$serial, meaning the user with that ssn exists
			$insert_test = "INSERT INTO `test_sample` (`TID`, `UID`, `serial_number`, `test_date`, `result`, `is_signed`) 
			VALUES (NULL, '', '$serial', '$date', 'NULL', 'NULL')";
			
		} else {
			echo "no patient exists with the ssn that was specified. please register a new patient before submitting their test.";
			header('Refresh: 2;URL=../forms/employee/employee_dashboard.php');
		}
	}
	
?>