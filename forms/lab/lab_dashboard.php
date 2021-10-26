<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab user dashboard</title>
    <link href="../../css/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    if($_SESSION['permission'] == 2){ 
    echo'<div class="header">';
        echo'<h1>Lab user dashboard</h1>';
    
    echo'</div>';
	
	echo'<div><a href="lab_dashboard.php">Home</a></div>';
    echo'<br>';
    echo'<div><a href="../patient/patient_dashboard.php">View Personal Test Results</a></div>';
    echo'<br>';
    echo'<div><a href="../login.php">Log Out</a></div>';


    echo'<div class="getTests">';
        echo'<h1>Enter date for tests </h1>';
        echo'<form method="post" action="" name="labtests">';
            echo'<input type="date" name="date"  placeholder="Desired date" id="date" required />';
            echo'<input type="submit" name="labtests" value="Search">';
        echo'</form>';
    echo'</div>';


    echo'<table class="desiredResults" id="desiredResults">';
        echo'<tr>';
            echo'<th>UID</th>
            <th>Serial #</th>
            <th>Test Date</th>
            <th>Result</th>
            <th>is_signed</th>
            <th>TID</th>';
        echo'<tr>';

                include('../../includes/connect.php'); 
	
                if (isset($_POST['labtests'])) {
                    $date = $_POST['date'];
            
                    $query_date = "SELECT * FROM `test_sample` WHERE `test_date` = '$date'"; //returns rows that have the desired date
                    $result = $connect->query($query_date); //saves resultng data
                    
                    if($result->num_rows > 0) {
                        //loop throught rows
                        while(($row = $result->fetch_row())!==null) {
                            //print out rows
                            echo '<tr>';
                            echo "<td>{$row[1]}</td>";
                            echo "<td>{$row[2]}</td>";
                            echo "<td>{$row[3]}</td>";
                            echo "<td>{$row[4]}</td>";
                            echo "<td>{$row[5]}</td>";
                            echo "<td>TID = {$row[0]}</td>";
                            echo '</tr>';
                            echo '<tr>
                            <td><hr></td><td><hr></td>
                            <td><hr></td><td><hr></td>
                            <td><hr></td><td><hr></td>
                            </tr>';
                        }
                        //print out the form
                        echo '<tr><td><
                        br></td></tr>
                        <tr>
                        <td>Update Test: </td>
                        <td>(All fields are required)</td>
                        <form action="lab_dashboard.php" method="post">
                        <td><input type="number" name="result" placeholder="Enter Result" id="result" pattern="[0-1]"/></td>
                        <td><input type="number" name="tid" placeholder="Enter TID" id="tid" pattern="[0-1]"/></td>
                        <td><input type="submit" name="submit" value="submit"></td>
                        </form>
                        </tr>';
                    } else {
                        echo '<tr><td>There were no tests on that date</td></tr>';
                        
                    }
                }
                if (isset($_POST['submit'])) { //checks if the submit button was pressed
                    $result = $_POST['result']; //saves variables from the user's input
                    $tid = $_POST['tid'];
                    
                    $update_result = "UPDATE `test_sample` SET `result` = $result WHERE `test_sample`.`TID` = $tid;"; //prepares sql statement to check if username already exists
                    $result = $connect->query($update_result); //runs $select_user as a query and stores the result in $result

                    if($connect->query($update_result) == TRUE) { //evan's query function, up for discussion on which to use
                        echo "Result has been updated";
                        //header('Refresh: 1;URL=lab_dashboard.php');
                    } else 
                        echo "insertion failed for some reason. try again.";
                    $connect->close();
                }
    }
    else{
        echo '<h1>This page is not reachable with your level of access.</h1>';
    }
        ?>
    </table>

</body>
</html>