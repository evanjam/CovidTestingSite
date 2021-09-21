<?php
	session_start();
	include('includes/config.php');
	if (isset($_POST['register'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password_hash = password_hash($password, PASSWORD_BCRYPT);
		echo $username;
		echo $password;
		echo $password_hash;
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