<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Edit User</title>
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
    if($_SESSION['permission'] == 4){ 
    echo'<div class="header">';
        echo'<h1>Admin Edit User</h1>';
    
    echo'</div>';
	
	echo'<div><a href="admin_dashboard.php">Home</a></div>';


    echo'<div class="getTests">';
        echo'<h1>Enter a username</h1>';
        echo'<form method="post" action="" name="users">';
            echo'<input type="text" name="user"  placeholder="username" id="user" required />';
            echo'<input type="submit" name="users" value="Search">';
        echo'</form>';
    echo'</div>';


    echo'<table class="desiredResults" id="desiredResults">';
        echo'<tr>';
            echo'<th>Username</th>
            <th>Password</th>
            <th>Fname</th>
            <th>Lname</th>
            <th>DOB</th>
            <th>SSN</th>
            <th>Permission</th>';
        echo'<tr>';

                include('../../includes/connect.php'); 
	
                if (isset($_POST['users'])) {
                    $user = $_POST['user'];
            
                    $query_date = "SELECT * FROM `user_profile` WHERE `username` = '$user'"; //returns rows that have the desired date
                    $result = $connect->query($query_date); //saves resultng data
                    
                    if($result->num_rows > 0) {
                        //loop throught rows
                        while(($row = $result->fetch_row())!==null) {
                            //print out rows
                            echo '<tr>';
                            echo "<td>{$row[1]}</td>";
                            echo "<td>****</td>";
                            echo "<td>{$row[3]}</td>";
                            echo "<td>{$row[4]}</td>";
                            echo "<td>{$row[5]}</td>";
                            echo "<td>{$row[6]}</td>";
                            echo "<td>{$row[7]}</td>";
                            echo '</tr>';
                            echo '<tr>
                            <td><hr></td><td><hr></td>
                            <td><hr></td><td><hr></td>
                            <td><hr></td><td><hr></td><td><hr></td>
                            </tr>';
                        }
                        //print out the form
                        echo '<tr><td>
                        </td></tr>
                        <tr>
                        <form action="admin_edit_user.php" method="post">
                        <td><input type="text" name="username"  placeholder="username" id="username" required /></td>
                        <td><input type="text" name="password"  placeholder="password" id="user" required /></td>
                        <td><input type="text" name="fname"  placeholder="Fname" id="fname" required /></td>
                        <td><input type="text" name="lname" placeholder="Lname" id="lname" required/></td>
                        <td><input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required /></td>
                        <td><input type="text" name="ssn" placeholder="ssn" id="ssn" pattern="[0-9]+" required></td>
                        <td><input type="number" name="permission" placeholder="permission" id="permission" pattern="[0-4]" required /></td>
                        <td><input type="submit" name="submit" value="submit"></td>
                        </form>
                        </tr>';
                    } else {
                        echo '<tr><td>There are no users with that username.</td></tr>';
                        
                    }
                }
                if (isset($_POST['submit'])) { //checks if the submit button was pressed
                    //$result = $_POST['result']; //saves variables from the user's input
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $date = $_POST['date'];
                    $ssn = $_POST['ssn'];
                    $permission = $_POST['permission'];

                    
                    $update_result = "UPDATE `user_profile` SET `username` = '$username', `password` = '$password', `fname` = '$fname', `lname` = '$lname', `dob` = '$date', `ssn` = '$ssn', `permission` = '$permission' WHERE `user_profile`.`UID` = 13;"; //prepares sql statement to check if username already exists
                    $result = $connect->query($update_result); //runs $select_user as a query and stores the result in $result

                    if($connect->query($update_result) == TRUE) { //evan's query function, up for discussion on which to use
                        echo "Result has been updated";
                        //header('Refresh: 1;URL=lab_dashboard.php');
                    } else 
                        echo "Insertion failed. Try again.";
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