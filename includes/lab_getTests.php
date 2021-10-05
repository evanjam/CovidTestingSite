<?php

    include('connect.php'); 
	
	if (isset($_POST['labtests'])) {
		$date = $_POST['date'];

		$query_date = "SELECT * FROM `test_sample` WHERE `test_date` = '$date'"; //returns rows that have the desired date
		$result = $connect->query($query_date); //saves resultng data
		
		if($result->num_rows >= 1) {
			echo "test(s) exist";
			echo "<br><br>";
			while(($row = $result->fetch_row())!==null) {
                displayHTML($row);//calls function to display tests
			
			}
		} else {
			echo 'no tests exist on the specified date';
			
	}


    function displayHTML($row){ //made a function so later on we can have a file with all funcitons in it to make our files more organized
        echo '<tr>';
        echo "<td>{$row[1]}</td>";
        echo "&nbsp";
        echo "<td>{$row[2]}</td>";
        echo "&nbsp";
        echo "<td>{$row[3]}</td>";
        echo "&nbsp";
        echo "<td>{$row[4]}</td>";
        echo "&nbsp";
        echo "<td>{$row[5]}</td>";
        echo "&nbsp";
        echo "<td>TID = {$row[0]}</td>";
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
            <?php  //demonstration on how you can add directly into the html file and display results, plz dont delete

            // $query_date = "SELECT * FROM `test_sample` WHERE `test_date` = '$date'"; //returns rows that have the desired date
            // $result = $connect->query($query_date); //saves resultng data
            
            // if($result->num_rows >= 1) {
            //     echo "test(s) exist";
            //     echo "<br><br>";

            //     while(($row = $result->fetch_row())!==null) {
            //         //print out rows
            //         echo '<tr>';
            //         echo "<td>{$row[1]}</td>";
            //         echo "<td>{$row[2]}</td>";
            //         echo "<td>{$row[3]}</td>";
            //         echo "<td>{$row[4]}</td>";
            //         echo "<td>{$row[5]}</td>";
            //         echo "<td>TID = {$row[0]}</td>";
            //         echo '</tr>';
            //         echo '<tr>
            //         <td><hr></td><td><hr></td>
            //         <td><hr></td><td><hr></td>
            //         <td><hr></td><td><hr></td>
            //         </tr>';
            //     }
            // }
            ?>
    </table>
</body>
</html>