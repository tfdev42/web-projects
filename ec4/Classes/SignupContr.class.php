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

    public function checkSignupErrors() {

        $this->sanitize->setTrimmedPostArray();

        $this->postArray = $this->sanitize->getPostArray();

        $this->sanitize->sanitize();        

        $this->errors = $this->sanitize->getErrors();

    }

    public function signupUser() {
        
    }

    
}