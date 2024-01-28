<?php

class Dbh {
    private $dbHost = "localhost";
    private $dbName = "new_ec_20240126";
    private $dbUser = "root";
    private $dbPwd = "";

    public function connect() {
        try {

            $pdo = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUser, $this->dbPwd);

            /**
             * Show DB errors
             */
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            /**
             * Set Default FETCH
             */
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;


        } catch (PDOException $e) {
            die("DB Connection failed: " . $e->getMessage());
        }
        
    }
}