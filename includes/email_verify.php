<?php
//emaiL_verify.php
//triggered via the link sent in new user verification email
//uses information from the URL to compare against values in database and then sets email_verify value to 1  if verified successfully
//todo: implement email logging in a new table email_log
		include('connect.php');
		
		$username = $_GET['username'];
		$email = $_GET['email'];

		$select_user = "SELECT * FROM user_profile WHERE username = '$username'"; //prepares sql statement to check if username already exists
		$result = $connect->query($select_user); //runs $select_user as a query and stores the result in $result
		
		if($result->num_rows > 0) { //if $result->num_rows > 0 returns true, then there exists rows where the username=$username 
			$row = $result->fetch_array(MYSQLI_ASSOC);
			echo 'username = ' . $username;
		}

?>