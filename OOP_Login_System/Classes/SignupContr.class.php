<?php

class SignupContr extends Signup {

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
     * Check Signup Errors
     */
    public function signupUser() {
        if($this->isInputEmpty()) {
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        if($this->isUidInvalid()) {
            header("location: ../index.php?error=username");
            exit();
        }

        if($this->isEmailInvalid()) {
            header("location: ../index.php?error=email");
            exit();
        }

        if($this->pwdDontMatchRepeatPwd()) {
            header("location: ../index.php?error=pwdmatch");
            exit();
        }

        if($this->isUidTaken()) {
            header("location: ../index.php?error=uidemailtaken");
            exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email);


    }

    /**
     * Returns TRUE if uid is taken
     */
    private function isUidTaken() {
        $result = true;
        if ( ! $this->isUsernameOrEmailTaken($this->uid, $this->email)){
            $result = false;
        }
        return $result;
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
     * Return TRUE if Username contains NOT ONLY [a-zA-Z0-9]
     */
    private function isUidInvalid() {
        $result = true;
        if (preg_match("/^[a-zA-Z0-9]*$/", $this->uid)){
            $result = false;
        }
        return $result;
    }

    /**
     * Returns TRUE if the Email is Invalid
     */
    private function isEmailInvalid() {
        $result = true;
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $result = false;
        }
        return $result;
    }

    /**
     * Returns TRUE if the PWD and Repeat_Pwd don't match 
     */
    private function pwdDontMatchRepeatPwd() {
        $result = true;
        if ($this->pwd === $this->pwd_repeat){
            $result = false;
        }
        return $result;
    }


}