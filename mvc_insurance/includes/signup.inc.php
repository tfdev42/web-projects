<?php
declare(strict_types=1);
require_once "config_session.inc.php";

error_reporting(E_ALL);
ini_set('display_errors', '1');






if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["role"])) {

    if ( ! isset($_SESSION["role_signup"])) {
        $_SESSION["role_signup"] = $_POST["role"];
        header("Location: signup.inc.php");
        exit();
    }    

    if (isset($_POST["bt_signup"])){
        $signupData = [];
        $formFields = ["fname", "lname","email","pwd","street","city","country","zip"];
        $paymentMethod = isset($_POST["payment_option"]) ? (int)$_POST['payment_option'] : null;
        
        
        

        try {
            require_once "dbh.inc.php";
            require_once "signup_model.inc.php";
            require_once "signup_contr.inc.php";

            $errors = [];
            $_SESSION["signup_data"] = [];

            foreach($formFields as $field){
                $signupData["$field"] = (isset($_POST["$field"])) ? $_POST["$field"] : null;
                $_SESSION["signup_data"]["$field"] = $signupData["$field"];
            }
            
            if (is_input_empty($signupData, $paymentMethod)){
                $errors["empty_input"] = "Fill in all fields!";
            }

            // if (is_email_invalid($signupData["email"])){
            //     $errors["invalid_email"] = "Invalid email used!";
            // }


            

            if(!empty($errors)){
                $_SESSION["errors_signup"] = $errors;
                $_SESSION["signup_data"] = $signupData;
                header("location: ../index.php");
                die();
            }


        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

        

    }else {
        header("Location: ../index.php");
        die();
    }
    // Error handling








}else {
    header("Location: ../index.php");
    die();
}
