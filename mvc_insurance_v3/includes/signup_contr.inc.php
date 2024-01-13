<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["signup_role"])){
    $_SESSION["signup_role"] = $_POST["signup_role"];
    header("Location: ../index.php");
    
} else {
    header("Location: ../index.php");
    die();
}