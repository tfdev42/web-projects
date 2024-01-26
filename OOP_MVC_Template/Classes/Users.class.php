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

    protected function setUser($firstName, $lastName, $DoB){

        $query=
        "INSERT INTO users (users_firstname, users_lastname, user_dateofbirth)
        VALUES (:firstName, :lastName, :dob);";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(":firstName", $firstName, PDO::PARAM_STR);
        $stmt->bindValue(":lastName", $lastName, PDO::PARAM_STR);
        $stmt->bindValue(":dob", $DoB, PDO::PARAM_STR);        
        
        return $stmt->execute();
        
    }

}