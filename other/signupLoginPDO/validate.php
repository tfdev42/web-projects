<?php
require_once "./inc/main.inc.php";

if(isset($_POST["bt_submit"])){

    if(empty($_POST["name"])){
        $errors[] = "Name is required";
    }

    if( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email is required";
    }

    if(strlen($_POST["password"] < 8)){
        $errors[] = "Password must be at least 8 characters long";
    }

    if( ! preg_match("/[a-z]/i", $_POST["password"])) {
        $errors[] = "Password must contain at least one letter";
    }

    if( ! $_POST["password"] === $_POST["password_confirm"]) {
        $errors[] = "Entered passwords don't match";
    }


};