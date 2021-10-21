<?php

if(isset($_POST["register"]))
{
    $username = $_POST["username"];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT); //prepares the password hash
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['date'];
    $ssn = $_POST['ssn'];


    //instantiating register controller 

    include "../classes/register.classes.php";
    include "../classes/register-contr.php";
    $registerUser = new RegisterContr(username, password, fname, lname, dob, ssn);


}