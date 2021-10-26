<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient dashboard</title>
    <link href="../../css/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    echo'
    <div class="header">
        <h1>Patient dashboard</h1>
    
    </div>
	
	<div><a href="patient_dashboard.php">Home</a></div>
    <div><a href="../login.php">Log Out</a></div>
    <br>
    <div class="getTests">
    <h1>Test Results </h1>
</div>
    <table class="desiredResults" id="desiredResults">
        <tr>
            <th>Test Date</th>
            <th>Result</th>
        <tr>';

                include('../../includes/connect.php'); 

                    //Get the user ID
                    $UID = $_SESSION['UID'];
                    $query_tests = "SELECT * FROM `test_sample` WHERE `UID` = '$UID'"; //returns rows that have the desired date
                    $result = $connect->query($query_tests); //saves resultng data
                    
                    //Check if there are tests
                    if($result->num_rows > 0) {
                        
                        while(($row = $result->fetch_row())!==null) {
                            if($row[4] != null){//Print out the row if result is not null
                                echo '<tr>';
                                echo "<td>{$row[3]}</td>";
                                echo "<td>{$row[4]}</td>";
                                echo '</tr>';
                            }
                        }
                    } else {
                        echo 'There are no test results available';                       
                }
        ?>

    </table>
</body>
</html>