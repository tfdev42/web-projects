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

        $loginContr = new LoginContr();

        try {

            $loginContr->checkLoginErrors();

            $loginContr->setLoginUser();

            $loginContr->validateLogin();

            $errors = $loginContr->getErrors();

            if (count($errors) > 0) {
                $_SESSION["errors"] = $errors;
                $errors = null;                
                header("Location: ../index.php?view=login&key=$uniqueKey");
                exit();
            } else {
                $loginContr->loginUser();                
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