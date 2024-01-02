<?php
// declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "config_session.inc.php";


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["role"])) {

    if ( ! isset($_SESSION["role_signup"]) && $_POST["role"] === "customer") {
        $_SESSION["role_signup"] = "customer";
        header("Location: ../index.php");
        die();
    }

    if ( ! isset($_SESSION["role_signup"]) && $_POST["role"] !== "customer"){
        $_SESSION["role_signup"] = $_POST["role"];
        header("Location: ../index.php");
        die();
    }

    

    







}else {
    header("Location: ../index.php");
    die();
}
