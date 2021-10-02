<?php
//login.php
//https://stackoverflow.com/questions/46819734/how-to-check-username-and-password-matches-the-database-values
//https://stackoverflow.com/questions/26536293/php-password-hash-password-verify

    include('connect.php'); 
	
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
		$get_user = "SELECT * FROM user_profile WHERE username = '$username'";
		$result = $connect->query($get_user);
		
		if($result->num_rows > 0) {
			$get_password = "SELECT password FROM user_profile WHERE username = '$username'";
			$row = $result->fetch_array(MYSQLI_ASSOC);
		if(password_verify($password, $row['password'])) {
				echo "credentials match, username and password has been successfully verified!";
			} else {
				echo "credentials do not match what is stored in the db, try again";
				header('Refresh: 1;URL=../index.php');
			}
		} else {
			echo "credentials do not match what is stored in the db, try again";
			header('Refresh: 1;URL=../index.php');
		}

	}
?>