<?php
require_once 'models.inc.php';

class DbAccess {

    private PDO $conn;

    public function getConn() : PDO {
        return $this->conn;
    }

    public function __construct() {
        // Database Login
        $host = '127.0.0.1';
        $dbName = '2023105_boot';
        $dbUser = 'root';
        $dbPassword = '';

        $conn = new PDO("mysql:dbname=$dbName; host=$host", $dbUser, $dbPassword);

        // show errors
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->conn = $conn;
    }

}

?>