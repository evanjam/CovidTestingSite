<?php

    include('connect.php'); //cmon you gotta connect to the db

    if (isset($_POST['reset'])) {

        //creating variables
        $username = $_POST['username']; 
        $ssn = $_POST['ssn'];
		$password = $_POST['password'];
        $Newpass = $_POST['Newpassword'];

        //queryy db
        $select_user = "SELECT * FROM user_profile WHERE username = '$username'"; //prepares sql statement to check if username already exists
		$result = $connect->query($select_user); 

        $matchnum = " SELECT * FROM user_profile WHERE ssn = '$ssn'";
        $result2 = $connect->query($matchnum);

        echo $result2;

        // if(($result->num_rows == 1) && ($result2 )) {//if there is no username in the db them it will not allow pw change
            
        // }
    

?>