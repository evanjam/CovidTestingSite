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
    <title>Resend Verification Email</title>
    <link href="../../css/dashboards.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
    //sets up error handling for Try-catch block on line 39
    set_error_handler('exceptions_error_handler');

    function exceptions_error_handler($severity, $message, $filename, $lineno) {
    if (error_reporting() == 0) {
        return;
    }
    if (error_reporting() & $severity) {
        throw new ErrorException($message, 0, $severity, $filename, $lineno);
    }
    }
    
	//try catch block
    try{
		
		//print the html front end for employee (1) and admin (4) users ONLY
		if($_SESSION['permission'] == 1 || $_SESSION['permission'] == 4){ 
			echo'<div class="header">
			<h1>Resend Verification Email</h1>
			</div>';
		
			//if employee user is viewing page, make sure the home/back buttons are redirecting to employee dash
			if($_SESSION['permission'] == 1) {
				echo'<ul>
			<li><a href="../../forms/employee/employee_dashboard.php">Home</a>
			<a href="../../forms/employee/employee_view_user.php">Back</a></li>
			</ul>';
			}
		
			//if admin user is viewing page, make sure the home/back buttons are redirecting to admin dash
			if($_SESSION['permission'] == 4) {
				echo'<ul>
			<li><a href="../../forms/admin/admin_dashboard.php">Home</a>
			<a href="../../forms/admin/admin_edit_user.php">Back</a></li>
			</ul>';
			}

			//print the html front end for the user search box
			echo'<div class="getTests">
			<h1 class="labHeading">Enter a username</h1>
			<form method="post" action="" name="users">
			<div class="labHeading"><input type="text" name="user"  placeholder="username" id="user" required/>
			<input type="submit" name="users" value="Resend Verification Email"></div>
			</form>
			</div>';
		
			//begin backend php code for processing of input
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
		} else {
			echo '<h1>This page is not reachable with your level of access.</h1>';
		}
		
	//end try-catch block
	//any error related to permissions, viewing variables that dont exist, etc, will result in page displaying "not available" message instead of printing the actual php code of the error message we receive
	} catch(Exception $e){
		echo'<h1>This page is unavailable.</h1>';
		header('Refresh: 1;URL=../../index.php');
	}
?>
    </table>
	
	<div class="logoContainer">
    <img class="logo" src="../../img/logo/logo.png" alt="Logo">
    </div>
	
    <footer>
        <div>
            <p>Covid Testing Site 2021</p>
        </div>
    </footer>
</body>
</html>