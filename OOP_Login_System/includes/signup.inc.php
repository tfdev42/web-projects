<?php

if (isset($_POST["submit"])){
    // Getting the data
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwd_repeat = $_POST["pwd_repeat"];
    $email = $_POST["email"];


    // Instantiate SignupContr class
    include "../Classes/Signup.class.php";
    include "../Classes/SignupContr.class.php";

    $signup = new SignupContr($uid, $pwd, $pwd_repeat, $email);

    // Runnin error handlers and user signup


    // Goin back to front page

}