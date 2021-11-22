<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor dashboard</title>
    <link href="../../css/dashboard.css" rel="stylesheet" type="text/css">
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
    

        try{
    if($_SESSION['permission'] == 3){

    echo'<div class="header">';
        echo'<h1>Doctor dashboard</h1>';
    
    echo'</div>';
	
	echo'<div><a href="doctor_dashboard.php">Home</a></div>';
    echo'<br>';
    echo'<div><a href="../patient/patient_dashboard.php">View Personal Test Results</a></div>';
    echo'<br>';
    echo'<div><a href="../../index.php">Log Out</a></div>';


    echo'<div class="getTests">';
        echo'<h1>Enter date for tests </h1>';
        echo'<form method="post" action="" name="labtests">';
            echo'<input type="date" name="date"  placeholder="Desired date" id="date" required />';
            echo'<input type="submit" name="labtests" value="Search">';
        echo'</form>';
    echo'</div>';


    echo'<table class="desiredResults" id="desiredResults">';
        echo'<tr>';
            echo'<th>UID</th>';
            echo'<th>Serial #</th>';
            echo'<th>Test Date</th>';
            echo'<th>Result</th>';
            echo'<th>is_signed</th>';
            echo'<th>TID</th>';
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
                        echo '<tr><td><br></td></tr>';
                        echo '<tr>';
                        echo '<td>Update Test: </td>';
                        echo '<td>(All fields are required)</td>';
                        echo '<form action="doctor_dashboard.php" method="post">';
                        echo '<td><input type="number" name="result" placeholder="Enter Result" id="result" pattern="[0-1]"/></td>';
                        echo '<td><input type="number" name="is_signed" placeholder="Enter is_signed" id="is_signed" pattern="[0-1]"/></td>';
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
                    $is_signed = $_POST['is_signed'];
                    $tid = $_POST['tid'];
                    
                    $update_result = "UPDATE `test_sample` SET `result` = '$result', `is_signed` = '$is_signed' WHERE `test_sample`.`TID` = $tid;"; //prepares sql statement to check if username already exists
                    $connect->query($update_result); //runs $update_result as a query

                    if($connect->query($update_result) == TRUE) { //evan's query function, up for discussion on which to use
                        echo "Result has been updated. Result email sent to email on file. *Email is only sent if the patient's email has been verified!*";
						
						//block of code related to sending email to patient after test submission
						//first, query the user associated with the test that was signed
						$select_test = "SELECT * from test_sample WHERE TID = $tid;"; //separate the test row that we just edited
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
						
						//now that we have all the info we need for our email (obtained as painfully as possible)
						//we can actually compose the email and send it using the php mail() function
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
            mail($email, $subject, $message, $headers); //function to send email
						}
						//lastly, refresh the doctor dashboard after a test sample is signed successfully (end email block)
                        header('Refresh: 2;URL=doctor_dashboard.php'); 
						
                    } else 
                        echo "insertion failed for some reason. try again.";
                    $connect->close();
                }
            }
            else{
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