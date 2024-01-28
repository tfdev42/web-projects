<?php
session_start();
session_regenerate_id();
include_once "./Classes/FormValidator.class.php";
include_once "./Classes/LoginContr.class.php";

if (isset($_POST["bt_login"])) {
    $post = $_POST;
    $errors = [];

    $loginContr = new LoginContr();

    

    if ($loginContr->loginHasErrors() === true){

        $user = $loginContr->getUserByEmail(FormValidator::$inputData["email"]);

        if ( ! $user) {

            FormValidator::$errors[] = "No user found!";
        }

        $_SESSION["errors"] = FormValidator::$errors;

        FormValidator::unsetErrorsArray();
        FormValidator::unsetInputDataArray();

        $errors = null;

        header("Location: ../index.php");

    }

    $loginContr->loginUser();
    header("Location: ../index.php");
    exit();

    
    

    
    
    
    
}


