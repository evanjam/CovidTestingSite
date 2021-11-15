<?php

	$email = 'deadhead9420@gmail.com';
	$subject = 'test sendmail subject text';
	$message = 'test sendmail email body text';
	$headers = 'From:cts.sendmail2021@gmail.com' . "\r\n"; // Set from headers

	mail($email, $subject, $message, $headers); // Send our email
	echo 'email sent check your inbox';

?>