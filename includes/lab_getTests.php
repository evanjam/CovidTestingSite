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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab dashboard</title>
    <link href="../css/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="header">
        <h1>Lab user dashboard</h1>
    
    </div>
	
	<div><a href="../forms/lab/lab_dashboard.php">Home</a></div>
    <br>


    <div class="getTests">
        <h1>Enter date for tests </h1>
        <form method="post" action="../includes/lab_getTests.php" name="labtests">
            <input type="date" name="date"  placeholder="Desired date" id="date" required />
            <input type="submit" name="labtests" value="Search">
        </form>
    </div>


    <table class="desiredResults" id="desiredResults">
        <tr>
            <th>UID</th>
            <th>Serial #</th>
            <th>Test Date</th>
            <th>Result</th>
            <th>is_signed</th>
        <tr>
        <tr>
            <td> <?php echo "$row[0]" ?> </td>
            <td>B</td>
            <td>C</td>
            <td>D</td>
            <td>E</td>
        <tr>

    </table>


 

</body>
</html>