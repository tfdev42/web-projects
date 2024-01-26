<?php

class UserModel extends Dbh {

    private $userId;
    private $email;
    private $pwd;
    private $userRole;

    public function __construct() {
        $this->userId  = null;
        $this->email  = null;
        $this->pwd  = null;
        $this->userRole  = "customer";
    }

    protected function setUserId($userId){
        $this->userId = $userId;        
    }

    public function getUserId(){
        return $this->userId;
    }

    protected function setEmail($email){
        $this->email = $email;        
    }

    public function getEmail(){
        return $this->email;
    }

    protected function setPwd($pwd){
        $this->pwd = $pwd;        
    }

    protected function getPwd(){
        return $this->pwd;
    }    

    public function getUserRole(){
        return $this->userRole;
    }

    /**
     * returns TRUE if Email is taken
     */
    protected function isEmailTaken($email){
        $query=
        "SELECT users_email
        FROM users
        WHERE users_email = :email;";

        $stmt = $this->connect()->prepare($query);
        return $stmt->execute();
    }

    /**
     * returns TRUE if user added to DB
     */
    protected function setUser($email, $pwd) {
        $query=
        "INSERT INTO users (users_email, users_pwd)
        VALUES (:email, :pwd);";

        $stmt = $this->connect()->prepare($query);
        return $stmt->execute();
    }

    protected function getUserObjByEmail($email) : object | false{
        $query=
        "SELECT users_id, users_email, users_role
        FROM users
        WHERE users_email = :email;";

        $stmt = $this->connect()->prepare($query);
        $stmt->execute();

        return $stmt->fetch();

    }
}