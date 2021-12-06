<?php
//emaiL_verify.php
//triggered via the link sent in new user verification email
//uses information from the URL to compare against values in database and then sets email_verify value to 1  if verified successfully
//todo: implement email logging in a new table email_log

//for testing use this url:
//http://localhost/CovidTestingSite/includes/email_verify.php?username=cts.sendmail2021@gmail.com&email_token=8065d07da4a77621450aa84fee5656d9

	//establishes connect to mysql database
	include('connect.php');
	
	//pulls variables from the URL that is typed in, see example syntax on line 8
	$username = $_GET['username'];
	$email_token = $_GET['email_token'];

	//prepares and executes sql query to select user from database where username matches the username in the URL
	$select_user = "SELECT * FROM user_profile WHERE username = '$username'";
	$result = $connect->query($select_user);
		
	//if num_rows is greater than 0, than there exists rows where the username equals username in URL. therefore user exists. 
	if($result->num_rows > 0) {
		//"explode" information from the returned row into an array with individually accessible fields that can be called via their field name
		//$row contains the array
		$row = $result->fetch_array(MYSQLI_ASSOC); 
			
		//compare username and email_token from URL with the information in database, created during registration
		//if the username in the URL matches the username from the selected row
		//AND the email token matches the email token in the selected row
		if($username == $row['username'] && $email_token == $row['email_token']) {
			
			//print echo statement (can still be cleaned up to print a nicer looking message)
			echo 'email successfully verified. please return to home page and sign in.';
				
			//prepare and execute sql query to update the email_verify field from 0 to 1
			$update_verification_status = "UPDATE `user_profile` SET `email_verified` = '1' WHERE `user_profile`.`username` = '$username'";
			$connect->query($update_verification_status);
			
			//prepare and execute sql query to update the email_token variable back to a NULL status
			//this prevents the same email verification link from being used again
			$update_email_token = "UPDATE `user_profile` SET `email_token` = '' WHERE `user_profile`.`username` = '$username'";
			$connect->query($update_email_token);
				
			//redirect to login screen
			header('Refresh: 2;URL=../index.php');


		} else {
			echo 'invalid token or the verification has already been processed. try again.';
			header('Refresh: 2;URL=../index.php');
		}
	}

?>