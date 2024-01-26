<?php

class User extends Dbh {
    private $userEmail;
    private $userPwd;

    public function __construct() {
        $this->userEmail;
        $this->userPwd;
    }

    protected function setUserEmail($userEmail) {
        $this->userEmail = $userEmail;
    }

    protected function setUserPwd($userPwd) {
        $this->userPwd = $userPwd;
    }

    public function getUserEmail() {
        return $this->userEmail;
    }

    public function getUserPwd() {
        return $this->userPwd;
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

    /**
     * returns Assoc Array of userdata
     */
    protected function getUserByEmail($userEmail) {
        $query=
        "SELECT users_id, users_email
        WHERE users_email = :userEmail";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(":userEmail", $userEmail);
        $stmt->execute();

        return $stmt->fetch();
    }
}