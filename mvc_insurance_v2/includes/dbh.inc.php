<?php

$host = 'localhost';
$dbname = 'v2_mvc_insurance_20240103';
$dbuser = 'root';
$dbpwd = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Connection to DB failed: " . $e->getMessage());
}