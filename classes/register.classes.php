<?php
//class to do the functions for data insertion/deletion/modification
class Register extends Dbh{

    protected function checkUser(username) {
        $stmt = $this->connect()->prepare('SELECT UID FROM user_profile WHERE UID =?;');

        //im going to research this more to match what we originally have and whats easier
    }

}