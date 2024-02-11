<?php

class Dbh {
    private $dbHost = "localhost";
    private $dbName = "ecommerce_template";
    private $dbUser = "root";
    private $dbPwd = "";

    public function connect() {
        try {

            $pdo = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUser, $this->dbPwd);

            /**
             * Show PDO errors
             */
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            /**
             * Set Default FETCH as Obj
             */
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            return $pdo;


        } catch (PDOException $e) {
            die("DB Connection failed: " . $e->getMessage());
        }
        
    }
}