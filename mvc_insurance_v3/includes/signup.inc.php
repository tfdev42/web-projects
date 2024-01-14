<?php

if ($_SERVER["REQUEST_METHOD"] === "POST"){

    if (isset($_POST["signup_role"])){

        $_SESSION["signup_role"] = $_POST["signup_role"];
        
    }

}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["bt_signup"])){
    require_once "./signup_contr.inc.php";

    $post = getPostInputFields();
    $_SESSION["result"] = $post;
    // header("location: ../index.php");
    // exit();
    
    
}