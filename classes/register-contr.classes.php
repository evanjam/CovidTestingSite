<?php
//this class registers an instance of a user which can then be placed in database
class RegisterContr extends Register{

    //private variables for each instance of a user, great for OOP implementation, also safe for users data allowing only user and top admin to reach this data
    private $username;
    private $password;
    private $fname;
    private $lname;
    private $dob;
    private $ssn;
    private $email;

    //constructor to create instance with the inputed data from the form which the employee will input for the first time user
    public function __construct($username, $password, $fname, $lname, $ssn, $email, $dob){
        $this->username = $username;
        $this->password = $password;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->dob = $dob;
        $this->ssn = $ssn;
        $this->email = $email;
    }

    //checking functions to then be able to 
    public function signupUser(){
        
        $this->setUser($this->username, $this->password, $this->fname, $this->lname, $this->ssn, $this->dob, $this->email);
    }

    //simple function to check to make sure all the data fields are checked and cleared to register with data needed to insert into DB table
    private function emptyField(){
        $result;
        if( empty($this->username) || empty($this->password) || empty($this->fname) || empty($this->lname) || empty($this->socialNum)|| empty($this->dob)) {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function userMatch(){
        $result;
        if(!$this->checkUser($this->username))
        {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }


}