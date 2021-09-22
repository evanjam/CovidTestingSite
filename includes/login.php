<?php
//source: https://code.tutsplus.com/tutorials/create-a-php-login-form--cms-33261
    session_start();
    include('config.php');
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
		echo "login form triggered. you entered:<br>username:$username<br>password:$password<br>nothing else works so good luck :)";
        $query = $connection->prepare("SELECT * FROM user_login WHERE username=:username");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '<p class="error">username password combination is wrong</p>';
        } else {
            if (password_verify($password, $result['password'])) {
                $_SESSION['user_id'] = $result['id'];
                echo '<p class="success">successful login</p>';
            } else {
                echo '<p class="error">login error</p>';
            }
        }
    }
?>