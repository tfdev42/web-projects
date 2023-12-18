<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

$host = "localhost";
$dbname = "login_db";
$username = "root";
$password = "";

// $mysqli = new mysqli(hostname: $host,
//                     username: $username,
//                     password: $password,
//                     database: $dbname);

$mysqli = new mysqli("localhost", "root", "", "login_db");

if ($mysqli->connect_error) {
    die("Connection error: " . $mysqli->connect_error);
}


?>