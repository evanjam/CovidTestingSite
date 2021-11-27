<?php
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
    <title>Patient dashboard</title>
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

    try{
    if($_SESSION['permission'] > -1 && $_SESSION['permission'] < 5){

    echo'
    <div class="header">
        <h1>Patient dashboard</h1>
    
    </div>';

    //Check to see which home button to display based on permission level
	if($_SESSION['permission'] == 0){
        echo'<div><a href="patient_dashboard.php">Home</a></div>';
    }
    else if($_SESSION['permission'] == 1){
        echo'<div><a href="../employee/employee_dashboard.php">Home</a></div>';
    }
    else if($_SESSION['permission'] == 2){
        echo'<div><a href="../lab/lab_dashboard.php">Home</a></div>';
    }
    else if($_SESSION['permission'] == 3){
        echo'<div><a href="../doctor/doctor_dashboard.php">Home</a></div>';
    }
    else if($_SESSION['permission'] == 4){
        echo'<div><a href="../admin/admin_dashboard.php">Home</a></div>';
    }
    echo'<br>';
	echo'<div><a href="patient_info.php">Personal Info</a></div>';
	echo'<br>';
    //Display the log out button
    echo'<div><a href="../../index.php">Log Out</a></div>';
	 echo'<br>';
    echo'<div class="getTests">';
        echo'<h1 class="labheading">Test Results</h1>';

    echo'</div>';

    echo'<table class="desiredResults" id="desiredResults">';
        echo'<tr>';
            echo'<th>Test Date</th>
            <th>Result</th>';
        echo'<tr>';

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
                                if($row[4] == 0){
                                    echo "<td>Test result is not ready.</td>";
                                }
                                else if($row[4] == 1){
                                    echo "<td>Negative</td>";
                                }
                                else if($row[4] == 2){
                                    echo "<td>Positive</td>";
                                }
                                
                                echo '</tr>';
                            }
                        }
                    } else {
                        echo '<tr>';
                        echo '<td>There are no test results available</td>';  
                        echo '</tr>';                  
                }
            }else{
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