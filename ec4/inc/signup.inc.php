<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $postArray = $_POST;

    try {
        include_once "./autoloader.php";
    } catch (ErrorException $e) {
        die("Internal error:" . $e->getMessage());
    }
}