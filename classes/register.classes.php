<?php
//class to do the functions for data insertion/deletion/modification
class Register extends Dbh{

    protected function setUser($username, $password, $fname, $lname, $ssn, $dob, $email) {

        require '../includes/connect.php';
       $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $email_token = md5(rand(0,1000));
				
				$insert_user = "INSERT INTO user_profile (UID, username, password, fname, lname, dob, ssn, email, email_token, permission) 
				VALUES (NULL, '$username', '$password_hash', '$fname', '$lname', '$dob', '$ssn', '$email', '$email_token', '0')"; //prepare sql insertion statement
				
        if ($connect->query($insert_user) == true){
            $subject = 'Verify your CTS Account';
            $message = '
You have been registered for weekly Covid-19 Testing Services with CTS Testing Services
========================
Username: ' . $username . '
========================
Please click the following link to activate your CTS account:
http://localhost/CovidTestingSite/includes/email_verify.php?username=' . $username . '&email_token=' . $email_token . '

Thank you.
            ';
            $headers = 'From:cts.sendmail2021@gmail.com' . "\r\n";
            mail($email, $subject, $message, $headers);
        }
    }

}