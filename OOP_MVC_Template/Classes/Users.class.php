<?php

// Model Class

class Users extends Dbh {

    protected function getUser($firstName){

        $query="SELECT * FROM users
        WHERE users_firstname = :firstName;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(":firstName", $firstName);
        $stmt->execute();

        return $stmt->fetchAll();

        
    }

}