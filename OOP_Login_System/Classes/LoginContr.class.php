<?php

class LoginContr extends Login {
    
    private $uid;
    private $pwd;

    public function __construct($uid, $pwd) {
        $this->uid = $uid;
        $this->pwd = $pwd;
    }


    private function isPwdWrong() {
        $result = true;
        $hashedPwd = $this->getHashedPwdByUid($this->uid);

        if (! password_verify($this->pwd, $hashedPwd)){
            $result = false;
        }
        return $result;
    }

    /**
     * Returns TRUE if an input is empty
     */
    private function isInputEmpty() {
        $result = true;
        if(empty($this->uid) || empty($this->pwd)){
            return;
        } else $result = false;
        return $result;
    }

    public function loginUser() {
        if ($this->isInputEmpty()){
            header("location: ../index.php?error=login");
            die();
        }

        if ($this->isPwdWrong()){
            header("location: ../index.php?=error=pwdwrong");
            die();
        }

        $user = $this->getUserDataByUid($this->uid);

        session_start();
        $_SESSION["user_id"] = $user["users_id"];
        $_SESSION["user_uid"] = $user["users_uid"];
        $_SESSION["user_email"] = $user["users_email"];
        
    }

    
}