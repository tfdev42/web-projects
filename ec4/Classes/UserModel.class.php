<?php

class UserModel extends Dbh {
    
    protected $userId;
    protected $userName;
    protected $userEmail;
    protected $userPwd;
    protected $userRole;
    protected $createdOn;

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
        return $this->userId;
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

    public function setUserRole($userRole){
        $this->userRole = $userRole;
    }
    public function setUserCreatedOnDate($date){
        $this->createdOn = $date;   
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

        if ($result){
            $user = new UserModel();
            $id = $result->user_id;
            $name  = $result->user_name;
            $email = $result->user_email;
            $hash = $result->user_pwd_hash;            
            $role = $result->user_role;
            
            $user->setUserId($id);
            $user->setUserName($name);
            $user->setUserEmail($email);
            $user->setUserPwd($hash);
            $user->setUserRole($role);
            
            return $user;
        }
        return $result;
    }

    /**
     * SELECT user ID by user_name (can be email or username)
     */
    public function selectUserIdByUnameOrEmail() {
        $query=
        "SELECT user_id 
        FROM users 
        WHERE user_name = :userName OR user_email = :userEmail;";

        $stmt = Dbh::connect()->prepare($query);

        $stmt->bindValue(":userName", $this->getUserName());        
        $stmt->bindValue(":userEmail", $this->getUserEmail());
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result){
            $user = new UserModel();            
            $id = $result->user_id;            
            
            $user->setUserPwd($id);            
            
            return $user;
        }
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

        if ($result){
            $user = new UserModel();
            $id = $result->user_id;
            $name  = $result->user_name;
            $email = $result->user_email;
            $hash = $result->user_pwd_hash;            
            $role = $result->user_role;
            
            $user->setUserId($id);
            $user->setUserName($name);
            $user->setUserEmail($email);
            $user->setUserPwd($hash);
            $user->setUserRole($role);
            
            return $user;
        }
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

        if ($result){
            $user = new UserModel();
            $id = $result->user_id;
            $name  = $result->user_name;
            $email = $result->user_email;
            $hash = $result->user_pwd_hash;            
            $role = $result->user_role;
            
            $user->setUserId($id);
            $user->setUserName($name);
            $user->setUserEmail($email);
            $user->setUserPwd($hash);
            $user->setUserRole($role);
            
            return $user;
        }
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
        // $result = $stmt->fetch();

        // if ($result){
        //     $user = new UserModel();            
        //     $hash = $result->user_pwd_hash;            
            
        //     $user->setUserPwd($hash);
            
            
        //     return $user;
        // }
        // return $result;
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as associative array

        if ($result) {
            return $result['user_pwd_hash'];
        }

        return false; // Or handle empty result as needed

    }
    
}