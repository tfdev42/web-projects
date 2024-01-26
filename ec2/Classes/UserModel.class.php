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
        $this->userRole  = "cutomer";
    }

    protected function setUserId($userId){
        $this->userId = $userId;        
    }

    protected function setEmail($email){
        $this->email = $email;        
    }

    protected function setPwd($pwd){
        $this->pwd = $pwd;        
    }

    protected function getPwd(){
        return $this->pwd;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function getEmail(){
        return $this->email;
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
}