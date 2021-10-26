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
    <title>Employee dashboard</title>
    <link href="../../css/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    //Check to see if the users permission level is correct for this page
    if($_SESSION['permission'] == 1){ 
        echo'<div class="header">';
            echo'<h1>Employee dashboard</h1>';
        
        echo'</div>';
        //Registration form link
        echo'<div><a href="employee_register.php">Patient Registration Form</a></div>';
        echo'<br>';
        //Submit test form link
        echo'<div><a href="employee_submit_test.php">Submit New Test</a></div>';
        echo'<br>';
        //Personal Restuls link
        echo'<div><a href="../patient/patient_dashboard.php">View Personal Test Results</a></div>';
        echo'<br>';
        //Log Out link
        echo'<div><a href="../../index.php">Log Out</a></div>';

    }
    else{
        //Return message if access level is incorrect.
        echo '<h1>This page is not reachable with your level of access.</h1>';
    }
    ?>

</body>
</html>