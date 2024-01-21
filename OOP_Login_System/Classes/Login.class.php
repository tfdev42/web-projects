<?php

class Login extends Dbh {
    private $uid;
    private $pwd;


    protected function getUserDataByUid($uid) {
        try {
            $query=
            "SELECT users_id, users_uid, users_email
            FROM users
            WHERE users_uid = :uid;";

            $stmt = $this->connect()->prepare($query);
            $stmt->bindValue(":uid", $uid);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            die("Query error: " . $e->getMessage());
        }
        

    }

    protected function getHashedPwdByUid() {
        $query=
        "SELECT users_pwd
        FROM users
        WHERE users_uid = :uid;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":uid", $this->uid);
        $stmt->execute();

        $hashedPwd = $stmt->fetch(PDO::FETCH_ASSOC);
        return $hashedPwd;
    }


}