<?php

class LoginContr extends UserModel {

    
    public function __construct() {
        parent::__construct();      
    }

    public function getUserByEmail($email) {
        return $this->getUserObjByEmail($email);
    }

    /**
     * returns TRUE if login has errors
     */
    public function loginHasErrors() {

        FormValidator::setInputDataArray($_POST);
        FormValidator::trimInputDataArray();

        if (FormValidator::isAnyInputEmpty()) {
            FormValidator::$errors[] = "Fill in all fields!";
        }
        if (FormValidator::isEmailInvalid()) {
            FormValidator::$errors[] = "Enter a valid E-mail!";
        }
        if ($this->pwdDoesntMatchHashedPwd(FormValidator::$inputData["pwd"])){
            FormValidator::$errors[] = "Invalid Password!";
        }

        return ( ! empty(FormValidator::$errors));
        
    }


    public function pwdDoesntMatchHashedPwd($pwd) {

        $haschedPwd = $this->getHashedPwdByEmail($this->getEmail());

        return password_verify($pwd, $haschedPwd) === false;
    }


    public function loginUser() {
        $_SESSION["user"]["id"] = $this->getUserId();
        $_SESSION["user"]["email"] = $this->getEmail();
        $_SESSION["user"]["role"] = $this->getUserRole();
        $_SESSION["user"]["cart"] = [];
    }

    


    
}