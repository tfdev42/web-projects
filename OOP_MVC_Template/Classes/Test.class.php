<?php

class Test extends Dbh {

    public function getUsersDataWithTableNames() {
        $query = "SELECT * FROM users;";
        
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();

        while($row = $stmt->fetch()){
            foreach ($row as $k=>$v){
                echo $k . " = " . $v . " ";
                echo "<br>";
            }
        }
        $stmt=null;

    }

    public function getUsers() {
        $query = "SELECT users_firstname, user_dateofbirth FROM users;";

        $stmt = $this->connect()->prepare($query);
        $stmt->execute();

        while($row = $stmt->fetch()){
            echo $row["users_firstname"] . ", DoB: " .$row["user_dateofbirth"] . "<br>";
        }
        $stmt=null;
    }

    public function setUser($firstName, $lastName, $dob){
        $query=
        "INSERT INTO users (users_firstname, users_lastname, user_dateofbirth)
        VALUES (:firstName, :lastName, :dob);";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(":firstName", $firstName, PDO::PARAM_STR);
        $stmt->bindValue(":lastName", $lastName, PDO::PARAM_STR);
        $stmt->bindValue(":dob", $dob, PDO::PARAM_STR);
        $result = $stmt->execute();

        if ($result){
            echo "OK";
        } else echo "NOK";
        $stmt=null;
    }

    public function updateLastname($firstName, $newLastName) {
        $query=
        "UPDATE users
        SET users_lastname = :newLastName
        WHERE users_firstname = :firstName;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(":firstName", $firstName, PDO::PARAM_STR);
        $stmt->bindValue(":newLastName", $newLastName, PDO::PARAM_STR);

        $result = $stmt->execute();

        if ($result){
            echo "OK";
        } else echo "NOK";
        $stmt=null;
    }

}