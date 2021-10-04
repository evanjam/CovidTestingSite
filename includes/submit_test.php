<?php
//submit_test.php
//inserts new test_sample into the test_sample table

	include('connect.php'); //allows us to use the $connect variable set in the connect.php file
	
	if (isset($_POST['submit_test'])) {
		$ssn = $_POST['ssn'];
		$serial = $_POST['serial'];
		
		
		
	}
	
?>