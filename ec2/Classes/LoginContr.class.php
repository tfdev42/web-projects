<?php

class LoginContr extends UserModel {
    private $userId;
    private $email;
    private $pwd;
    private $userRole;

    public function __construct($email, $pwd) {
        $this->email = $email;
        $this->email = $pwd;
        $this->userId = null;
        $this->userRole = null;
    }


    
}