<?php

class Dbh {
    private $dbHost;
    private $dbName;
    private $dbUser;
    private $dbPwd;

    protected function connect() {
        try {

            $this->dbHost = "localhost";
            $this->dbName = "";
            $this->dbUser = "root";
            $this->dbPwd = "";

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
            die("DB Query failed: " . $e->getMessage());
        }
        
    }
}