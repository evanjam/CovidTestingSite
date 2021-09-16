<?php
//?path = '/includes';
//set_include_path(get_include_path().PATH_SEPARATOR.$path);

//names for the database for the later function to use to connect to 
$serverName = "";
$userName = "";
$passWord = "";
$dbName = "";
$debug = "true";

//function to connect to db with debugging included
$connect = mysqli_connect($serverName, $userName, $passWord, $dbName);

if($connect->connect_error) {
	die('Could not connect: ' . $connect->connect_error);
}elseif($debug =="true") {
	echo nl2br("\nDEBUG:\n");
	echo nl2br("\nConnection Success\n");
}

?>