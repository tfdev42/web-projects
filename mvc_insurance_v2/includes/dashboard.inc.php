<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "config_session.inc.php";

if ( ! empty([$_SESSION["user_id"]])){
    
} else {
    if (isset($_SESSION["user_id"])){
        unset($_SESSION["user_id"]);
    }
    
    header("Location: ../index.php");
    exit();
}