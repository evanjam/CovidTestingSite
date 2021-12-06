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
    <title>Doctor dashboard</title>
    <link href="../../css/dashboards.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
        //This allows the error to be caught. It gets missed without line 19-28
        set_error_handler('exceptions_error_handler');

        function exceptions_error_handler($severity, $message, $filename, $lineno) {
        if (error_reporting() == 0) {
            return;
        }
        if (error_reporting() & $severity) {
            throw new ErrorException($message, 0, $severity, $filename, $lineno);
        }
        }
    
        //Try to check if the permission level is 3. Catch error if it does not exist.
        try{
            if($_SESSION['permission'] == 3){

                //Add header, navigation bar, and submit date + submit button.
                echo
                '<div class="header">
                    <h1>Doctor dashboard</h1>
                </div>
                <ul>
                    <li><a href="doctor_dashboard.php">Home</a></li>
                    <br>
                    <li><a href="../patient/patient_dashboard.php">View Personal Test Results</a></li>
                    <br>
                    <li><a href="../../index.php">Log Out</a></li>
                </ul>
                <div class="getTests">
                    <h1 class="docHeading">Enter date for tests </h1>
                    <form method="post" action="" name="labtests" class="docDate">
                        <hr>
                        <input class="inputColor" type="date" name="date"  placeholder="Desired date" id="date" required />
                        <input class="inputColor" type="submit" name="labtests" value="Search">
                    </form>
                </div>';

                //Print out the headings of each column
                echo'<table class="desiredResults" id="desiredResults">';
                    echo'<tr>';
                        echo'<th>UID</th>';
                        echo'<th>Serial #</th>';
                        echo'<th>Test Date</th>';
                        echo'<th>Result</th>';
                        echo'<th>is_signed</th>';
                        echo'<th>TID</th>';
                    echo'<tr>';

                //Create connection to the DB
                include('../../includes/connect.php'); 
	
                //Handle when the submit button is clicked
                if (isset($_POST['labtests'])) {

                    //Set the date to the current date
                    $date = $_POST['date'];
            
                    //Select all test samples for the current date
                    $query_date = "SELECT * FROM `test_sample` WHERE `test_date` = '$date'";

                    //Saves the data that was returned from the select query
                    $result = $connect->query($query_date); //saves resultng data
                    
                    //Check to see if there were results
                    if($result->num_rows > 0) {
                        //Loop through the rows
                        while(($row = $result->fetch_row())!==null) {

                            //Print out the rows
                            echo '<tr>';
                            echo "<td>{$row[1]}</td>";
                            echo "<td>{$row[2]}</td>";
                            echo "<td>{$row[3]}</td>";

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
                        //Print out headings for the columns for the form
                        echo '<tr><td><br></td></tr>';
                        echo '<tr>';
                        echo '<td>Update Test: </td>';
                        echo '<td>(All fields are required)</td>';
                        echo '<td>Result</td>';
                        echo '<td>Sign</td>';
                        echo '<td>Corresponding TID</td>';
                        echo '<td></td>';
                        echo '</tr>';

                        //Print out empty row with horizontal lines for formatting
                        echo '<tr>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td><hr></td>';
                        echo '<td><hr></td>';
                        echo '<td><hr></td>';
                        echo '<td></td>';
                        echo '</tr>';

                        //Print out the first two columns empty the add the form inputs
                        echo '<tr>
                        <td></td>
                        <td></td>
                        <form action="doctor_dashboard.php" method="post">
                            <td>
                                <input type="radio" id="noResult" name="result" value="0">
                                <label for="noResult">No Result</label><br>
                                <input type="radio" id="positive" name="result" value="2">
                                <label for="positive">Positive</label><br>
                                <input type="radio" id="negative" name="result" value="1">
                                <label for="negative">Negative</label>
                            </td>
                            <td>
                                <input type="radio" id="is_signed" name="is_signed" value="1">
                                <label for="is_signed">Sign</label><br>
                                <input type="radio" id="is_signed" name="is_signed" value="0">
                                <label for="is_signed">Do not Sign</label><br>
                            </td>
                            <td>
                                <input class="inputColor" type="number" name="tid" placeholder="Enter TID" id="tid" pattern="[0-1]"/>
                            </td>
                            <td>
                                <input class="inputColor" type="submit" name="submit" value="submit">
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
                    $is_signed = $_POST['is_signed'];
                    $tid = $_POST['tid'];

                    //Sql statement to update the information in the Database.
                    $update_result = "UPDATE `test_sample` SET `result` = '$result', `is_signed` = '$is_signed' WHERE `test_sample`.`TID` = $tid;";
                    
                    //Runs $update_result as a query
                    $connect->query($update_result);

                    //Check to see if the query was successful
                    if($connect->query($update_result) == TRUE) {
                        echo "Result has been updated. ";
					
						//block of code related to sending email to patient after test submission
						//first, query the user associated with the test that was signed
                        //separate the test row that we just edited
						$select_test = "SELECT * from test_sample WHERE TID = $tid;";
						$result = $connect->query($select_test);
						$temp_row = $result->fetch_array(MYSQLI_ASSOC);
						$submitted_test_UID = $temp_row['UID'];
						$select_UID = "SELECT * from user_profile WHERE UID = $submitted_test_UID;";
						$result = $connect->query($select_UID);
						$temp_row2 = $result->fetch_array(MYSQLI_ASSOC);
						$username = $temp_row2['username'];
						$email = $temp_row2['email'];
						$email_verify = $temp_row2['email_verified'];
						$submitted_test_result = $temp_row['result'];
						if($submitted_test_result == '0') {
							$email_result = 'Not Examined';
						} else if($submitted_test_result == '1') {
							$email_result = 'Negative';
						} else if($submitted_test_result == '2') {
							$email_result = 'Positive';
						}
						$submitted_test_date = $temp_row['test_date'];
						
						//Compose the email and send it using the php mail() function
						if($is_signed == '1' && $email_verify == '1') {
							 $subject = 'Your Recent CTS Test Results Are Available';
            $message = 'Thank you for using CTS Testing Services. Your recent test results are available for viewing on the CTS Patient Portal. Please see results below.
========================
Username: ' . $username . '
Test ID: ' . $tid . '
Test Date: ' . $submitted_test_date . '
Test Result: ' . $email_result . '
========================
Please click the following link to log in to your patient portal.
http://localhost/CovidTestingSite/

Thank you.
            ';
            $headers = 'From:cts.sendmail2021@gmail.com' . "\r\n";

            //Function to send email
            mail($email, $subject, $message, $headers);
						}
						//Indicate whether the result email was sent to the patient
						if($email_verify == '1'){
							echo 'Result email sent to patient\'s email address on file';
						} else 
							echo 'Patient has not yet verified email address. No email sent.';
						//Refresh the doctor dashboard
                        header('Refresh: 3;URL=doctor_dashboard.php'); 
						
                    } else 
                        echo "insertion failed for some reason. try again.";
                    $connect->close();
                }
            }
            //If permission level is not 3
            else{
                echo '<h1>This page is not reachable with your level of access.</h1>';
            }
            //Catch exception if session variables are not set
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