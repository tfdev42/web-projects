<?php

class SignupContr extends UserModel{
    
    private $validator;
    private $errors;
    private $email;
    private $pwd;
    private $pwd_repeat;
    public $postArray;
    

    public function __construct() {
        parent::__construct();        
        $this->validator = new Validator();
        $this->errors = [];
        $this->postArray = $this->validator->getTrimmedPostArray();
        $this->email = $this->postArray["email"];
        $this->pwd = $this->postArray["pwd"];
        $this->pwd_repeat = $this->postArray["pwd_repeat"];
    }

    public function signupUser() {
        
        return $this->createUser();
    }

    public function pwdDoesntMatchRepeatPwd() {

        return $this->pwd !== $this->pwd_repeat;
    }

    public function createUser() {
        $hashedPwd = password_hash($this->pwd, PASSWORD_DEFAULT);
        return $this->setUser($this->email, $hashedPwd);
    }

    public function getUserByEmail() {
        return $this->getUserArrayByEmail($this->email);
    }

    public function signupHasErrors() {
        
        if ($this->validator->isInputEmpty()){
            $this->errors[] = "Fill in all fields!";
        }

        if ($this->validator->isEmailInvalid()){
            $this->errors[] = "Enter a valid Email!";
        }

        return $this->errors ? true : false;
    }

    public function getErrors(){
        return $this->errors;
    }
}