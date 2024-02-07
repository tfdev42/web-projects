<?php

class SignupContr {

    private $sanitize;
    private $postArray;
    private $errors;
    private $user;

    public function __construct() {        
        $this->sanitize = new Sanitize();
        $this->postArray;
        $this->errors;
        $this->user = new UserModel();
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
            $usernameTaken = $this->user->selectUserByUname();
            $emailTaken = $this->user->selectUserByEmail();

            if ($usernameTaken !== false ) {
                $this->errors[] = "Username is taken!";
            }

            if ($emailTaken !== false ) {
                $this->errors[] = "Email is taken!";
            }
        }
        
    }

    public function setSignupUser() {

        $this->user->setUserName($this->postArray["user_name"]);
        $this->user->setUserEmail($this->postArray["email"]);
        $this->user->setUserPwd($this->postArray["password"]);        
    }

    public function createUser() {
        // inserts into DB
        $this->user->insertUser();
    }


    
}