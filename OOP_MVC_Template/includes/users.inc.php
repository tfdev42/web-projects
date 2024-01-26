<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

if(isset($_POST["submit"])){
    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $DoB = "{$_POST["year"]}-{$_POST["month"]}-{$_POST["day"]}";

    try {
        include "./autoload_classes.inc.php";
        $createUser = new UsersContr();
        $result = $createUser->createUser($firstName, $lastName, $DoB);

        if ($result){            
            $_SESSION["messages"] = View::renderSuccess();
            header("Location: ../index.php?msg=success");
            die();
        } else {
            $_SESSION["errors"] = View::renderFail();
            header("Location: ../index.php?error=true");
            die();
        }


    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}