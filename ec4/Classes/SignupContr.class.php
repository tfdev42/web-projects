<?php

class SignupContr extends UserModel {

    private $sanitize;
    private $postArray;
    private $errors;

    public function __construct() {
        parent::__construct();
        $this->sanitize = new Sanitize();
        $this->postArray;
        $this->errors;
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
    public function checkSignupErrors() {

        $this->sanitize->setTrimmedPostArray();

        $this->postArray = $this->sanitize->getPostArray();

        $this->sanitize->sanitize();        

        $this->errors = $this->sanitize->getErrors();

    }


    public function validateSignup() {

        if ( !empty($this->postArray["user_name"]) && !empty($this->postArray["email"])) {
            $usernameTaken = $this->selectUserByUname();
            $emailTaken = $this->selectUserByEmail();

            if ($usernameTaken !== false ) {
                $this->errors[] = "Username is taken!";
            }

            if ($emailTaken !== false ) {
                $this->errors[] = "Email is taken!";
            }
        }
        
    }

    public function setSignupUser() {

        $this->setUserName($this->postArray["user_name"]);
        $this->setUserEmail($this->postArray["email"]);
        $this->setUserPwd($this->postArray["password"]);        
    }

    public function createUser() {
        // inserts into DB
        $this->insertUser();
    }


    
}