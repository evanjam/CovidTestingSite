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
    <title>Submit New Test</title>
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
                <h1>Submit New Test</h1>
            
            </div>
            
            <div><a href="admin_dashboard.php">Home</a></div>
            

            <div class="employee_register">
                <h1>Submit New Test</h1>
                Please enter the patients username and the serial # on the test vial and press Submit
                <img src="../../img/employee/cotton_swab_resize.jpg" alt="Cotton Swab">
                <form method="post" action="../../includes/submit_test.php" name="submit_test">
                    <input type="text" name="username" placeholder="username" required>
                    <input type="text" name="serial" placeholder="serial #" pattern="[0-9]+" required>
                    <input type="submit" name="submit_test" value="Submit">
                </form>
                
            </div>';

        }else{
            //Return message if access level is incorrect.
            echo '<h1>This page is not reachable with your level of access.</h1>';
        }
    }catch(Exception $e){
        echo'<h1>This page is unavailable.</h1>';
        header('Refresh: 1;URL=../../index.php');
    }
?>
	

</body>
</html>