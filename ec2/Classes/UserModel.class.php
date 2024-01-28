<?php

class UserModel {

    private $userId;
    private $email;
    private $pwd;
    private $userRole;
    private object $Dbh;

    public function __construct() {
        $this->userId  = null;
        $this->email  = null;
        $this->pwd  = null;
        $this->userRole  = "customer";
        $this->Dbh  = new Dbh();
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
    public function setUserRole($userRole){
        $this->userRole = $userRole;
    }

    /**
     * returns TRUE if Email is taken
     */
    protected function isEmailTaken($email){
        $query=
        "SELECT users_email
        FROM users
        WHERE users_email = :email;";

        $stmt = $this->Dbh->connect()->prepare($query);
        return $stmt->execute();
    }

    /**
     * returns TRUE if user added to DB
     */
    protected function setUser($email, $pwd) {
        $query=
        "INSERT INTO users (users_email, users_pwd)
        VALUES (:email, :pwd);";

        $stmt = $this->Dbh->connect()->prepare($query);
        return $stmt->execute();
    }

    protected function getUserArrayByEmail($email) : array | false {
        $query=
        "SELECT users_id, users_email, users_role
        FROM users
        WHERE users_email = :email;";

        $stmt = $this->Dbh->connect()->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    protected function getUserObjByEmail($email) : object | false{
        $user = $this->getUserArrayByEmail($email);
        if ($user) {
            $userObj = new UserModel();
            $userObj->setEmail($user["users_email"]);
            $userObj->setUserId($user["users_id"]);
            $userObj->setUserRole($user["users_role"]);

            return $userObj;
        }
        return $user; // if $user is FALSE       

    }


    /**
     * returns Hashed Password
     */
    protected function getHashedPwdByEmail($email) {
        $user = $this->getUserObjByEmail($email);
        $query =
        "SELECT users_pwd FROM users WHERE users_email = :email";

        $stmt = $this->Dbh->connect()->prepare($query);
        $stmt->bindValue(":email", $this->getEmail());
        $stmt->execute();

        return $stmt->fetch();

    }
    

    

    public function updateUserPassword($userId, $hashedPassword) {
        $query = 
        "UPDATE users 
        SET users_pwd = :hashedPassword 
        WHERE users_id = :userId";

        $stmt = $this->Dbh->connect()->prepare($query);
        $stmt->bindValue(":hashedPassword", $hashedPassword);
        $stmt->bindValue(":userId", $userId);
        return $stmt->execute();
    }
}