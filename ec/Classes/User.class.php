<?php

class User extends Dbh {
    private $userEmail;
    private $userPwd;

    public function __construct() {
        $this->userEmail;
        $this->userPwd;
    }


    /**
     * returns TRUE if user has been set
     */
    protected function setUser($userEmail, $userPwd) {
        $query=
        "INSERT INTO users (users_email, users_pwd)
        VALUES (:userEmail, :userPwd);";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(":userEmail", $userEmail);
        $stmt->bindValue(":userPwd", $userPwd);
        return $stmt->execute();
    }

    /**
     * returns TRUE if email already registered
     */
    protected function isEmailTaken($userEmail) {
        $query=
        "SELECT *
        FROM users
        WHERE users_email = :userEmail);";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(":userEmail", $userEmail);        
        $stmt->execute();
        $result = $stmt->fetch();

        return $result !== false;
    }
}