<?php

class LoginContr extends UserModel {
    private $sanitize;
    private $postArray;
    private $errors;
    private $loginByEmail;
    

    public function __construct() {
        parent::__construct();
        $this->sanitize = new Sanitize();
        $this->postArray;
        $this->errors;  
        $this->loginByEmail = false;      
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
         * by sanitize() because the different $value naming
         * from login.temp.php
         */
        $this->setUserName($this->postArray["uname"]);
        $this->setUserPwd($this->postArray["pwd"]);       
    }


    public function validateLogin() {

        $loginByEmail = filter_var($this->postArray["uname"], FILTER_VALIDATE_EMAIL);

        if ($loginByEmail) {
            $userExists = $this->selectUserByEmail();
        } else {
            $userExists = $this->selectUserByUname();
        }

        if (!$userExists) {
            $this->errors[] = "Wrong login data!";                
        }

        // Set flag for login method
        $this->loginByEmail = $loginByEmail;
        
    }

    public function loginUser() {
        if ($this->loginByEmail) {
            // Login by email
        } else {
            // Login by username
        }
    }
}