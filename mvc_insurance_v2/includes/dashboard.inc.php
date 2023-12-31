<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "config_session.inc.php";

if ( ! empty([$_SESSION["user_id"]])){
    $userId = $_SESSION["user_id"];

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

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("User query failed: " . $e->getMessage());
    }
    
} else {    
    header("Location: ../index.php");
    die();
}