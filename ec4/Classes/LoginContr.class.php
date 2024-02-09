<?php

class LoginContr {
    protected $sanitize;
    protected $postArray;
    protected $errors;
    protected $loginByEmail;
    protected $tempUser;
    protected $pwdHash;
    

    public function __construct() {        
        $this->sanitize = new Sanitize();
        $this->postArray;
        $this->errors;  
        $this->loginByEmail = false;  
        $this->tempUser = new UserModel(); 
        $this->pwdHash;   
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getPostArray() {
        return $this->postArray;
    }
    public function getPwdHash() {
        return $this->pwdHash;
    }

    public function setPwdHash($pwdHash) {
        $this->pwdHash = $pwdHash;
    }

    /**
     * Sets a trimmed post array and errors[] if any errors present
     */
    public function checkLoginErrors() {

        $this->sanitize->setTrimmedPostArray();

        $this->postArray = $this->sanitize->getPostArray();
        
        $this->sanitize->sanitize();

        $this->errors = $this->sanitize->getErrors();

    }

    public function setLoginUser() {
        /**
         * these get only trimmed and checked for empty
         * by sanitize() because the different input $value naming
         * from login.temp.php
         */
        $this->tempUser->setUserName($this->postArray["uname"]);
        $this->tempUser->setUserEmail($this->postArray["uname"]);
        $this->tempUser->setUserPwd($this->postArray["pwd"]);       
    }


    public function validateLogin() {

        $loginByEmail = filter_var($this->postArray["uname"], FILTER_VALIDATE_EMAIL);
        $userExists = false;

        // Check if user exists
        if ($loginByEmail) {     

            $userExists = $this->tempUser->selectUserByEmail();
            
        } else {

            $userExists = $this->tempUser->selectUserByUname();
            
        }

        if ($userExists) {
            $this->tempUser->setUserId($userExists->getUserId());
            $this->tempUser->setUserName($userExists->getUserName());
            $this->tempUser->setUserEmail($userExists->getUserEmail());
            $this->tempUser->setUserPwd($this->postArray["pwd"]);
            $hash = $userExists->getUserPwd();
            $this->pwdHash = $hash;
                            
        } else {
            $this->errors[] = "User doesn't exist!";
        }

        // Set flag for login method
        $this->loginByEmail = $loginByEmail;
        
    }

    public function verifyCredentials() {

        $hashedPwd = $this->tempUser->selectPwdHashByUserId();
        
        if ( ! password_verify($this->tempUser->getUserPwd(), $hashedPwd)){
            $this->errors[] = "Wrong credentials!";
        }
    
    }


    public function loginUser() {
        $userContr = new UserContr();
        $userContr->userModel->setUserName($this->tempUser->getUserName());
        $userContr->userModel->setUserId($this->tempUser->getUserId());
        $userContr->userModel->setUserEmail($this->tempUser->getUserEmail());
        $userContr->userModel->setUserRole($this->tempUser->getUserRole());
        $userContr->setUserToSession();
        
    }
}