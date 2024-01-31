<?php

class LoginContr extends UserModel{
    
    private $validator;
    private $errors;

    public function __construct() {
        parent::__construct();        
        $this->validator = new Validator();
        $this->errors = [];
    }

    public function loginUser($email) {
        $user = $this->getUserByEmail($email);
        $_SESSION["user"]["id"] = $user["user_id"];
        $_SESSION["user"]["email"] = $user["user_email"];
        $_SESSION["user"]["role"] = $user["user_role"];
        $_SESSION["cart"] = [];
    }

    public function pwdDoesntMatchHashedPwd($pwd, $email) {

        $haschedPwd = (string)$this->getHashedPwdByEmail($email);

        return password_verify($pwd, $haschedPwd) === false;
    }

    public function getUserByEmail($email) {
        return $this->getUserArrayByEmail($email);
    }

    public function loginHasErrors() {
        
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