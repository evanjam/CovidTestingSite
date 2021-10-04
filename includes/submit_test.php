<?php
//submit_test.php
//inserts new test_sample into the test_sample table

	include('connect.php'); //allows us to use the $connect variable set in the connect.php file
	
	if (isset($_POST['submit_test'])) {
		$ssn = $_POST['ssn'];
		$serial = $_POST['serial'];
		
		$select_user = "SELECT * FROM user_profile WHERE ssn = '$ssn'";
		$result = $connect->query($select_user);
		
		if($result->num_rows > 0) { //if $result->num_rows > 0 returns true, then there exists rows where the username=$username 
			echo "user exists, do stuf";
		} else {
			echo "no patient exists with the ssn that was specified. please register a new patient before submitting their test.";
			header('Refresh: 2;URL=../forms/employee/employee_dashboard.php');
		}
	}
	
?>