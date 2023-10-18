<?php
require_once 'models.inc.php';

class DbAccess {

    private PDO $pdo;

    public function getConn() : PDO {
        return $this->pdo;
    }

    public function createUser(
        string $fname,
        string $lname,
        string $email,
        string $password,
        string $street,
        string $city,
        string $country,
        string $zip,
        string $paymentMethod,
        bool $is_admin = false
    ) : int {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('
        INSERT INTO user
        (fname, lname, email, password, street, city, country, zip, paymentMethod, is_admin)
        VALUES
        (:fname, :lname, :email, :password, :street, :city, :country, :zip, :paymentMethod, :is_admin)
        ');
        $stmt->bindValue('fname', $fname);
        $stmt->bindValue('lname', $lname);
        $stmt->bindValue('email', $email);
        $stmt->bindValue('password', $password);
        $stmt->bindValue('street', $street);
        $stmt->bindValue('city', $city);
        $stmt->bindValue('country', $country);
        $stmt->bindValue('zip', $zip);
        $stmt->bindValue('paymentMethod', $paymentMethod);
        $stmt->bindValue('is_admin', $is_admin, PDO::PARAM_BOOL);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }


    public function istEmailVorhanden() : bool {
        $stmt = $this->pdo->prepare('
        SELECT email
        FROM users
        WHERE email = :email
        ');
        $stmt->bindValue('email', $email);
    }




    public function __construct() {
        // Database Login
        $host = '127.0.0.1';
        $dbName = '2023105_boot';
        $dbUser = 'root';
        $dbPassword = '';

        $pdo = new PDO("mysql:dbname=$dbName; host=$host", $dbUser, $dbPassword);

        // show errors
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo = $pdo;
    }



}

?>