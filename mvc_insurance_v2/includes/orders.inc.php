<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "./config_session.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["bt_product_order"])){
    
        try {
            require_once "./dbh.inc.php";
            require_once "./orders_model.inc.php";
            require_once "./orders_contr.inc.php";

            if(is_input_empty($_POST["boat_registration_number"])){
                $errors["errors_order"] = "Boat registration number is missing!";
            }

            if($errors){
                $_SESSION["errors"] = $errors;
                $errors = null;
                header("Location: ../dashboard.php");
                die();
            }
            
            $_SESSION["product_id"] = $_POST["product_id"];
            $_SESSION["boat_registration_number"] = $_POST["boat_registration_number"];

            if (order_product($pdo, $_SESSION["user_id"], $_SESSION["product_id"], $_SESSION["boat_registration_number"])){
                $messages["order"] = "Order placed!";
            }

            $pdo = null;
            $stmt = null;
            $_SESSION["product_id"] = null;

            header("Location: ../dashboard.php");       


        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    
}