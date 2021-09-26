<?php
//login.php
//https://stackoverflow.com/questions/46819734/how-to-check-username-and-password-matches-the-database-values
//work in progress evan/dustin 9/26

    include('connect.php'); 
	
    if (isset($_POST['login'])) {
        $username = $_POST['username']; 
        $password = $_POST['password'];
		$password_hash = password_hash($password, PASSWORD_BCRYPT); 
		$get_user = "SELECT * FROM user_login WHERE username = '$username'"; 
		$result = $connect->query($get_user); 
		
		if($result->num_rows > 0) { 
			$get_password = "SELECT password FROM user_login WHERE username = '$username'"; 
			if(strcmp($password_hash, $get_password)) {
				echo "credentials match, username and password has been successfully verified!";
			} else {
				echo "credentials do not match what is stored in the db, try again";
				header('Refresh: 1;URL=../index.php');
			}
		} else {
			echo "user doesnt exist, redirecting to home..";
			header('Refresh: 1;URL=../index.php');
		}
		
	}
?>