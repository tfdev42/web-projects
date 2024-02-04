<?php

class SignupContr extends UserModel {

    private $userModel;
    private $validate;

    public function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
        $this->validate = new Validate();
    }
}