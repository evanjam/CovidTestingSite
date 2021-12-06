<?php
    session_start();
	//user inactivity logout, create $t to time() for unix Timestamp
	$t=time();
	//if user is logged and user hasn't interacted with the page for 15 mins, destroy session, redirect
	if (isset($_SESSION['logged']) && ($t - $_SESSION['logged'] > 900))
	{
    session_destroy();
	header('Refresh: 0.01;URL=../../sessioninactivitytimeout.php');
	}
	//if not User refreshes or clicks another link, start time() again
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
	//connect to the DB and set the header and make the Home button
	include('../../includes/connect.php'); 
	
		echo'
		<div class="header">
        <h1>My Personal Information</h1>
		</div>';

		echo '<ul>
		<li><a href="patient_dashboard.php">Home</a></li>
		</ul>
		<br>';
		//make a session variable called UID
		$UID = $_SESSION['UID'];
		//Create get_user and SELECT in user_profile table where UID of user matches UID
		$get_user = "SELECT * FROM `user_profile` WHERE `UID` = '$UID'";
		//runs $get_user as a query and stores the result in $result
		$result = $connect->query($get_user);
		//if $result->num_rows > 0 returns true, then there exists rows where the UID=$UID 
		if($result->num_rows > 0) 
		{
			//While the row we fetched is not null, perform the if statements
			while(($row = $result->fetch_row())!==null)
			{
				//Iterate through the row to check if it null, if not print whats in the index
				if($row[3] != null)
				{
					print "<p><b>First Name: $row[3]</b></p>";
					//print "First Name: $row[3]";
				}
				if($row[4] != null)
				{
					print "<p><b>Last Name: $row[4]</b></p>";
				}
				if($row[5] != null)
				{
					print "<p><b>Date of birth: $row[5]</b></p>";
				}
				if($row[6] != null)
				{
					//Create $part to get a substring of s string, in this case SSN to hide part of it
					$part = substr($row[6], -4);
					print "<p><b>Social Security: xxx-xx-$part</b></p>";
				}
				if($row[8] != null)
				{
					print "<p><b>Email Address: $row[8]</b></p>";
				}
				if($row[10] != null)
				{
					if($row[10] == '0')
						$temp = 'Not Verified';
					else
						$temp = "Verified";
					print "<p><b>Email Verified: $temp</b></p>";
				}
			}
		}
	?>
	
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


	