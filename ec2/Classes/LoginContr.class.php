<?php

class LoginContr extends UserModel {
    private $userId;
    private $email;
    private $pwd;
    private $userRole;

    public function __construct(Type $var = null) {
        $this->var = $var;
    }
}