<?php
require_once "./inc/models.inc.php";

class DBAccess {
    private PDO $pdo;

    public function getPDO() : PDO {
        return $this->pdo;
    }

    public function createUser($name, $email, $password){

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare('
            INSERT INTO user (name, email, password)
            VALUES (:name, :email, :password)
        ');

        $stmt->bindValue('name', $name);
        $stmt->bindValue('email', $email);
        $stmt->bindValue('password', $password_hash);
        $stmt->execute();

        $userId = $this->pdo->lastInsertId();
        return $userId;
    }

}