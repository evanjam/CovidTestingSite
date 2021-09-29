<?php
    session_start();
    include('config.php');
	$username = "ev";
	$password = "ev";
	$password_hash = password_hash($password, PASSWORD_BCRYPT);
	echo "username:<br>$username<br><br>password:<br>$password<br><br>password_hash:<br>$password_hash<br><br>";
	echo "vardump:<br>";
	var_dump($password_hash);
	echo "<br>this var_dump spits out some details about the data stored in the \$password_hash variable. note that it is a 60 character string which is why we needed to increase the password varchar in user_login to 64";
	
	echo "<br><br><br>";
	
	echo "testing password_verify function:<br>";
	if(password_verify($password, $password_hash)) {
		echo "this works, which means that password_verify is decrypting the password stored in \"\$password_hash\"";
	} else
		echo "you really suck";
	
	echo "<br><br><br>";
	echo "this is really interesting because every time you refresh this page and re-run this code, the password hash is different<br>";
	echo "is this going to make storing and reading passwords difficult?";
?>