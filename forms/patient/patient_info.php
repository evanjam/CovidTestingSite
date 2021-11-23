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
    <link href="../../css/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>
	
	<?php
	include('../../includes/connect.php'); 
	
		echo'
		<div class="header">
        <h1>My Personal Information</h1>
		</div>';
	
		$UID = $_SESSION['UID'];
		$get_user = "SELECT * FROM `user_profile` WHERE `UID` = '$UID'";;
		$result = $connect->query($get_user);
		
		if($result->num_rows > 0) 
		{
			while(($row = $result->fetch_row())!==null)
			{
				if($row[3] != null)
				{
					print "First Name: $row[3]";
				}
				echo '<br>';
				if($row[4] != null)
				{
					print "Last Name: $row[4]";
				}
				echo '<br>';
				if($row[5] != null)
				{
					print "Date of birth: $row[5]";
				}
				echo '<br>';
				if($row[6] != null)
				{
					print "Social Security: $row[6]";
				}
				echo '<br>';
				if($row[8] != null)
				{
					print "Email Address: $row[8]";
				}
				echo '<br>';
				if($row[10] != null)
				{
					if($row[10] == '0')
						$temp = 'Not Verified';
					else
						$temp = "Verified";
					print "Email Verified: " . $temp;
				}
			}
		}
		echo '<br>';
		echo '<div><a href="patient_dashboard.php">Home</a></div>'
	?>

</body>
</html>


	