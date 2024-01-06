<?php
declare(strict_types=1);
require_once "config_session.inc.php";


if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["user_id"])){
    
    $userId = $_SESSION["user_id"];


    try {
        require_once "dbh.inc.php";
        require_once "dashboard_model.inc.php";
        require_once "dashboard_contr.inc.php";
        // get_user_info(); if customer then:
        // get_billing_address();
        // get_cart();
        $user = get_user_by_id($pdo, $userId);
        
        // if ($user){
        //     $_SESSION["user_role"] = get_user_role($user);
        //     $_SESSION["user_permissions"] = get_user_role_permissions($user);
        // }
        $_SESSION["user"] = $user;
        die();
        


    } catch (PDOException $e) {

        die("Query failed: " . $e->getMessage());

    }
    

} else {
    header("location: ../index.php");
    die();
}