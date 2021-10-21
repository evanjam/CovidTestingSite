<?php
//class designated for database handeling methods making it easier to call functions and will make other files simpler and put all functions in one area


class Dbh {

    //method to get db connection 
    protected function connect() {
        try {
            $serverName = "localhost";
            $userName = "root";
            $passWord = "";
            $dbName = "sc19_alpha";

            $dbh = new mysqli($serverName, $userName, $passWord, $dbName);
            return $dbh;
        } catch (PDOException $e) {
            print "error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}

?>