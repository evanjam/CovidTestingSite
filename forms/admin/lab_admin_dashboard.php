<?php
    //Start the session to access the user and permission level
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin/Lab user dashboard</title>
    <link href="../../css/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php

    //This allows the error to be caught
    set_error_handler('exceptions_error_handler');

    function exceptions_error_handler($severity, $message, $filename, $lineno) {
    if (error_reporting() == 0) {
        return;
    }
    if (error_reporting() & $severity) {
        throw new ErrorException($message, 0, $severity, $filename, $lineno);
    }
    }

    //Check to see if the users permission level is correct for this page
    try{
    if($_SESSION['permission'] == 4){

    echo'<div class="header">
        <h1>Admin/Lab user dashboard</h1>
    
    </div>
	
	<div><a href="admin_dashboard.php">Home</a></div>
    <br>


    <div class="getTests">
        <h1>Enter date for tests </h1>
        <form method="post" action="" name="labtests">
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
            <th>TID</th>
        <tr>';

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
                        echo '<tr><td><br></td></tr>';
                        echo '<tr>';
                        echo '<td>Update Test: </td>';
                        echo '<td>(All fields are required)</td>';
                        echo '<form action="lab_admin_dashboard.php" method="post">';
                        echo '<td><input type="number" name="result" placeholder="Enter Result" id="result" pattern="[0-1]"/></td>';
                        echo '<td><input type="number" name="tid" placeholder="Enter TID" id="tid" pattern="[0-1]"/></td>';
                        echo '<td><input type="submit" name="submit" value="submit"></td>';
                        echo '</form>';
                        echo '</tr>';
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
            }else{
                //Return message if access level is incorrect.
                echo '<h1>This page is not reachable with your level of access.</h1>';
            }
    }catch(Exception $e){
        echo'<h1>This page is unavailable.</h1>';
        header('Refresh: 1;URL=../../index.php');
    }
        ?>

    </table>
</body>
</html>