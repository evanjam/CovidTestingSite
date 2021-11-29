<?php

    include('connect.php'); 
	
	if (isset($_POST['labtests'])) {
		$date = $_POST['date'];
		
		$query_date = "SELECT * FROM `test_sample` WHERE `test_date` = '$date'";
		$result = $connect->query($query_date);
		
		if($result->num_rows > 0) {
			echo 'test exists on that date';
		} else {
			echo 'rip';
		}
	}
	
?>