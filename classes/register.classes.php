<?php
//class to do the functions for data insertion/deletion/modification
class Register extends Dbh{

    protected function setUser($username, $password, $fname, $lname, $socialNum, $dob) {

        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->connect()->prepare("INSERT INTO user_profile (UID, username, password, fname, lname, dob, ssn) 
        VALUES (NULL, '$username', '$password_hash', '$fname', '$lname', '$dob', '$socialNum')");
    
            if(!$stmt ->execute(array($username, $password_hash, $fname, $lname, $dob, $socialNum))){
                $stmt = null;
                header("location: ../forms/login.php");
                exit();
            }
    
            $resultCheck;
            if($stmt ->rowCount() > 0){
                $resultCheck = false;
            }
            else{
                $resultCheck = true;
            }
            return $resultCheck;
        }



    protected function checkUser(username) {
    $stmt = $this->connect()->prepare('SELECT UID FROM user_profile WHERE UID =?;');

        if(!$stmt ->execute(arra($username))){
            $stmt = null;
            header("location: ../forms/login.php");
            exit();
        }

        $resultCheck;
        if($stmt ->rowCount() > 0){
            $resultCheck = false;
        }
        else{
            $resultCheck = true;
        }
        return $resultCheck;
    }

}