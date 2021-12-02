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
    <title>Employee View User</title>
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
    if($_SESSION['permission'] == 1){ 
    echo'<div class="header">';
        echo'<h1>Employee View User</h1>';
    
    echo'</div>';
	
	echo'<ul>
    <li><a href="../../forms/employee/employee_dashboard.php">Home</a>
	<a href="../../forms/employee/employee_view_user.php">Back</a></li>
    </ul>';


    echo'<div class="getTests">';
        echo'<h1 class="labHeading">Enter a username</h1>';
        echo'<form method="post" action="" name="users">';
            echo'<div class="labHeading"><input type="text" name="user"  placeholder="username" id="user" required/>
            <input type="submit" name="users" value="Resend Verification Email"></div>
    ';
        echo'</form>';
    echo'</div>';

                include('../../includes/connect.php'); 
	
                if (isset($_POST['users'])) {
                    $username = $_POST['user'];
            
                    $query = "SELECT * FROM `user_profile` WHERE `username` = '$username'"; //returns rows that have the desired date
                    $result = $connect->query($query); //saves resultng data
					
                    if($result->num_rows > 0) {
						$row = $result->fetch_array(MYSQLI_ASSOC); //explode returned row into array
						$UID = $row['UID'];
						$email = $row['email'];
						
						$email_token = md5(rand(0,1000)); //prepare random # to use for new email token
						
						$update_email_token = "UPDATE `user_profile` SET `email_token` = '$email_token' WHERE `user_profile`.`UID` = $UID;"; //prepare sql query
						$connect->query($update_email_token); //run sql query to update email token
						
						//prepare and send account verification email
						$subject = 'Verify your CTS Account';
						$message = '
You have been registered for weekly Covid-19 Testing Services with CTS Testing Services
========================
Username: ' . $username . '
========================
Please click the following link to activate your CTS account:
http://localhost/CovidTestingSite/includes/email_verify.php?username=' . $username . '&email_token=' . $email_token . '

Thank you.
						';
						$headers = 'From:cts.sendmail2021@gmail.com' . "\r\n";
						mail($email, $subject, $message, $headers); // Send our email
						
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
    <footer>
        <div>
            <p>Covid Testing Site 2021</p>
        </div>
    </footer>
</body>
</html>