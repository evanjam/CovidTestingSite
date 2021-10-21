<?php
//this class registers an instance of a user which can then be placed in database
class RegisterContr {

    //private variables for each instance of a user, great for OOP implementation, also safe for users data allowing only user and top admin to reach this data
    private $username
    private $password
    private $fname
    private $lname
    private $socialNum
    private $dob
    private $permissions = 1;

    //constructor to create instance with the inputed data from the form which the employee will input for the first time user
    public function __construct(username, password, fname, lname,socialnum, dob ){
        $this->$username = username;
        $this->$password = password;
        $this->$fname = fname;
        $this->$lname = lname;
        $this->$socialNum = socialnum;
        $this->$dob = dob;
    }

    //simple function to check to make sure all the data fields are checked and cleared to register with data needed to insert into DB table
    private function emptyField(){
        $result;
        if( empty($this->$username) || empty($this->$password) || empty($this->$fname) || empty($this->$lname) || empty($this->$socialNum)|| empty($this->$dob)) {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result
    }


}