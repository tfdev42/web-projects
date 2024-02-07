<?php

class LoginContr {
    private $sanitize;
    private $postArray;
    private $errors;
    private $loginByEmail;

    private $tempUser;
    

    public function __construct() {        
        $this->sanitize = new Sanitize();
        $this->postArray;
        $this->errors;  
        $this->loginByEmail = false;  
        $this->tempUser = new UserModel();    
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getPostArray() {
        return $this->postArray;
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
        $this->tempUser->setUserPwd($this->postArray["pwd"]);       
    }


    public function validateLogin() {

        $loginByEmail = filter_var($this->postArray["uname"], FILTER_VALIDATE_EMAIL);

        if ($loginByEmail) {
            $userExists = $this->tempUser->selectUserByEmail();
        } else {
            $userExists = $this->tempUser->selectUserByUname();
        }

        if (!$userExists) {
            $this->errors[] = "Wrong login data!";                
        }        

        // Set flag for login method
        $this->loginByEmail = $loginByEmail;
        
    }

    public function verifyCredentials() {

        $id = $this->tempUser->selectUserIdByUnameOrEmail();
        $this->tempUser->setUserId($id);
        // Verify Pwd 
        $hashedPwd = $this->tempUser->selectPwdHashByUserId();
        
        $result = password_verify($this->tempUser->getUserPwd(), $hashedPwd);
        if (!$result) {
            $this->errors[] = "Wrong credentials!";
        }
    }


    public function loginUser() {
        $userContr = new UserContr();
        $userContr->setUserName($this->tempUser->getUserName());
        $userContr->setUserId($this->tempUser->getUserId());
        $userContr->setEmail($this->tempUser->getEmail());
        $userContr->setUserRole($this->tempUser->getUserRole());
        $userContr->setUserToSession();
        
    }
}