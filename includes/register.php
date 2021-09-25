<?php
//register.php
//inserts username and password data into user_login table

	include('connect.php'); //allows us to use the $connect variable set in the connect.php file
	
	if (isset($_POST['register'])) { //checks if the register button was pressed on index.php
		$username = $_POST['username']; //saves variables from the user's input
		$password = $_POST['password'];
		$password_hash = password_hash($password, PASSWORD_BCRYPT); //prepares the password hash

		$sql_statement = "INSERT INTO user_login (username, password) VALUES ('$username', '$password_hash')"; //prepare sql insertion statement
		
		if($connect->query($sql_statement) === TRUE) { //call query function on $connect and pass $sql_statement as parameter, then does an if statement to check if it worked at the same time
			echo "new record created";
		} else 
			echo "error";
		$connect->close(); //it still works if I don't include this but I feel like it's probably necessary down the line to do this
	}
?>