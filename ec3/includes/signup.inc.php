<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();


if (isset($_POST["bt_signup"])){

    include "../Classes/Dbh.class.php";
    include "../Classes/UserModel.class.php";
    include "../Classes/Validator.class.php";
    include "../Classes/SignupContr.class.php";

    $errors = [];
    $_SESSION["test"] = $postArray = $_POST;
    
    
    $loginContr = new SignupContr($postArray);

    /**
     * empty or invalid
     */
    if($loginContr->signupHasErrors()){
        $errors = $loginContr->getErrors();
    }

    /**
     * email already exist in DB
     */
    if($loginContr->getUserByEmail($postArray["email"]) === "true"){
        $errors = "Email already registered!";
    }
    
    /**
     * pw wrong
     */
    if ($loginContr->pwdDoesntMatchRepeatPwd()){
        $errors[] = "Passwords don't match!";
    }
    

    if($errors > 0){
        $_SESSION["errors"] = $errors;
        $errors = null;
        header("Location: ../index.php?view=signup");
        die();
    }

    /**
     * Signup User
     */
    try {
        $loginContr->signupUser();        
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    header("Location: ../index.php?view=products");
    die();
    
    

}