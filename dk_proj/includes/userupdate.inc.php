<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];


    try {
        
        require_once "dbh.inc.php";
        
        $query = "UPDATE users
        SET username = :username, pwd = :pwd, email = :email
        WHERE id = '3';
        ";
        // change the user id=3 = cesar

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $pwd);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $pdo = null;
        $stmt = null;

        
        header("Location: ../index.php");
        

    } catch (PDOException $e) {

        die("Query failed: " . $e->getMessage());
    }

}

else {
    header("Location: ../index.php");
}