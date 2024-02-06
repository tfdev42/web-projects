<?php

class UserModel extends Dbh {
    
    private $userId;
    private $userName;
    private $userEmail;
    private $userPwd;
    private $userRole = "customer";
    private $createdOn;
    private $userCartId;

    public function __construct() {
        $this->userId;
        $this->userName;
        $this->userEmail;
        $this->userPwd;
        $this->userRole;
        $this->createdOn;
        $this->userCartId;
    }

    // Getters
    public function getUserId(){
        return $this->userId;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function getUserEmail(){
        return $this->userEmail;
    }

    public function getUserPwd(){
        return $this->userPwd;
    }

    public function getUserRole(){
        return $this->userRole;
    }

    public function getUserCreatedOnDate(){
        return $this->createdOn;
    }

    public function getUserCartId(){
        return $this->userCartId;
    }

    // Setters
    public function setUserName($userName){
        $this->userName = $userName;
    }

    public function setUserEmail($userEmail){
        $this->userEmail = $userEmail;
    }

    public function setUserPwd($userPwd){
        $this->userPwd = $userPwd;
    }

    public function setUserCartId($userCartId){
        $this->userCartId = $userCartId;
    }

    // CRUD

    /**
     * returns TRUE on user INSERT into DB
     */
    public function insertUser() {
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



    /**
     * SELECT user by user_name
     */
    public function selectUserByUname() {
        $query=
        "SELECT * FROM users WHERE user_name = :userName;";

        $stmt = Dbh::connect()->prepare($query);

        $stmt->bindValue(":userName", $this->getUserName());
        $stmt->execute();

        $result = $stmt->fetch();

        return $result;
    }

    /**
     * SELECT user by user_email
     */
    public function selectUserByEmail() {
        $query=
        "SELECT * FROM users WHERE user_name = :userEmail;";

        $stmt = Dbh::connect()->prepare($query);

        $stmt->bindValue(":userEmail", $this->getUserEmail());
        $stmt->execute();

        $result = $stmt->fetch();

        return $result;
    }

    /**
     * SELECT user by Id
     */
    public function selectUserById() {
        $query=
        "SELECT * FROM users WHERE user_id = :userId;";

        $stmt = Dbh::connect()->prepare($query);

        $stmt->bindValue(":userId", $this->getUserId());
        $stmt->execute();

        $result = $stmt->fetch();

        return $result;
    }

    /**
     * UPDATE user_name
     */
    
}