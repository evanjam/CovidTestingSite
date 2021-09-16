<?php

//names for the database for the later function to use to connect to 
$serveName = "";
$userName = "";
$passWord = "";
$dbName = "";

//function to connect to db with debugging included
$connect = sqlConnect($serveName, $userName, $passWord, $dbName);

if(sqlConnect_errono()){
    echo "connection failed";
    exit();
}
echo "connection made!";

?>