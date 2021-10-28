<?php

    include('connect.php');

    if (isset($_POST['reset'])) {

        //creating variables
        $username = $_POST['username']; 
        $ssn = $_POST['ssn'];
        $Newpass = $_POST['Newpassword'];
        $confirm_pass = $_POST['Confirmpassword'];

        if($Newpass != $confirm_pass) //simple condition to make sure the passwords match
        {
            echo "passwords do not match. please try again.";
            echo "<br>";
            echo'<div><a href="../index.php">Login</a></div>';
            //exit();
        }
        
        $password_hash = password_hash($Newpass, PASSWORD_BCRYPT);
        //queryy db
        $select_user = "SELECT * FROM user_profile WHERE username = '$username'"; //prepares sql statement to check if username already exists
		$result = $connect->query($select_user); 

        $matchnum = " SELECT * FROM user_profile WHERE ssn = '$ssn'";
        $result2 = $connect->query($matchnum);

        if($result2->num_rows == 1) {//if there is no username in the db then it will not allow pw change
            $update_pass = "UPDATE user_profile SET password = '$password_hash' WHERE ssn= '$ssn'"; //set to update as long as the ssn matches 
            if($connect->query($update_pass) === TRUE) { 
				echo "new record created, redirecting to home...";
				header('Refresh: 1;URL= ../index.php');
			} else{
				echo "insertion failed for some reason. try again.";
		    }
        }else{
            echo "account not found, please try again.";
			echo'<div><a href="../index.php">Login</a></div>';
        }
		$connect->close();
    }

?>