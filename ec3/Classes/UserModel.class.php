<?php

class UserModel {
    private $Dbh;
    private $uid;
    private $email;
    private $pwd;
    private $userRole;

    protected function __construct() {
        $this->Dbh = new Dbh();
        $this->email;
        $this->uid;        
        $this->pwd;
        $this->userRole = "customer";
    }

    public function getUid(){
        return $this->uid;
    }

    protected function setEmail($email){
        $this->email = $email;
    }

    public function getEmail($email){
        $this->email = $email;
    }
    
    public function getUserRole(){
        return $this->userRole;
    }

    /**
     * returns Hashed Password
     */
    protected function getHashedPwdByEmail($email) {        
        $query =
        "SELECT user_pwd_hash FROM users WHERE user_email = :email";

        $stmt = $this->Dbh->connect()->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        return $stmt->fetch();

    }

    /**
     * returns TRUE if user added to DB
     */
    protected function setUser($email, $pwd) {
        $query=
        "INSERT INTO users (user_email, user_pwd_hash, user_role)
        VALUES (:email, :pwd, :user_role);";

        $stmt = $this->Dbh->connect()->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":pwd", $pwd);
        $stmt->bindValue(":userRole", $this->userRole);
        return $stmt->execute();
    }

    protected function getUserArrayByEmail($email) : array | false {
        $query=
        "SELECT user_id, user_email, user_pwd_hash, user_role
        FROM users
        WHERE user_email = :email;";

        $stmt = $this->Dbh->connect()->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        return $stmt->fetch();
    }
}
