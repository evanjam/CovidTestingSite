<?php

    include('connect.php'); //cmon you gotta connect to the db

    if (isset($_POST['reset'])) {

        //creating variables
        $username = $_POST['username']; 
        $ssn = $_POST['ssn'];
        $Newpass = $_POST['Newpassword'];
        $confirm_pass = $_POST['Confirmpassword'];

        if($Newpass != $confirm_pass) //simple condition to make sure the passwords match
        {
            echo "passwords do no match try again!";
            echo "<br>";
            echo'<div><a href="../index.php">Login</a></div>';
            exit();
        }
        
        $password_hash = password_hash($Newpass, PASSWORD_BCRYPT);
        //queryy db
        $select_user = "SELECT * FROM user_profile WHERE username = '$username'"; //prepares sql statement to check if username already exists
		$result = $connect->query($select_user); 

        $matchnum = " SELECT * FROM user_profile WHERE ssn = '$ssn'";
        $result2 = $connect->query($matchnum);

        if($result2->num_rows == 1) {//if there is no username in the db them it will not allow pw change
            $update_pass = "UPDATE user_profile SET password = '$password_hash' WHERE ssn= '$ssn'"; //set to update as long as the ssn matches 
            if($connect->query($update_pass) === TRUE) { //evan's query function, up for discussion on which to use
				echo "new record created, redirecting to home...";
				header('Refresh: 1;URL= ../index.php');
			} else{
				echo "insertion failed for some reason. try again.";
			$connect->close(); //it still works if I don't include this but I feel like it's probably necessary down the line to do this
		    }
        }else{
            echo "inputs do not match any data in the databse";
        }
    }

?>