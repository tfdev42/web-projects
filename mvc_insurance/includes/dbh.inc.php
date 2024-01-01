<?php

$host = "localhost";
$dbName = "mvc_insurance_20240101";
$dbUser = "root";
$dbPwd = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $dbUser, $dbPwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}