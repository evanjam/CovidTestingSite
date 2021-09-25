<?php
//login.php
//waluigi

    include('connect.php');
	
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
		
		$sql_statement = "SELECT * FROM user_login WHERE username = '$username'";
		$result = $connect->query($sql_statement);
		if($result->num_rows > 0) {
			echo "user exists..do something..";
			$sql_statement2 = "SELECT password FROM user_login WHERE username = '$username'";
			$stored_password = $connect->query($sql_statement2);
			$validate_password = password_verify($password, $stored_password);
			if($validate_password ) {
				echo "no way....????";
			} else
				echo "lol of course it didnt work";
		} else {
			echo "user doesnt exist, redirecting to home..";
			header('Refresh: 1;URL=../index.php');
		}
		
	}
?>