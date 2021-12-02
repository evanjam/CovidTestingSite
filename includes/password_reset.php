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
            
            $password_hash = password_hash($Newpass, PASSWORD_BCRYPT); //creating new password hash to be inserted
            $select_user = "SELECT * FROM user_profile WHERE username = '$username'"; //prepares sql statement to check if username already exists
            $result = $connect->query($select_user);    

            if($result->num_rows == 0) {//if there is no username in the db then it will not allow pw change 
                echo "account not found, please try again.";
                echo'<div><a href="../index.php">Login</a></div>';
            }else{
                $matchnum = " SELECT * FROM user_profile WHERE ssn = '$ssn'"; //query to get row with user profile with the ssn inserted
                $result2 = $connect->query($matchnum);
                if($result2->num_rows == 0){ //if there is no username with the ssn inputed error is thrown and page is refreshed
                    echo "SSN does not match username, try again";
                    header('Refresh: 2;URL=../index.php');
                }else{
                    $row = $result2->fetch_row();//creating row to check if the ssn matched the username in the db
                    $row2 = $result->fetch_row();//getting row of username query 

                    if($row[6] != $row2[6]){ //checks if the row does not match credentials inputed
                        echo "SSN does not match for the username given, try again";
                        echo'<div><a href="../index.php">Login</a></div>';
                    }else{
                        $update_pass = "UPDATE user_profile SET password = '$password_hash' WHERE ssn= '$ssn'"; //sets updated password to the correct username
                        if($connect->query($update_pass) == TRUE)//if update pass is successful, sends message and refreshed to index
                        {
                            echo "new record created redirect to the home page to log in with your new password";
                            echo'<div><a href="../index.php">Login</a></div>';
                        }

                    }
                }
            }
                $connect->close();
    }

?>



