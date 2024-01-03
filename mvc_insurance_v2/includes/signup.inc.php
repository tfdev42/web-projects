<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "./config_session.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ( ! isset($_SESSION["role_signup"])) {
        $_SESSION["role_signup"] = $_POST["role"];
        header("Location: ../index.php");
        exit();
    }

    if (isset($_POST["bt_signup"])) {
        $signupData = [];
        $signupFieldsReq = ["fname", "lname","email","pwd","street","city","country","zip"];
        
        if ($_SESSION["role_signup"] === 'customer'){
            $signupFieldsOpt = ["payment_option", "iban"];
            $signupFieldsReq = array_merge($signupFieldsReq, $signupFieldsOpt);
        }
        
        foreach($signupFieldsReq as $field){
            $signupData[$field] = isset($_POST[$field]) ? $_POST[$field] : "";
        }

        try {
            require_once "dbh.inc.php";
            require_once "signup_model.inc.php";
            require_once "signup_contr.inc.php";

            if(is_input_empty($signupData)){
                $errors["empty_input"] = "Fill in all fields!";
            }
           


            if($errors){
                $_SESSION["errors_signup"] = $errors;
                $errors = [];

                $_SESSION["signup_data"] = $signupData;
                $signupData = [];

                header("Location: ../index.php");
                die();
            }


        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

    }


} else {
    header("Location: ../index.php");
    die();
}

