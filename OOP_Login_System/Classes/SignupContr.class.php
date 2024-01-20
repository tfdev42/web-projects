<?php

class SignupContr {

    private $uid;
    private $pwd;
    private $pwd_repeat;
    private $email;

    public function __construct($uid, $pwd, $pwd_repeat, $email) {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwd_repeat = $pwd_repeat;
        $this->email = $email;
    }


}