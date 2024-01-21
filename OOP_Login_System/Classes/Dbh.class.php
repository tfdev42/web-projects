<?php

class Dbh {

    /**
     * PROTECTED visibility, so that extended classes can use Dbh.connect()
     */
    protected function connect() {
        try {
            $dbhost = "localhost";
            $dbname = "ooplogin_20240121";
            $dbuser = "root";
            $dbpwd = "";

            $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpwd);

            return $dbh;

        } catch (PDOException $e) {
            die("DB connection failed: " . $e->getMessage() . "<br>");
        }
    }

}