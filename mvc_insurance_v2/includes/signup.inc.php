<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "./config_session.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ( ! isset($_SESSION["role_signup"])) {
        $_SESSION["role_signup"] = $_POST["role"];
        header("Location: ../index.php");
        exit();
    }



} else {
    header("Location: ../index.php");
    die();
}

