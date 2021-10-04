<?php

    include('connect.php'); 
	
	if (isset($_POST['labtests'])) {
		$date = $_POST['date'];

		$query_date = "SELECT * FROM `test_sample` WHERE `test_date` = '$date'"; //returns rows that have the desired date
		$result = $connect->query($query_date); //saves resultng data
		
		if($result->num_rows > 2) {
			echo "test(s) exist";
			echo "<br><br>";
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$get_username = $row['username'];
			echo "$get_username";
			
		} else {
			echo 'no tests exist on the specified date';
			
	}
}
?>