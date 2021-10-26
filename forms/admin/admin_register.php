<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration Form</title>
    <link href="../../css/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
    if($_SESSION['permission'] == 4){
        echo'<div class="header">
            <h1>Admin/User Registration Form</h1>
        
        </div>

        <div><a href="admin_dashboard.php">Home</a></div>
        <br>

        <div class="employee_register">
            <h1>User Registration Form</h1>
            Please fill out the following form and press Register to register a new User. Enter permission level as number 0-4.
            <img src="../../img/employee/nurse_resize.jpg" alt="Nurse">
            <form method="post" action="../../includes/admin_register.php" name="register">
                <input type="text" name="username" placeholder="username" required>
                <input type="password" name="password" placeholder="password" required>
                <input type="text" name="fname" placeholder="first name" required>
                <input type="text" name="lname" placeholder="last name" required>
                <input type="text" name="ssn" placeholder="ssn" pattern="[0-9]+" required>
                <input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required />
                <input type="number" name="permission" placeholder="permission" id="permission" pattern="[0-4]" required />
                <input type="submit" name="register" value="Register">
            </form>
        </div>';
    }
    else{
        echo '<h1>This page is not reachable with your level of access.</h1>';
    }
?>


</body>
</html>