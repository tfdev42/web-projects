<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "config_session.inc.php";

if ( ! empty([$_SESSION["user_id"]])){
    $userId = $_SESSION["user_id"];
    if(!isset($_SESSION["display"])){
        $_SESSION["display"] = "home";
    }
    

    try {
        require_once "dbh.inc.php";
        require_once "dashboard_model.inc.php";
        require_once "dashboard_contr.inc.php";

        $user = get_user_by_id($pdo, $userId);

        if ($user){
            $_SESSION["user_role"] = get_user_role($user);
        }

        if ($user) {
            $_SESSION["user_permissions"] = get_user_role_permissions($user);
        }

        $products = get_products($pdo);
        if ($products) {
            $_SESSION["products"] = $products;
        } else {
            $_SESSION["products"] = "no products yet!";
        }

        if($_SESSION["user_role"] === "customer"){
            $orders = get_customer_orders($pdo, $_SESSION["user_id"]);
            $_SESSION["customer_orders"] = $orders;
        }

        if($_SESSION["user_role"] === "agent"){
            $orders = get_agent_orders($pdo);
            $_SESSION["agent_orders"] = $orders;
        }

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("User query failed: " . $e->getMessage());
    }
    
} else {    
    header("Location: ../index.php");
    die();
}

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["show_orders"])){
    $_SESSION["display"] = "orders";
    header("Location: ../dashboard.php");
    die();
}

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["show_home"])){
    $_SESSION["display"] = "home";
    header("Location: ../dashboard.php");
    die();
}
