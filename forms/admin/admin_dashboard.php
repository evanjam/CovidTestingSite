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
    <title>Admin dashboard</title>
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

    //Check to see if the users permission level is correct for this page
    try{
        if($_SESSION['permission'] == 4){    
            echo'<div class="header">
                <h1>Admin dashboard</h1>
            
            </div> 
            <ul>       
            <li><a href="admin_register.php">User Registration Form</a></li>
            <br>
            <li><a href="admin_edit_user.php">Edit User</a></li>
            <br>
            <li><a href="admin_submit_test.php">Submit New Test</a></li>
            <br>
            <li><a href="lab_admin_dashboard.php">Edit Test</a></li>
            <br>
            <li><a href="../patient/patient_dashboard.php">View Personal Test Results</a></li>
            <br>
            <li><a href="../../index.php">Log Out</a></li>
            </ul>';
        }else{
            //Return message if access level is incorrect.
            echo '<h1>This page is not reachable with your level of access.</h1>';
            header('Refresh: 1;URL=../../index.php');
        }
    } catch(Exception $e){
        echo'<h1>This page is unavailable.</h1>';
        header('Refresh: 1;URL=../../index.php');
    }
    ?>
   
    <footer>
        <div>
            <p>Covid Testing Site 2021</p>
        </div>
    </footer>
</body>
</html>