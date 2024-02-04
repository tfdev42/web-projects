<?php

class UserModel extends Dbh {
    
    private $userId;
    private $userName;
    private $userEmail;
    private $userPwd;
    private $userRole = "customer";
    private $createdOn;
    private $userCart;

    public function __construct() {
        $this->userId;
        $this->userName;
        $this->userEmail;
        $this->userPwd;
        $this->userRole;
        $this->createdOn;
        $this->userCart;
    }

    // Getters
    protected function getUserId(){
        return $this->userId;
    }

    protected function getUserName(){
        return $this->userName;
    }

    protected function getUserEmail(){
        return $this->userEmail;
    }

    protected function getUserPwd(){
        return $this->userPwd;
    }

    protected function getUserRole(){
        return $this->userRole;
    }

    protected function getUserCreatedOnDate(){
        return $this->createdOn;
    }

    // Setters
    protected function setUserName($userName){
        $this->userName = $userName;
    }

    protected function setUserEmail($userEmail){
        $this->userEmail = $userEmail;
    }

    protected function setUserPwd($userPwd){
        $this->userPwd = $userPwd;
    }

    protected function setUserCart(Cart $userCart){
        $this->userCart = $userCart;
    }

    // CRUD

    /**
     * returns TRUE on user INSERT into DB
     */
    protected function insertUser(UserModel $user) {
        $query=
        "INSERT INTO users (user_name, user_email, user_pwd_hash)
        VALUES (:userName, :userEmail, :userPwd)";

        $hashedPwd = password_hash($this->getUserPwd(), PASSWORD_DEFAULT);

        $stmt = Dbh::connect()->prepare($query);

        $stmt->bindValue(":userName", $this->getUserName());
        $stmt->bindValue(":userEmail", $this->getUserEmail());
        $stmt->bindValue(":userPwd", $hashedPwd);
        return $stmt->execute();
    }
}