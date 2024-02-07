<?php

class UserModel extends Dbh {
    
    private $userId;
    private $userName;
    private $userEmail;
    private $userPwd;
    private $userRole = "customer";
    private $createdOn;

    public function __construct() {
        $this->userId;
        $this->userName;
        $this->userEmail;
        $this->userPwd;
        $this->userRole;
        $this->createdOn;
    }

    // Getters
    

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

    public function getUserId(){
        return (int)$this->userId;
    }


    // Setters
    public function setUserName($userName){
        $this->userName = $userName;
    }

    public function setUserId($userId){
        $this->userId = $userId;
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
     * SELECT user ID by user_name (can be email or username)
     */
    public function selectUserIdByUnameOrEmail() {
        $query=
        "SELECT user_id 
        FROM users 
        WHERE user_name = :userName OR user_email = :userName;";

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
        "SELECT * FROM users WHERE user_email = :userEmail;";

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
     * SELECT hashedPwd by user_id
     */
    public function selectPwdHashByUserId() {
        $query=
        "SELECT user_pwd_hash FROM users WHERE user_id = :userId;";

        $stmt = Dbh::connect()->prepare($query);
        $stmt->bindValue(":userId", $this->getUserId());
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as associative array
        return $result["user_pwd_hash"];

    }
    
}