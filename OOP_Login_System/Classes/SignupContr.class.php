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

    /**
     * Returns TRUE if an input is empty
     */
    private function isInputEmpty() {
        $result = true;
        if(empty($this->uid)
        || empty($this->pwd)
        || empty($this->pwd_repeat)
        || empty($this->email)){
            return $result;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * Return TRUE if Username contains NOT only [a-zA-Z0-9]
     */
    private function isUidInvalid() {
        $result = true;
        if (preg_match("/^[a-zA-Z0-9]*$/", $this->uid)){
            $result = false;
        }
        return $result;
    }


}