<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        // ORDER DOES MATTER!
        require_once "dbh.inc.php";
        require_once "login_model.inc.php";
        require_once "login_contr.inc.php";


        // ERROR HANDLERS
        $errors = [];

        if (is_input_empty($username, $pwd, $email)){
            $errors["empty_input"] = "Fill in all fields!";
        }

        require_once "config_session.inc.php";

        if($errors){
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                'username' => $username,
                'email' => $email,
            ];
            $_SESSION["signup_data"] = $signupData;

            // print out errors on index page
            header("Location: ../index.php");
            // exit script if errors true
            die();
        }




    } catch (PDOException $e) {

        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
    die();
}