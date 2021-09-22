<?php
//source: https://code.tutsplus.com/tutorials/create-a-php-login-form--cms-33261
	session_start();
	include('config.php');
	if (isset($_POST['register'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		echo "registration form triggered. you entered:<br>username:$username<br>password:$password<br>nothing else works so good luck :)";
		$password_hash = password_hash($password, PASSWORD_BCRYPT);
		$query = $connection->prepare("SELECT * FROM user_login WHERE username=:username");
		$query->bindParam("username", $username, PDO::PARAM_STR);
		$query->execute();
		if ($query->rowCount() > 0) {
			echo '<p class="error">user already registered</p>';
		}
		if ($query->rowCount() == 0) {
			$query = $connection->prepare("INSERT INTO user_login(username, password) VALUES (:username,:password_hash)");
			$query->bindParam("username", $username, PDO::PARAM_STR);
			$query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
			$result = $query->execute();
			if ($result) {
				echo '<p class="success">successful registration</p>';
			} else {
				echo '<p class="error">registration error</p>';
			}
		}
	}
?>