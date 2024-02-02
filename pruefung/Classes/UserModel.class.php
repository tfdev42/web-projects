<?php

class UserModel extends Dbh {
    protected $user_id;
    protected $user_name;
    protected $first_name;
    protected $last_name;
    protected $pwd;
    protected $user_role;
    // protected $Dbh;

    public function __construct() {
        $this->user_id;
        $this->user_name;
        $this->first_name;
        $this->last_name;
        $this->pwd;
        $this->user_role;
        // $this->Dbh = new Dbh();
    }

    public function getUserID(){
        return $this->user_id;
    }
    public function getUserName(){
        return $this->user_name;
    }
    public function getUserFirstName(){
        return $this->first_name;
    }
    public function getUserLastName(){
        return $this->last_name;
    }
    public function getUserRole(){
        return $this->user_role;
    }

    /**
     * returns Hashed Password
     */
    public function getHashedPwdByUserName($user_name) {        
        $query =
        "SELECT user_pwd_hash FROM users WHERE user_name = :user_name;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(":user_name", $user_name);
        $stmt->execute();
        $hashedPwd = $stmt->fetch();
        return $hashedPwd;

    }
    

    /**
     * returns TRUE if user added to DB
     */
    public function insertUser($user_name, $pwd, $user_role) {
        $query=
        "INSERT INTO users (user_name, user_pwd_hash, user_role)
        VALUES (:user_name, :pwd, :user_role);";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(":user_name", $user_name);
        $stmt->bindValue(":pwd", $pwd);
        $stmt->bindValue(":user_role", $user_role);
        return $stmt->execute();
    }

    /**
     * returns User Array or False
     */
    public function getUserByUserName($user_name){
        $query =
        "SELECT * FROM users WHERE user_name = :user_name;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(":user_name", $user_name);
        $stmt->execute();
        return $stmt->fetch();
    }
}