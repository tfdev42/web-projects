<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();


if (isset($_POST["bt_login"])){

    include "../Classes/Dbh.class.php";
    include "../Classes/UserModel.class.php";
    include "../Classes/Validator.class.php";
    include "../Classes/LoginContr.class.php";

    $errors = [];
    $postArray = $_POST;
    
    
    $loginContr = new LoginContr($postArray);

    /**
     * empty or invalid
     */
    if($loginContr->loginHasErrors()){
        $errors = $loginContr->getErrors();
    }

    /**
     * email does not exist in DB
     */
    if($loginContr->getUserByEmail($postArray["email"]) === "false"){
        $errors = "Email not registered!";
    }
    
    /**
     * pw wrong
     */
    if ($loginContr->pwdDoesntMatchHashedPwd($postArray["pwd"], $postArray["email"])){
        $errors[] = "Invalid Password";
    }
    

    if(isset($errors)){
        $_SESSION["errors"] = $errors;
        $errors = null;
        header("Location: ../index.php?view=login");
        die();
    }

    /**
     * login User
     */
    try {
        $loginContr->loginUser($postArray["email"]);
    header("Location: ../index.php?view=products");
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    

}