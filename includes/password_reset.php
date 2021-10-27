<?php

    include('connect.php'); //cmon you gotta connect to the db

    if (isset($_POST['reset'])) {

        //creating variables
        $username = $_POST['username']; 
        $ssn = $_POST['ssn'];
        $Newpass = $_POST['Newpassword'];
        $password_hash = password_hash($Newpass, PASSWORD_BCRYPT);

        //queryy db
        $select_user = "SELECT * FROM user_profile WHERE username = '$username'"; //prepares sql statement to check if username already exists
		$result = $connect->query($select_user); 

        $matchnum = " SELECT * FROM user_profile WHERE ssn = '$ssn'";
        $result2 = $connect->query($matchnum);



        if(($result->num_rows == 1) && ($result2->num_rows ==1)) {//if there is no username in the db them it will not allow pw change
            $update_pass = "UPDATE user_profile SET password WHERE ssn=$ssn";
            echo "gets here";
            if($connect->query($update_pass) === TRUE) { //evan's query function, up for discussion on which to use
				echo "new record created, redirecting to home...";
				header('Refresh: 1;URL= index.php');
			} else{
				echo "insertion failed for some reason. try again.";
			$connect->close(); //it still works if I don't include this but I feel like it's probably necessary down the line to do this
		    }
        }
    }

?>