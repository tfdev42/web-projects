<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];


    try {
        
        require_once "dbh.inc.php";
        // non-named parameters ! order has to match up of '?'
        // $query = "INSERT INTO users (username, pwd, email)
        //             VALUES (?, ?, ?);";

        $query = "INSERT INTO users (username, pwd, email)
        VALUES (:username, :pwd, :email);";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $pwd);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        // non-named params
        // $stmt->execute([$username, $pwd, $email]);

        // always close stmt and connection
        $pdo = null;
        $stmt = null;

        // die(); // if something is running with a connection within it

        header("Location: ../index.php");
        

    } catch (PDOException $e) {

        die("Query failed: " . $e->getMessage());
    }

}

else {
    header("Location: ../index.php");
}