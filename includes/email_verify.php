<?php
//emaiL_verify.php
//triggered via the link sent in new user verification email
//uses information from the URL to compare against values in database and then sets email_verify value to 1  if verified successfully
//todo: implement email logging in a new table email_log

//for testing use this url:
//http://localhost/covidtestingsite/includes/email_verify.php?username=e&email=email@email.com


		include('connect.php');
		
		$username = $_GET['username']; //pulls variable from the URL using ?username= in url
		$email = $_GET['email']; //pulls variable from the URL using $email= in url

		$select_user = "SELECT * FROM user_profile WHERE username = '$username'"; //prepares sql statement to check if username already exists
		$result = $connect->query($select_user); //runs $select_user as a query and stores the result in $result
		
		if($result->num_rows > 0) { //if $result->num_rows > 0 returns true, then there exists rows where the username=$username 
			$row = $result->fetch_array(MYSQLI_ASSOC);
			echo 'username = ' . $username;
			echo '<br>';
			echo 'email = '. $email;
		}

?>