<?php
declare(strict_types=1);
require_once "./config_session.inc.php";

error_reporting(E_ALL);
ini_set('display_errors', '1');




if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ( ! isset($_SESSION["role_signup"])) {
        $_SESSION["role_signup"] = $_POST["role"];
        header("Location: ../index.php");
        exit();
    }

    if (isset($_POST["bt_signup"]) && isset($_SESSION["role_signup"])) {

        $signupFieldsOpt = [];

        if ($_SESSION["role_signup"] === "customer"){
            if ($_POST["payment_options_id"] === "2"){
                $signupFieldsOpt = ["payment_options_id", "iban"];
            } else {
                $signupFieldsOpt = ["payment_options_id"];
            }            
        }

        // if ($_SESSION["role_signup"] !== "customer"){
        //     $signupFieldsOpt["payment_options_id"] = null;
        //     $signupFieldsOpt["iban"] = null;
        // }
        
        $signupFieldsReq = ["fname", "lname","email","pwd","street","city","country","zip"];

        $signupFieldsReq = array_merge($signupFieldsReq, $signupFieldsOpt);

        foreach($signupFieldsReq as $field){
            $signupData[$field] = $_POST[$field];
        }

        $signupData["role_id"] = $_SESSION["role_signup"];
        

        try {
            require_once "dbh.inc.php";
            require_once "signup_model.inc.php";
            require_once "signup_contr.inc.php";
            
            switch_role_Str_to_ID($signupData);

            if(is_input_empty($signupData)){
                $errors["empty_input"] = "Fill in all fields!";
            }
           
            if(is_email_invalid($signupData["email"])){
                $errors["email_invalid"] = "Add a valid Email!";
            }

            if(is_email_taken($pdo, $signupData["email"])){
                $errors["email_taken"] = "Email is already registered";
            }

            // and other input handling functions come here

            if($errors){
                $_SESSION["errors_signup"] = $errors;
                $errors = array();

                switch_role_ID_to_Str($signupData);
                $_SESSION["signup_data"] = $signupData;
                $signupData = array();

                header("Location: ../index.php");
                die();
            }

            // create the User
            create_user($pdo, $signupData);

            header("Location: ../index.php?signup=success");
            $pdo = null;
            $stmt = null;
            unset_signup_form();
            die();


        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

    }


} else {
    header("Location: ../index.php");
    die();
}

