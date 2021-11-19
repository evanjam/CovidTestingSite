<?php
//class to do the functions for data insertion/deletion/modification
class Register extends Dbh{

    protected function setUser($username, $password, $fname, $lname, $ssn, $dob, $email) {

        require '../includes/connect.php';
       $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // $getAge = explode("-", $dob);
		// $age = (date("md", date("U", mktime(0, 0, 0, $getAge[1], $getAge[2], $getAge[0]))) > date("md")
		// ? ((date("Y") - $getAge[0]) - 1)
		// : (date("Y") - $getAge[0]));

        $email_token = md5(rand(0,1000));

        $sql = 'INSERT INTO user_profile (username, password, fname, lname, dob, ssn, permission, email, email_token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);';    
        $stmt = mysqli_stmt_init($connect); //statement to run query
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "There was an error";
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "ssssssisd" , $username, $password_hash, $fname, $lname, $dob, $ssn, '0', $email, $email_token);
            mysqli_stmt_execute($stmt);


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
            mail($email, $subject, $message, $headers); // Send our email
            echo "query completed";
        }
    

    }

}