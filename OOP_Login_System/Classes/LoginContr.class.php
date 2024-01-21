<?php

class LoginContr extends Login {
    
    private $uid;
    private $pwd;


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

        $this->getUserDataByUid($this->uid);
        
    }

    
}