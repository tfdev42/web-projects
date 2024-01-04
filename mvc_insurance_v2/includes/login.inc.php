<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    

    try {
        require_once "dbh.inc.php";
        require_once "login_model.inc.php";
        require_once "login_contr.inc.php";


        
        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {

        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
    die();
}