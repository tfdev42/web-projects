<?php

class UserContr {

    private object $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    /**
     * returns TRUE if PWD has been changed
     */
    public function changeUserPwdById($userId, $newPwd){
        
        $hashedPassword = password_hash($newPwd, PASSWORD_DEFAULT);
        
        return $this->userModel->updateUserPassword($userId, $hashedPassword);
    }
}