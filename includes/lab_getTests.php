<?php

    include('connect.php'); 
	
	if (isset($_POST['labtests'])) {
		$date = $_POST['date'];

		$query_date = "SELECT * FROM `test_sample` WHERE `test_date` = '$date'"; //returns rows that have the desired date
		$result = $connect->query($query_date); //saves resultng data
		
		if($result->num_rows > 0) {
			echo "penis";
			while(($row = $result->fetch_assoc())) // gets a row into an array from the results query
			{
				$test = "select * from test_sample where test_date=" .$row[$date].""; //error is occuring here not recognizing the date input
				$test_query = $connect->query($test);
				$testArray = $test_query->fetch_assoc();
				echo $testArray;
			}
			

		} else {
			echo 'gay';
			echo "<br>";
	}
}//fix ur formatting also ur keybaord is shit
?>
