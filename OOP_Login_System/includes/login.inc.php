<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (isset($_POST["bt_login"])){
    // Getting the data
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];


    // Instantiate SignupContr class
    include "../Classes/Dbh.class.php";
    include "../Classes/Login.class.php";
    include "../Classes/LoginContr.class.php";

    $login = new LoginContr($uid, $pwd);

    
    // Runnin error handlers and user signup
    $user = $login->loginUser();
    session_start();
    $_SESSION["user_id"] = $user["users_id"];
    $_SESSION["user_uid"] = $user["users_uid"];
    $_SESSION["user_email"] = $user["users_email"];

    // Goin back to front page
    header("location: ../index.php?error=none");
    die();
}