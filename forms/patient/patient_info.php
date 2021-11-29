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
    <title>Patient dashboard</title>
    <link href="../../css/dashboards.css" rel="stylesheet" type="text/css">
</head>
<body>
	
	<?php
	include('../../includes/connect.php'); 
	
		echo'
		<div class="header">
        <h1>My Personal Information</h1>
		</div>';

		echo '<ul>
		<li><a href="patient_dashboard.php">Home</a></li>
		</ul>
		<br>';
	
		$UID = $_SESSION['UID'];
		$get_user = "SELECT * FROM `user_profile` WHERE `UID` = '$UID'";;
		$result = $connect->query($get_user);
		
		if($result->num_rows > 0) 
		{
			while(($row = $result->fetch_row())!==null)
			{
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

  <footer>
        <div>
            <p>Covid Testing Site 2021</p>
        </div>
    </footer>
	
</body>
</html>


	