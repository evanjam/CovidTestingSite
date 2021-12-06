<?php
    //Start the session to gain access to the session variables
    session_start();
	
    //Set the current time
	$t=time();
    //Check to see if the session time is less than 900 seconds on refresh
	if (isset($_SESSION['logged']) && ($t - $_SESSION['logged'] > 900)) 
	{
        //End the session if session time is 900 seconds or more
        session_destroy();
        header('Refresh: 0.01;URL=../../sessioninactivitytimeout.php');
	}
	else
	{
        //Update the session time to the current time
		$_SESSION['logged'] = time();
	}  
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lab user dashboard</title>
        <link href="../../css/dashboards.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        //This allows the error to be caught.
        set_error_handler('exceptions_error_handler');

        function exceptions_error_handler($severity, $message, $filename, $lineno) {
            if (error_reporting() == 0) {
                return;
            }
            if (error_reporting() & $severity) {
                throw new ErrorException($message, 0, $severity, $filename, $lineno);
            }
        }
        
        try{
            //Check to make sure that the user has the admin permission level of 2.
            if($_SESSION['permission'] == 2){ 
            
            //Print out the header, navigation bar, and input for date and submit.
            echo
            '<div class="header">
                <h1>Lab user dashboard</h1>
            </div>
            <ul>
                <li><a href="lab_dashboard.php">Home</a></li>
                <br>
                <li><a href="../patient/patient_dashboard.php">View Personal Test Results</a></li>
                <br>
                <li><a href="../../index.php">Log Out</a></li>
            </ul>
            <div class="getTests">
                <h1 class="labHeading">Enter date for tests </h1>
                <hr>
                <form method="post" action="" name="labtests" class="labDate">
                    <input class="inputColor" type="date" name="date"  placeholder="Desired date" id="date" required />
                    <input class="inputColor" type="submit" name="labtests" value="Search">
                </form>
            </div>';

            //Print out the headings of each column.
            echo
            '<table class="desiredResults" id="desiredResults">
                <tr>
                    <th>UID</th>
                    <th>Serial #</th>
                    <th>Test Date</th>
                    <th>Result</th>
                    <th>is_signed</th>
                    <th>TID</th>
                <tr>';
                        //Create connection to the DB
                        include('../../includes/connect.php'); 

                        //Handle when the submit button is clicked
                        if (isset($_POST['labtests'])) {

                            //Set the date to the current date
                            $date = $_POST['date'];
                    
                            //Select all test samples for the current date
                            $query_date = "SELECT * FROM `test_sample` WHERE `test_date` = '$date'";

                            //Saves the data that was returned from the select query
                            $result = $connect->query($query_date);
                            
                            //Check to see if there were results
                            if($result->num_rows > 0) {

                                //Loop through the rows
                                while(($row = $result->fetch_row())!==null) {

                                    //Print out the rows
                                    echo '<tr>';
                                    echo"<td>{$row[1]}</td>";
                                    echo"<td>{$row[2]}</td>";
                                    echo"<td>{$row[3]}</td>";

                                    //Check the value of the test result
                                    //0 == Null. 1 == Negative. 2 == Positive.
                                    if($row[4] == 0){
                                        echo "<td>No Result</td>";
                                    }else if($row[4] == 1){
                                        echo "<td>Negative</td>";
                                    }else if($row[4] == 2){
                                        echo "<td>Positive</td>";
                                    }

                                    //Check the value to determine if signed
                                    //0 == Not signed. 1 == Signed.
                                    if($row[5] == 0){
                                        echo "<td>Not Signed</td>";
                                    }else if($row[5] == 1){
                                        echo "<td>Signed</td>";
                                    }
                                    echo "<td>TID = {$row[0]}</td>";
                                    echo '</tr>';

                                    //Print an empty row with lines for formatting
                                    echo '<tr>
                                    <td><hr></td><td><hr></td>
                                    <td><hr></td><td><hr></td>
                                    <td><hr></td><td><hr></td>
                                    </tr>';
                                }
                                //Print out the title rows for the submit form
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
                                //Print out a row with horizontal lines
                                echo '
                                <tr>
                                <td></td>
                                </tr><tr>
                                <td></td>
                                <td></td>
                                <td><hr></td>
                                <td><hr></td>
                                <td></td>
                                </tr>';

                                //Print out the result input and the submit button at the bottom of the table
                                echo 
                                '<tr>
                                <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <form action="lab_dashboard.php" method="post">
                                        <td>
                                            <input type="radio" id="noResult" name="result" value="0">
                                            <label for="noResult">No Result</label><br>
                                            <input type="radio" id="positive" name="result" value="2">
                                            <label for="positive">Positive</label><br>
                                            <input type="radio" id="negative" name="result" value="1">
                                            <label for="negative">Negative</label>
                                        </td>
                                        <td>
                                            <input class="inputColor" type="number" name="tid" placeholder="Enter TID" id="tid" pattern="[0-1]"/></td>
                                            <td><input class="inputColor" type="submit" name="submit" value="submit">
                                        </td>
                                    </form>
                                </tr>';
                                //If the number of rows was 0
                            } else {
                                echo '<tr><td>There were no tests on that date</td></tr>';
                                
                            }
                        }
                        //Checks if the submit button was pressed
                        if (isset($_POST['submit'])) {
                            //Saves variables from the user's input
                            $result = $_POST['result']; 
                            $tid = $_POST['tid'];

                            //Sql statement to update the information in the Database.
                            $update_result = "UPDATE `test_sample` SET `result` = $result WHERE `test_sample`.`TID` = $tid;";
                            //Stores the result of the query in $result
                            $result = $connect->query($update_result); 

                            //Check to see if the query was successful
                            if($connect->query($update_result) == TRUE) {
                                echo "Result has been updated";
                                header('Refresh: 1;URL=lab_dashboard.php');
                            } else 
                                echo "insertion failed for some reason. try again.";
                            $connect->close();
                        }
            }
            else{
                //If the permission level was no 2.
                echo '<h1>This page is not reachable with your level of access.</h1>';
            }
            //If the session variable did not exist catch the error.
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