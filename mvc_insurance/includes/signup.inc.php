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

    if (isset($_POST["bt_signup"])){
        $signupData = [];
        $formFields = ["fname", "lname","email","pwd","street","city","country","zip", "paymentMethod"];

        foreach($formFields as $field){
             $signupData[$field] = (isset($_POST[$field])) ? $_POST[$field] : null;
        }

        try {
            require_once "./dbh.inc.php";
            require_once "signup_model.inc.php";
            require_once "signup_contr.inc.php";



        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

        

    }else {
        header("Location: ../index.php");
        die();
    }
    // Error handling








}else {
    header("Location: ../index.php");
    die();
}
