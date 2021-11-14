<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee View User</title>
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
    if($_SESSION['permission'] == 1){ 
    echo'<div class="header">';
        echo'<h1>Employee View User</h1>';
    
    echo'</div>';
	
	echo'<div><a href="employee_dashboard.php">Home</a></div>';


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
			<th>Email</th>
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
							echo "<td>{$row[8]}</td>";
                            echo "<td>{$row[7]}</td>";
                            echo '</tr>';
                            echo '<tr>
                            <td><hr></td><td><hr></td>
                            <td><hr></td><td><hr></td>
                            <td><hr></td><td><hr></td><td><hr></td>
                            </tr>';
                        }
                    } else {
                        echo '<tr><td>There are no users with that username.</td></tr>';
                        
                    }
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