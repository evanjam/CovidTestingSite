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
    <title>Admin dashboard</title>
    <link href="../../css/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    //Check to see if the users permission level is correct for this page
    if($_SESSION['permission'] == 4){    
        echo'<div class="header">
            <h1>Admin dashboard</h1>
        
        </div>        
        <div><a href="admin_register.php">User Registration Form</a></div>
        <br>
        <div>(Link to edit user/ user permissions)</div>
        <br>
        <div><a href="admin_submit_test.php">Submit New Test</a></div>
        <br>
        <div><a href="lab_admin_dashboard.php">Edit Test</a></div>
        <br>
        <div><a href="../patient/patient_dashboard.php">View Personal Test Results</a></div>
        <br>
        <div><a href="../login.php">Log Out</a></div>';
    }else{
        //Return message if access level is incorrect.
        echo '<h1>This page is not reachable with your level of access.</h1>';
    }
    ?>

</body>
</html>