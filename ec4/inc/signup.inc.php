<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST)) {
    
    $errors = [];

    // Set a unique key
    $uniqueKey = uniqid();
    $_SESSION['redirect_key'] = $uniqueKey;

    try {
        
        include_once "./autoloader.php";

        $signupContr = new SignupContr();

        try {

            $signupContr->checkSignupErrors();

            $signupContr->setSignupUser();

            $signupContr->validateSignup();

            $errors = $signupContr->getErrors();

            if (count($errors) > 0) {
                $_SESSION["errors"] = $errors;
                $errors = null;
                $_SESSION["signup_data"] = $signupContr->getPostArray();
                header("Location: ../index.php?view=signup&key=$uniqueKey");
                exit();
            } else {
                $signupContr->createUser();
                unset($_SESSION["signup_data"]);
                header("Location: ../index.php?view=success&key=$uniqueKey");
                exit();
            }


        } catch (PDOException $e) {

            die("Query error: " . $e->getMessage());
        }



    } catch (ErrorException $e) {

        die("Internal error:" . $e->getMessage());
    }
}