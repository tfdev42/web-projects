<?php

class Signup extends Dbh {


    protected function setUser($uid, $pwd, $email){
        $query =
        "INSERT INTO users (users_uid, users_pwd, users_email)
        VALUES (:uid, :pwd, :email);";

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(":uid", $uid);
        $stmt->bindValue(":pwd", $hashedPwd);
        $stmt->bindValue(":email", $email);
        $result = $stmt->execute();

        if (!$result){
            $stmt = null;
            header("location: ../index.php?error=setuserfailed");
            exit();
        }
        $stmt = null;
        return true;
    }


    /**
     * Returns TRUE if username or email is taken
     */
    protected function isUsernameOrEmailTaken($uid, $email) {
        $query = 
        "SELECT users_uid
        FROM users
        WHERE users_uid = :users_uid OR users_email = :users_email;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(":users_uid", $uid);
        $stmt->bindValue(":users_email", $email);
        $result = $stmt->execute();

        if (!$result){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        return $stmt->rowCount() > 0;
        
    }

}