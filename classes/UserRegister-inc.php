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
    $email = $_POST['email'];


    //instantiating register controller 
    require_once 'db.classes.php';
    require_once 'register.classes.php';
    require_once 'register-contr.classes.php';

    $registerUser = new RegisterContr($username, $password, $fname, $lname, $ssn, $dob, $email);


    $registerUser->signupUser();

    header("location: ../index.php?error=none'");



}