<?php
    //Start the session to access the user and permission level
    session_start();
	
	$t=time();
	if (isset($_SESSION['logged']) && ($t - $_SESSION['logged'] > 900)) 
	{
    session_destroy();
	header('Refresh: 0.01;URL=../../sessioninactivitytimeout.php');
	}
	else
	{
		$_SESSION['logged'] = time();
	}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin/Lab user dashboard</title>
    <link href="../../css/dashboards.css" rel="stylesheet" type="text/css">
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
	
	<ul>
    <li><a href="admin_dashboard.php">Home</a></li>
    </ul>
    <br>


    <div class="getTests">
        <h1 class="labHeading">Enter date for tests </h1>
        <form method="post" action="" name="labtests">
            <div class="labHeading">
            <input class="inputColor" type="date" name="date"  placeholder="Desired date" id="date" required />
            <input class="inputColor" type="submit" name="labtests" value="Search">
            </div>
            <br></br>
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
                            
                            if($row[4] == 0){
                                echo "<td>No Result</td>";
                            }else if($row[4] == 1){
                                echo "<td>Negative</td>";
                            }else if($row[4] == 2){
                                echo "<td>Positive</td>";
                            }

                            if($row[5] == 0){
                                echo "<td>Not Signed</td>";
                            }else if($row[5] == 1){
                                echo "<td>Signed</td>";
                            }
                            echo "<td>TID = {$row[0]}</td>";
                            echo '</tr>';
                            echo '<tr>
                            <td><hr></td><td><hr></td>
                            <td><hr></td><td><hr></td>
                            <td><hr></td><td><hr></td>
                            </tr>';
                        }
                        //print out the form
                        echo '
                        <tr><td><br></br></td></tr>
                        <tr><td>
                        </td></tr>
                        <tr>
                        <td>Update Test: </td>
                        <td>(All fields are required)</td>
                        <td>Result</td>
                        <td>Corresponding TID</td>
                        <td></td>
                        </tr>';

                        echo '
                        <tr><td>
                        </td></tr>
                        <tr>
                        <td></td>
                        <td></td>
                        <td><hr></td>
                        <td><hr></td>
                        <td></td>
                        </tr>';

                        echo '<tr>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<form action="lab_admin_dashboard.php" method="post">';
                        echo '<td><input type="radio" id="noResult" name="result" value="0">
                        <label for="noResult">No Result</label><br>
                        <input type="radio" id="positive" name="result" value="2">
                        <label for="positive">Positive</label><br>
                        <input type="radio" id="negative" name="result" value="1">
                        <label for="negative">Negative</label></td>';
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

    <footer>
        <div>
            <p>Covid Testing Site 2021</p>
        </div>
    </footer>
</body>
</html>