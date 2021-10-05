<?php

    include('connect.php'); 
	
	if (isset($_POST['labtests'])) {
		$date = $_POST['date'];

		$query_date = "SELECT * FROM `test_sample` WHERE `test_date` = '$date'"; //returns rows that have the desired date
		$result = $connect->query($query_date); //saves resultng data
		
		if($result->num_rows > 2) {
			echo "test(s) exist";
			echo "<br><br>";
			
			while(($row = $result->fetch_row())!==null) {
				echo "$row[0], $row[1], $row[2], $row[3], $row[4], $row[5]<br><br>";
			
			}
		} else {
			echo 'no tests exist on the specified date';
			
	}
}
?>

