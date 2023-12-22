<?php
require_once "./models.inc.php";

class DBAccess {
    private PDO $pdo;

    public function getPDO() : PDO {
        return $this->pdo;
    }

    public function isEmailTaken($email) : bool {
        $stmt = $this->pdo->prepare('
        SELECT COUNT(*)
        FROM user
        WHERE email = :email
        ');
        $stmt->bindValue('email', $email);
        $result = $stmt->execute();

        return $result > 0;
    }

    public function createUser($name, $email, $password) : int {

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

    public function __construct(){
        
        $host = 'localhost';
        $dbName = 'login_db_pdo_231220';
        $dbUser = 'root';
        $dbPassword = '';
        
        $pdo = new PDO("mysql:dbname=$dbName; host=$host", $dbUser, $dbPassword);
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->pdo = $pdo;
    }

}