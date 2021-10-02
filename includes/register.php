<?php
//register.php
//inserts username and password data into user_login table

	include('connect.php'); //allows us to use the $connect variable set in the connect.php file
	
	if (isset($_POST['register'])) { //checks if the register button was pressed on index.php
		$username = $_POST['username']; //saves variables from the user's input
		$password = $_POST['password'];
		$password_hash = password_hash($password, PASSWORD_BCRYPT); //prepares the password hash
		$select_user = "SELECT * FROM user_profile WHERE username = '$username'"; //prepares sql statement to check if username already exists
		$result = $connect->query($select_user); //runs $select_user as a query and stores the result in $result
		
		if($result->num_rows > 0) { //if $result->num_rows > 0 returns true, then there exists rows where the username=$username 
			echo "username already exists, redirecting to home..."; //print a message saying that username already exists
			header('Refresh: 1;URL=../index.php'); //wait 1 second and refresh index.php homepage
		} else { //if username doesnt already exist in database, execute remaining steps to insert the username and password
			$insert_user = "INSERT INTO user_profile (UID, username, password) VALUES (NULL, '$username', '$password_hash')"; //prepare sql insertion statement
			
			if($connect->query($insert_user) == TRUE) { //evan's query function, up for discussion on which to use
				echo "new record created, redirecting to home...";
				header('Refresh: 1;URL=../index.php');
			} else 
				echo "error";
			$connect->close(); //it still works if I don't include this but I feel like it's probably necessary down the line to do this
		}
	}
?>