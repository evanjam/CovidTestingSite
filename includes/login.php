<?php
//login.php
//https://stackoverflow.com/questions/46819734/how-to-check-username-and-password-matches-the-database-values

    include('connect.php');
	
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
		$password_hash = password_hash($password, PASSWORD_BCRYPT);

		$get_user = "SELECT * FROM user_login WHERE username = '$username'";
		$result = $connect->query($get_user);
		if($result->num_rows > 0) {
			echo "user exists..do something..";
			
			//my attempt at retrieving the password stored in the database 
			//and then using the password_verify function to compare it to the hashed user's input
			$get_password = "SELECT password FROM user_login WHERE username = '$username'";
			//$stored_password = $connect->query($sql_statement2);
			//$validate_password = password_verify($password_hash, $stored_password); 
			
			if(strcmp($password_hash, $get_password)) {
				echo "no way....????";
			} else
				echo "lol of course it didnt work";
		} else {
			echo "user doesnt exist, redirecting to home..";
			header('Refresh: 1;URL=../index.php');
		}
		
	}
?>